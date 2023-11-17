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

        <form action="sendMail"  class="apiform" method="post">
            <div class="row mt-4 ">
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

              <div class="col-lg-6 mt-2 pr-0">
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

              <div class="col-lg-3 mt-2  ">
                <div class=" pt-4 ">
                  <input type="submit" name="draft" id="draft" class=" btn btn-primary float-right btn-block pb-2" value="Save as Draft" />
                </div>
              </div>

              <div class="col-lg-3 mt-2  pl-0">
                <div class="pr-lg-4 pl-lg-1 pl-sm-3 pr-sm-0 pl-3 pr-0 pt-4 ">
                  <input type="submit" name="send" id="send" class=" btn btn-success float-right btn-block pb-2" value="Send Mail" />
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