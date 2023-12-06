@extends('layouts.main')
@section('main-section')
<!-- partial -->
<div class="content-wrapper py-0 my-2 mb-5">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title pb-3">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23.1783 16.5241L19.5521 3.01716C19.1579 1.54862 17.353 1.00759 16.2133 2.01629L13.9278 4.039C11.3845 6.28991 8.35111 7.91891 5.06775 8.79698C2.31938 9.53199 0.690561 12.3597 1.42698 15.1028C2.16341 17.8459 4.99058 19.4819 7.73896 18.7469C11.0223 17.8688 14.4654 17.7657 17.7956 18.4459L20.7882 19.0571C22.2806 19.3619 23.5725 17.9926 23.1783 16.5241Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M7.53931 8.09998L11.7001 23.5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span>@lang('Transactional Settings ')</span>
        </h3>
        <div class="container" id="home">
          @if (Session::has('msg'))
          <div class="alert alert-success col-lg-8 col-md-12 col-sm-12 ">
            <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
            <strong>{{ session('msg') }}</strong>
          </div>
          @endif
          <form action="transectionStore" id="formData" method="post">
            <input type="hidden" name="id" value="{{$transectional->id ?? ''}} ">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="user_id">@lang('Transactional User')</label>
                <select id="user_id" name="user_id" class="form-select">
                  @if($user->role == user_roles('1'))
                  <option value="{{$user->id}}" {{($transectional->user_id ?? '') == $user->id ? 'selected' : ''}}> Self </option>
                  @endif
                  <option value="" {{($transectional->user_id ?? '') == $user->id ? '' : 'selected'}} disabled>select email user </option>
                  @foreach($admins as $key => $val)
                  <option value="{{$key}}" {{($transectional->user_id ?? '') == $key ? 'selected' : ''}}>{{$val}}</option>
                  @endforeach
                </select>

                <span id="user_id_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" class="mt-1" class="form-label" for="email">@lang('Transactional Email')</label>
                <input required type="email" maxlength="100" name="email" id="email" value="{{ $transectional->email ?? '' }}" placeholder="@lang('enter transectional email')" class="form-control">
                <span id="email_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="password">@lang('Transactional Password')</label>
                <input required type="text" maxlength="100" name="password" id="password" value="{{ $transectional->password ?? '' }}" placeholder="@lang('email password')" class="form-control">
                <span id="password_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="port">@lang('Mail Port')</label>
                <input required type="text" maxlength="100" name="port" id="port" value="{{ $transectional->port ?? '' }}" placeholder="@lang('transectional email port')" class="form-control">
                <span id="port_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="host">@lang('Mail Host')</label>
                <input required type="text" maxlength="100" name="host" id="host" value="{{ $transectional->host ?? '' }}" placeholder="@lang('email host')" class="form-control">
                <span id="host_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="mail_encryption">@lang('Mail Encryption')</label>
                <select id="mail_encryption" name="mail_encryption" class="form-select">
                  <option value="" disabled selected>select mail encryption</option>
                  <option value="ssl" {{($transectional->mail_encryption ?? '' == 'ssl')?  'selected' : ''}}>SSL</option>
                  <option value="tsl" {{($transectional->mail_encryption ?? '' == 'tsl')?  'selected' : ''}}>TSL</option>
                </select>
                <span id="mail_encryption_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="reply_email">@lang('Reply Email')</label>
                <input type="email" maxlength="200" name="reply_email" id="reply_email" value="{{ $transectional->reply_email ?? '' }}" placeholder="@lang('transection reply email')" class="form-control">
                <span id="reply_email_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="cc_email">@lang('Cc Email')</label>
                <input type="email" maxlength="200" name="cc_email" id="cc_email" value="{{ $transectional->cc_email ?? '' }}" placeholder="@lang('transection cc email')" class="form-control">
                <span id="cc_email_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-2 mb-1" for="bcc_email">@lang('Bcc Email')</label>
                <input type="email" maxlength="200" name="bcc_email" id="bcc_email" value="{{ $transectional->bcc_email ?? '' }}" placeholder="@lang('transection bcc email')" class="form-control">
                <span id="bcc_email_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                <label class="mt-4 mb-1" for="email_subject">@lang('Email Subject')</label>
                <input type="text" maxlength="230" name="email_subject" id="email_subject" value="{{ $transectional->email_subject ?? '' }}" placeholder="@lang('transection email Subject')" class="form-control">
                <span id="email_subject_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12">
                <label class="mt-2 mb-1" for="email_body">@lang('Default Email Body')</label>
                <textarea name="email_body" id="email_body" class="form-control summernote"> {{ $transectional->email_body ?? '' }} </textarea>
                <span id="email_body_error" class="error-message text-danger"></span>
              </div>

              <div class="mt-3">
                <div class="row justify-content-end mt-2  ">
                  <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                    <button type="submit" id="btn_save" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                      <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                      <span id="text">@lang('Save')</span>
                    </button>
                  </div>
                </div>
              </div>

          </form>
        </div>

        <hr>
        <div class="px-2">
          <div class="table-responsive">
            <table id="transection-table" class="display" style="width:100%">
              <thead class="text-white" style="background-color: #184A45;">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th>@lang('Created at')</th>
                  <th>@lang('lang.name')</th>
                  <th>@lang('lang.email')</th>
                  <th>@lang('lang.status')</th>
                  <th>@lang('lang.actions')</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach($data as $key => $value)
                <tr style="font-size: small;">
                  <td>{{++$key}}</td>
                  <td>{{table_date($value['created_at'])}}</td>
                  <td> {{ $value['user']['name'] ?? ''}} </td>
                  <td>{{ $value['email'] ?? '' }}</td>

                  @if($value['status'] == 1)
                  <td>
                    <button class="btn btn_status">
                      <span data-client_id="{{$value['id']}}">
                        <div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">Active</div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @elseif($value['status'] == 2)
                  <td>
                    <button class="btn btn_status">
                      <span data-client_id="{{$value['id']}}">
                        <div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 4px; padding-left: 15px; padding-right: 13px; background: rgba(77, 77, 77, 0.12); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center; color: #8F9090; font-size: 14px; font-weight: 500; word-wrap: break-word">@lang('lang.pending')</div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @elseif($value['status'] == 5)
                  <td>
                    <button class="btn btn_status">
                      <span data-client_id="{{$value['id']}}">
                        <div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 14px; padding-right: 12px;    background: rgba(245, 34, 45, 0.19); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center; color: #F5222D; font-size: 14px; font-weight: 500; word-wrap: break-word">@lang('lang.deleted')</div>
                        </div>
                      </span>
                    </button>
                  </td>

                  @else
                  <td>
                    <button class="btn btn_status">
                      <span data-client_id="{{$value['id']}}">
                        <div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 14px; padding-right: 12px;    background: rgba(245, 34, 45, 0.19); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center; color: #F5222D; font-size: 14px; font-weight: 500; word-wrap: break-word">@lang('lang.suspend')</div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @endif
                  <td style="width: 80px;">
                    @if($value['status'] != 5)
                    <div class="row">
                      <div class="col-6 p-0">
                        <form method="POST" action="/transactional">
                          @csrf
                          <input type="hidden" name="id" value="{{$value['id']}}">
                          <input type="hidden" name="action" value="edit">
                          <button id="btn_edit_currency" class="btn p-0">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
                            </svg>
                          </button>
                        </form>
                      </div>
                      <div class="col-6 p-0">
                        <form method="POST" action="/transactional">
                          @csrf
                          <input type="hidden" name="id" value="{{$value['id']}}">
                          <input type="hidden" name="action" value="dell">
                          <button id="btn_dell_currency" class="btn btn_dell_currency p-0" data-toggle="modal" data-target="#deleteclient">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4909 13.743C23.7359 13.743 23.94 13.9465 23.94 14.2054V14.4448C23.94 14.6975 23.7359 14.9072 23.4909 14.9072H13.0497C12.804 14.9072 12.6 14.6975 12.6 14.4448V14.2054C12.6 13.9465 12.804 13.743 13.0497 13.743H14.8866C15.2597 13.743 15.5845 13.4778 15.6684 13.1036L15.7646 12.6739C15.9141 12.0887 16.4061 11.7 16.9692 11.7H19.5708C20.1277 11.7 20.6252 12.0887 20.7692 12.6431L20.8721 13.1029C20.9555 13.4778 21.2802 13.743 21.654 13.743H23.4909ZM22.5577 22.4943C22.7495 20.707 23.0852 16.4609 23.0852 16.418C23.0975 16.2883 23.0552 16.1654 22.9713 16.0665C22.8812 15.9739 22.7672 15.9191 22.6416 15.9191H13.9032C13.777 15.9191 13.6569 15.9739 13.5735 16.0665C13.489 16.1654 13.4473 16.2883 13.4534 16.418C13.4546 16.4259 13.4666 16.5755 13.4868 16.8255C13.5762 17.9364 13.8255 21.0303 13.9865 22.4943C14.1005 23.5729 14.8081 24.2507 15.8332 24.2753C16.6242 24.2936 17.4391 24.2999 18.2724 24.2999C19.0573 24.2999 19.8544 24.2936 20.6699 24.2753C21.7305 24.257 22.4376 23.5911 22.5577 22.4943Z" fill="#D11A2A" />
                            </svg>
                          </button>
                        </form>
                      </div>
                    </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    let transection_table = $('#transection-table').DataTable();

    $('#btn_save').click(function(event) {
      var adminId = $('#user_id').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var port = $('#port').val();
      var host = $('#host').val();
      var mail_encryption = $('#mail_encryption').val();

      // Reset error messages
      $('.error-message text-danger').text('');


      if (adminId === null) {
        $('#user_id_error').text('*Please select a admin.');
        event.preventDefault();
      }

      if (email == '') {
        $('#email_error').text('*Please select a email.');
        event.preventDefault();
      }

      if (password == '') {
        $('#password_error').text('*Please enter password.');
        event.preventDefault();
      }

      if (port == '') {
        $('#port_error').text('*Please enter client port.');
        event.preventDefault();
      }

      if (mail_encryption === null) {
        $('#mail_encryption_error').text('*Please select a mail_encryption.');
        event.preventDefault();
      }

      if (host == '') {
        $('#host_error').text('*Please enter mail host.');
        event.preventDefault();
      }
    });

    $('#email').on('input', function() {
      $('#email_error').text('');
    });

    $('#password').on('input', function() {
      $('#password_error').text('');
    });

    $('#port').on('input', function() {
      $('#port_error').text('');
    });

    $('#host').on('input', function() {
      $('#host_error').text('');
    });

    $('#user_id').on('change', function() {
      $('#user_id_error').text('');
    });

    $('#mail_encryption').on('change', function() {
      $('#mail_encryption_error').text('');
    });
  </script>

  @endsection