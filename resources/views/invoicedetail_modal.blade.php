<style>
  #invoicedetail {
    backdrop-filter: blur(5px);
    background-color: #01223770;
  }
</style>
<!-- Invoice Detail Modal -->
<div class="modal fade" id="invoicedetail" tabindex="-1" aria-labelledby="invoicedetaillable" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: #184A45FF; border-radius: 12px 12px 0px 0px;">
        <h5 class="modal-title mx-auto text-white" id="inovicedetaillable"><span>@lang('Invoice Details')</span></h5>
        <button class="btn p-0" data-dismiss="modal">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="modal-body pt-1">

        <div id="mdl-spinnerDt">
          <div style="height:60vh" class="d-flex justify-content-center align-items-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div id="data-inoviceDetails" class="d-none">
          <div class="row pb-2 mb-2" style="border-bottom: 2px solid #ACADAE4D;">
            <div class="col-lg-6 mt-4 mb-1">
              <div class="d-flex justify-content-evenly">
                <div class="">
                  <img src="assets/images/user.png" id="inoviceDetail_adminImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div>
                  <label for="client_name" class="mb-0"><span style="color: #184A45FF;">@lang('Admin Name')</span></label>
                  <input type="text" disabled id="inoviceDetail_admin" class="form-control" value="">
                </div>
              </div>
            </div>
            <div class="col-lg-6 mt-4 mb-1">
              <div class="d-flex justify-content-evenly">
                <div class="">
                  <img src="assets/images/user.png" id="inoviceDetail_userImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div>
                  <label for="client_name" class="mb-0"><span style="color: #184A45FF;">@lang('User Name')</span></label>
                  <input type="text" disabled id="inoviceDetail_user" class="form-control" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-2">

            <div class="col-lg-8">
              <div class="pl-lg-4 pl-sm-0 pl-0">
                <label for="inovice_title" class="mb-0"><span style="color: #184A45FF;">@lang('Client Name')</span></label>
                <input type="text" disabled id="inoviceDetail_clientName" class="form-control" value="">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="pr-lg-4 pr-sm-0 pr-0">
                <label for="inovice_title" class="mb-0"><span style="color: #184A45FF;">@lang('Invoice Date')</span></label>
                <input type="text" disabled class="form-control" id="inoviceDetail_date" value="">
              </div>
            </div>

            <div class="col-lg-12 mt-2">
              <div class="px-lg-4 px-sm-0 px-0">
                <label for="inovice_desc" class="mb-0"><span style="color: #184A45FF;">@lang('Invoice Description')</span></label>
                <textarea name="" rows="5" id="inoviceDetail_description" class="form-control" disabled></textarea>
              </div>
            </div>

            <div class="col-lg-6 mt-2 pr-0">
              <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="inovice_desc" class="mb-0"><span style="color: #184A45FF;">@lang('Invoice Ammount')</span></label>
                <input type="text" id="inoviceDetail_ammount" class="form-control" disabled value="">
              </div>
            </div>
            <div class="col-lg-6 mt-2 pl-0">
              <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                <label for="inovice_desc" class="mb-0"><span style="color: #184A45FF;">@lang('Invoice Service')</span></label>
                <input type="text" id="inoviceDetail_service" class="form-control" disabled value="">
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