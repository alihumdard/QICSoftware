<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/SheetJS/js-xlsx/master/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
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

        //login user through API .... 
        $('#login-form').on('submit', function(e) {

            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            if (email === '' || password === '') {
                (email === '') ? $('.validation-error-email').empty().append('<label class="text-danger">* email is required</label>'): $('.validation-error-email').empty();
                (password === '') ? $('.validation-error-password').empty().append('<label class="text-danger">* password  is required</label>'): $('.validation-error-password').empty();
            } else {
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
                        } else if (responseArray.status === 'error') {
                            // console.log(response.message);
                            $('.error-label').remove();
                            $.each(responseArray.message, function(field, errorMessages) {
                                $.each(errorMessages, function(index, errorMessage) {
                                    (field == 'email') ? $('.validation-error-email').empty().append('<label class="text-danger">*' + errorMessage + '</label>'): $('.validation-error-email').empty();
                                    (field == 'password') ? $('.validation-error-password').empty().append('<label class="text-danger">*' + errorMessage + '</label>'): $('.validation-error-password').empty();
                                });
                            });

                        } else {
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
                    showlogin('Wait', 'saving......');
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
                    showlogin('Wait', 'saving......');
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
                        if (response.tripDleted) {
                            if (response.tripDleted == 'yes') {
                                $('#routes-table').load(location.href + " #routes-table > *");
                                $('#deleteroute').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        }
                        if (response.announcementDeleted) {
                            if (response.announcementDeleted == 'yes') {
                                $('#users-table').load(location.href + " #users-table > *");
                                $('#deleteAnnoncement').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        }
                        if (response.packageDeleted) {
                            if (response.packageDeleted == 'yes') {
                                $('#users-table').load(location.href + " #users-table > *");
                                $('#deletePackage').modal('hide');
                                showAlert("Success", response.message, response.status);
                            }

                        } else {
                            if (response.role == 3) {
                                $('#drivers-table').load(location.href + " #drivers-table > *");
                            } else {
                                $('#users-table').load(location.href + " #users-table > *");
                            }
                            $('#closeicon').trigger('click');

                            $('#userDeleteModal').modal('hide');
                            showAlert("Success", response.message, response.status);

                            if (response.logout) {
                                setTimeout(function() {
                                    window.location.href = '/logout';
                                }, 2000);
                            }
                        }
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
                    showAlert("Error", 'Request Can not Procceed', 'Can not Procceed furhter');
                }
            });
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
                        $('#addclient #btn_save').html('<div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div><span id="add_btn">' + "{{ trans('lang.save') }}" + '</span>').css('background-color', '#233A85');
                        if (responseData.user_pic) {
                            $('#addclient #user_pic').attr('src', "{{ asset('storage') }}/" + responseData.user_pic).removeClass('d-none');
                        } else {
                            $('#addclient #user_pic').attr('src', "assets/images/user.png").removeClass('d-none');
                        }
                        if (responseData.com_pic) {
                            $('#addclient #com_pic').attr('src', "{{ asset('storage') }}/" + responseData.com_pic).removeClass('d-none');
                        } else {
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

        // send mail invoice .....
        $(document).on('click', '.send_mail', function() {
            var id = $(this).attr('data-id');
            var apiname = 'sendMail';
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
                    $('#spinner_mail_' + id).removeClass('d-none');
                    $('#mail_btn_' + id).addClass('d-none').prop('disabled', true);
                },
                success: function(response) {

                    if (response.status === 'success') {
                        $('#spinner_mail_' + id).addClass('d-none');
                        $('#mail_btn_' + id).removeClass('d-none').prop('disabled', false).text('Resend');;
                        toast_message(response.message, 'green');

                    } else {
                        showAlert("Warning", response.message, response.status);
                    }
                },
                error: function(xhr, status, error) {
                    $('#spinner_mail_' + id).addClass('d-none');
                    $('#mail_btn_' + id).removeClass('d-none').prop('disabled', false);
                    showAlert("Warning", status, error);
                }
            });
        });

        // deleting users ... calling modals
        $(document).on('click', '#btn_dell_user', function() {
            let user_id = $(this).attr('data-id');
            $('#userDeleteModal #user_id').val(user_id);
            $('#userDeleteModal').modal('show');
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
        $(document).on('click', '.btn_status', function() {
            var id = $(this).find('span').attr('data-client_id');
            $('#user_sts_modal').modal('show');
            $('#user_sts').data('id', id);
        });

        $(document).on('click', '#btn_dell_client', function() {
            let user_id = $(this).attr('data-id');
            $('#userDeleteModal #user_id').val(user_id);
            $('#userDeleteModal').modal('show');
        });

        $(document).on('submit', '#user_sts', function(event) {
            event.preventDefault();
            var id = $('#user_sts').data('id');
            var status = $('#status').val();
            var _token = $(this).find('input[name="_token"]').val();

            $.ajax({
                url: '/change_status',
                method: 'POST',
                beforeSend: function() {

                    $('#change_sts').prop('disabled', true);
                    $('#change_sts #spinner').removeClass('d-none');
                    $('#change_sts #add_btn').addClass('d-none');
                },
                data: {
                    'id': id,
                    '_token': _token,
                    'status': status
                },
                success: function(response) {
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

        // datatables only for client table and users table
        var users_table = $('#users-table').DataTable();

        $('#filter_by_sts_client').on('change', function() {
            var selectedStatus = $(this).val();
            users_table.column(7).search(selectedStatus).draw();
        });

        $('#filter_by_sts_users').on('change', function() {
            var selectedStatus = $(this).val();
            users_table.column(6).search(selectedStatus).draw();
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