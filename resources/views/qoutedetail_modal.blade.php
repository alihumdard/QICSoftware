<style>
  #qoutedetail {
    backdrop-filter: blur(5px);
    background-color: #01223770;
  }
</style>
<!-- qoute Detail Modal -->
<div class="modal fade" id="qoutedetail" tabindex="-1" aria-labelledby="qoutedetaillable" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: #184A45FF; border-radius: 12px 12px 0px 0px;">
        <h5 class="modal-title mx-auto text-white" id="qoutedetaillable"><span>@lang('Quotation Details')</span></h5>
        <button class="btn p-0" data-dismiss="modal">
          <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="modal-body pt-1">

        <div id="mdl-spinner" class="d-none">
          <div style="height:60vh" class="d-flex justify-content-center align-items-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div id="data-qouteDetails" class="d-none">
          <div class="row pb-2 mb-2" style="border-bottom: 2px solid #ACADAE4D;">

            <div class="col-lg-6 mt-4 mb-1">
              <div class="d-flex justify-content-evenly">
                <div class="">
                  <img src="assets/images/user.png" id="quoteDetail_adminImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div>
                  <label for="quoteDetail_admin" class="mb-0"><span style="color: #184A45FF;">@lang('Admin Name')</span></label>
                  <input type="text" disabled id="quoteDetail_admin" class="form-control" value="">
                </div>
              </div>
            </div>

            <div class="col-lg-6 mt-4 mb-1">
              <div class="d-flex justify-content-evenly">
                <div class="">
                  <img src="assets/images/user.png" id="quoteDetail_userImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                </div>
                <div>
                  <label for="quoteDetail_user" class="mb-0"><span style="color: #184A45FF;">@lang('User Name')</span></label>
                  <input type="text" disabled id="quoteDetail_user" class="form-control" value="">
                </div>
              </div>
            </div>

          </div>
          <div class="row mb-2">

            <div class="col-lg-4  mt-2 pr-0">
              <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="quoteDetail_clientName" class="mb-0"><span style="color: #184A45FF;">@lang('Client Name')</span></label>
                <input type="text" disabled id="quoteDetail_clientName" class="form-control" value="">
              </div>
            </div>

            <div class="col-lg-4 mt-2 pr-0">
              <div class="pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="quoteDetail_ammount" class="mb-0"><span style="color: #184A45FF;">@lang('Total Ammount')</span></label>
                <input type="text" id="quoteDetail_ammount" class="form-control" disabled value="">
              </div>
            </div>


            <div class="col-lg-4  mt-2 ">
              <div class=" pl-sm-0 pr-sm-3 pl-0 pr-3">
                <label for="quoteDetail_date" class="mb-0"><span style="color: #184A45FF;">@lang('Qouted Date')</span></label>
                <input type="text" disabled class="form-control" id="quoteDetail_date" value="">
              </div>
            </div>


            <div class="col-lg-12 mt-2">
              <div class="px-lg-4 px-sm-0 px-0">
                <label for="quoteDetail_description" class="mb-0"><span style="color: #184A45FF;">@lang('Quotation Description')</span></label>
                <textarea rows="5" name="" id="quoteDetail_description" class="form-control" disabled></textarea>
              </div>
            </div>

            <div class="col-lg-12 mt-4">
              <div class="px-lg-4 px-sm-0 px-0">
                <table class="table table-striped table-bordered">
                  <thead class="thead-dark">
                    <tr class="text-center">
                      <th>#</th>
                      <th>Service Name</th>
                      <th>Service Amount</th>
                    </tr>
                  </thead>
                  <tbody id="tbl_sevice_data">
                    <!-- Add  rows here as needed -->
                  </tbody>
                </table>
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- quote Detail Modal End -->
<script>
  var services = @json($services);
  // Quote Detail  data in through the api...
  $(document).on('click', '.quoteDetail_view', function(e) {
    e.preventDefault();
    var quoteDetail = $(this);
    var quoteId = quoteDetail.attr('data-id');

    var apiname = 'quoteDetail';
    var apiurl = "{{ end_url('') }}" + apiname;
    var payload = {
      id: quoteId,
      role: 'Admin',
    };

    var bearerToken = "{{session('access_token')}}";

    $.ajax({
      url: apiurl,
      type: 'POST',
      data: JSON.stringify(payload),
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + bearerToken
      },
      beforeSend: function() {
        $('#data-qouteDetails').addClass('d-none');
        $('#mdl-spinner').removeClass('d-none');
      },
      success: function(response) {

        if (response.status === 'success') {
          let s_id = response.data.service_id;
          if (response.data.admin_pic) {
            $('#quoteDetail_adminImg').attr('src', "{{ asset('storage') }}/" + response.data.admin_pic);
          } else {
            $('#quoteDetail_adminImg').attr('src', "assets/images/user.png")
          }

          if (response.data.user_pic) {
            $('#quoteDetail_userImg').attr('src', "{{ asset('storage') }}/" + response.data.user_pic);
          } else {
            $('#quoteDetail_userImg').attr('src', "assets/images/user.png")
          }

          $("#quoteDetail_admin").val(response.data.admin_name);
          $("#quoteDetail_user").val(response.data.user_name);
          $("#quoteDetail_clientName").val(response.data.client_name);
          $("#quoteDetail_description").val(response.data.desc);
          $("#quoteDetail_date").val(response.data.date);
          $("#quoteDetail_ammount").val(response.data.amount + ' (' + response.data.currency.code + ')');
          $("#quoteDetail_service").val(services[s_id]);

          var serviceData = response.data.service_data;
          var tbody = $("#tbl_sevice_data");
          var ind = 1;
          $.each(JSON.parse(serviceData), function(index, key) {
            var row = $("<tr class='text-center'>");
            $("<td>").text(ind++).appendTo(row);
            $("<td>").text(services[key.service_id]).appendTo(row);
            $("<td>").text(key.s_amount + ' (' + response.data.currency.code + ')').appendTo(row);
            row.appendTo(tbody);
          });

          setTimeout(function() {
            $('#mdl-spinner').addClass('d-none');
            $('#data-qouteDetails').removeClass('d-none');
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