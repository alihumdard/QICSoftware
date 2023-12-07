@php
$user = auth()->user();
@endphp
<script>
    $(document).ready(function() {
        var user = @json($user);
        var simple_toolbar = [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['paragraph', 'ol', 'ul']],
        ];
        var full_toolbar = [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['paragraph', 'ol', 'ul']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
        ];

        $(document).on('click', '.btn_status_q', function() {
            var id = $(this).find('span').attr('data-qoute_id');
            $('#qoute_id').val(id);
            $('#qoute_sts_modal').modal('show');
        });

        var login_alert;

        function toast_message(text, bg_color) {
            if (bg_color) {
                $('#snackbar').css('background-color', bg_color)
            }
            if (text) {
                $("#snackbar").text(text);
            }
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        // get comments  data in through the api...
        $(document).on('click', '.invComment', function(e) {
            e.preventDefault();
            var commentrow = $(this);
            var rowId = commentrow.attr('data-id');
            $('#invo_id').val(rowId);
            var apiname = 'comments';
            var apiurl = "{{ end_url('') }}" + apiname;
            var payload = {
                comment_for: 'Invoice',
                comment_for_id: rowId,
            };

            var bearerToken = "{{session('user')}}";

            $.ajax({
                url: apiurl,
                type: 'POST',
                data: JSON.stringify(payload),
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + bearerToken
                },
                beforeSend: function() {
                    $('#mdl-data').addClass('d-none');
                    $('#mdl-spinner').removeClass('d-none');
                },
                success: function(response) {

                    if (response.status === 'success') {
                        var comment_html = '';
                        if (response.data != '') {
                            $('.no_comment').addClass('d-none');
                            $.each(response.data, function(index, data) {
                                let createdDate = new Date(data.created_at);
                                let formattedDate = createdDate.toLocaleString();
                                formattedDate = formattedDate.replace(/\//g, '-');
                                let user_pic = (data.user_pic) ? 'storage/' + data.user_pic : 'assets/images/user.png';

                                let comment_data = '<div class="card mb-1">' +
                                    '<div class="card-body py-3 px-5">' +
                                    '<p>' + data.comment + '</p>' +
                                    '<div class="d-flex justify-content-between">' +
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<img src="' + user_pic + '" alt="user image" width="25" height="25" />' +
                                    '<p class="small mb-0 ms-2">' + data.user_name + '</p>' +
                                    '</div>' +
                                    '<div class="d-flex flex-row align-items-center">' +
                                    '<p class="small text-muted mb-0">' + formattedDate + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                comment_html += comment_data;
                            });
                        } else {
                            $('.no_comment').removeClass('d-none');
                        }
                        $('.comment_data').html(comment_html);
                        $('#inv_comment').val('');

                        setTimeout(function() {
                            $('#mdl-spinner').addClass('d-none');
                            $('#mdl-data').removeClass('d-none');
                        }, 500);

                    } else if (response.status === 'error') {

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
        // Adding  comment in through the api...
        $('#commentform').on('submit', function(e) {
            e.preventDefault();

            var apiname = $(this).attr('action');
            var apiurl = "{{ end_url('') }}" + apiname;
            var formData = new FormData(this);
            var inv_id = formData.get('comment_for_id');
            var inv_comment = formData.get('comment');
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
                    $('#spinner_coment').removeClass('d-none');
                    $('#coment_btn').addClass('d-none');
                },
                success: function(response) {


                    if (response.status === 'success') {
                        $('#comment_inv_' + inv_id).attr('data-comment', inv_comment);
                        let createdDate = new Date();
                        let formattedDate = createdDate.toLocaleString();
                        formattedDate = formattedDate.replace(/\//g, '-');
                        let user_pic = (user.user_pic) ? 'storage/' + user.user_pic : 'assets/images/user.png';
                        let comment_data = '<div class="card mb-1">' +
                            '<div class="card-body py-3 px-5">' +
                            '<p>' + inv_comment + '</p>' +
                            '<div class="d-flex justify-content-between">' +
                            '<div class="d-flex flex-row align-items-center">' +
                            '<img src="' + user_pic + '" alt="user image" width="25" height="25" />' +
                            '<p class="small mb-0 ms-2">' + user.name + '</p>' +
                            '</div>' +
                            '<div class="d-flex flex-row align-items-center">' +
                            '<p class="small text-muted mb-0">' + formattedDate + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('.no_comment').addClass('d-none');
                        $('.comment_data').append(comment_data);
                        $('#inv_comment').val('');
                        $('#spinner_coment').addClass('d-none');
                        $('#coment_btn').removeClass('d-none').prop('disabled', false);
                        toast_message(response.message, 'green');
                    } else if (response.status === 'error') {
                        showAlert("Warning", "Please fill the form correctly", response.status);
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(status);
                    $('#spinner_coment').addClass('d-none');
                    $('#coment_btn').removeClass('d-none').prop('disabled', false);
                    showAlert("Warning", 'Sytem Error', 'Can not Procceed furhter');

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
                    showloading('Wait', 'saving......');
                },
                success: function(response) {

                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none').prop('disabled', false);

                    if (response.status === 'success') {

                        // $('#formData')[0].reset();

                        const lastSegment = location.href.substring(location.href.lastIndexOf("/") + 1);
                        if (lastSegment == 'settings' || lastSegment == 'announcements' || lastSegment == 'add_quotation' || lastSegment == 'add_contract' || lastSegment == 'add_invoice') {
                            if (lastSegment == 'add_quotation' || lastSegment == 'add_contract' || lastSegment == 'add_invoice') {
                                setTimeout(function() {
                                    window.location.href = document.referrer;
                                }, 1500);
                            } else {
                                $('#closeicon').trigger('click');
                                setTimeout(function() {
                                    window.location.href = window.location.href;
                                }, 1500);
                            }

                        } else {
                            $('#tableData').load(location.href + " #tableData > *");
                            $('#formData').load(location.href + " #formData > *", function() {
                                destory_summernote('.summernote');
                                init_summernote('.summernote', simple_toolbar);
                            });
                            $('#closeicon').trigger('click');
                        }

                        $('#addclient').modal('hide');
                        showAlert("Success", response.message, response.status);
                    } else if (response.status === 'error') {

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
                    console.log(status);
                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none').prop('disabled', false);
                    showAlert("Warning", 'Sytem Error', 'Can not Procceed furhter');

                }
            });
        });

        // Adding  data in through the api...
        $('.apiform').on('submit', function(e) {

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
                    showloading('Wait', 'saving......');
                },
                success: function(response) {

                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none').prop('disabled', false);

                    if (response.status === 'success') {

                        // $('#formData')[0].reset();

                        const lastSegment = location.href.substring(location.href.lastIndexOf("/") + 1);
                        if (lastSegment == 'settings' || lastSegment == 'announcements' || lastSegment == 'add_quotation' || lastSegment == 'add_contract' || lastSegment == 'add_invoice') {
                            if (lastSegment == 'add_quotation' || lastSegment == 'add_contract' || lastSegment == 'add_invoice') {
                                setTimeout(function() {
                                    window.location.href = document.referrer;
                                }, 1500);
                            } else {
                                $('#closeicon').trigger('click');
                                setTimeout(function() {
                                    window.location.href = window.location.href;
                                }, 1500);
                            }

                        } else {
                            $('#tableData').load(location.href + " #tableData > *");
                            $('.apiform').load(location.href + " .apiform > *", function() {
                                destory_summernote('.summernote');
                                init_summernote('.summernote', simple_toolbar);
                            });
                            $('#closeicon').trigger('click');
                            $('.close-serviceModel').trigger('click');
                        }

                        $('#addclient').modal('hide');
                        showAlert("Success", response.message, response.status);
                    } else if (response.status === 'error') {

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
                    console.log(status);
                    $('#spinner').addClass('d-none');
                    $('#add_btn').removeClass('d-none').prop('disabled', false);
                    showAlert("Warning", 'Sytem Error', 'Can not Procceed furhter');

                }
            });
        });

        // Adding savetemplate data in through the api...
        $('#savetemplate').on('submit', function(e) {

            e.preventDefault();
            var button = $(this);
            var spinner = button.find('#spinner');
            var buttonText = button.find('#text');

            button.prop('disabled', true);
            spinner.removeClass('d-none');

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
                    showloading('Wait', 'saving......');
                },
                success: function(response) {
                    button.prop('disabled', false);
                    spinner.addClass('d-none');
                    buttonText.removeClass('d-none');

                    if (response.status === 'success') {

                        showAlert("Success", response.message, response.status);
                    } else if (response.status === 'error') {

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
                    showAlert("Warning", 'Sytem Error', 'Can not Procceed furhter');
                }
            });
        });

        // send mail invoice .....
        $(document).on('click', '.send_mail', function() {
            let row_id = $(this).attr('data-id');
            $('#row_id').val(row_id);
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

        function showloading(title, message) {
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

        init_summernote('.summernote', simple_toolbar);

        function init_summernote(selector, toolbar, height = 250) {
            $(selector).summernote({
                placeholder: 'Email Body here ',
                tabsize: 2,
                height: height,
                toolbar: toolbar ?? full_toolbar,
            });
        }

        function destory_summernote(selector) {
            $(selector).summernote('destroy');
        }

        $('input').on('input', function() {
            $(this).removeClass('error');
            $(this).next('.error-label').remove();
        });

        $('#btn_cancel').click(function() {
            $('#addclient').modal('hide');
        });

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