                      <!-- Trip Detail Modal -->
                      <div class="modal fade" id="tripdetail" tabindex="-1" aria-labelledby="tripdetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" style="border-radius: 12px;">
                            <div class="modal-header" style="background: #452C88; border-radius: 12px 12px 0px 0px;">
                              <h5 class="modal-title mx-auto text-white" id="tripdetailLabel"><span>@lang('lang.trip_detail')</span></h5>
                              <button class="btn p-0" data-dismiss="modal">
                              <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              </button>
                            </div>
                            <div class="modal-body pt-1">
                              <div class="row pb-2 mb-2" style="border-bottom: 2px solid #ACADAE4D;">
                                <div class="col-lg-6 mt-4 mb-1">
                                  <div class="d-flex justify-content-evenly">
                                    <div class="">
                                      <img src="assets/images/user.png" id="tripDetail_clientimg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                                    </div>
                                    <div>
                                      <label for="client_name" class="mb-0"><span style="color: #452C88;">@lang('lang.client_name')</span></label>
                                      <input type="text" disabled id="tripDetail_client" class="form-control" value="">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-6 mt-4 mb-1">
                                  <div class="d-flex justify-content-evenly">
                                    <div class="">
                                      <img src="assets/images/user.png" id="tripDetail_driverimg" style="border-radius: 12px !important; object-fit: cover; width: 65px; height: 65px;" alt="no image">
                                    </div>
                                    <div>
                                      <label for="client_name" class="mb-0"><span style="color: #452C88;">@lang('lang.driver_name')</span></label>
                                      <input type="text" disabled id="tripDetail_driver" class="form-control" value="">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-2">
                                <div class="col-lg-8">
                                  <div class="pl-lg-4 pl-sm-0 pl-0">
                                    <label for="trip_title" class="mb-0"><span style="color: #452C88;">@lang('lang.trip_title')</span></label>
                                    <input type="text" disabled id="tripDetail_title" class="form-control" value="">
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                <div class="pr-lg-4 pr-sm-0 pr-0">
                                  <label for="trip_title" class="mb-0"><span style="color: #452C88;">@lang('lang.trip_date')</span></label>
                                  <input type="text" disabled class="form-control" id="tripDetail_date"  value="">
                                </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                  <div class="px-lg-4 px-sm-0 px-0">
                                    <label for="trip_desc" class="mb-0"><span style="color: #452C88;">@lang('lang.trip_description')</span></label>
                                    <textarea name="" id="tripDetail_description" class="form-control" disabled></textarea>
                                  </div>
                                </div>
                                <div class="col-lg-6 mt-2 pr-0">
                                  <div class="pl-lg-4 pr-lg-2 pl-sm-0 pr-sm-3 pl-0 pr-3">
                                    <label for="trip_desc" class="mb-0"><span style="color: #452C88;">@lang('lang.start_point')</span></label>
                                    <input type="text" id="tripDetail_startpoint" class="form-control" disabled value="">
                                  </div>
                                </div>
                                <div class="col-lg-6 mt-2 pl-0">
                                  <div class="pr-lg-4 pl-lg-2 pl-sm-3 pr-sm-0 pl-3 pr-0">
                                    <label for="trip_desc" class="mb-0"><span style="color: #452C88;">@lang('lang.end_point')</span></label>
                                    <input type="text" id="tripDetail_endpoint" class="form-control" disabled value="">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="text-center" style="background-color: #452C88;">
                                  <h5 class="text-white mb-0 py-2"><span>@lang('lang.address')</span></h5>
                                </div>
                              </div>
                              <div class="table-responsive" >
                                <table class="table" id="tripDetail_addresses">
                                  <thead>
                                    <tr>
                                      <th style="color: #452C88;"><span>@lang('lang.address')</span></th>
                                      <th style="color: #452C88;"><span>@lang('lang.description')</span></th>
                                      <th style="color: #452C88;"><span>@lang('lang.picture')</span></th>
                                      <th style="color: #452C88;"><span>@lang('lang.signature')</span></th>
                                      <th style="color: #452C88;"><span>@lang('lang.note')</span></th>
                                    </tr>
                                  </thead>
                                  <tbody id="gettripdata">
                                    <tr>
                                      <td class="text-wrap">Lorem ipsum dolor sit</td>
                                      <td class="text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                      <td>
                                      <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                      </svg>
                                      </td>
                                      <td>
                                        <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                        </svg>
                                      </td>
                                      <td>
                                        <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                        </svg>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="text-wrap">Lorem ipsum dolor sit</td>
                                      <td class="text-wrap">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                      <td>
                                      <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                      </svg>
                                      </td>
                                      <td>
                                        
                                      </td>
                                      <td>
                                        <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22 0C21.44 0 20.94 0.22 20.58 0.58L8 13.18L3.42 8.58C3.06 8.22 2.56 8 2 8C0.9 8 0 8.9 0 10C0 10.56 0.22 11.06 0.58 11.42L6.58 17.42C6.94 17.78 7.44 18 8 18C8.56 18 9.06 17.78 9.42 17.42L23.42 3.42C23.78 3.06 24 2.56 24 2C24 0.9 23.1 0 22 0Z" fill="#452C88"/>
                                        </svg>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Trip Detail Modal End -->