<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/SheetJS/js-xlsx/master/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/signature_pad"></script>


<script>
    $(document).ready(function() {

        var login_alert;
        var canvasElement = document.getElementById('driver_signature');
        if (canvasElement) {
            var signaturePad = new SignaturePad(canvasElement);
            document.getElementById('clear-btn').addEventListener('click', function () {
                signaturePad.clear();
                });
        }
      
        function updateFormFields() {
            const rows = $("#table_address tbody tr");
            const startAddressSelect = $("#start_address");
            const endAddressSelect = $("#end_address");

            startAddressSelect.empty();
            endAddressSelect.empty();

            const firstRow = rows.first();
            const lastRow = rows.last();

            const firstAddress = firstRow.find("td:nth-child(2)").text();
            const lastAddress = lastRow.find("td:nth-child(2)").text();

            startAddressSelect.append($("<option>", {
                value: firstAddress,
                text: firstAddress
            }));

            endAddressSelect.append($("<option>", {
                value: lastAddress,
                text: lastAddress
            }));
        }

        updateFormFields();

        // Draggable and Sortable functionality
        // $(".draggable-row").draggable({
        //     cursor: "grab",
        //     axis: "y",
        //     handle: "td:first-child",
        //     opacity: 0.6,
        //     containment: "parent",
        //     start: function(event, ui) {
        //         $(this).addClass("dragging");
        //     },
        //     stop: function(event, ui) {
        //         $(this).removeClass("dragging");
        //         updateFormFields(); 
        //     }
        // });

        // $("tbody").sortable({
        //     cursor: "move",
        //     axis: "y",
        //     handle: "td:first-child",
        //     opacity: 0.6,
        //     containment: "parent",
        //     update: function(event, ui) {
        //         updateFormFields(); 
        //     }
        // });
        $("tbody").sortable({
            cursor: "move",
            handle: ".first-column", // This specifies the handle to be the first column
            update: function(event, ui) {
                updateFormFields();
            },
        }).disableSelection();

        $(document).on('click', '.delete-row', function() {
            const row = $(this).closest('tr');
            row.fadeOut(600, function() {
                row.remove();
                updateFormFields();
            });

        });

        $(document).on('click', '.edit-icon', function() {
            const row = $(this).closest('tr');
            const rowIndex = row.index();
            const title = row.find('td:nth-child(2)').text().trim();
            const description = row.find('td:nth-child(3)').text().trim();
            const hasPicture = row.find('input[name="picture"]').is(':checked');
            const hasSignature = row.find('input[name="signature"]').is(':checked');
            const hasNote = row.find('input[name="note"]').is(':checked');

            $('#addressTile').val(title);
            $('#addressDesc').val(description);
            $('#addressPicture').prop('checked', hasPicture);
            $('#addressSignature').prop('checked', hasSignature);
            $('#addressNote').prop('checked', hasNote);

            $('#btn_address_detail').attr('data-row-index', rowIndex);

            $('#addAddressModal').modal('show');
        });

        $('#importAddress').on('change', function() {
            excelImport()
        });

        function excelImport() {
            const input = document.getElementById("importAddress");
            const reader = new FileReader();
            reader.onload = function(event) {
                console.log(event.target.result);
                const workbook = XLSX.read(event.target.result, {
                    type: 'binary'
                });
                const first_sheet_name = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[first_sheet_name];
                const json = XLSX.utils.sheet_to_json(worksheet, { raw: true });
                console.log(json);

                // Loop through the JSON data and create table rows
                for (let i = 0; i < json.length; i++) {
                    const address = json[i].address;
                    const description = json[i].description;
                    const picture = json[i].picture === 1;
                    const signature = json[i].signature === 1;
                    const note = json[i].note === 1;
                    var addressResult;
                        verifyAddress(address)
                            .then(function(result) {
                                addressResult = result;
                                insert_table_row(address, description, picture, signature, note, addressResult);
                                console.log(result); // "Valid" or "Invalid"
                            })
                            .catch(function(error) {
                                result = ''
                                insert_table_row(address, description, picture, signature, note, result);
                                console.error(error);
                            });        
                }
            };
            reader.readAsBinaryString(input.files[0]);
        }

        function insert_table_row(addressName, addressDesc, picture, signature, note, addressResult) {
            
            addressName = addressName || '';
            addressDesc = addressDesc || '';
            picture = picture || false;
            signature = signature || false;
            note = note || false;
            addressResult = addressResult || false;

                    var newRow = '<tr>\
                                        <td class="draggable-row first-column">\
                                            <svg width="30" height="40"  viewBox="0 0 25 12" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                <circle cx="19" cy="6" r="5.5" stroke="#230B34" />\
                                                <circle cx="1.875" cy="2.25" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="2.25" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="1.875" cy="6" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="6" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="1.875" cy="9.75" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="9.75" r="1.25" fill="#9FA2B4" />\
                                            </svg>\
                                        </td>\
                                        <td class="address-name text-wrap" >' + addressName + '</td>\
                                        <td class="text-wrap">' + addressDesc + '</td>\
                                        <td>\
                                            <input type="checkbox" name="picture" ' + (picture ? 'checked' : '') + ' id="picture">\
                                        </td>\
                                        <td>\
                                            <input type="checkbox" name="signature" ' + (signature ? 'checked' : '') + ' id="signature">\
                                        </td>\
                                        <td>\
                                            <input type="checkbox" name="note" ' + (note ? 'checked' : '') + ' id="note">\
                                        </td>\
                                        <td><div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 24px; padding-right: 23px; background-color: ' + (addressResult ? '#31A6132E' : '#F3E8E9') + ' ; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex"><div style="text-align: center; color: ' + (addressResult ? '31A613' : '#D11A2A') + ' ; font-size: 14px; font-weight: 500; word-wrap: break-word">' + (addressResult ? 'Valid' : 'Invalid') + '</div></div></td>\
                                        <td>\
                                        <button type="button" class="btn p-0 edit-icon " >\
                                                \<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />\
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#452C88" />\
                                                </svg>\
                                            </button>\
                                            <button type="button" class="btn p-0 delete-row">\
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />\
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.491 13.743C23.7361 13.743 23.9401 13.9465 23.9401 14.2054V14.4448C23.9401 14.6975 23.7361 14.9072 23.491 14.9072H13.0498C12.8041 14.9072 12.6001 14.6975 12.6001 14.4448V14.2054C12.6001 13.9465 12.8041 13.743 13.0498 13.743H14.8867C15.2599 13.743 15.5846 13.4778 15.6685 13.1036L15.7647 12.6739C15.9142 12.0887 16.4062 11.7 16.9693 11.7H19.5709C20.1278 11.7 20.6253 12.0887 20.7693 12.6431L20.8723 13.1029C20.9556 13.4778 21.2803 13.743 21.6541 13.743H23.491ZM22.5578 22.4943C22.7496 20.707 23.0853 16.4609 23.0853 16.418C23.0976 16.2883 23.0553 16.1654 22.9714 16.0665C22.8813 15.9739 22.7673 15.9191 22.6417 15.9191H13.9033C13.7771 15.9191 13.657 15.9739 13.5737 16.0665C13.4891 16.1654 13.4474 16.2883 13.4536 16.418C13.4547 16.4259 13.4667 16.5755 13.4869 16.8255C13.5764 17.9364 13.8256 21.0303 13.9866 22.4943C14.1006 23.5729 14.8083 24.2507 15.8333 24.2753C16.6243 24.2936 17.4392 24.2999 18.2725 24.2999C19.0574 24.2999 19.8545 24.2936 20.67 24.2753C21.7306 24.257 22.4377 23.5911 22.5578 22.4943Z" fill="#D11A2A" />\
                                                </svg>\
                                            </button>\
                                            <button type="button"  class="btn btnView-address p-0" data-toggle="modal" data-target="#viewlocation" >\
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#E45F00" />\
                                                    <rect x="12" y="12" width="12" height="12" fill="url(#pattern0)" />\
                                                    <defs>\
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">\
                                                            <use xlink:href="#image0_360_2649" transform="scale(0.00195312)" />\
                                                        </pattern>\
                                                        <image id="image0_360_2649" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFFmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDYwLCAyMDIwLzA1LzEyLTE2OjA0OjE3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMiAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTAzLTI3VDEyOjQwOjAyKzA1OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpmYmMzMWNhOS01MjQzLTM4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" />\
                                                    </defs>\
                                                </svg>\
                                            </button>\
                                        </td>\
                                    </tr>';
                    $('#importAddress').val('');
                    $('#table_address').append(newRow);
                    updateFormFields();
                    // $('#addAddressModal').removeClass('show');
        }

        $(".draggable-modal").draggable({
            cursor: "grab",
            handle: ".modal-header"
        });

        // adding address from the add address
        $(document).on('click', '#btn_address_detail', function() {
            var addressName = $('#addressTile').val();
            var addressDesc = $('#addressDesc').val();
            if (addressName === '' || addressDesc === '') {
                (addressName === '') ? $('.validation-error-title').empty().append('<label class="text-danger">*Address name is required</label>') : $('.validation-error-title').empty();
                (addressDesc === '') ? $('.validation-error-desc').empty().append('<label class="text-danger">*Address description is required</label>') : $('.validation-error-desc').empty();
            } else {
                $('.validation-error-title').empty();
                $('.validation-error-desc').empty();
                $('#btn_address_detail').prop('disabled', true);
                
                var addressResult;
                verifyAddress(addressName)
                    .then(function(result) {
                        addressResult = result;
                        tableRow(result);
                        console.log(result); // "Valid" or "Invalid"
                    })
                    .catch(function(error) {
                        result = '';
                        tableRow(result);
                        console.error(error);
                    });

            }

        });

        function tableRow(addressResult) {
            var addressName = $('#addressTile').val();
            var addressDesc = $('#addressDesc').val();
            var picture = $('#addressPicture').is(':checked');
            var signature = $('#addressSignature').is(':checked');
            var note = $('#addressNote').is(':checked');

            var rowIndex = $('#btn_address_detail').attr('data-row-index');
            if (rowIndex) {
                // Update existing row
                var row = $('#table_address tbody tr').eq(rowIndex);
                row.find('td:nth-child(2)').text(addressName);
                row.find('td:nth-child(3)').text(addressDesc);
                row.find('input[name="picture"]').prop('checked', picture);
                row.find('input[name="signature"]').prop('checked', signature);
                row.find('input[name="note"]').prop('checked', note);
                row.find('td:nth-child(7)').html('<div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 24px; padding-right: 23px; background-color: ' + (addressResult ? '#31A6132E' : '#F3E8E9') + ' ; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex"><div style="text-align: center; color: ' + (addressResult ? '31A613' : '#D11A2A') + ' ; font-size: 14px; font-weight: 500; word-wrap: break-word">' + (addressResult ? 'Valid' : 'Invalid') + '</div></div>');
            }
            else {
                    var newRow = '<tr>\
                                        <td class="draggable-row first-column">\
                                            <svg width="30" height="40"  viewBox="0 0 25 12" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                <circle cx="19" cy="6" r="5.5" stroke="#230B34" />\
                                                <circle cx="1.875" cy="2.25" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="2.25" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="1.875" cy="6" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="6" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="1.875" cy="9.75" r="1.25" fill="#9FA2B4" />\
                                                <circle cx="5.625" cy="9.75" r="1.25" fill="#9FA2B4" />\
                                            </svg>\
                                        </td>\
                                        <td class="address-name text-wrap">' + addressName + '</td>\
                                        <td class="text-wrap">' + addressDesc + '</td>\
                                        <td>\
                                            <input type="checkbox" name="picture" ' + (picture ? 'checked' : '') + ' id="picture">\
                                        </td>\
                                        <td>\
                                            <input type="checkbox" name="signature" ' + (signature ? 'checked' : '') + ' id="signature">\
                                        </td>\
                                        <td>\
                                            <input type="checkbox" name="note" ' + (note ? 'checked' : '') + ' id="note">\
                                        </td>\
                                        <td><div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 24px; padding-right: 23px; background-color: ' + (addressResult ? '#31A6132E' : '#F3E8E9') + ' ; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex"><div style="text-align: center; color: ' + (addressResult ? '31A613' : '#D11A2A') + ' ; font-size: 14px; font-weight: 500; word-wrap: break-word">' + (addressResult ? 'Valid' : 'Invalid') + '</div></div></td>\
                                        <td>\
                                        <button type="button" class="btn p-0 edit-icon" data-toggle="modal" data-target="#edittrip">\
                                                \<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />\
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#452C88" />\
                                                </svg>\
                                            </button>\
                                            <button type="button" class=" delete-row btn p-0">\
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />\
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.491 13.743C23.7361 13.743 23.9401 13.9465 23.9401 14.2054V14.4448C23.9401 14.6975 23.7361 14.9072 23.491 14.9072H13.0498C12.8041 14.9072 12.6001 14.6975 12.6001 14.4448V14.2054C12.6001 13.9465 12.8041 13.743 13.0498 13.743H14.8867C15.2599 13.743 15.5846 13.4778 15.6685 13.1036L15.7647 12.6739C15.9142 12.0887 16.4062 11.7 16.9693 11.7H19.5709C20.1278 11.7 20.6253 12.0887 20.7693 12.6431L20.8723 13.1029C20.9556 13.4778 21.2803 13.743 21.6541 13.743H23.491ZM22.5578 22.4943C22.7496 20.707 23.0853 16.4609 23.0853 16.418C23.0976 16.2883 23.0553 16.1654 22.9714 16.0665C22.8813 15.9739 22.7673 15.9191 22.6417 15.9191H13.9033C13.7771 15.9191 13.657 15.9739 13.5737 16.0665C13.4891 16.1654 13.4474 16.2883 13.4536 16.418C13.4547 16.4259 13.4667 16.5755 13.4869 16.8255C13.5764 17.9364 13.8256 21.0303 13.9866 22.4943C14.1006 23.5729 14.8083 24.2507 15.8333 24.2753C16.6243 24.2936 17.4392 24.2999 18.2725 24.2999C19.0574 24.2999 19.8545 24.2936 20.67 24.2753C21.7306 24.257 22.4377 23.5911 22.5578 22.4943Z" fill="#D11A2A" />\
                                                </svg>\
                                            </button>\
                                            <button type="button" class="btn btnView-address p-0" data-toggle="modal" data-target="#viewlocation" >\
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#E45F00" />\
                                                    <rect x="12" y="12" width="12" height="12" fill="url(#pattern0)" />\
                                                    <defs>\
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">\
                                                            <use xlink:href="#image0_360_2649" transform="scale(0.00195312)" />\
                                                        </pattern>\
                                                        <image id="image0_360_2649" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFFmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDYwLCAyMDIwLzA1LzEyLTE2OjA0OjE3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMiAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTAzLTI3VDEyOjQwOjAyKzA1OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpmYmMzMWNhOS01MjQzLTM4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" />\
                                                    </defs>\
                                                </svg>\
                                            </button>\
                                        </td>\
                                    </tr>';

                    $('#table_address').append(newRow);
            }       
                    $('#addressTile').val('');
                    $('#addressDesc').val('');
                    $('#addressPicture').prop('checked', false);
                    $('#addressSignature').prop('checked', false);
                    $('#addressNote').prop('checked', false);
                    $('#btn_address_detail').prop('disabled', false).attr('data-row-index','');
                    updateFormFields();
                    // $('#addAddressModal').removeClass('show');
        };
      
        function verifyAddress(address) {
            return new Promise(function(resolve, reject) {
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    address: address
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var formattedAddress = results[0].formatted_address;
                        var isValidAddress = isAddressValid(results[0]);

                        if (isValidAddress) {
                            resolve("Valid");
                        } else {
                            resolve("Invalid");
                        }
                    } else {
                        reject("Geocoding failed. Status: " + status);
                    }
                });
            });
        }

        function isAddressValid(result) {
            if (result.address_components && result.address_components.length > 0) {
                if (result.formatted_address) {
                    return true;
                }
            }
            return false;
        }

        //login user through API .... 
        $('#login-form').on('submit', function(e) {

            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            if (email === '' || password === '') {
                (email === '') ? $('.validation-error-email').empty().append('<label class="text-danger">* email is required</label>') : $('.validation-error-email').empty();
                (password === '') ? $('.validation-error-password').empty().append('<label class="text-danger">* password  is required</label>') : $('.validation-error-password').empty();
            } 
            else {
                $('.validation-error-email').empty();
                $('.validation-error-password').empty();
                $('#btn_user_login').prop('disabled', true);

                var apiurl = $(this).attr('action');
                var csrfToken = '{{ csrf_token() }}';
                var formData = {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: csrfToken
                };

                $.ajax({

                    url: "/" + apiurl,
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        $('#spinner').removeClass('d-none');
                        $('#text').addClass('d-none');
                        showlogin('Wait', 'User Login...');
                    },
                    success: function(response) {
                      
                        $('#btn_user_login').prop('disabled', false);;
                        var responseArray = JSON.parse(response);
                        console.log(responseArray);
                        $('#text').removeClass('d-none');
                        $('#spinner').addClass('d-none');
                        if (responseArray.status === 'success') {
                            showAlert("Success", "Login Successfully", "success");
                            
                            setTimeout(function() {
                                window.location.replace('/');
                            }, 1200);
                        } 
                        else if(responseArray.status === 'error'){ 
                        // console.log(response.message);
                            $('.error-label').remove();
                            $.each(responseArray.message, function(field, errorMessages) {
                                $.each(errorMessages, function(index, errorMessage) {
                                    (field == 'email') ? $('.validation-error-email').empty().append('<label class="text-danger">*'+errorMessage+'</label>') : $('.validation-error-email').empty();
                                    (field == 'password') ? $('.validation-error-password').empty().append('<label class="text-danger">*'+errorMessage+'</label>') : $('.validation-error-password').empty();
                                });
                            });

                        }
                        else {
                            showAlert(responseArray.status, responseArray.message, "warning");
                        }
                    },

                    error: function(xhr, status, error) {
                        $('#btn_user_login').prop('disabled', false);
                        $('#spinner').addClass('d-none');
                        $('#text').removeClass('d-none');
                        // console.error(xhr.responseText);
                        showAlert("Error", "Please contact your admin", "warning");
                    }

                });
        }
        });

        // saving trip in through the api...
        $(document).on('submit', '#saveTrip', function(e) {

            e.preventDefault();
            var apiname = $(this).attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var bearerToken = "{{session('user')}}";

            const rowData = [];
            const invalidAddresses = [];

            const form = $(this);
            const table = form.find('table');
            
            table.find('tbody tr').each(function() {

                const row = $(this);
                const cells = row.find("td").not(":last");
                const rowValues = {};

                cells.each(function(index) {
                    let fieldName;
                    if (index === 0) {
                        fieldName = "id";
                    } else if (index === 1) {
                        fieldName = "title";
                    } else if (index === 2) {
                        fieldName = "desc";
                    } else if (index === 6) {
                        fieldName = "status";
                    } else {
                        fieldName = 'field' + (index + 1);
                    }
                    const cellValue = $(this).text().trim();

                    if (index === 6 && cellValue === 'Invalid') {
                        const addressTitle = rowValues.title || '';
                        invalidAddresses.push(addressTitle);
                    } else {
                        rowValues[fieldName] = cellValue;
                    }
                });

                const checkboxes = row.find("input[type=checkbox]");
                checkboxes.each(function(index) {
                    let checkboxName;
                    if (index === 0) {
                        checkboxName = "trip_pic";
                    } else if (index === 1) {
                        checkboxName = "trip_signature";
                    } else if (index === 2) {
                        checkboxName = "trip_note";
                    }
                    const checkboxValue = $(this).is(":checked") ? 1 : 0;
                    rowValues[checkboxName] = checkboxValue;
                });

                // Remove unwanted fields
                delete rowValues.field4;
                delete rowValues.field5;
                delete rowValues.field6;
                // delete rowValues.field1;

                rowData.push(rowValues);
            });

            if (invalidAddresses.length > 0) {
                var alertMessage = 'Invalid addresses detected Correct or Remove these :\n';
                for (var i = 0; i < invalidAddresses.length; i++) {
                    alertMessage += (i + 1) + '. ' + invalidAddresses[i] + '\n';
                }
                alert(alertMessage);
                return;
            }


            const formInputs = {};
            $(this).find('input[name], textarea[name], select[name]').each(function() {
                const inputName = $(this).attr('name');
                const inputValue = $(this).val().trim();
                formInputs[inputName] = inputValue;
            });

            delete formInputs.picture;
            delete formInputs.signature;
            delete formInputs.note;

            const payload = {
                address: rowData,
                trip_detail: formInputs
            };


            $.ajax({
                url: apiurl,
                type: 'POST',
                data: JSON.stringify(payload),
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + bearerToken
                },
                beforeSend: function() {

                    $('#btn_address_detail').prop('disabled', true);
                    $('#spinner').removeClass('d-none');
                    $('#btn_address_detail ').addClass('d-none');
                    showlogin('Wait', 'saving......');
                },
                success: function(response) {

                    $(' #btn_address_detail .btn_spinner').addClass('d-none');
                    $('#btn_address_detail').prop('disabled', false);

                    if (response.status === 'success') {
                        $('#addclient').modal('hide');
                        showAlert("Success", response.message, response.status);
                        
                        setTimeout(function() {
                            window.location.href = document.referrer;
                        }, 1500);

                    } else {
                        showAlert("Warning", response.message, response.status);
                    }

                },
                error: function(xhr, status, error) {
                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none');
                    showAlert("Error", response.message, response.status);
                }
            });
        });

        // Adding  data in through the api...
        $('#formData').on('submit', function(e) {

            e.preventDefault();
            var button = $(this);
            var spinner = button.find('.btn_spinner');
            var buttonText = button.find('#text');

            button.prop('disabled', true);
            spinner.removeClass('d-none');
            buttonText.addClass('d-none');

            var apiname = $(this).attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var formData = new FormData(this);
            var bearerToken = "{{session('user')}}";
            $.ajax({
                url: apiurl,
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                },
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#spinner').removeClass('d-none');
                    $('#add_btn').addClass('d-none');
                    showlogin('Wait', 'saving......');
                },
                success: function(response) {

                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none').prop('disabled', false);

                    if (response.status === 'success') {

                        // $('#formData')[0].reset();
                        
                        const lastSegment = location.href.substring(location.href.lastIndexOf("/") + 1);
                        
                        if(lastSegment =='settings' || lastSegment == 'announcements'){
                            setTimeout(function() {
                                window.location.href = window.location.href;
                            }, 1500);
                        }else{
                            $('#tableData').load(location.href + " #tableData > *");
                            $('#formData').load(location.href + " #formData > *");
                            $('#closeicon').trigger('click');
                        }
                       
                        $('#addclient').modal('hide');
                        showAlert("Success", response.message, response.status);
                        // $('#formData').trigger('reset');
                    }
                    
                    else if(response.status === 'error'){
                       
                        showAlert("Warning", "Please fill the form correctly", response.status);
                        console.log(response.message);
                        $('.error-label').remove();

                        $.each(response.message, function(field, errorMessages) {
                            var inputField = $('input[name="' + field + '"]');

                            $.each(errorMessages, function(index, errorMessage) {
                                var errorLabel = $('<label class="error-label text-danger">* ' + errorMessage + '</label>');
                                inputField.addClass('error');
                                inputField.after(errorLabel);
                            });
                        });

                    }
                },
                error: function(xhr, status, error) {
                    console.log(status);

                    spinner.addClass('d-none');
                    buttonText.removeClass('d-none');
                    button.prop('disabled', false);
                    showAlert("Error", 'Request Can not Procceed', 'Can not Procceed furhter');
                }
            });
        });

        // Delete users  data in through the api...
        $('#DeleteData').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var button = form.find('.btn_deleteUser');
            var spinner = button.find('.btn_spinner');
            var buttonText = button.find('#add_btn');

            var apiname = $(this).attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var formData = new FormData(this);
            var bearerToken = "{{session('user')}}";
            
            $.ajax({
                url: apiurl,
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                },
                contentType: false,
                processData: false,
                beforeSend: function() {
                    button.prop('disabled', true);
                    spinner.removeClass('d-none');
                    buttonText.addClass('d-none');
                    // showlogin('Wait', 'saving......');
                },
                success: function(response) {

                    button.prop('disabled', false);
                    spinner.addClass('d-none');
                    buttonText.removeClass('d-none');

                    if (response.status === 'success') {
                        $('#DeleteData')[0].reset();
                        if(response.tripDleted){
                            if(response.tripDleted == 'yes'){
                                $('#routes-table').load(location.href + " #routes-table > *");
                                $('#deleteroute').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        }
                        if(response.announcementDeleted){
                            if(response.announcementDeleted == 'yes'){
                                $('#users-table').load(location.href + " #users-table > *");
                                $('#deleteAnnoncement').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        }
                        if(response.packageDeleted){
                            if(response.packageDeleted == 'yes'){
                                $('#users-table').load(location.href + " #users-table > *");
                                $('#deletePackage').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        }
                        else{
                            if(response.role ==3){
                                $('#drivers-table').load(location.href + " #drivers-table > *");
                            }else{
                                $('#users-table').load(location.href + " #users-table > *");
                            }
                                $('#closeicon').trigger('click');
    
                            $('#userDeleteModal').modal('hide');
                            showAlert("Success", response.message, response.status);
                            
                            if(response.logout){
                              setTimeout(function() {
                                window.location.href = '/logout';
                              }, 2000);
                            }
                        }
                    }
                    
                    else if(response.status === 'error'){
                    
                        showAlert("Warning", "Please fill the form correctly", response.status);
                        console.log(response.message);
                        $('.error-label').remove();

                        $.each(response.message, function(field, errorMessages) {
                            var inputField = $('input[name="' + field + '"]');

                            $.each(errorMessages, function(index, errorMessage) {
                                var errorLabel = $('<label class="error-label text-danger">* ' + errorMessage + '</label>');
                                inputField.addClass('error');
                                inputField.after(errorLabel);
                            });
                        });

                    }
                },
                error: function(xhr, status, error) {
                    console.log(status);

                    button.prop('disabled', false);
                    spinner.addClass('d-none');
                    buttonText.removeClass('d-none');
                    showAlert("Error", 'Request Can not Procceed', 'Can not Procceed furhter');
                }
            });
        });
    
        // check the ongoing address ??
        function ongoing_address(complete_alert = 'yes') {
            var end_trip = []; 

            $(".draggable").each(function() {
                let addressSt = $(this).find('input[data-address-status]').attr('data-address-status');
                let tripPic = $(this).find('input[data-trip-pic]').attr('data-trip-pic');
                let tripSignature = $(this).find('input[data-trip-signature]').attr('data-trip-signature');
                let tripNote = $(this).find('input[data-trip-note]').attr('data-trip-note');
                let waypoint_title = $(this).find('input[data-address-title]').attr('data-address-title');
                let waypoint_desc = $(this).find('input[data-address-desc]').attr('data-address-desc');

                if (addressSt == 1) {
                    
                    $("#way_point_title").text(waypoint_title);
                    $("#text_address-desc").text(waypoint_desc);

                    let addressId = this.id.replace("address_card_", "");
                    if(addressId){
                        $('#complete_add_id').val(addressId);
                    }

                    if (tripPic == 1) {
                        $("#pic_required").removeClass('d-none');
                        $('#required-fields').attr('data-trip-pic','1');                        
                    } else {
                        $("#pic_required").addClass('d-none');
                        $('#required-fields').attr('data-trip-pic','0');
                    }

                    if (tripSignature == 1) {
                        $("#signature_required").removeClass('d-none');
                        $('#required-fields').attr('data-trip-signature','1');
                    } else {
                        $("#signature_required").addClass('d-none');
                        $('#required-fields').attr('data-trip-signature','0');
                    }

                    if (tripNote == 1) {
                        $("#note_required").removeClass('d-none');
                        $('#required-fields').attr('data-trip-note','1');
                    } else {
                        $("#note_required").addClass('d-none');
                        $('#required-fields').attr('data-trip-note','0');
                    }

                    end_trip.push('no');
                } 
                else if (addressSt == 2) {
                    end_trip.push('no');
                }
                else {
                    end_trip.push('yes');
                }
            });

            if (end_trip.includes('no')) {
                $("#btn-optimize_address").removeClass('d-none');
                $("#btn-update_address").removeClass('d-none');
                return 'no';
            } else {
                if(complete_alert == 'yes'){
                    showAlert("Trip Completed", "Click on the 'End Trip' to Exit safely!", 'success');
                    $("#way_point_title").text('');
                    $("#text_address-desc").text('');
                    $("#pic_required").addClass('d-none');
                    $("#signature_required").addClass('d-none');
                    $("#note_required").addClass('d-none');
                    $("#btn-optimize_address").addClass('d-none');
                    $("#btn-update_address").addClass('d-none');
                    $('#btn-next_waypoint').attr('data-address_id','').addClass('d-none');
                    $('#btn-waypoint_details').attr('data-address_id','').addClass('d-none');
                    $('#btn-complete_waypoint').attr('data-address_id','').addClass('d-none');
                    $('#nextpointmodal').modal('hide');
                    $('#btn-next_waypoint').modal('hide');
                }

                return 'yes';
            }
        }

        function disable_dragable() {
            // Remove event listeners
            var draggableItems = document.querySelectorAll('.draggablecards');
            draggableItems.forEach(function (item) {
                item.removeEventListener('dragstart', handleDragStart, false);
                item.removeEventListener('dragover', handleDragOver, false);
                item.removeEventListener('dragleave', handleDragLeave, false);
                item.removeEventListener('drop', handleDrop, false);
            });

            // Remove 'dragging' class from any element that has it
            var draggingItems = document.querySelectorAll('.dragging');
            draggingItems.forEach(function (item) {
                item.classList.remove('dragging');
            });
            $('[id^="address_card_"]').removeClass('draggablecards');

        }

        $(document).on('click', '#btn-add-newAddress', function() {
            $('#addressTile').val('');
            $('#addressDesc').val('');
            $('#addressPicture').prop('checked', false);
            $('#addressSignature').prop('checked', false);
            $('#addressNote').prop('checked', false);
            $('#btn_address_detail').prop('disabled', false).attr('data-row-id','');
            $('#addAddressModal').modal('show');
        });

        // deleting users ... calling modals
        $(document).on('click', '#btn_dell_user', function() {
            let user_id = $(this).attr('data-id');
            $('#userDeleteModal #user_id').val(user_id);
            $('#userDeleteModal').modal('show');
        });

        // deleting trips ... calling modals
        $(document).on('click', '.delete_rotues', function() {
            let trip_id = $(this).attr('data-id');
            $('#deleteroute #trip_id').val(trip_id);
            $('#deleteroute').modal('show');
        });

        // deleting announcement ... calling modals
        $(document).on('click', '.btn_dell_announcement', function() {
            let announcement_id = $(this).attr('data-id');
            $('#deleteAnnoncement #annoucement_id').val(announcement_id);
            $('#deleteAnnoncement').modal('show');
        });

                // deleting packages ... calling modals
        $(document).on('click', '.btn_dell_package', function() {
            let package_id = $(this).attr('data-id');
            $('#deletePackage #package_id').val(package_id);
            $('#deletePackage').modal('show');
        });


        // Updating trip status in through the api...
        $('.status_update').on('submit', function(e) {
            e.preventDefault();

            var form = $(this); // Get the form element
            var apiname = form.attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var bearerToken = "{{session('user')}}";

            var formData = new FormData(this);
            var skipedAddressDescValue = formData.get('skiped_address_desc');

            if(skipedAddressDescValue === ''){
                $('#error_message').text('*This field is required. Please write a reason.').show();
            }
            else{ 
                $('#error_message').text('*This field is required. Please write a reason.').hide();
                
                $.ajax({
                    url: apiurl,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'Authorization': 'Bearer ' + bearerToken
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('.btn_statusUpdate').prop('disabled', true);
                        form.find('.btn_statusUpdate #spinner').removeClass('d-none');
                    },
                    success: function(response) {
                        form.find('.btn_statusUpdate #spinner').addClass('d-none');
                        form.find('.btn_statusUpdate').prop('disabled', false);

                        if (response.status === 'success') {
                            form[0].reset();

                            if(response.data.tripStarted == 'yes'){
                                $('#btn-optimize_address').hide();
                                $('#btn-update_address').hide();  
                                disable_dragable();                          
                            }
                            
                            if(response.data.waypoint){
                                if(response.data.waypoint.address_status == 4) {
                                    $('#skipwaypointmodal').modal('hide');
                                }
                                else if(response.data.waypoint.address_status == 3) {
                                    $('#completepointmodal').modal('hide');
                                }
                                else if(response.data.waypoint.address_status == 1) {
                                    $('#nextpointmodal').modal('hide');
                                    $('#btn_start-trip').replaceWith('<button id="btn_started-trip" class="btn btn-warning text-white btn-md"><span>Trip Started</span></button>');
                                    $('#btn_status-close').trigger('click');
                                    
                                }      
                                else if(response.data.ongoing){
                                $('#btn_start-trip').replaceWith('<button id="btn_started-trip" class="btn btn-warning text-white btn-md"><span>Trip Started</span></button>');
                                $('#btn_status-close').trigger('click');
                            }
                            }
                            else if(response.data.ongoing){
                                $('#btn_start-trip').replaceWith('<button id="btn_started-trip" class="btn btn-warning text-white btn-md"><span>Trip Started</span></button>');
                                $('#btn_status-close').trigger('click');
                            }
                            else if (response.data.endTrip == 'yes'){
                                $('#nextpointmodal').modal('hide');
                                $('#btn-next_waypoint').modal('hide');
                                ongoing_address();
                            }
                            else{
                                $('#btn-trip_manage').html('<button class="btn btn-sm text-white" style="background-color: #233A85; border-radius: 6px;">Trip Compelted</button>');
                                $('#tripend').modal('hide');
                                $('#btn_status-close').trigger('click');
                            }
                            

                        setTimeout(function () {

                            if(response.data.waypoint){

                                if(response.data.waypoint.address_status == 4) {
                                    let SkippedaddressId = response.data.waypoint.id;
                                    $('#address_card_' + SkippedaddressId).addClass('opacity-50');
                                    $('#address_card_' + SkippedaddressId + ' #span_address_status').text('Skipped');
                                    $('#address_card_' + SkippedaddressId + ' #svg_skip_address').removeClass('skip_address');
                                    $('#address_card_' + SkippedaddressId).find('input[data-address-status]').attr('data-address-status', '4'); 
                                    $('#address_card_' + SkippedaddressId).addClass('zoom-in');  
                                    

                                    setTimeout(function () {
                                            $('#address_card_' + SkippedaddressId).removeClass('zoom-in');
                                            if(response.data.activeAddress == 'yes'){
                                                $('#btn-waypoint_details').fadeOut('slow').attr('data-address_id','').addClass('d-none');
                                                $('#btn-next_waypoint').removeClass('d-none').attr('data-address_id',SkippedaddressId).fadeIn('fast');
                                            }
                                    }, 500);

                                    $("#snackbar").text('Address Successfully Skipped.');
                
                                    showtoast('#17a2b8');
                                }
                                
                                else if(response.data.waypoint.address_status == 3) {
                                    let CompletedAddressId = response.data.waypoint.id;
                                    $('#address_card_' + CompletedAddressId + ' #span_address_status').text('Completed');
                                    $('#address_card_' + CompletedAddressId + ' #svg_skip_address').removeClass('skip_address');
                                    $('#address_card_' + CompletedAddressId).find('input[data-address-status]').attr('data-address-status', '3'); 
                                    $('#address_card_' + CompletedAddressId).addClass('zoom-in'); 
                                    $('#btn-complete_waypoint').fadeOut('slow').attr('data-address_id','').addClass('d-none');
                                    $('#btn-next_waypoint').removeClass('d-none').attr('data-address_id',CompletedAddressId).fadeIn('fast'); 
                                    ongoing_address();

                                    setTimeout(function () {
                                            $('#address_card_' + CompletedAddressId).removeClass('zoom-in');
                                    }, 500);

                                    $("#snackbar").text(' Address Successfully Completed.');
                                    showtoast('#28a745');
                                }

                                else if (response.data.ongoing){
                                    let ongoingAddressId = response.data.ongoing.id;
                                    $('#address_card_' + ongoingAddressId + ' #span_address_status').text('On Going');
                                    $('#address_card_' + ongoingAddressId).find('input[data-address-status]').attr('data-address-status','1');
                                    ongoing_address();

                                    $('#address_card_' + ongoingAddressId).addClass('zoom-in');
                                    setTimeout(function () {
                                        $('#address_card_' + ongoingAddressId).removeClass('zoom-in');
                                        $('#btn-next_waypoint').fadeOut('slow').attr('data-address_id','').addClass('d-none');
                                        $('#btn-waypoint_details').removeClass('d-none').attr('data-address_id',ongoingAddressId).fadeIn('fast');
                                    }, 500);
                                }
                            }
                            else if (response.data.ongoing){
                                let ongoingAddressId = response.data.ongoing.id;
                                $('#address_card_' + ongoingAddressId + ' #span_address_status').text('On Going');
                                $('#address_card_' + ongoingAddressId).find('input[data-address-status]').attr('data-address-status','1');
                                ongoing_address();

                                $('#address_card_' + ongoingAddressId).addClass('zoom-in');
                                setTimeout(function () {
                                    $('#address_card_' + ongoingAddressId).removeClass('zoom-in');
                                    $('#btn-next_waypoint').fadeOut('slow').attr('data-address_id','').addClass('d-none');
                                    $('#btn-waypoint_details').removeClass('d-none').attr('data-address_id',ongoingAddressId).fadeIn('fast');
                                }, 500);
                            }

                            }, 500);
                        }
                        
                    },
                    error: function(xhr, status, error) {
                            console.log(error)
                    }
                });
            }

        });

        // Completing  address in through the api...
        $('#complete_waypoint').on('submit', function(e) {
            e.preventDefault();

            var requirment_filled = [];

            let pic_required = $('#required-fields').attr('data-trip-pic');
            let signature_required = $('#required-fields').attr('data-trip-signature');
            let note_required = $('#required-fields').attr('data-trip-note');
            
            var form = $(this); 
            var apiname = form.attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var bearerToken = "{{session('user')}}";

            var formData = new FormData(this);            

            if(pic_required == 1){
                let address_pic = formData.get('address_pic');
                if(address_pic && address_pic.size <= 0){
                    $('#error_message_pic').removeClass('d-none');
                    requirment_filled.push('no');
                }else{
                    $('#error_message_pic').addClass('d-none');
                    requirment_filled.push('yes');
                }        
            }            
            else{
                    requirment_filled.push('yes');
            }        

            if(signature_required == 1){
                if(signaturePad.isEmpty()){
                    $('#error_message_sigature').removeClass('d-none');
                    requirment_filled.push('no');
                }
                else{
                    const signatureDataUrl = signaturePad.toDataURL();
                    
                    // const downloadLink = document.createElement('a');
                    // downloadLink.href = signatureDataUrl;
                    // downloadLink.download = 'signature.png';
                    // document.body.appendChild(downloadLink);
                    // downloadLink.click();
                    // document.body.removeChild(downloadLink);

                    formData.set('driv_signature',signatureDataUrl);
                    $('#error_message_sigature').addClass('d-none');
                    requirment_filled.push('yes');
                }        
            }            
            else{
                    requirment_filled.push('yes');
            }        

            if(note_required == 1){
                let driv_note = formData.get('address_note');
                if(driv_note == ''){
                    $('#error_message_note').removeClass('d-none');
                    requirment_filled.push('no');
                }else{
                    $('#error_message_note').addClass('d-none');
                    requirment_filled.push('yes');
                }        
            }
            else{
                    requirment_filled.push('yes');
            }        

            if(!requirment_filled.includes('no')){

                    $.ajax({
                        url: apiurl,
                        type: 'POST',
                        data: formData,
                        headers: {
                            'Authorization': 'Bearer ' + bearerToken
                        },
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            form.find('.btn_statusUpdate').prop('disabled', true);
                            form.find('.btn_statusUpdate #spinner').removeClass('d-none');
                        },
                        success: function(response) {
                            form.find('.btn_statusUpdate #spinner').addClass('d-none');
                            form.find('.btn_statusUpdate').prop('disabled', false);
    
                            if (response.status === 'success') {
                                console.log(response.data.waypoint);
                                if (response.data.waypoint.id) {
                                    $('#btn_complete_add').trigger('click');
                                    form[0].reset();
                                    $('#clear-btn').trigger('click');
                                    $('.upload-text').text('Upload Image')
                                    $('#btn-waypoint_details').fadeOut('slow').attr('data-address_id','').addClass('d-none');
                                    $('#btn-complete_waypoint').removeClass('d-none').attr('data-address_id',response.data.waypoint.id).fadeIn('fast');
                                    $('.close').trigger('click');
                                    
                                    $("#snackbar").text('Address  details Added Successfully. ');
                                    showtoast('#28a745');
                                }
    
                            }
                            
                        },
                        error: function(xhr, status, error) {
                                console.log(error)
                        }
                    });
            }

        });

        // get api .....
        $(document).on('click', '#btn_edit_client', function() {
            var id = $(this).data('client_id');
            var apiname = $(this).data('api_name');
            var apiurl = "{{ end_url('') }}" + apiname;
            var bearerToken = "{{session('user')}}";
            $.ajax({
                url: apiurl + '?id=' + id,
                type: 'GET',
                data: {
                    'id': id
                },
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                },
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#addclient #btn_save').css('background-color', '#233A85');
                    $('#addclient').modal('show');
                    $('#btn_save #spinner').removeClass('d-none');
                    $('#btn_save #add_btn').addClass('d-none');
                    // showlogin('Wait', 'loading......');
                },
                success: function(response) {
 
                    if (response.status === 'success') {
                        
                        let responseData = response.data[0];
                        let formattedDateTime = moment(responseData.created_at).format("YYYY-MM-DDTHH:mm");
                        $('#addclient #btn_save').html('<div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div><span id="add_btn">'+ "{{ trans('lang.save') }}"+'</span>').css('background-color', '#233A85');
                        if(responseData.user_pic){
                            $('#addclient #user_pic').attr('src', "{{ asset('storage') }}/" + responseData.user_pic).removeClass('d-none');
                        }else{
                            $('#addclient #user_pic').attr('src', "assets/images/user.png").removeClass('d-none');
                        }
                        if(responseData.com_pic){
                            $('#addclient #com_pic').attr('src', "{{ asset('storage') }}/" + responseData.com_pic).removeClass('d-none');
                        }else{
                            $('#addclient #com_pic').attr('src', "assets/images/user.png").removeClass('d-none');
                        }
                        $('#addclient #id').val(responseData.id);
                        $('#addclient #client_id').val(responseData.client_id);
                        $('#addclient #role').val(responseData.role);
                        $('#addclient #name').val(responseData.name);
                        $('#addclient #phone').val(responseData.phone);
                        $('#addclient #email').val(responseData.email);
                        $('#addclient #com_name').val(responseData.com_name);
                        $('#addclient #address').val(responseData.address);
                        $('#addclient #joining_date').val(formattedDateTime);

                        $('#spinner').addClass('d-none');
                        $('#add_btn').removeClass('d-none');
                    } else {
                        showAlert("Warning", response.message, response.status);
                    }
                },
                error: function(xhr, status, error) {
                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none');
                    showAlert("Error", status, error);
                }
            });
        });
   
        $(document).on('click', '.skip_address', function() {
            let add_id = $(this).data('address_id');
            $('#address_id').val(add_id);
            $('#skipwaypointmodal').modal('show');
        });

        $(document).on('click', '#btn-complete_waypoint', function() {
            let ad_id = $(this).attr('data-address_id');
            $('#completepointmodal #address_id').val(ad_id);
            $('#completepointmodal').modal('show');
        });

        $(document).on('click', '#btn-next_waypoint', function() {
            $('#nextpointmodal').modal('show');
        });

        $(document).on('click', '#btn-end_trip', function() {
            let End_trip = ongoing_address('no');
            if(End_trip == 'yes'){
                $('#tripend').modal('show');
            }else{
                showAlert('Uncomplete Trip', 'Your Trips is Uncomplete Yet!', 'warning'); 
            }
        });

        function dismissModal(modle_id) {
            $('#addclient').modal('hide');
            $('#formData')[0].reset();
        }

        function showAlert(title, message, type) {  
            
                swal({
                    title: title,
                    text: message,
                    icon: type,
                    showClass: {
                        popup: 'swal2-show',
                        backdrop: 'swal2-backdrop-show',
                        icon: 'swal2-icon-show'
                    },
                    hideClass: {
                        popup: 'swal2-hide',
                        backdrop: 'swal2-backdrop-hide',
                        icon: 'swal2-icon-hide'
                    },
                    onOpen: function() {
                        $('.swal2-popup').css('animation', 'swal2-show 0.5s');
                    },
                    onClose: function() {
                        $('.swal2-popup').css('animation', 'swal2-hide 0.5s');
                    }
                });
            
        }

        function showlogin(title, message) {
            login_alert = swal({
                title: title,
                content: {
                    element: "div",
                    attributes: {
                        class: "custom-spinner"
                    }
                },
                text: message,
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                onOpen: function() {
                    $('.custom-spinner').addClass('spinner-border spinner-border-sm text-primary');
                },
                onClose: function() {
                    $('.custom-spinner').removeClass('spinner-border spinner-border-sm text-primary');
                }
            });

            return login_alert;
        }

        $('input').on('input', function() {
            $(this).removeClass('error');
            $(this).next('.error-label').remove();
        });

        var passwordInputs = $("input[type='password']");
        passwordInputs.each(function() {
            var passwordInput = $(this);
            var eyeButton = passwordInput.next(".input-group-append").find("#eye");

            eyeButton.on("keydown", function(event) {
            if (event.key === "Tab" && !event.shiftKey) {
                event.preventDefault();
                passwordInput.focus();
            }
            });

            passwordInput.on("keydown", function(event) {
            if (event.key === "Tab" && !event.shiftKey) {
                event.preventDefault();
                var formInputs = $("input");
                var currentIndex = formInputs.index(this);

                var nextInput = formInputs.eq(currentIndex + 1);
                while (nextInput.length && !nextInput.is(":visible")) {
                nextInput = formInputs.eq(currentIndex + 2);
                currentIndex++;
                }

                if (nextInput.length) {
                nextInput.focus();
                } else {
                formInputs.eq(0).focus();
                }
            }
            });
        });

        //user status
        $(document).on('click', '.btn_status', function () {
         var id = $(this).find('span').attr('data-client_id');
            $('#user_sts_modal').modal('show');
            $('#user_sts').data('id', id);
        });

        $(document).on('click', '#btn_dell_client', function() {
            let user_id = $(this).attr('data-id');
            $('#userDeleteModal #user_id').val(user_id);
            $('#userDeleteModal').modal('show');
        });

        $(document).on('submit', '#user_sts', function (event) {
            event.preventDefault();
            var id = $('#user_sts').data('id');
            var status = $('#status').val();
            var _token = $(this).find('input[name="_token"]').val();
        
            $.ajax({
                url: '/change_status',
                method: 'POST',
                beforeSend: function () {

                    $('#change_sts').prop('disabled', true);
                    $('#change_sts #spinner').removeClass('d-none');
                    $('#change_sts #add_btn').addClass('d-none');
                },
                data: {
                    'id': id,
                    '_token': _token,
                    'status': status
                },
                success: function (response) {
                    if (response) {
                        
                        $('#change_sts').prop('disabled', false);
                        $('#spinner').addClass('d-none');
                        $('#add_btn').removeClass('d-none');

                        console.log(response);
                        $('#user_sts').off('submit');
                        window.location.href = window.location.href;
                    }
                }
            });
        });

        // Trip Detail  data in through the api...
        $('.tripDetail_view').on('click', function(e) {
            e.preventDefault();
            var tripDetail_view = $(this);
            var tripId = tripDetail_view.attr('data-id');
            //alert(tripId);

            var apiname = 'tripDetail';
            var apiurl = "{{ end_url('') }}" + apiname;
            var formData = new FormData();
            formData.set('id', tripId);
            // formData.get('id');
            console.log(formData);
            var bearerToken = "{{session('user')}}";
            
            $.ajax({
                url: apiurl,
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                },
                contentType: false,
                processData: false,
                beforeSend: function() {

                },
                success: function(response) {
                    
                    if (response.status === 'success') {
                        if(response.data.user.user_pic){
                            $('#tripDetail_clientimg').attr('src', "{{ asset('storage') }}/" + response.data.user.user_pic);
                        }else{
                            $('#tripDetail_clientimg').attr('src', "assets/images/user.png")
                        }
                        if(response.data.driver.user_pic){
                            $('#tripDetail_driverimg').attr('src', "{{ asset('storage') }}/" + response.data.driver.user_pic);
                        }else{
                            $('#tripDetail_driverimg').attr('src', "assets/images/user.png")
                        }
                        $("#tripDetail_client").val(response.data.user.name);
                        $("#tripDetail_driver").val(response.data.driver.name);
                        $("#tripDetail_title").val(response.data.title);
                        $("#tripDetail_description").val(response.data.desc);
                        $("#tripDetail_date").val(response.data.trip_date);
                        $("#tripDetail_startpoint").val(response.data.start_point);
                        $("#tripDetail_endpoint").val(response.data.end_point);

                        // Assuming you have the translated JSON data stored in the variable 'translatedData'

                        
                        var translatedData = response.data.addresses;

// Select the target element
var $tripDetailAddresses = $("#gettripdata");

// Clear any previous content
$tripDetailAddresses.empty();

function convertToYesNo(value) {
  return value === "1" ? `<svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                        </svg>` : "";
}

// Loop through each address and create a <tr> element
translatedData.forEach(function(address) {
  var $tr = $("<tr>");

  // Add columns (td) with address information

  $tr.append($("<td class='text-wrap'>").text(address.title));
  $tr.append($("<td class='text-wrap'>").text(address.desc));

  // Convert and add pic column
  $tr.append($("<td>").html(convertToYesNo(address.trip_pic)));

  // Convert and add signature column
  $tr.append($("<td>").html(convertToYesNo(address.trip_signature)));

  // Convert and add note column
  $tr.append($("<td>").html(convertToYesNo(address.trip_note)));

  // Append the <tr> element to the table
  $tripDetailAddresses.append($tr);

});








                       
                        
                    }
                    
                    else if(response.status === 'error'){
                    
                        showAlert("Warning", "Please fill the form correctly", response.status);
                        console.log(response.message);

                    }
                },
                error: function(xhr, status, error) {
                    console.log(status);
                    showAlert("Error", 'Request Can not Procceed', 'Can not Procceed furhter');
                }
            });
        });

        $(document).on('click', '.duplicate_trip', function () {
         var id = $(this).data('id');
            $('#duplicateroute').modal('show');
            $('#inp_trip').val(id);
        });
    

        // datatables only for client table and users table
        var users_table = $('#users-table').DataTable();

        $('#filter_by_sts_client').on('change', function() {
            var selectedStatus = $(this).val();
            users_table.column(5).search(selectedStatus).draw();
        });

        $('#filter_by_sts_users').on('change', function() {
            var selectedStatus = $(this).val();
            users_table.column(6).search(selectedStatus).draw();
        });

        $('#btn_cancel').click(function() {
            $('#addclient').modal('hide');
        });
        
        function showtoast(bg_color){
                if(bg_color){
                    $('#snackbar').css('background-color',bg_color)
                }
                let xid = document.getElementById("snackbar");
                xid.className = "show";
                setTimeout(function(){ xid.className = xid.className.replace("show", ""); }, 3000);
        }


