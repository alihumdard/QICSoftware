@extends('layouts.main')

@section('main-section')
<style>
  .custom-search-input {
  padding: 100px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 100%;
  box-sizing: border-box;
  /* Add any additional custom styles you want */
}
</style>
<!-- partial -->
  <div class="content-wrapper py-0 my-2">
    <div style="border: none;">
      <div class="bg-white" style="border-radius: 20px;">
        <div class="p-3">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
              <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.8576 5.98446C19.3853 5.98446 19.8684 5.71825 20.2227 5.28788C20.5987 4.83115 20.8314 4.1931 20.8314 3.48206C20.8314 2.73797 20.7572 2.07559 20.468 1.63218C20.205 1.22902 19.7172 0.979618 18.8576 0.979618C17.9981 0.979618 17.5102 1.22902 17.2473 1.63218C16.9581 2.07557 16.8839 2.73797 16.8839 3.48206C16.8839 4.19315 17.1165 4.83118 17.4926 5.28792C17.8469 5.71827 18.3299 5.98446 18.8576 5.98446ZM20.9765 5.90778C20.4392 6.5604 19.6904 6.96408 18.8576 6.96408C18.0248 6.96408 17.276 6.56041 16.7387 5.90781C16.2232 5.28162 15.9043 4.42355 15.9043 3.48206C15.9043 2.57365 16.0112 1.73985 16.4284 1.10029C16.8718 0.420497 17.6158 0 18.8576 0C20.0994 0 20.8434 0.420497 21.2868 1.10029C21.704 1.73984 21.811 2.57365 21.811 3.48206C21.811 4.42354 21.4921 5.28162 20.9765 5.90778Z" fill="white" />
                <path d="M23.0174 11.7404C22.9962 10.4001 22.9069 9.5513 22.5236 9.02564C22.1733 8.5453 21.5146 8.26609 20.3554 8.03867C20.0918 8.24402 19.5995 8.52014 18.8576 8.52014C18.1156 8.52014 17.6233 8.244 17.3597 8.03865C16.6132 8.18514 16.0743 8.35323 15.6915 8.58278C15.8194 8.20153 15.902 7.80454 15.9393 7.40337C16.353 7.25757 16.8421 7.13877 17.4224 7.03403L17.7077 6.98254L17.8892 7.20814C17.89 7.20908 18.1491 7.54052 18.8576 7.54052C19.566 7.54052 19.8251 7.20908 19.8259 7.20814L20.0075 6.98254L20.2927 7.03403C21.8634 7.31755 22.7665 7.70391 23.3119 8.45166C23.8472 9.18565 23.9688 10.1865 23.9932 11.7251L23.9942 11.7924C23.9971 11.9705 24 12.1469 24 12.1559L23.9426 12.3836C23.9401 12.3883 23.1231 14.0266 18.8576 14.0266C18.7048 14.0266 18.5568 14.0243 18.4126 14.0202C18.3449 13.6778 18.2519 13.3442 18.1236 13.0309C18.3533 13.0413 18.5975 13.047 18.8576 13.047C21.9203 13.047 22.809 12.2702 23.0202 12.0112C23.0199 11.8958 23.0192 11.8524 23.0185 11.8077L23.0174 11.7404Z" fill="white" />
                <path d="M12.0007 9.68808C12.6715 9.68808 13.2843 9.35136 13.7325 8.80697C14.2024 8.23625 14.493 7.44074 14.493 6.5557C14.493 5.63766 14.3998 4.81782 14.0362 4.26041C13.6989 3.74324 13.0814 3.42333 12.0007 3.42333C10.9199 3.42333 10.3024 3.74324 9.96507 4.26041C9.6015 4.8178 9.50831 5.63764 9.50831 6.5557C9.50831 7.44075 9.79897 8.2363 10.2689 8.80702C10.717 9.35137 11.3297 9.68808 12.0007 9.68808ZM14.4863 9.42687C13.8551 10.1935 12.9766 10.6677 12.0007 10.6677C11.0246 10.6677 10.1462 10.1935 9.51503 9.42692C8.90565 8.68673 8.52869 7.67116 8.52869 6.55571C8.52869 5.47336 8.65467 4.4821 9.1462 3.72854C9.66394 2.93473 10.5376 2.44373 12.0006 2.44373C13.4636 2.44373 14.3372 2.93473 14.8551 3.72854C15.3466 4.48208 15.4726 5.47336 15.4726 6.55571C15.4726 7.67117 15.0957 8.6867 14.4863 9.42687Z" fill="white" />
                <path d="M17.1387 16.4788C17.1127 14.8356 17.0013 13.792 16.5213 13.1338C16.0751 12.5221 15.2464 12.1721 13.7873 11.8897C13.4934 12.1291 12.9085 12.4792 12.0005 12.4792C11.0924 12.4792 10.5075 12.1291 10.2136 11.8897C8.77045 12.169 7.94372 12.5148 7.49424 13.1148C7.01302 13.7571 6.89407 14.7715 6.86427 16.3656L6.86315 16.4248C6.86097 16.5402 6.859 16.6444 6.85836 16.8421C7.09453 17.1482 8.16716 18.1653 12.0005 18.1653C15.8339 18.1653 16.9065 17.1481 17.1426 16.842C17.1422 16.6944 17.1411 16.629 17.1401 16.5635L17.1387 16.4788L17.1387 16.4788ZM17.3095 12.5598C17.9415 13.4264 18.0854 14.6219 18.1145 16.4635L18.1159 16.5482C18.1192 16.7505 18.1224 16.9483 18.1224 16.9834L18.065 17.2111C18.0621 17.2166 17.1008 19.1449 12.0005 19.1449C6.90013 19.1449 5.93886 17.2166 5.93596 17.2111L5.87854 16.9834C5.87854 16.8746 5.88268 16.6571 5.88738 16.4095L5.8885 16.3503C5.92211 14.5513 6.0764 13.3799 6.71364 12.5293C7.35823 11.6689 8.42912 11.2188 10.2813 10.8844L10.5659 10.833L10.7481 11.0585C10.7491 11.0598 11.0931 11.4995 12.0005 11.4995C12.9078 11.4995 13.2518 11.0598 13.2528 11.0585L13.435 10.833L13.7196 10.8844C15.5932 11.2226 16.6675 11.6794 17.3095 12.5598Z" fill="white" />
                <path d="M5.14237 5.98446C4.61469 5.98446 4.13162 5.71825 3.77729 5.28788C3.40127 4.83115 3.16864 4.1931 3.16864 3.48206C3.16864 2.73797 3.24281 2.07559 3.53204 1.63218C3.79503 1.22902 4.28284 0.979618 5.14237 0.979618C6.00195 0.979618 6.48977 1.22902 6.75274 1.63218C7.04193 2.07557 7.11607 2.73797 7.11607 3.48206C7.11607 4.19315 6.88346 4.83118 6.50744 5.28792C6.15313 5.71827 5.67009 5.98446 5.14237 5.98446ZM3.02347 5.90778C3.56079 6.5604 4.3096 6.96408 5.14237 6.96408C5.97517 6.96408 6.72396 6.56041 7.26127 5.90781C7.7768 5.28162 8.0957 4.42355 8.0957 3.48206C8.0957 2.57365 7.98877 1.73985 7.57162 1.10029C7.1282 0.420497 6.38419 0 5.14237 0C3.90062 0 3.15662 0.420497 2.71318 1.10029C2.29599 1.73984 2.18903 2.57365 2.18903 3.48206C2.18903 4.42354 2.50793 5.28162 3.02347 5.90778Z" fill="white" />
                <path d="M0.982648 11.7404C1.00385 10.4001 1.09307 9.5513 1.47643 9.02564C1.82673 8.5453 2.48539 8.26609 3.64459 8.03867C3.90819 8.24402 4.40047 8.52014 5.14238 8.52014C5.88438 8.52014 6.37671 8.244 6.64031 8.03865C7.38683 8.18514 7.92575 8.35323 8.30848 8.58278C8.18059 8.20153 8.09799 7.80454 8.06068 7.40337C7.64704 7.25757 7.15791 7.13877 6.57761 7.03403L6.29235 6.98254L6.11076 7.20814C6.11 7.20908 5.85092 7.54052 5.14237 7.54052C4.43396 7.54052 4.17487 7.20908 4.17411 7.20814L3.99253 6.98254L3.70726 7.03403C2.13658 7.31755 1.23347 7.70391 0.688143 8.45166C0.15285 9.18565 0.0311854 10.1865 0.00685173 11.7251L0.00576688 11.7924C0.00287438 11.9705 0 12.1469 0 12.1559L0.0574159 12.3836C0.0598745 12.3883 0.876932 14.0266 5.14236 14.0266C5.29525 14.0266 5.4432 14.0243 5.58736 14.0202C5.65512 13.6778 5.74807 13.3442 5.87641 13.0309C5.64669 13.0413 5.40255 13.047 5.14237 13.047C2.07971 13.047 1.19102 12.2702 0.979779 12.0112C0.980104 11.8958 0.980827 11.8524 0.98155 11.8077L0.982648 11.7404Z" fill="white" />
              </svg>
            </span>
            <span>@lang('lang.admins')</span>
          </h3>
          <div class="row mb-2">
            <!-- <div class="col-lg-4"></div> -->
            <div class="col-lg-12">
              <div class="row mx-1">
                <div class="col-lg-9 col-sm-6 mb-1 pr-0" style="text-align: right;">
                  <button class="btn content-background add-btn text-white" data-toggle="modal" data-target="#addUsers" ><span><i class="fa fa-plus"></i> @lang('lang.add_admin')</span></button>
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
                    <select name="filter_by_sts" id="filter_by_sts_client" class="form-select select-group">
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
                </div> -->
              </div>
            </div>
          </div>
          <hr>
          <div class="px-2">
              <div class="table-responsive">
                <table id="users-table" class="display" style="width:100%">
                  <thead class="text-secondary" style="background-color: #E9EAEF;">
                    <tr style="font-size: small;">
                      <th>#</th>
                      <th> @lang('lang.joining_date') </th>
                      <th></th>
                      <th> @lang('lang.name') </th>
                      <th> @lang('lang.email') </th>
                      <th></th>
                      <th> @lang('lang.company_name') </th>
                      <!-- <th> @lang('lang.expiry_date') </th> -->
                      <th> @lang('lang.status') </th>
                      <th>@lang('lang.actions')</th>
                    </tr>
                  </thead>
                  <tbody id="tableData">

                    @foreach($admins as $key => $value)
                    <tr style="font-size: small;">
                      <td>{{++$key}}</td>
                      <td>{{table_date($value['created_at'])}}</td>
                      <td><img src="{{ (isset($value['user_pic'])) ? asset('storage/' . $value['user_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
                      <td> {{ $value['name'] }} </td>
                      <td>{{ $value['email'] }}</td>
                      <td><img src="{{ (isset($value['com_pic'])) ? asset('storage/' . $value['com_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
                      <td> {{ $value['com_name'] }}</td>
                      <!-- <td>{{ $value['sub_exp_date'] }}</td> -->
                      @if($value['status'] == 1)
                      <td>
                        <button class="btn btn_status">
                          <span data-client_id="{{$value['id']}}"> 
                            <div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                              <div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">@lang('lang.active')</div>
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
                        <button id="btn_edit_user" class="btn p-0" data-admin_id="{{$value['id']}}" data-api_name ="{{'users'}}">
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
    </div>
  </div>
  <!-- content-wrapper ends -->

  <!-- Add Users Modal -->
  @php
  $login_userId = $user->id;
  $user_role_static = user_roles('2');
  @endphp

  @include('usermodal')

  <!-- Add Button Modal -->
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
        <div class="modal-header" style="border: none;">
          <h5 class="modal-title" id="addLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="48" height="48" rx="24" fill="#D1FADF" />
            <path d="M37.75 16H18.25C17.0073 16 16 17.3431 16 19V37C16 38.6569 17.0073 40 18.25 40H37.75C38.9927 40 40 38.6569 40 37V19C40 17.3431 38.9927 16 37.75 16ZM37.75 19V21.5503C36.699 22.6915 35.0234 24.466 31.4412 28.2059C30.6518 29.0339 29.0881 31.0229 28 30.9998C26.9121 31.0232 25.3479 29.0336 24.5588 28.2059C20.9772 24.4666 19.3012 22.6917 18.25 21.5503V19H37.75ZM18.25 37V25.3999C19.3241 26.5406 20.8473 28.1413 23.169 30.5653C24.1935 31.6406 25.9877 34.0144 28 33.9999C30.0024 34.0144 31.7739 31.675 32.8306 30.5658C35.1522 28.1418 36.6759 26.5407 37.75 25.3999V37H18.25Z" fill="#0F771A" />
            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#ECFDF3" stroke-width="8" />
          </svg>
          <h5 class="mt-3"> @lang('lang.email_sent_with_status') </h5>
        </div>
        <div class="modal-footer" style="border: none;">
          <button class="btn btn-sm text-white px-5" style="background-color: #233A85; border-radius: 8px;"> @lang('lang.ok')</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Button Modal End -->


  @endsection