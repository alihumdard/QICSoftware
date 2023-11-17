<style>
  #invoiceMail {
    backdrop-filter: blur(5px);
    background-color: #01223770;
  }
</style>
<!-- Invoice Detail Modal -->
<div class="modal fade" id="invoiceMail" tabindex="-1" role="dialog" aria-labelledby="invoiceMail" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: #184A45FF; border-radius: 12px 12px 0px 0px;">
        <h5 class="modal-title mx-auto text-white" id="inovicedetaillable"><span>@lang('Invoice Email Details')</span></h5>
        <button class="btn p-0" data-dismiss="modal">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="modal-body pt-1">

        <div id="mdl-spinnerMail" class="">
          <div style="height:85vh" class=" d-flex justify-content-center align-items-center">
            <div class="spinner-border  " role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div id="data-mailData" class="d-none">

          <form action="sendMail" class="apiform" method="post">
            <div class="row mt-4 mb-3">
              <div class="col-lg-6 mt-2 pr-0">
                <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                  <label for="reply_email" class="mb-0 "><span style="color: #184A45FF; ">@lang('Reply Email')</span></label>
                  <input type="email" maxlength="200" name="reply_email" id="reply_email" value="{{ $transData['reply_email'] ?? '' }}" placeholder="@lang('transection reply email')" class="form-control">
                </div>
              </div>

              <div class="col-lg-6 mt-2 pl-0">
                <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                  <label for="cc_email" class="mb-0"><span style="color: #184A45FF;">@lang('Cc Email')</span></label>
                  <input type="email" maxlength="200" name="cc_email" id="cc_email" value="{{ $transData['cc_email'] ?? '' }}" placeholder="@lang('transection cc email')" class="form-control">
                </div>
              </div>

              <div class="col-lg-6 mt-2 pr-0">
                <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                  <label for="reply_email" class="mb-0"><span style="color: #184A45FF;">@lang('Bcc Email')</span></label>
                  <input type="email" maxlength="200" name="bcc_email" id="bcc_email" value="{{ $transData['bcc_email'] ?? '' }}" placeholder="@lang('transection bcc email')" class="form-control">
                </div>
              </div>

              <div class="col-lg-6 mt-2 pl-0">
                <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                  <label for="cc_email" class="mb-0"><span style="color: #184A45FF;">@lang('Transactional Email')</span></label>
                  <input required type="email" disabled name="email" id="email" value="{{ $transData['email'] ?? '' }}" placeholder="@lang('enter transectional email')" class="form-control">
                </div>
              </div>

              <div class="col-lg-12 mt-3 ">
                <div class="px-lg-4 px-sm-0 px-0">
                  <label for="inovice_title" class="mb-0"><span style="color: #184A45FF;">@lang('Email Subject')</span></label>
                  <input type="text" maxlength="230" name="email_subject" id="email_subject" value="{{ $transData['email_subject'] ?? '' }}" placeholder="@lang('transection email Subject')" class="form-control">
                </div>
              </div>

              <div class="col-lg-12 mt-1 mb-0">
                <div class="px-lg-4 px-sm-0 px-0">
                  <label for="email_body" class="mb-0"><span style="color: #184A45FF;">@lang('Email Body')</span></label>
                  <textarea name="email_body" rows="20" id="email_body" class="form-control summernote"> {{ $transData['email_body'] ?? '' }} </textarea>
                </div>
              </div>

              <div class="col-lg-4 mt-2 pr-0">
                <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                  <label for="inovice_desc" class="mb-1"><span style="color: #184A45FF;">@lang('Select Admin')</span></label>
                  <select id="user_id" name="user_id" class="form-select">
                    @if($user->role == user_roles('1'))
                    <option selected value="{{$user->id}}">Self</option>
                    @endif
                    <option value="" disabled>{{ ($transAdmins) ? 'select admin' : 'Add more admins' }}</option>
                    @foreach($transAdmins as $key => $val)
                    <option value="{{$key}}">{{$val}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-8 mt-2 d-flex align-items-end ">
                <div class="mt-2 ">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input form-check-input-lg " name="process" checked value="mail">
                      <span class="pb-5 mb-5"> Send Only Mail </span>
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input form-check-input-lg" name="process" value="draft">
                      <span class="pb-5">Save As Daraft </span>
                    </label>
                  </div>
                  <div class="form-check-inline ">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input form-check-input-lg" name="process" value="mail&draft">
                      <span class="pb-5"> Draft & Send Mail</span>
                    </label>
                  </div>
                  <!-- <input type="button" name="draft" id="draft" class="btn btn-primary float-right btn-block pb-2" value="Save as Draft" /> -->
                </div>
              </div>

              <div class="col-lg-12 mb-lg-2  ">
                <div class="row justify-content-end mt-3 pr-lg-4">
                  <div class="col-lg-2">
                    <button type="submit" id="btn_save_quotation" class="btn btn-block  text-white " style="background-color: #184A45FF; border-radius: 8px;">
                      <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>

                      <span id="text" class="d-flex justify-content-center align-items-center">
                        <span class="pr-1">
                          @lang(' GO ')
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.2em; height: 1.1em;">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>

                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                          <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                        </svg> -->


                      </span>

                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Invoice Detail Modal End -->

<script>
  $(document).on('click', '.sendmail', function(e) {
    e.preventDefault();
    setTimeout(function() {
      $('#mdl-spinnerMail').addClass('d-none');
      $('#data-mailData').removeClass('d-none');
    }, 700);
  });

  // Invoice Detail  data in through the api...
  $(document).on('change', '#user_id', function(e) {
    e.preventDefault();
    var user_id = $('#user_id').val();

    var apiname = 'transectionals';
    var apiurl = "{{ end_url('') }}" + apiname;
    var payload = {
      user_id: user_id,
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
        $('#mdl-spinnerMail').removeClass('d-none');
        $('#data-mailData').addClass('d-none');
      },
      success: function(response) {

        if (response.status === 'success') {
          if (response.data) {
            $("#reply_email").val(response.data.reply_email);
            $("#cc_email").val(response.data.cc_email);
            $("#bcc_email").val(response.data.bcc_email);
            $("#email").val(response.data.email);
            $("#email_subject").val(response.data.email_subject);
            $("#email_body").summernote('code', response.data.email_body);
          }

          setTimeout(function() {
            $('#mdl-spinnerMail').addClass('d-none');
            $('#data-mailData').removeClass('d-none');
          }, 500);

        } else if (response.status === 'error') {
          showAlert("Warning", "Please fill the form correctly", response.status);
          console.log(response.message);
          $('#mdl-spinnerMail').addClass('d-none');
          $('#data-mailData').removeClass('d-none');
        }
      },
      error: function(xhr, status, error) {
        $('#mdl-spinnerMail').addClass('d-none');
        $('#data-mailData').removeClass('d-none');
        console.log(status);
        showAlert("Error", 'Request Can not Procceed', 'Can not Procceed furhter');
      }
    });
  });
</script>