// Extra code pending ,Log Terms goals.. for future usage....

        // get_waypoint();
        // loadTables('users','Client');
        // loadTables('users','Admin');

                // loading tables 
        // function loadTables(apiname, role) {

        //     var apiurl = "{{ end_url('') }}" + apiname;

        //     if (role == 'Client') {
        //         $('#users-table').DataTable({
        //             ajax: {
        //                 url: apiurl,
        //                 type: 'GET',
        //                 dataType: 'json',
        //                 beforeSend: function(xhr) {
        //                     var token = '{{ session('
        //                     user ') }}';
        //                     xhr.setRequestHeader('Authorization', 'Bearer ' + token);
        //                 },
        //                 dataSrc: 'data',
        //                 data: {
        //                     role: role
        //                 }
        //             },
        //             columns: [{
        //                     data: 'id'
        //                 },
        //                 {
        //                     data: 'name'
        //                 },
        //                 {
        //                     data: 'address'
        //                 },
        //                 {
        //                     data: 'com_name'
        //                 },
        //                 {
        //                     data: 'status',
        //                     render: function(data) {
        //                         if (data == 1) {
        //                             return '<span class="badge" style="background-color: #31A6132E; color: #31A613;">Active</span>';
        //                         } else if (data == 2) {
        //                             return '<span class="badge" style="background-color: #4D4D4D1F; color: #8F9090;">Pending</span>';
        //                         } else if (data == 3) {
        //                             return '<span class="badge" style="background-color: #F5222D30; color: #F5222D;">Suspend</span>';
        //                         } else {
        //                             return '';
        //                         }
        //                     }
        //                 },
        //                 {
        //                     data: 'created_at',
        //                     render: function(data) {
        //                         var date = new Date(data);
        //                         var options = {
        //                             year: 'numeric',
        //                             month: 'short',
        //                             day: 'numeric'
        //                         };
        //                         return date.toLocaleDateString('en-US', options);
        //                     }
        //                 },
        //             ],
        //         });
        //     }

        //     if (role == 'Admin') {
        //         $('#admin-table').DataTable({
        //             ajax: {
        //                 url: apiurl,
        //                 type: 'GET',
        //                 dataType: 'json',
        //                 beforeSend: function(xhr) {
        //                     var token = '{{ session('
        //                     user ') }}';
        //                     xhr.setRequestHeader('Authorization', 'Bearer ' + token);
        //                 },
        //                 dataSrc: 'data',
        //                 data: {
        //                     role: role
        //                 }
        //             },
        //             columns: [{
        //                     data: 'name'
        //                 },
        //                 {
        //                     data: 'created_at',
        //                     render: function(data) {
        //                         var date = new Date(data);
        //                         var options = {
        //                             year: 'numeric',
        //                             month: 'short',
        //                             day: 'numeric'
        //                         };
        //                         return date.toLocaleDateString('en-US', options);
        //                     }
        //                 },
        //                 {
        //                     data: 'address'
        //                 },
        //                 {
        //                     data: 'role'
        //                 },
        //                 {
        //                     data: 'email'
        //                 },
        //                 {
        //                     data: 'status',
        //                     render: function(data) {
        //                         if (data == 1) {
        //                             return '<span class="badge" style="background-color: #31A6132E; color: #31A613;">Active</span>';
        //                         } else if (data == 2) {
        //                             return '<span class="badge" style="background-color: #4D4D4D1F; color: #8F9090;">Pending</span>';
        //                         } else if (data == 3) {
        //                             return '<span class="badge" style="background-color: #F5222D30; color: #F5222D;">Suspend</span>';
        //                         } else {
        //                             return '';
        //                         }
        //                     }
        //                 },
        //                 {
        //                     data: null,
        //                     render: function(data) {
        //                         return '<span class="badge" style="background-color: #F5222D30; color: #F5222D;"><i class="fa fa-edit"></i> Edit</span> <span class="badge" style="background-color: #F5222D30; color: #F5222D;"><i class="fa fa-trash"></i> Delete</span>';
        //                     }
        //                 }
        //             ],
        //         });
        //     }

        // }
        $('.closeModalButton').click(function() {
    // Get the modal ID from the clicked button's parent modal
    var modalId = $(this).closest('.modal').attr('id');
    
    // Reset the form inside the modal
    $('#formData').load(location.href + " #formData > *");

    // Close the corresponding modal using the extracted ID
    $('#' + modalId).modal('hide');
});
     
    });
</script>