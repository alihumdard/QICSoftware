@extends('layouts.main')

@section('main-section')
<!-- partial -->
  <div class="content-wrapper py-0 my-2">
    <div style="border: none;">
      <div class="bg-white" style="border-radius: 20px;">
        <div class="p-3">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
              <svg width="17" height="24" viewBox="0 0 17 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.09148 20.3718H7.52588V15.9374C5.19759 16.1948 3.34889 18.0435 3.09148 20.3718ZM8.64214 15.9374V20.3718H13.0765C12.8191 18.0435 10.9704 16.1948 8.64214 15.9374ZM13.0766 21.4881C12.9986 22.194 12.7746 22.855 12.4355 23.4412L13.4018 24.0001C13.9245 23.0965 14.2234 22.0473 14.2234 20.93C14.2234 17.5393 11.4747 14.7905 8.08401 14.7905C4.69332 14.7905 1.94458 17.5393 1.94458 20.93C1.94458 22.0473 2.24357 23.0965 2.76626 24.0001L3.73249 23.4412C3.39343 22.855 3.1694 22.194 3.09143 21.4881H13.0766Z" fill="white" />
                <path d="M9.75845 20.9299C9.75845 21.8547 9.00883 22.6043 8.08406 22.6043C7.15929 22.6043 6.40967 21.8547 6.40967 20.9299C6.40967 20.0051 7.15929 19.2555 8.08406 19.2555C9.00883 19.2555 9.75845 20.0051 9.75845 20.9299Z" fill="white" />
                <path d="M12.3171 19.169C12.1576 18.5735 12.511 17.9614 13.1064 17.8018L14.1847 17.5129C14.7802 17.3534 15.3923 17.7068 15.5518 18.3022L16.1297 20.4587C16.2892 21.0542 15.9358 21.6663 15.3403 21.8258L14.2621 22.1148C13.6666 22.2743 13.0545 21.9209 12.895 21.3254L12.3171 19.169Z" fill="white" />
                <path d="M0.616123 18.3017C0.775693 17.7063 1.38779 17.3529 1.98326 17.5124L3.06152 17.8014C3.65699 17.9609 4.01039 18.573 3.85082 19.1685L3.27299 21.3249C3.11342 21.9204 2.50132 22.2738 1.90585 22.1143L0.827655 21.8253C0.232141 21.6658 -0.12125 21.0537 0.0383139 20.4582L0.616123 18.3017Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.06085 8.09285V6.41846H4.17711V8.09285C4.17711 10.2506 5.92629 11.9998 8.08403 11.9998C10.2418 11.9998 11.9909 10.2506 11.9909 8.09285V6.41846H13.1072V8.09285C13.1072 10.8671 10.8583 13.116 8.08403 13.116C5.30978 13.116 3.06085 10.8671 3.06085 8.09285Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.3879 4.74411H13.8045C13.8446 4.64169 13.888 4.52097 13.9311 4.38278L13.9379 4.36118C14.0884 3.87935 14.2234 3.44699 14.2234 2.5656C14.2234 2.11865 13.9331 1.74229 13.5487 1.44471C13.1592 1.14321 12.6273 0.885078 12.0349 0.674668C10.8484 0.253296 9.35203 0 8.08401 0C6.816 0 5.31965 0.253296 4.13318 0.674668C3.54072 0.885078 3.00882 1.14321 2.61936 1.44471C2.23498 1.74229 1.94458 2.11865 1.94458 2.5656C1.94458 3.38385 2.08143 3.8151 2.22203 4.25826C2.23514 4.29956 2.24826 4.34092 2.26132 4.38272C2.30446 4.52091 2.34777 4.64164 2.3879 4.74411ZM5.85149 3.06972C5.85149 2.76147 6.10137 2.51159 6.40962 2.51159H9.7584C10.0667 2.51159 10.3165 2.76147 10.3165 3.06972C10.3165 3.37796 10.0667 3.62785 9.7584 3.62785H6.40962C6.10137 3.62785 5.85149 3.37796 5.85149 3.06972Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.51468 6.08952C2.54002 5.9568 2.66152 5.86035 2.80334 5.86035H13.3647C13.5066 5.86035 13.6281 5.9568 13.6534 6.08952L13.6535 6.09019L13.6537 6.09086L13.654 6.09248L13.6546 6.09627L13.6562 6.10643C13.6574 6.1143 13.6588 6.1244 13.66 6.13651C13.6626 6.16079 13.6649 6.19339 13.6653 6.23307C13.666 6.31249 13.6586 6.42116 13.6286 6.54914C13.5677 6.80783 13.416 7.13668 13.0686 7.45627C12.3798 8.08986 10.9647 8.651 8.08404 8.651C5.20341 8.651 3.78827 8.08986 3.09948 7.45627C2.75205 7.13668 2.60035 6.80783 2.53951 6.54914C2.50943 6.42116 2.50212 6.31249 2.50279 6.23307C2.50312 6.19339 2.50547 6.16079 2.50803 6.13651C2.50932 6.1244 2.51066 6.1143 2.51183 6.10643L2.51345 6.09627L2.51412 6.09248L2.5144 6.09086L2.51456 6.09019L2.51468 6.08952Z" fill="white" />
              </svg>
            </span>
            <span>@lang('lang.users')</span>
          </h3>
          <div class="row mb-2">
            <!-- <div class="col-lg-4"></div> -->
            <div class="col-lg-12">
              <div class="row mx-1">
                <div class="col-lg-9 col-sm-6 mb-1 pr-0" style="text-align: right;">
                  <button class="btn content-background add-btn text-white" data-toggle="modal" data-target="#addclient" ><span><i class="fa fa-plus"></i> @lang('lang.add_user')</span></button>
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
                    <select name="filter_by_sts" id="filter_by_sts_drivers" class="form-select select-group">
                      <option value="">
                        @lang('lang.filter_by_status')
                      </option>
                      @foreach(config('constants.STATUS_OPTIONS_' . app()->getLocale()) as $key => $value)
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
                </div>
                 -->
              </div>
            </div>
          </div>
          <hr>
          <div class="px-2">
            <div class="table-responsive">
              <table id="drivers-table" class="display" style="width:100%">
                <thead class="text-secondary" style="background-color: #E9EAEF;">
                  <tr style="font-size: small;">
                    <th>#</th>
                    <th>@lang('lang.joining_date')</th>
                    <th></th>
                    <th>@lang('lang.name')</th>
                    <th>@lang('lang.email')</th>

                    @if($user->role != 'Client')
                    <th></th>
                    <th>@lang('lang.admins')</th>
                    <th>@lang('lang.admin_email')</th>
                    @endif

                    <th>@lang('lang.status')</th>
                    <th>@lang('lang.actions')</th>
                  </tr>
                </thead>
                <tbody id="tableData">
                  @foreach($data as $key => $value)
                 
                  <tr style="font-size: small;">
                    <td>{{++$key}}</td>
                    <td>{{table_date($value['created_at'])}}</td>
                    <td><img src="{{ (isset($value['user_pic'])) ? asset('storage/' . $value['user_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
                    <td> {{ $value['name'] }} </td>
                    <td>{{ $value['email'] }}</td>
                   
                    @if($user->role != 'Client')
                    <td><img src="{{(isset($value['client_pic'])) ? asset('storage/' . $value['client_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
                    <td> {{(isset($value['client_name'])) ? $value['client_name'] : $user->name}}</td>
                    <td>{{$value['client_email']}}</td>
                    @endif

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
                    <td style="min-width: 80px; max-width: fit-content;">
                    @if($value['status'] != 5)
                      <button id="btn_edit_client" class="btn p-0" data-client_id="{{$value['id']}}" data-api_name ="{{'users'}}">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
                        </svg>
                      </button>
                      <button id="btn_dell_user" class="btn p-0" data-id=" {{$value['id']}} " >
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4909 13.743C23.7359 13.743 23.94 13.9465 23.94 14.2054V14.4448C23.94 14.6975 23.7359 14.9072 23.4909 14.9072H13.0497C12.804 14.9072 12.6 14.6975 12.6 14.4448V14.2054C12.6 13.9465 12.804 13.743 13.0497 13.743H14.8866C15.2597 13.743 15.5845 13.4778 15.6684 13.1036L15.7646 12.6739C15.9141 12.0887 16.4061 11.7 16.9692 11.7H19.5708C20.1277 11.7 20.6252 12.0887 20.7692 12.6431L20.8721 13.1029C20.9555 13.4778 21.2802 13.743 21.654 13.743H23.4909ZM22.5577 22.4943C22.7495 20.707 23.0852 16.4609 23.0852 16.418C23.0975 16.2883 23.0552 16.1654 22.9713 16.0665C22.8812 15.9739 22.7672 15.9191 22.6416 15.9191H13.9032C13.777 15.9191 13.6569 15.9739 13.5735 16.0665C13.489 16.1654 13.4473 16.2883 13.4534 16.418C13.4546 16.4259 13.4666 16.5755 13.4868 16.8255C13.5762 17.9364 13.8255 21.0303 13.9865 22.4943C14.1005 23.5729 14.8081 24.2507 15.8332 24.2753C16.6242 24.2936 17.4391 24.2999 18.2724 24.2999C19.0573 24.2999 19.8544 24.2936 20.6699 24.2753C21.7305 24.257 22.4376 23.5911 22.5577 22.4943Z" fill="#D11A2A" />
                        </svg>
                      </button>
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
    <!-- content-wrapper ends -->

    <!-- Add Client Modal -->
  @php
  $modal_title = "User";
  $login_userId = $user->id;
  $user_role_static = 'Driver';
  @endphp

  @include('usermodal')


    <!-- <div class="modal fade" style="height: 30rem;" id="addclient" tabindex="-1" aria-labelledby="addclientLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white">
          <div class="modal-header pb-0" style="border-bottom: none;">
            <h4>
              <svg width="30" height="30" viewBox="0 0 25 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7707 32.0805H11.6138V25.2375C8.0208 25.6347 5.168 28.4875 4.7707 32.0805ZM13.3364 25.2375V32.0805H20.1794C19.7822 28.4875 16.9293 25.6347 13.3364 25.2375ZM20.1795 33.8031C20.0592 34.8924 19.7135 35.9125 19.1902 36.817L20.6813 37.6795C21.4879 36.2852 21.9493 34.666 21.9493 32.9418C21.9493 27.7094 17.7075 23.4676 12.4751 23.4676C7.2426 23.4676 3.0009 27.7094 3.0009 32.9418C3.0009 34.666 3.4622 36.2852 4.2688 37.6795L5.7599 36.817C5.2367 35.9125 4.891 34.8924 4.7706 33.8031H20.1795Z" fill="#452C88" />
                <path d="M15.059 32.9417C15.059 34.3687 13.9022 35.5255 12.4751 35.5255C11.048 35.5255 9.8912 34.3687 9.8912 32.9417C9.8912 31.5146 11.048 30.3578 12.4751 30.3578C13.9022 30.3578 15.059 31.5146 15.059 32.9417Z" fill="#452C88" />
                <path d="M19.0075 30.2243C18.7612 29.3054 19.3066 28.3609 20.2255 28.1146L21.8895 27.6688C22.8084 27.4226 23.753 27.9679 23.9992 28.8868L24.8909 32.2146C25.1371 33.1336 24.5918 34.0781 23.6729 34.3244L22.0089 34.7703C21.09 35.0164 20.1454 34.4711 19.8992 33.5521L19.0075 30.2243Z" fill="#452C88" />
                <path d="M0.950799 28.8861C1.197 27.9671 2.1416 27.4218 3.0605 27.668L4.7245 28.1139C5.6434 28.3601 6.1887 29.3046 5.9425 30.2236L5.0508 33.5513C4.8046 34.4703 3.86 35.0156 2.9411 34.7695L1.2772 34.3236C0.3582 34.0773 -0.187102 33.1328 0.0590983 32.2138L0.950799 28.8861Z" fill="#452C88" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.7234 13.1319V10.548H6.446V13.1319C6.446 16.4617 9.1453 19.161 12.475 19.161C15.8048 19.161 18.5041 16.4617 18.5041 13.1319V10.548H20.2267V13.1319C20.2267 17.4131 16.7562 20.8835 12.475 20.8835C8.1939 20.8835 4.7234 17.4131 4.7234 13.1319Z" fill="#452C88" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.685 7.9642H21.3028C21.3647 7.8062 21.4316 7.6199 21.4981 7.4066L21.5086 7.3733C21.7409 6.6298 21.9493 5.9626 21.9493 4.6024C21.9493 3.9127 21.5012 3.3319 20.908 2.8727C20.307 2.4074 19.4862 2.0091 18.5719 1.6844C16.741 1.0341 14.4318 0.643204 12.4751 0.643204C10.5183 0.643204 8.2092 1.0341 6.3782 1.6844C5.464 2.0091 4.6432 2.4074 4.0422 2.8727C3.449 3.3319 3.0009 3.9127 3.0009 4.6024C3.0009 5.8651 3.212 6.5306 3.429 7.2145C3.4492 7.2782 3.4695 7.342 3.4896 7.4065C3.5562 7.6198 3.6231 7.8061 3.685 7.9642ZM9.0299 5.3804C9.0299 4.9047 9.4155 4.5191 9.8912 4.5191H15.059C15.5346 4.5191 15.9202 4.9047 15.9202 5.3804C15.9202 5.856 15.5346 6.2417 15.059 6.2417H9.8912C9.4155 6.2417 9.0299 5.856 9.0299 5.3804Z" fill="#452C88" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.8806 10.0404C3.9197 9.8356 4.1072 9.6868 4.3261 9.6868H20.6241C20.843 9.6868 21.0305 9.8356 21.0696 10.0404L21.0698 10.0414L21.07 10.0425L21.0704 10.045L21.0715 10.0508L21.074 10.0665C21.0758 10.0787 21.0779 10.0942 21.0798 10.1129C21.0838 10.1504 21.0874 10.2007 21.0879 10.2619C21.089 10.3845 21.0777 10.5522 21.0313 10.7497C20.9374 11.1489 20.7033 11.6564 20.1671 12.1495C19.1042 13.1273 16.9204 13.9932 12.4751 13.9932C8.0298 13.9932 5.846 13.1273 4.7831 12.1495C4.2469 11.6564 4.0128 11.1489 3.9189 10.7497C3.8725 10.5522 3.8612 10.3845 3.8622 10.2619C3.8628 10.2007 3.8664 10.1504 3.8703 10.1129C3.8723 10.0942 3.8744 10.0787 3.8762 10.0665L3.8787 10.0508L3.8797 10.045L3.8802 10.0425L3.8804 10.0414L3.8806 10.0404Z" fill="#452C88" />
              </svg>

              Add Driver
            </h4>
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="userStore" id="formData" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="role" name="role" value="Driver">
            <input type="hidden" id="client_id" name="id">
            <div class="modal-body pt-0">
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <label for="user_pic">Upload Image</label>
                  <input type="file" name="user_pic" id="user_pic" class="form-control">
                </div>
                <div class="col-lg-6 mb-2">
                  <label for="com_pic">Company Logo</label>
                  <input type="file" name="com_pic" id="com_pic" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                  <label for="name">Name</label>
                  <input type="text" required name="name" id="name" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                  <label for="email">E-mail</label>
                  <input type="email" required name="email" id="email" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                  <label for="phone">Phone</label>
                  <input type="tel" name="phone" id="phone" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                  <label for="com_name">Company Name</label>
                  <input type="text" name="com_name" id="com_name" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                  <label for="address">Address</label>
                  <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="col-lg-6 mt-3">
                  <div class="row py-4">
                    <div class="col-lg-6">
                      <button type="button" class="btn btn-sm btn-outline px-5" data-dismiss="modal" data-bs-dismiss="modal" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                    <div class="col-lg-6">
                      <button type="submit" id="btn_save" class="btn btn-sm text-white px-5" data-target="#add" style="background-color: #E45F00; border-radius: 8px; width: 100%;">
                      <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                    <span id="add_btn">@lang('lang.add')</span>
                    </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> -->
    <!-- Add Client Modal End -->

    <!-- Delete Client Modal -->
    <div class="modal fade" id="deleteclient" tabindex="-1" aria-labelledby="deleteclientLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-white">
          
        <div class="modal-body">
            <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2"/>
              <path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8"/>
            </svg>
            <button class="btn p-0 float-right" data-dismiss="modal">
              <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>

            <div class="mt-3">
              <h6>@lang('lang.really_want_to_delete_driver')</h6>
              <p>@lang('lang.driver_has_assigned_trips_what_to_do_with_them')</p>
            </div>
            <form action="" method="post">
              <div class="my-2">
                <div>
                  <input type="checkbox" name="delete_assigned_trips"> @lang('lang.delete_all_assigned_trips')
                </div>
                <div>
                  <input type="checkbox" name="delete_completed_trips"> @lang('lang.delete_completed_trips')
                </div>
                <div>
                  <input type="checkbox" name="dont_delete_any_trips"> @lang('lang.dont_delete_any_trips')
                </div>
              </div>
              <div class="row mt-3 text-center">
                <div class="col-lg-6">
                  <button data-dismiss="modal" class="btn btn-sm btn-outline px-5" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">@lang('lang.delete')</button>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- Delete Client Modal End -->
    
  @if($user->role != 'Client')
  <script>
    var users_table = $('#drivers-table').DataTable();
        $('#filter_by_sts_drivers').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(6).search(selectedStatus).draw();
    });
  </script>
  @else
  <script>
    var users_table = $('#drivers-table').DataTable();
        $('#filter_by_sts_drivers').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(4).search(selectedStatus).draw();
    });
  </script>
  @endif

    @endsection