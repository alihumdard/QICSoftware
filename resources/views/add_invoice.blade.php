@extends('layouts.main')

@section('main-section')
<style>
    tbody tr {
        cursor: move;
    }

    tbody tr td:first-child {
        cursor: grab;
    }

    .modal-backdrop.show {
        opacity: 0 !important;
    }

    .draggable-modal .modal-dialog {
        pointer-events: none;
    }

    .draggable-modal .modal-content {
        pointer-events: auto;
    }

    .form-group .form-check {
        margin-bottom: 5px;
    }


    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
    }

    #map {
        height: 400px;
        width: 100%;
    }

    .d-view_map {
        width: 100%;
        height: 400px;
    }

    .custom-button {
        width: 100%;
        height: 36px;
        display: inline-block;
        background-color: #00a962;
        color: white;
        cursor: pointer;
        border: none;
        text-align: center;
        text-decoration: none;
        border-radius: 3px;
        padding: 6px;
    }

    .custom-button:hover {
        background-color: #00824b;
    }

    .custom-button:active {
        background-color: #00a962;
    }

    #addAddressModal .modal-header {
        padding: 0.5rem 1rem;
    }

    #addAddressModal .modal-title {
        font-size: 1rem;
        margin-bottom: 0;
    }
</style>
<div class="content-wrapper py-0 my-2">
    <div style="border: none;">
        <div class="bg-white" style="border-radius: 20px;">
            <div class="p-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6667 0H3.33333C2.44928 0 1.60143 0.35119 0.976311 0.976311C0.35119 1.60143 0 2.44928 0 3.33333V16.6667C0 17.5507 0.35119 18.3986 0.976311 19.0237C1.60143 19.6488 2.44928 20 3.33333 20H16.6667C17.5507 20 18.3986 19.6488 19.0237 19.0237C19.6488 18.3986 20 17.5507 20 16.6667V3.33333C20 2.44928 19.6488 1.60143 19.0237 0.976311C18.3986 0.35119 17.5507 0 16.6667 0ZM17.7778 16.6667C17.7778 16.9614 17.6607 17.244 17.4523 17.4523C17.244 17.6607 16.9614 17.7778 16.6667 17.7778H3.33333C3.03865 17.7778 2.75603 17.6607 2.54766 17.4523C2.33929 17.244 2.22222 16.9614 2.22222 16.6667V3.33333C2.22222 3.03865 2.33929 2.75603 2.54766 2.54766C2.75603 2.33929 3.03865 2.22222 3.33333 2.22222H16.6667C16.9614 2.22222 17.244 2.33929 17.4523 2.54766C17.6607 2.75603 17.7778 3.03865 17.7778 3.33333V16.6667Z" fill="white" />
                            <path d="M13.3333 8.88888H11.1111V6.66665C11.1111 6.37197 10.994 6.08935 10.7857 5.88098C10.5773 5.67261 10.2947 5.55554 9.99999 5.55554C9.7053 5.55554 9.42269 5.67261 9.21431 5.88098C9.00594 6.08935 8.88888 6.37197 8.88888 6.66665V8.88888H6.66665C6.37197 8.88888 6.08935 9.00594 5.88098 9.21431C5.67261 9.42269 5.55554 9.7053 5.55554 9.99999C5.55554 10.2947 5.67261 10.5773 5.88098 10.7857C6.08935 10.994 6.37197 11.1111 6.66665 11.1111H8.88888V13.3333C8.88888 13.628 9.00594 13.9106 9.21431 14.119C9.42269 14.3274 9.7053 14.4444 9.99999 14.4444C10.2947 14.4444 10.5773 14.3274 10.7857 14.119C10.994 13.9106 11.1111 13.628 11.1111 13.3333V11.1111H13.3333C13.628 11.1111 13.9106 10.994 14.119 10.7857C14.3274 10.5773 14.4444 10.2947 14.4444 9.99999C14.4444 9.7053 14.3274 9.42269 14.119 9.21431C13.9106 9.00594 13.628 8.88888 13.3333 8.88888Z" fill="white" />
                        </svg>
                    </span>
                    <span>{{ (isset($data['id'])) ? 'Update Invoice' : 'Add Invoice' }}</span>
                </h3>
            </div>
            <div class="container" id="home">
                <form action="invoiceStore" class="apiform" method="post">
                    <div class="row">
                        @csrf
                        <div class="col-lg-{{ ($user->role == user_roles('3')) ? '4' : (($user->role == user_roles('2')) ? '3' : '4') }} col-md-6 col-sm-12  my-2">
                            <label for="q_date">@lang('lang.date')</label>
                            <input required type="date" name="date" id="q_date" value="{{ $data['date'] ?? date('Y-m-d')  }}" min="{{ $data['date'] ?? date('Y-m-d')  }}" class="form-control">
                            <span id="q_date_error" class="error-message text-danger"></span>
                            <input type="hidden" name="id" id="q_id" value="{{ $data['id'] ?? '' }}" />
                            <input type="hidden" name="sadmin_id" id="sadmin_id" value="{{ $sadmin_id ?? ''}}" />
                        </div>

                        @if(isset($user->role) && ($user->role == user_roles('1')))
                        <div class="col-lg-{{ $user->role == user_roles('2') ? '3' : '4' }} col-md-6 col-sm-12 my-2">
                            <label for="admin_id">@lang('lang.admins') </label>
                            <select required name="admin_id" id="admin_id" class="form-select" onchange="getDrivers(this.value)">
                                <option disabled selected> Select @lang('lang.admins') </option>
                                @foreach($admins_list as $value)
                                <option value="{{ $value['id'] }}" {{ isset($data['admin_id']) && $data['admin_id'] == $value['id'] ? 'selected' : '' }}>
                                    {{ $value['name'] }}
                                </option>
                                @endforeach
                            </select>
                            <span id="admin_id_error" class="error-message text-danger"></span>
                        </div>
                        @else
                        <input type="hidden" name="admin_id" id="admin_id" value="{{ ($user->role == user_roles('2')) ? $user->id : $user->client_id }}" />
                        @endif

                        @if (isset($user->role) && ($user->role == user_roles('1') || $user->role == user_roles('2')))
                        <div class="col-lg-{{ $user->role == user_roles('2') ? '3' : '4' }} col-md-6 col-sm-12 my-2">
                            <label for="user_id">@lang('lang.users')</label>
                            <select required name="user_id" id="user_id" class="form-select">
                                <option disabled selected> Select @lang('lang.users')</option>
                                @forelse($users_list as $value)
                                <option value="{{ $value['id'] }}" {{ isset($data['user_id']) && $data['user_id'] == $value['id'] ? 'selected' : '' }}>
                                    {{ $value['name'] }}
                                </option>
                                @empty
                                <!-- Code to handle the case when $driver_list is empty or null -->
                                @endforelse
                            </select>
                            <span id="user_id_error" class="error-message text-danger"></span>
                        </div>
                        @else
                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" />
                        @endif

                        <div class="col-lg-{{ ($user->role == user_roles('3')) ? '4' : (($user->role == user_roles('2')) ? '3' : '4') }} col-md-6 col-sm-12">
                            <label for="client_name">@lang('lang.client_name')</label>
                            <input required type="text" maxlength="100" name="client_name" id="client_name" value="{{ $data['client_name'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                            <span id="client_name_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-{{ ($user->role == user_roles('3')) ? '4': (($user->role == user_roles('2')) ? '3' : '4')  }} col-md-6 col-sm-12">
                            <label for="client_mail">@lang('Client Email')</label>
                            <input required type="email" maxlength="100" name="client_mail" id="client_mail" value="{{ $data['client_mail'] ?? '' }}" placeholder="@lang('client email')" class="form-control">
                            <span id="client_mail_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label for="q_desc">@lang('lang.invoice_desc')</label>
                            <textarea name="desc" id="q_desc" class="form-control" placeholder="@lang('lang.invoice_desc')">{{ $data['desc'] ?? '' }}</textarea>
                            <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">250</span> /250</p>
                            <span id="q_desc_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-3 col-md-6  col-sm-12">
                            <label for="service_id">@lang('Invoice Category')</label>
                            <select required name="service_id" id="service_id" class="form-select">
                                <option disabled selected> Select @lang(' category')</option>
                                @forelse($services as $key => $value)
                                <option value="{{ $key}}" {{ isset($data['service_id']) && $data['service_id'] == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @empty
                                <!-- Code to handle the case when $driver_list is empty or null -->
                                @endforelse
                            </select>
                            <span id="service_id_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-3 col-md-6  col-sm-12">
                            <label for="service_id">@lang('Invoice Location')</label>
                            <select required name="location_id" id="location" class="form-select">
                                <option disabled selected> Select @lang(' location')</option>
                                @forelse($location as $key => $value)
                                <option value="{{ $key}}" {{ isset($data['location_id']) && $data['location_id'] == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @empty
                                <!-- Code to handle the case when $driver_list is empty or null -->
                                @endforelse
                            </select>
                            <span id="location_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="q_amount">@lang('lang.invoice_amount')</label>
                            <input required type="number" min="1" name="amount" id="q_amount" value="{{ $data['amount'] ?? 1 }}" placeholder="@lang('lang.quoted_amount')" class="form-control">
                            <span id="q_amount_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="currency_code">Currency Code</label>
                            <select required name="currency_id" id="currency_code" class="form-select">
                                <option disabled selected> @lang('currency')</option>
                                @forelse($currencies as $key => $value)
                                <option value="{{ $key}}" {{ isset($data['currency_id']) && $data['currency_id'] == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @empty
                                <!-- Code to handle the case when $driver_list is empty or null -->
                                @endforelse
                            </select>
                            <span id="currency_code_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="q_file">@lang('Inovice File ')</label>
                            <label for="q_file" class="custom-button">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.8 14.4C22.4817 14.4 22.1765 14.5264 21.9515 14.7515C21.7264 14.9765 21.6 15.2817 21.6 15.6V20.4C21.6 20.7183 21.4736 21.0235 21.2485 21.2485C21.0235 21.4736 20.7183 21.6 20.4 21.6H3.6C3.28174 21.6 2.97652 21.4736 2.75147 21.2485C2.52643 21.0235 2.4 20.7183 2.4 20.4V15.6C2.4 15.2817 2.27357 14.9765 2.04853 14.7515C1.82348 14.5264 1.51826 14.4 1.2 14.4C0.88174 14.4 0.576515 14.5264 0.351472 14.7515C0.126428 14.9765 0 15.2817 0 15.6V20.4C0 21.3548 0.379285 22.2705 1.05442 22.9456C1.72955 23.6207 2.64522 24 3.6 24H20.4C21.3548 24 22.2705 23.6207 22.9456 22.9456C23.6207 22.2705 24 21.3548 24 20.4V15.6C24 15.2817 23.8736 14.9765 23.6485 14.7515C23.4235 14.5264 23.1183 14.4 22.8 14.4ZM11.148 16.452C11.2621 16.5612 11.3967 16.6469 11.544 16.704C11.6876 16.7675 11.843 16.8003 12 16.8003C12.157 16.8003 12.3124 16.7675 12.456 16.704C12.6033 16.6469 12.7379 16.5612 12.852 16.452L17.652 11.652C17.878 11.426 18.0049 11.1196 18.0049 10.8C18.0049 10.4804 17.878 10.174 17.652 9.948C17.426 9.72204 17.1196 9.59509 16.8 9.59509C16.4804 9.59509 16.174 9.72204 15.948 9.948L13.2 12.708V1.2C13.2 0.88174 13.0736 0.576515 12.8485 0.351472C12.6235 0.126428 12.3183 0 12 0C11.6817 0 11.3765 0.126428 11.1515 0.351472C10.9264 0.576515 10.8 0.88174 10.8 1.2V12.708L8.052 9.948C7.94011 9.83611 7.80729 9.74736 7.6611 9.68681C7.51491 9.62626 7.35823 9.59509 7.2 9.59509C7.04177 9.59509 6.88509 9.62626 6.7389 9.68681C6.59271 9.74736 6.45989 9.83611 6.348 9.948C6.23611 10.0599 6.14736 10.1927 6.08681 10.3389C6.02626 10.4851 5.99509 10.6418 5.99509 10.8C5.99509 10.9582 6.02626 11.1149 6.08681 11.2611C6.14736 11.4073 6.23611 11.5401 6.348 11.652L11.148 16.452Z" fill="white" />
                                </svg>
                                <span>@lang('Upload')</span>
                            </label>

                            <input type="file" id="q_file" name="file" style="display: none;">
                            <p class="float-right mr-3 file-uploaded d-none text-success" style="font-size: smaller; margin-top:-5px;">@lang('File Uploaded') <i class="fas fa-check-circle fa-lg"></i></p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row justify-content-end mt-2  ">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                <a href="/invoices" id="btn_cancel_quotation" class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span id="text">@lang('Cancel')</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_quotation" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('Save Inovice')</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</div>

<!-- viewlocation Modal End -->
<script>
    $(document).ready(function() {
        $('#q_file').change(function() {
            var fileUploadedParagraph = $('.file-uploaded');
            if ($(this).prop('files').length > 0) {
                fileUploadedParagraph.removeClass('d-none');
            } else {
                fileUploadedParagraph.addClass('d-none');
            }
        });

        const maxLength = 250;
        const textarea = $('#q_desc');
        const charCountElement = $('#charCount');
        const charCountContainer = $('#charCountContainer');
        const submitButton = $('#btn_save_quotation');
        textarea.on('input', function() {
            const currentLength = textarea.val().length;
            const charCount = Math.max(maxLength - currentLength);
            charCountElement.text(charCount);

            if (currentLength > 0) {
                charCountContainer.show();
            } else {
                charCountContainer.hide();
            }

            if (currentLength > maxLength) {
                const exceededCount = currentLength - maxLength;
                charCountElement.css('color', 'red');
                charCountElement.text(`Your limit exceeded by ${exceededCount} characters`);
                submitButton.prop('disabled', true);
            } else if (currentLength === maxLength) {
                charCountElement.css('color', ''); // Reset text color
                charCountElement.text(''); // Clear the message
                submitButton.prop('disabled', false);
            } else {
                charCountElement.css('color', ''); // Reset text color
                charCountElement.text(`${maxLength - currentLength}`);
                submitButton.prop('disabled', false);
            }
        });

        $('#btn_save_quotation').click(function(event) {
            var qDate = $('#q_date').val();
            var adminId = $('#admin_id').val();
            var userId = $('#user_id').val();
            var client_name = $('#client_name').val();
            var q_desc = $('#q_desc').val();
            var service_id = $('#service_id').val();
            var q_amount = $('#q_amount').val();
            var currency_code = $('#currency_code').val();
            var location = $('#location').val();
            var client_mail = $('#client_mail').val();

            // Reset error messages
            $('.error-message text-danger').text('');

            if (qDate === '') {
                $('#q_date_error').text('*Please enter a quatation date.');
                event.preventDefault();
            }

            if (adminId === null) {
                $('#admin_id_error').text('*Please select a admin.');
                event.preventDefault();
            }

            if (userId === null) {
                $('#user_id_error').text('*Please select a user.');
                event.preventDefault();
            }

            if (client_name == '') {
                $('#client_name_error').text('*Please enter client name.');
                event.preventDefault();
            }

            if (q_desc == '') {
                $('#q_desc_error').text('*Please enter client description.');
                event.preventDefault();
            }

            if (service_id === null) {
                $('#service_id_error').text('*Please select a service.');
                event.preventDefault();
            }

            if (q_amount == '') {
                $('#q_amount_error').text('*Please enter quoted ammount.');
                event.preventDefault();
            }

            if (currency_code === null) {
                $('#currency_code_error').text('*Please select a currency.');
                event.preventDefault();
            }

            if (location === null) {
                $('#location_error').text('*Please select a location.');
                event.preventDefault();
            }

            if (client_mail == '') {
                $('#client_mail_error').text('*Please write a email.');
                event.preventDefault();
            }
        });



        $('#q_date').on('input', function() {
            $('#q_date_error').text('');
        });

        $('#admin_id').on('input', function() {
            $('#admin_id_error').text('');
        });

        $('#user_id').on('change', function() {
            $('#user_id_error').text('');
        });

        $('#currency_code').on('change', function() {
            $('#currency_code_error').text('');
        });

        $('#service_id').on('change', function() {
            $('#service_id_error').text('');
        });

        $('#q_amount').on('input', function() {
            $('#q_amount_error').text('');
        });

        $('#client_name').on('input', function() {
            $('#client_name_error').text('');
        });

        $('#q_desc').on('input', function() {
            $('#q_desc_error').text('');
        });

        $('#client_mail').on('input', function() {
            $('#client_mail_error').text('');
        });

        $('#location').on('change', function() {
            $('#location_error').text('');
        });

    });

    function getDrivers(clientId) {
        $.ajax({
            url: '/get_users/' + clientId,
            type: 'GET',
            success: function(response) {
                var drivers = response;

                var options = '';
                drivers.forEach(function(driver) {
                    options += '<option value="' + driver.id + '">' + driver.name + '</option>';
                });
                if (options) {
                    $('#user_id_error').text('');
                    $('#user_id').html(options);
                } else {
                    $('#user_id_error').text('*admin do not have any user.');
                    $('#user_id').html('');
                }
            },
            error: function(xhr, status, error) {
                // Handle the error
            }
        });
    }
</script>

@endsection