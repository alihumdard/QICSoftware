@extends('layouts.main')

@section('main-section')
@php
  $tripStatus = config('constants.TRIP_STATUS');
  $tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
@endphp
<!-- partial -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3YWssMkDiW3F1noE6AVbiJEL40MR0IFU&libraries=places"></script>
  <div class="content-wrapper py-0 my-0">
    <div style="border: none;">
      <div class="bg-white" style="border-radius: 20px;">
        <div class="p-3">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.46997 9C7.40297 9 8.96997 7.433 8.96997 5.5C8.96997 3.567 7.40297 2 5.46997 2C3.53697 2 1.96997 3.567 1.96997 5.5C1.96997 7.433 3.53697 9 5.46997 9Z" stroke="white" stroke-width="1.5" />
                <path d="M16.97 15H19.97C21.07 15 21.97 15.9 21.97 17V20C21.97 21.1 21.07 22 19.97 22H16.97C15.87 22 14.97 21.1 14.97 20V17C14.97 15.9 15.87 15 16.97 15Z" stroke="white" stroke-width="1.5" />
                <path d="M11.9999 5H14.6799C16.5299 5 17.3899 7.29 15.9999 8.51L8.00995 15.5C6.61995 16.71 7.47994 19 9.31994 19H11.9999" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M5.48622 5.5H5.49777" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M18.4862 18.5H18.4978" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
            <span>@lang('lang.routes')</span>
          </h3>
          <div class="row mb-2">
            <!-- <div class="col-lg-4"></div> -->
            <div class="col-lg-12">
              <div class="row mx-1">
                <div class="col-lg-9 col-sm-6 mb-1 pr-0" style="text-align: right;">
                @if($user->role != 'Driver')
                  <a href="/create_trip">
                    <button class="btn add-btn text-white" style="background-color: #E45F00;"><span><i class="fa fa-plus"></i> @lang('lang.create_trip')</span></button>
                  </a>
                @endif
                </div>
                <div class="col-lg-3 col-sm-6 pr-0">
                  <div class="input-group">
                    <div class="input-group-prepend d-none d-md-block d-sm-block d-lg-block">
                      <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                        <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.56221 14.0648C7.58971 14.3147 7.52097 14.5814 7.36287 14.7563C7.29927 14.8336 7.22373 14.8949 7.14058 14.9367C7.05742 14.9785 6.96827 15 6.87825 15C6.78822 15 6.69907 14.9785 6.61592 14.9367C6.53276 14.8949 6.45722 14.8336 6.39363 14.7563L3.63713 11.4151C3.56216 11.3263 3.50516 11.2176 3.47057 11.0977C3.43599 10.9777 3.42477 10.8496 3.43779 10.7235V6.45746L0.145116 1.34982C0.0334875 1.17612 -0.0168817 0.955919 0.005015 0.737342C0.0269117 0.518764 0.119294 0.319579 0.261975 0.183308C0.392582 0.0666576 0.536937 0 0.688166 0H10.3118C10.4631 0 10.6074 0.0666576 10.738 0.183308C10.8807 0.319579 10.9731 0.518764 10.995 0.737342C11.0169 0.955919 10.9665 1.17612 10.8549 1.34982L7.56221 6.45746V14.0648ZM2.09047 1.66644L4.81259 5.88254V10.4819L6.1874 12.1484V5.8742L8.90953 1.66644H2.09047Z" fill="#323C47" />
                        </svg>
                      </div>
                    </div>
                    <select name="filter_by_sts" id="filter_by_sts_routes" class="form-select select-group">
                      <option value="">
                        @lang('lang.filter_by_status')
                      </option>
                      @foreach($tripStatus_trans as $key => $value)
                        <option value="{{$value}}">{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- <div class="col-lg-4 px-1">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                        <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.6752 0.558058C13.4311 0.313981 13.0354 0.313981 12.7913 0.558058L8.81386 4.53553C8.56978 4.77961 8.56978 5.17534 8.81386 5.41942C9.05794 5.6635 9.45366 5.6635 9.69774 5.41942L13.2333 1.88388L16.7688 5.41942C17.0129 5.6635 17.4086 5.6635 17.6527 5.41942C17.8968 5.17534 17.8968 4.77961 17.6527 4.53553L13.6752 0.558058ZM12.6083 14C12.6083 14.3452 12.8881 14.625 13.2333 14.625C13.5785 14.625 13.8583 14.3452 13.8583 14H12.6083ZM12.6083 1V14H13.8583V1H12.6083Z" fill="#323C47" />
                          <path d="M5.625 1C5.625 0.654822 5.34518 0.375 5 0.375C4.65482 0.375 4.375 0.654822 4.375 1H5.625ZM4.55806 14.4419C4.80214 14.686 5.19786 14.686 5.44194 14.4419L9.41942 10.4645C9.6635 10.2204 9.6635 9.82466 9.41942 9.58058C9.17534 9.3365 8.77961 9.3365 8.53553 9.58058L5 13.1161L1.46447 9.58058C1.22039 9.3365 0.82466 9.3365 0.580583 9.58058C0.336505 9.82466 0.336505 10.2204 0.580583 10.4645L4.55806 14.4419ZM4.375 1V14H5.625V1H4.375Z" fill="#323C47" />
                        </svg>
                      </div>
                    </div>
                    <select name="sort_by" id="sort_by" class="form-select" style="border-left: none;">
                      <option value="">
                        @lang('lang.sort_by')
                      </option>
                    </select>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <hr>
          <div class="px-2">
            <div class="table-responsive">
              <table id="routes-table" class="display" style="width:100%">
                <thead class="text-secondary" style="background-color: #E9EAEF;">
                  <tr style="font-size: small;">
                    <th>#</th>
                    <th style="width: 100px;">@lang('lang.trip_date')</th>
                    <th>@lang('lang.trip_title')</th>
                    <th>@lang('lang.start_point')</th>
                    <th>@lang('lang.end_point')</th>
                    
                    @if($user->role != 'Client' && $user->role != 'Admin')
                    <th>@lang('lang.description')</th>
                    @endif
                    
                    @if($user->role != 'Driver')
                    <th></th>
                    <th>@lang('lang.driver_name')</th>
                    @endif

                    <th>@lang('lang.status')</th>
                    <th>@lang('lang.actions')</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $key => $value)
                  <tr style="font-size: small;">
                    <td>{{ $value['id'] }}</td>
                    <td>{{ date('M d, Y', strtotime($value['trip_date']))}}</td>
                    <td>{{ $value['title'] }}</td>
                    <td>{{ $value['start_point'] }}</td>
                    <td>{{ $value['end_point'] }}</td>

                    @if($user->role != 'Client' && $user->role != 'Admin')
                    <td>
                      <div class="row">
                        <div class="col-12 col-sm-12 col-lg-6 my-auto">
                          {{ $value['desc'] }} </td>
                        </div>
                      </div>
                    @endif

                    @if($user->role != 'Driver')
                    <td><img src="{{ (isset($value['driver_pic'])) ? asset('storage/' . $value['driver_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
                    <td>{{ $value['driver_name'] }} </td>
                    @endif 

                    <td>
                        <button class="btn btn_status">
                          @if ($value['status'] == $tripStatus['In Progress'])
                            <span data-client_id="{{$value['id']}}">
                            <div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 4px; background: #E9EBF3; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                              <div style="text-align: center; color: #233A85; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
                            </div>
                          </span>
                          @elseif ($value['status'] == $tripStatus['Pending'])
                            <span data-client_id="{{$value['id']}}">
                            <div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 15px; padding-right: 13px; background: rgba(77, 77, 77, 0.12); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                              <div style="text-align: center; color: #8F9090; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
                            </div>
                          </span>
                          @elseif ($value['status'] == $tripStatus['Completed'])
                            <span data-client_id="{{$value['id']}}">
                            <div style="width: 100%; height: 100%; padding: 5px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                              <div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
                            </div>
                          </span>
                          @elseif ($value['status'] == $tripStatus['Deleted'])
                            <span data-client_id="{{$value['id']}}">
                            <div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 15px; padding-right: 13px; background: rgba(77, 77, 77, 0.12); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                              <div style="text-align: center; color: #8F9090; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
                            </div>
                          </span>
                          @endif
                        </button>
                      </td>


                    <td class="">
                      <div class="d-flex my-auto">
                    @if($user->role != user_roles('3') && $value['status'] == $tripStatus['Pending'])
                      <form method="POST" action="/create_trip" class="mb-0">
                        @csrf
                        <input type="hidden" name="id" value="{{$value['id']}}">
                        <button id="btn_edit_announcement" class="btn p-0">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
                          </svg>
                        </button>
                      </form>
                      <button class="btn p-0 delete_rotues" data-id="{{$value['id']}}" >
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4909 13.743C23.7359 13.743 23.94 13.9465 23.94 14.2054V14.4448C23.94 14.6975 23.7359 14.9072 23.4909 14.9072H13.0497C12.804 14.9072 12.6 14.6975 12.6 14.4448V14.2054C12.6 13.9465 12.804 13.743 13.0497 13.743H14.8866C15.2597 13.743 15.5845 13.4778 15.6684 13.1036L15.7646 12.6739C15.9141 12.0887 16.4061 11.7 16.9692 11.7H19.5708C20.1277 11.7 20.6252 12.0887 20.7692 12.6431L20.8721 13.1029C20.9555 13.4778 21.2802 13.743 21.654 13.743H23.4909ZM22.5577 22.4943C22.7495 20.707 23.0852 16.4609 23.0852 16.418C23.0975 16.2883 23.0552 16.1654 22.9713 16.0665C22.8812 15.9739 22.7672 15.9191 22.6416 15.9191H13.9032C13.777 15.9191 13.6569 15.9739 13.5735 16.0665C13.489 16.1654 13.4473 16.2883 13.4534 16.418C13.4546 16.4259 13.4666 16.5755 13.4868 16.8255C13.5762 17.9364 13.8255 21.0303 13.9865 22.4943C14.1005 23.5729 14.8081 24.2507 15.8332 24.2753C16.6242 24.2936 17.4391 24.2999 18.2724 24.2999C19.0573 24.2999 19.8544 24.2936 20.6699 24.2753C21.7305 24.257 22.4376 23.5911 22.5577 22.4943Z" fill="#D11A2A" />
                        </svg>
                      </button>
                      @endif
                      @if ($user->role != user_roles('3') &&$value['status'] == $tripStatus['Completed'])
                      <form method="POST" action="/create_trip" class="mb-0">
                        @csrf
                        <input type="hidden" name="id" value="{{$value['id']}}">
                        <input type="hidden" name="dashboard_data" value="1">
                        <button class="btn p-0">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
                            <path d="M23.2857 12.8571V12H20.7143V16.2857H21.5714V14.5714H22.8572V13.7143H21.5714V12.8571H23.2857Z" fill="#452C88" />
                            <path d="M21.5715 21.4285V23.1428H14.7143V21.4285H13.8571V23.1428C13.8571 23.3701 13.9475 23.5881 14.1082 23.7489C14.2689 23.9096 14.487 23.9999 14.7143 23.9999H21.5715C21.7988 23.9999 22.0168 23.9096 22.1776 23.7489C22.3383 23.5881 22.4286 23.3701 22.4286 23.1428V21.4285H21.5715Z" fill="#452C88" />
                            <path d="M20.2857 20.1428L19.6797 19.5368L18.5714 20.6451V17.1428H17.7143V20.6451L16.606 19.5368L16 20.1428L18.1429 22.2857L20.2857 20.1428Z" fill="#452C88" />
                            <path d="M18.5715 16.2857H16.8572V12H18.5715C18.9123 12.0004 19.2392 12.136 19.4802 12.377C19.7212 12.618 19.8568 12.9448 19.8572 13.2857V15C19.8568 15.3409 19.7212 15.6677 19.4802 15.9087C19.2392 16.1498 18.9123 16.2854 18.5715 16.2857ZM17.7143 15.4286H18.5715C18.6851 15.4285 18.794 15.3833 18.8744 15.3029C18.9547 15.2226 18.9999 15.1136 19 15V13.2857C18.9999 13.1721 18.9547 13.0632 18.8744 12.9828C18.794 12.9025 18.6851 12.8573 18.5715 12.8571H17.7143V15.4286Z" fill="#452C88" />
                            <path d="M15.1429 12H13V16.2857H13.8571V15H15.1429C15.3701 14.9997 15.5879 14.9093 15.7486 14.7486C15.9093 14.5879 15.9997 14.3701 16 14.1429V12.8571C15.9998 12.6299 15.9094 12.412 15.7487 12.2513C15.588 12.0907 15.3701 12.0003 15.1429 12ZM13.8571 14.1429V12.8571H15.1429L15.1433 14.1429H13.8571Z" fill="#452C88" />
                          </svg>
                        </button>
                      </form>
                      @endif
                      @if($user->role == user_roles('3') && $value['status'] != $tripStatus['Deleted'])
                      <form method="POST" action="/driver_map" class="mb-0">
                        @csrf
                        <input type="hidden" name="id" value="{{$value['id']}}">
                      <button class="btn p-0">
                      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7941 24.7919C17.7943 24.7919 17.7944 24.792 18 24.5L17.7941 24.7919ZM18.2059 24.7919L18.2071 24.7909L18.2104 24.7886L18.2217 24.7805C18.2315 24.7735 18.2455 24.7634 18.2635 24.7501C18.2995 24.7237 18.3515 24.6849 18.4172 24.6345C18.5485 24.5335 18.7347 24.3855 18.9575 24.195C19.4028 23.8143 19.9967 23.2617 20.5916 22.5735C21.7728 21.2071 23 19.257 23 17.0275C23 15.6948 22.4737 14.4162 21.5363 13.4733C20.5988 12.5302 19.3268 12 18 12C16.6733 12 15.4013 12.5302 14.4637 13.4733C13.5263 14.4162 13 15.6948 13 17.0275C13 19.257 14.2272 21.2071 15.4084 22.5735C16.0033 23.2617 16.5972 23.8143 17.0425 24.195C17.2653 24.3855 17.4515 24.5335 17.5828 24.6345C17.6485 24.6849 17.7005 24.7237 17.7365 24.7501C17.7545 24.7634 17.7685 24.7735 17.7783 24.7805L17.7896 24.7886L17.7929 24.7909L17.7941 24.7919C17.9175 24.8787 18.0825 24.8787 18.2059 24.7919ZM18 24.5L18.2059 24.7919C18.2057 24.7919 18.2056 24.792 18 24.5ZM19.7857 17C19.7857 17.9862 18.9862 18.7857 18 18.7857C17.0138 18.7857 16.2143 17.9862 16.2143 17C16.2143 16.0138 17.0138 15.2143 18 15.2143C18.9862 15.2143 19.7857 16.0138 19.7857 17Z" fill="#452C88"/>
                      </svg>  
                    </button>
                      </form>
                      @endif
                      <button  data-id="{{ $value['id'] }}" id="tripDetail_btn" class="btn p-0 tripDetail_view" data-toggle="modal" data-target="#tripdetail">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z" fill="black" />
                        </svg>
                      </button>
                      </div>
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
  </div>
  <!-- content-wrapper ends -->

  <!-- Delete Client Modal -->
  <div class="modal fade" id="deleteroute" tabindex="-1" aria-labelledby="deleterouteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="deleterouteLabel"></h5>
        </div> -->
        <div class="modal-body">
        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2"/>
          <path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8"/>
        </svg>
        <div class="float-right">
          <button class="btn p-0" data-dismiss="modal">
          <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          </button>
        </div>
          <div class="mt-3">
            <h6>@lang('lang.really_want_to_delete_route')</h6>
          </div>
          <div class="row mt-3 text-center">
            <div class="col-lg-6">
              <button class="btn btn-sm btn-outline px-5" data-toggle="modal" data-target="#deleteroute" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
            </div>
            <div class="col-lg-6">
              <form method="post" id="DeleteData" action="deleteUsers">
                    <input type="hidden" id="trip_id" name="trip_id">
                    <input type="hidden" id="user_id" name="id" value="{{$user->id}}">
                    <button  type="submit" class="btn  btn_deleteUser btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">
                      <div class="spinner-border btn_spinner spinner-border-sm text-white d-none" ></div>
                      <span id="add_btn">@lang('lang.delete')</span>
                  </button>
                  </from>
                </div>
          </div>
        </div>
        <!-- <div class="modal-footer">
                    
                </div> -->
      </div>
    </div>
  </div>
  <!-- Delete Client Modal End -->
  
  @if($user->role == user_roles('1'))
  <script>
    var users_table = $('#routes-table').DataTable({
        "order": [[0, 'desc']] // Sort by the first column in descending order (0 is the index of the first column)
    });

    $('#filter_by_sts_routes').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(6).search(selectedStatus).draw();
    });
  </script>

  @else
  <script>
    var users_table = $('#routes-table').DataTable();
    $('#filter_by_sts_routes').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(6).search(selectedStatus).draw();
    });
  </script>
  @endif
  <script>
        function downloadPDF() {
      // URL of the PDF file
      var pdfUrl = '{{ asset('storage/pdf_templates.pdf') }}';

      // Create a link element
      var link = document.createElement('a');

      // Set the link's attributes
      link.href = pdfUrl;
      link.target = '_blank';
      link.download = 'pdf_templates.pdf';

      // Simulate a click on the link to trigger the download
      link.click();
    }
  </script>
  @include('tripdetail_modal')
  
  @endsection