                      <!-- Contract  Detail Modal -->
                      <div class="modal fade" id="contractdetail" tabindex="-1" aria-labelledby="qoutedetaillable" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" style="border-radius: 12px;">
                            <div class="modal-header" style="background: #452C88; border-radius: 12px 12px 0px 0px;">
                              <h5 class="modal-title mx-auto text-white" id="qoutedetaillable"><span>@lang('Contract Details')</span></h5>
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

                              <div id="data-contractDetails" class="d-none">
                                <div class="row pb-2 mb-2" style="border-bottom: 2px solid #ACADAE4D;">
                                  <div class="col-lg-6 mt-4 mb-1">
                                    <div class="d-flex justify-content-evenly">
                                      <div class="">
                                        <img src="assets/images/user.png" id="contractDetail_adminImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                                      </div>
                                      <div>
                                        <label for="client_name" class="mb-0"><span style="color: #452C88;">@lang('Admin Name')</span></label>
                                        <input type="text" disabled id="contractDetail_admin" class="form-control" value="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 mt-4 mb-1">
                                    <div class="d-flex justify-content-evenly">
                                      <div class="">
                                        <img src="assets/images/user.png" id="contractDetail_userImg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                                      </div>
                                      <div>
                                        <label for="client_name" class="mb-0"><span style="color: #452C88;">@lang('User Name')</span></label>
                                        <input type="text" disabled id="contractDetail_user" class="form-control" value="">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row mb-2">

                                  <div class="col-lg-4">
                                    <div class="pl-lg-4 pl-sm-0 pl-0">
                                      <label for="contractDetail_clientName" class="mb-0"><span style="color: #452C88;">@lang('Client Name')</span></label>
                                      <input type="text" disabled id="contractDetail_clientName" class="form-control" value="">
                                    </div>
                                  </div>

                                  <div class="col-lg-4">
                                    <div class="pr-lg-4 pr-sm-0 pr-0">
                                      <label for="c_start_date" class="mb-0"><span style="color: #452C88;">@lang('Start Date')</span></label>
                                      <input type="text" disabled class="form-control" id="c_start_date" value="">
                                    </div>
                                  </div>

                                  <div class="col-lg-4">
                                    <div class="pr-lg-4 pr-sm-0 pr-0">
                                      <label for="c_end_date" class="mb-0"><span style="color: #452C88;">@lang('End Date')</span></label>
                                      <input type="text" disabled class="form-control" id="c_end_date" value="">
                                    </div>
                                  </div>

                                  <div class="col-lg-12 mt-2">
                                    <div class="px-lg-4 px-sm-0 px-0">
                                      <label for="contractDetail_description" class="mb-0"><span style="color: #452C88;">@lang('Contract Description')</span></label>
                                      <textarea name="" rows="5" id="contractDetail_description" class="form-control" disabled></textarea>
                                    </div>
                                  </div>

                                  <div class="col-lg-4 mt-2 pr-0">
                                    <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                                      <label for="c_location" class="mb-0"><span style="color: #452C88;">@lang('Contract Location')</span></label>
                                      <input type="text" id="c_location" class="form-control" disabled value="">
                                    </div>
                                  </div>

                                  <div class="col-lg-4 mt-2 pr-0">
                                    <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                                      <label for="c_ammount" class="mb-0"><span style="color: #452C88;">@lang('Contract Ammount')</span></label>
                                      <input type="text" id="c_ammount" class="form-control" disabled value="">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 mt-2 pl-0">
                                    <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                                      <label for="c_category" class="mb-0"><span style="color: #452C88;">@lang('Contract Category')</span></label>
                                      <input type="text" id="c_category" class="form-control" disabled value="">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Contract  Detail Modal End -->
                      <script>
                        // Contract Detail  data in through the api...
                        $(document).on('click', '.contractDetail_view', function(e) {
                          e.preventDefault();
                          var contractDetail = $(this);
                          var contractId = contractDetail.attr('data-id');

                          var apiname = 'contractDetail';
                          var apiurl = "{{ end_url('') }}" + apiname;
                          var payload = {
                            id: contractId,
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
                              $('#data-contractDetails').addClass('d-none');
                              $('#mdl-spinner').removeClass('d-none');
                            },
                            success: function(response) {

                              if (response.status === 'success') {
                                let s_id = response.data.service_id;
                                if (response.data.admin_pic) {
                                  $('#contractDetail_adminImg').attr('src', "{{ asset('storage') }}/" + response.data.admin_pic);
                                } else {
                                  $('#contractDetail_adminImg').attr('src', "assets/images/user.png")
                                }

                                if (response.data.user_pic) {
                                  $('#contractDetail_userImg').attr('src', "{{ asset('storage') }}/" + response.data.user_pic);
                                } else {
                                  $('#contractDetail_userImg').attr('src', "assets/images/user.png")
                                }

                                $("#contractDetail_admin").val(response.data.admin_name);
                                $("#contractDetail_user").val(response.data.user_name);
                                $("#contractDetail_clientName").val(response.data.client_name);
                                $("#contractDetail_description").val(response.data.desc);
                                $("#c_start_date").val(response.data.start_date);
                                $("#c_end_date").val(response.data.end_date);
                                $("#c_location").val(response.data.location.name);
                                $("#c_ammount").val(response.data.amount + ' (' + response.data.currency.code + ')');
                                $("#c_category").val(response.data.service.service_title);
                                setTimeout(function() {
                                  $('#mdl-spinner').addClass('d-none');
                                  $('#data-contractDetails').removeClass('d-none');
                                }, 500);

                              } else if (response.status === 'error') {

                                showAlert("Warning", "Please fill the form correctly", response.status);
                                console.log(response.message);

                              }
                            },
                            error: function(xhr, status, error) {
                              console.log(status);
                              showAlert("Warning", 'Request Can not Procceed', 'Can not Procceed furhter');
                            }
                          });
                        });
                      </script>