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

        <div id="mdl-spinnerDt" class="d-none ">
          <div style="height:60vh" class=" d-flex justify-content-center align-items-center">
            <div class="spinner-border  " role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div id="data-inoviceDetails" class="">

          <div class="row mt-4 ">

            <div class="col-lg-6 mt-2 pr-0">
              <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="reply_email" class="mb-0 "><span style="color: #184A45FF; ">@lang('Reply Email')</span></label>
                <input type="email" maxlength="200" name="reply_email" id="reply_email" value="{{ $data['reply_email'] ?? '' }}" placeholder="@lang('transection reply email')" class="form-control">
              </div>
            </div>

            <div class="col-lg-6 mt-2 pl-0">
              <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                <label for="cc_email" class="mb-0"><span style="color: #184A45FF;">@lang('Cc Email')</span></label>
                <input type="email" maxlength="200" name="cc_email" id="cc_email" value="{{ $data['cc_email'] ?? '' }}" placeholder="@lang('transection cc email')" class="form-control">
              </div>
            </div>

            <div class="col-lg-6 mt-2 pr-0">
              <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="reply_email" class="mb-0"><span style="color: #184A45FF;">@lang('Bcc Email')</span></label>
                <input type="email" maxlength="200" name="bcc_email" id="bcc_email" value="{{ $data['bcc_email'] ?? '' }}" placeholder="@lang('transection bcc email')" class="form-control">
              </div>
            </div>

            <div class="col-lg-6 mt-2 pl-0">
              <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                <label for="cc_email" class="mb-0"><span style="color: #184A45FF;">@lang('Transactional Email')</span></label>
                <input required type="email" disabled name="email" id="email" value="{{ $data['email'] ?? '' }}" placeholder="@lang('enter transectional email')" class="form-control">
              </div>
            </div>

            <div class="col-lg-12 mt-3 ">
              <div class="px-lg-4 px-sm-0 px-0">
                <label for="inovice_title" class="mb-0"><span style="color: #184A45FF;">@lang('Email Subject')</span></label>
                <input type="text" maxlength="230" name="email_subject" id="email_subject" value="{{ $data['email_subject'] ?? '' }}" placeholder="@lang('transection email Subject')" class="form-control">
              </div>
            </div>

            <div class="col-lg-12 mt-1 mb-0">
              <div class="px-lg-4 px-sm-0 px-0">
                <label for="email_body" class="mb-0"><span style="color: #184A45FF;">@lang('Email Body')</span></label>
                <textarea name="email_body" rows="20" id="email_body" class="form-control summernote"> {{ $data['email_body'] ?? '' }} </textarea>
              </div>
            </div>

            <div class="col-lg-6 mt-2 pr-0">
              <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="inovice_desc" class="mb-1"><span style="color: #184A45FF;">@lang('Select Admin')</span></label>
                <select id="admin_id" name="admin_id" class="form-select">
                  <option value="" selected disabled>select admin </option>
                  <option value="">admin </option>
                </select>
              </div>
            </div>

            <div class="col-lg-3 mt-2  ">
              <div class=" pt-4 ">
                <button type="submit" id="inoviceDetail_service" class=" btn btn-primary float-right btn-block pb-2"> Save as Draft </button>
              </div>
            </div>

            <div class="col-lg-3 mt-2  pl-0">
              <div class="pr-lg-4 pl-lg-1 pl-sm-3 pr-sm-0 pl-3 pr-0 pt-4 ">
                <button type="submit" id="inoviceDetail_service" class=" btn btn-success float-right btn-block pb-2">Send Mail </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Invoice Detail Modal End -->

<script>
  // Invoice Detail  data in through the api...
  $(document).on('click', '.invoiceDetail_view', function(e) {
    e.preventDefault();
    var inoviceDetail = $(this);
    var inoviceId = inoviceDetail.attr('data-id');

    var apiname = 'invoiceDetail';
    var apiurl = "{{ end_url('') }}" + apiname;
    var payload = {
      id: inoviceId,
      role: 'Admin',
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
        $('#data-inoviceDetails').addClass('d-none');
        $('#mdl-spinnerDt').removeClass('d-none');
      },
      success: function(response) {

        if (response.status === 'success') {
          let s_id = response.data.service_id;
          if (response.data.admin_pic) {
            $('#inoviceDetail_adminImg').attr('src', "{{ asset('storage') }}/" + response.data.admin_pic);
          } else {
            $('#inoviceDetail_adminImg').attr('src', "assets/images/user.png")
          }

          if (response.data.user_pic) {
            $('#inoviceDetail_userImg').attr('src', "{{ asset('storage') }}/" + response.data.user_pic);
          } else {
            $('#inoviceDetail_userImg').attr('src', "assets/images/user.png")
          }

          $("#inoviceDetail_admin").val(response.data.admin_name);
          $("#inoviceDetail_user").val(response.data.user_name);
          $("#inoviceDetail_clientName").val(response.data.client_name);
          $("#inoviceDetail_description").val(response.data.desc);
          $("#inoviceDetail_date").val(response.data.date);
          $("#inoviceDetail_ammount").val(response.data.amount + ' (' + response.data.currency_code + ')');
          $("#inoviceDetail_service").val(response.data.service.service_title);
          setTimeout(function() {
            $('#mdl-spinnerDt').addClass('d-none');
            $('#data-inoviceDetails').removeClass('d-none');
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
</script>