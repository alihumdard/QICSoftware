  <style>
    .form-image {
      object-fit: contain;
    }

    #addUsers {
      backdrop-filter: blur(5px);
      background-color: #01223770;
    }
  </style>
<!-- include the moment.js library using a CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <!-- Add Users Modal -->
  <div class="modal" id="addUsers" tabindex="-1" aria-labelledby="addUsers" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-white" style="border-radius: 10px; z-index: 10 !important;">
        <div class="modal-header pb-0" style="border-bottom: none;">
          <h4>
            <svg width="30" height="30" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M31.4294 9.97411C32.3088 9.97411 33.1139 9.53041 33.7045 8.81313C34.3312 8.05192 34.7189 6.98851 34.7189 5.80344C34.7189 4.56328 34.5953 3.45931 34.1132 2.7203C33.6749 2.04837 32.8619 1.6327 31.4294 1.6327C29.9967 1.6327 29.1837 2.04837 28.7454 2.7203C28.2634 3.45928 28.1399 4.56327 28.1399 5.80344C28.1399 6.98858 28.5275 8.05196 29.1542 8.81321C29.7448 9.53046 30.5498 9.97411 31.4294 9.97411ZM34.9609 9.84629C34.0653 10.934 32.8173 11.6068 31.4294 11.6068C30.0414 11.6068 28.7934 10.934 27.8979 9.84635C27.0386 8.8027 26.5071 7.37258 26.5071 5.80343C26.5071 4.28941 26.6854 2.89975 27.3806 1.83381C28.1196 0.700828 29.3597 0 31.4294 0C33.4989 0 34.739 0.700828 35.478 1.83381C36.1733 2.89973 36.3516 4.28942 36.3516 5.80343C36.3516 7.37257 35.8201 8.8027 34.9609 9.84629Z" fill="#452C88" />
              <path d="M38.3622 19.5672C38.3269 17.3334 38.1782 15.9187 37.5393 15.0426C36.9554 14.2421 35.8577 13.7767 33.9257 13.3977C33.4863 13.7399 32.6659 14.2001 31.4294 14.2001C30.1927 14.2001 29.3721 13.7399 28.9328 13.3976C27.6886 13.6418 26.7904 13.9219 26.1525 14.3045C26.3657 13.6691 26.5033 13.0074 26.5655 12.3388C27.2549 12.0958 28.0701 11.8978 29.0373 11.7233L29.5127 11.6375L29.8154 12.0134C29.8167 12.015 30.2485 12.5674 31.4294 12.5674C32.6101 12.5674 33.0419 12.015 33.0431 12.0134L33.3458 11.6375L33.8212 11.7233C36.439 12.1958 37.9442 12.8397 38.8531 14.086C39.7452 15.3093 39.948 16.9773 39.9886 19.5417L39.9904 19.654C39.9952 19.9508 40 20.2447 40 20.2597L39.9043 20.6391C39.9002 20.647 38.5384 23.3776 31.4294 23.3776C31.1746 23.3776 30.928 23.3737 30.6877 23.3669C30.5748 22.7961 30.4199 22.2403 30.206 21.718C30.5888 21.7353 30.9957 21.7449 31.4294 21.7449C36.5338 21.7449 38.015 20.4502 38.367 20.0186C38.3665 19.8262 38.3653 19.7538 38.3641 19.6795L38.3622 19.5672Z" fill="#184A45" />
              <path d="M20.0011 16.1469C21.1192 16.1469 22.1405 15.5857 22.8874 14.6784C23.6706 13.7272 24.1551 12.4014 24.1551 10.9263C24.1551 9.39622 23.9997 8.02982 23.3937 7.10081C22.8314 6.23885 21.8023 5.70567 20.0011 5.70567C18.1998 5.70567 17.1706 6.23885 16.6085 7.10081C16.0025 8.02979 15.8472 9.39619 15.8472 10.9263C15.8472 12.4014 16.3316 13.7273 17.1148 14.6785C17.8617 15.5857 18.8829 16.1469 20.0011 16.1469ZM24.1438 15.7116C23.0918 16.9893 21.6277 17.7796 20.0011 17.7796C18.3744 17.7796 16.9103 16.9893 15.8584 15.7117C14.8428 14.478 14.2145 12.7854 14.2145 10.9263C14.2145 9.12239 14.4245 7.47029 15.2437 6.21435C16.1066 4.89133 17.5627 4.073 20.0011 4.073C22.4393 4.073 23.8954 4.89133 24.7584 6.21435C25.5777 7.47026 25.7877 9.12238 25.7877 10.9263C25.7877 12.7854 25.1595 14.4779 24.1438 15.7116Z" fill="#452C88" />
              <path d="M28.5646 27.4648C28.5212 24.726 28.3356 22.9868 27.5355 21.8897C26.7919 20.8701 25.4106 20.2868 22.979 19.8162C22.4891 20.2153 21.5143 20.7986 20.0009 20.7986C18.4874 20.7986 17.5125 20.2153 17.0227 19.8162C14.6175 20.2818 13.2396 20.8581 12.4904 21.858C11.6884 22.9285 11.4902 24.6191 11.4405 27.276L11.4386 27.3747C11.435 27.5671 11.4317 27.7407 11.4306 28.0702C11.8243 28.5803 13.612 30.2755 20.0009 30.2755C26.3899 30.2755 28.1775 28.5802 28.571 28.0701C28.5703 27.8241 28.5686 27.715 28.5668 27.6058L28.5646 27.4648L28.5646 27.4648ZM28.8493 20.933C29.9026 22.3774 30.1423 24.3699 30.1909 27.4393L30.1932 27.5804C30.1987 27.9175 30.204 28.2472 30.204 28.3058L30.1084 28.6852C30.1035 28.6944 28.5013 31.9082 20.0009 31.9082C11.5003 31.9082 9.89815 28.6944 9.8933 28.6852L9.79761 28.3058C9.79761 28.1243 9.80451 27.7619 9.81234 27.3492L9.81421 27.2505C9.87022 24.2522 10.1274 22.2998 11.1894 20.8822C12.2638 19.4482 14.0486 18.698 17.1355 18.1407L17.6099 18.0551L17.9136 18.4309C17.9152 18.433 18.4885 19.166 20.0009 19.166C21.5131 19.166 22.0864 18.433 22.088 18.4309L22.3917 18.0551L22.8661 18.1407C25.9887 18.7044 27.7792 19.4658 28.8493 20.933Z" fill="#184A45" />
              <path d="M8.57067 9.97411C7.69121 9.97411 6.8861 9.53041 6.29555 8.81313C5.66884 8.05192 5.28112 6.98851 5.28112 5.80344C5.28112 4.56328 5.40475 3.45931 5.8868 2.7203C6.3251 2.04837 7.13813 1.6327 8.57067 1.6327C10.0033 1.6327 10.8163 2.04837 11.2546 2.7203C11.7366 3.45928 11.8602 4.56327 11.8602 5.80344C11.8602 6.98858 11.4725 8.05196 10.8458 8.81321C10.2553 9.53046 9.4502 9.97411 8.57067 9.97411ZM5.03917 9.84629C5.9347 10.934 7.18272 11.6068 8.57067 11.6068C9.95868 11.6068 11.2067 10.934 12.1022 9.84635C12.9614 8.8027 13.4929 7.37258 13.4929 5.80343C13.4929 4.28941 13.3147 2.89975 12.6194 1.83381C11.8804 0.700828 10.6404 0 8.57067 0C6.50109 0 5.26109 0.700828 4.52203 1.83381C3.82672 2.89973 3.64844 4.28942 3.64844 5.80343C3.64844 7.37257 4.17995 8.8027 5.03917 9.84629Z" fill="#452C88" />
              <path d="M1.63775 19.5672C1.67309 17.3334 1.82178 15.9187 2.46072 15.0426C3.04455 14.2421 4.14232 13.7767 6.07432 13.3977C6.51365 13.7399 7.33412 14.2001 8.57063 14.2001C9.80729 14.2001 10.6279 13.7399 11.0672 13.3976C12.3114 13.6418 13.2096 13.9219 13.8475 14.3045C13.6343 13.6691 13.4967 13.0074 13.4345 12.3388C12.7451 12.0958 11.9299 11.8978 10.9627 11.7233L10.4873 11.6375L10.1846 12.0134C10.1833 12.015 9.75154 12.5674 8.57061 12.5674C7.38994 12.5674 6.95811 12.015 6.95684 12.0134L6.65422 11.6375L6.17876 11.7233C3.56096 12.1958 2.05578 12.8397 1.14691 14.086C0.254751 15.3093 0.0519756 16.9773 0.0114196 19.5417L0.00961147 19.654C0.00479063 19.9508 0 20.2447 0 20.2597L0.0956931 20.6391C0.0997908 20.647 1.46155 23.3776 8.57061 23.3776C8.82542 23.3776 9.072 23.3737 9.31226 23.3669C9.42519 22.7961 9.58012 22.2403 9.79402 21.718C9.41115 21.7353 9.00424 21.7449 8.57061 21.7449C3.46618 21.7449 1.98503 20.4502 1.63296 20.0186C1.63351 19.8262 1.63471 19.7538 1.63592 19.6795L1.63775 19.5672Z" fill="#184A45" />
            </svg>
            Add {{$add_as_user ?? 'Guest'}}
          </h4>
          <button type="button" class="close closeModalButton" id="closeicon" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
            <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
        <form action="userStore" id="formData" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="role" name="role" value="{{isset($add_as_user) ? $add_as_user : ''}}">
          <input type="hidden" id="id" name="id">

          @if($add_as_user == user_roles('1'))
          <input type="hidden" id="manager_id" name="manager_id" value="{{$user->id}}">
          @endif

          @if($add_as_user == user_roles('2'))
          <input type="hidden" id="manager_id" name="manager_id" value="{{$user->manager_id}}">
          <input type="hidden" id="sadmin_id" name="sadmin_id" value="{{$user->id}}">
          @endif

          @if($add_as_user == user_roles('3') && $user->role == user_roles('2'))
          <input type="hidden" id="manager_id" name="manager_id" value="{{$user->manager_id}}">
          <input type="hidden" id="sadmin_id" name="sadmin_id" value="{{$user->sadmin_id}}">
          <input type="hidden" id="admin_id" name="admin_id" value="{{$user->id}}">
          @endif
 
          <div class="modal-body pt-0">
            <div class="row">

              <div class="col-lg-6 mb-2">
                <label for="user_pic">@lang('lang.upload_image')</label>
                <div class="row">
                  <div class="col-lg-10 col-10 col-sm-10 col-xl-10">
                    <input type="file" name="user_pic" id="user_pic" class="form-control" require>
                  </div>
                  <div class="col-lg-2 col-2 col-sm-2 col-xl-2">
                    <img src="" width="45px" height="45px" style="border-radius: 50%;" id="user_pic" class="d-none">
                  </div>
                </div>
              </div>

              @if($add_as_user == user_roles('3'))
              <div class="col-lg-6 mb-2">
                <label for="com_pic">@lang('lang.admin')</label>
                <select name="admin_id" id="admin_id" class="form-select">
                  <option disabled selected>@lang('select admins') </option>
                  @foreach($admins_list ?? [] as $value)
                  <option value="{{ $value['id'] }}" {{ isset($data['admin_id']) && $data['admin_id'] == $value['id'] ? 'selected' : '' }}>
                    {{ $value['name'] }}
                  </option>
                  @endforeach
                </select>
                <div id="adminError" class="text-danger d-none">*@lang('lang.select_admin_error')</div>
              </div>
              @endif 

              @if($add_as_user == user_roles('1'))
              <div class="col-lg-6 mb-2">
                <label for="com_pic">@lang('lang.company_logo')</label>
                <div class="row">
                  <div class="col-lg-10 col-10 col-sm-10 col-xl-10">
                    <input type="file" name="com_pic" id="com_pic" class="form-control" require>
                  </div>
                  <div class="col-lg-2 col-2 col-sm-2 col-xl-2">
                    <img src="" width="45px" height="45px" style="border-radius: 50%;" id="com_pic" class="d-none">
                  </div>
                </div>
              </div>
              @endif

              <div class="col-lg-6 mt-2">
                <label for="name">@lang('lang.name')</label>
                <input type="text" name="name" id="name" class="form-control">
                <div id="nameError" class="text-danger d-none">@lang('lang.name_error')</div>
              </div>

              <div class="col-lg-6 mt-2">
                <label for="email">@lang('lang.email')</label>
                <input type="email" name="email" id="email" class="form-control">
                <div id="emailError" class="text-danger d-none">@lang('lang.email_error')</div>
              </div>

              <div class="col-lg-6 mt-2">
                <label for="phone">@lang('lang.phone')</label>
                <input type="tel" name="phone" id="phone" class="form-control" maxlength="15">
              </div>

              <div class="col-lg-6 mt-2">
                <label for="com_name">@lang('lang.company_name')</label>
                <input type="text" name="com_name" id="com_name" class="form-control">
              </div>

              <div class="col-lg-6 mt-2">
                <label for="address">@lang('lang.address')</label>
                <input type="text" name="address" id="address" class="form-control">
                <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">150</span> /150</p>
              </div>

              <div class="col-lg-6 mt-3">
                <div class="row py-4 justify-content-end">
                  <div class="col-lg-12">
                    <button type="submit" id="btn_save" class="btn btn-md text-white px-5 " data-target="#add" style="background-color: #184A45; width: 100%;">
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
  </div>
  <!-- Add Users Modal End -->



  <!-- User Status Modal -->
  <div class="modal fade" id="user_sts_modal" tabindex="-1" aria-labelledby="user_stsLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white" style="border-radius: 10px;">
        <div class="modal-header pb-0" style="border: none;">
          <h5 class="modal-title" id="user_stsLabel"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
        <form method="post" id="user_sts">
          @csrf
          <input type="hidden" name="_previous" value="{{url()->previous()}}">
          <input type="hidden" id="admin_id" name="id">
          <div class="modal-body pt-0">
            <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="4" y="4" width="48" height="48" rx="24" fill="#D1FADF" />
              <path d="M23.5 28L26.5 31L32.5 25M38 28C38 33.5228 33.5228 38 28 38C22.4772 38 18 33.5228 18 28C18 22.4772 22.4772 18 28 18C33.5228 18 38 22.4772 38 28Z" stroke="#039855" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <rect x="4" y="4" width="48" height="48" rx="24" stroke="#ECFDF3" stroke-width="8" />
            </svg>
            <select name="status" id="status" class="form-select mt-3">
              <option value="1">@lang('lang.activate')</option>
              <option value="3">@lang('lang.suspend')</option>
            </select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm text-white px-5" id="change_sts" name="change_sts" type="submit" style="background-color: #233A85; border-radius: 8px;">
              <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
              <span id="add_btn">@lang('lang.ok')</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- User Status Modal End -->



  <!-- Delete admin Modal -->
  <div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="deleteAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white" style="border-radius: 10px;">
        @if($user_role_static == user_roles(1))
        <div class="modal-body">
          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4909 13.743C23.7359 13.743 23.94 13.9465 23.94 14.2054V14.4448C23.94 14.6975 23.7359 14.9072 23.4909 14.9072H13.0497C12.804 14.9072 12.6 14.6975 12.6 14.4448V14.2054C12.6 13.9465 12.804 13.743 13.0497 13.743H14.8866C15.2597 13.743 15.5845 13.4778 15.6684 13.1036L15.7646 12.6739C15.9141 12.0887 16.4061 11.7 16.9692 11.7H19.5708C20.1277 11.7 20.6252 12.0887 20.7692 12.6431L20.8721 13.1029C20.9555 13.4778 21.2802 13.743 21.654 13.743H23.4909ZM22.5577 22.4943C22.7495 20.707 23.0852 16.4609 23.0852 16.418C23.0975 16.2883 23.0552 16.1654 22.9713 16.0665C22.8812 15.9739 22.7672 15.9191 22.6416 15.9191H13.9032C13.777 15.9191 13.6569 15.9739 13.5735 16.0665C13.489 16.1654 13.4473 16.2883 13.4534 16.418C13.4546 16.4259 13.4666 16.5755 13.4868 16.8255C13.5762 17.9364 13.8255 21.0303 13.9865 22.4943C14.1005 23.5729 14.8081 24.2507 15.8332 24.2753C16.6242 24.2936 17.4391 24.2999 18.2724 24.2999C19.0573 24.2999 19.8544 24.2936 20.6699 24.2753C21.7305 24.257 22.4376 23.5911 22.5577 22.4943Z" fill="#D11A2A" />
          </svg>
          <div class="mt-3">
            <h6>@lang('lang.really_want_to_delete_user')</h6>
          </div>
          <div class="row mt-3 text-center">
            <div class="col-lg-6">
              <button class="btn btn-sm btn-outline px-5 closeModalButton" type="button" data-toggle="modal" data-target="#deleteadmin" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
            </div>
            <div class="col-lg-6">
              <form method="post" id="DeleteData" action="deleteUsers">
                <input type="hidden" id="user_id" name="id">
                <input type="hidden" id="deleted_by" name="deleted_by" value="{{ $login_userId ?? ''}}">
                <button type="submit" class="btn  btn_deleteUser btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">
                  <div class="spinner-border btn_spinner spinner-border-sm text-white d-none"></div>
                  <span id="add_btn">@lang('lang.delete')</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        @elseif($user_role_static == user_roles(2))
        <div class="modal-body">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2" />
            <path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8" />
          </svg>
          <button class="btn p-0 float-right closeModalButton" data-dismiss="modal">
            <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
          <div class="mt-3">
            <h6>@lang('lang.really_want_to_delete_admin')</h6>
            <p>@lang('Admin has assigned Users what to do with them')</p>
          </div>
          <form method="post" id="DeleteData" action="deleteUsers">
            <input type="hidden" id="user_id" name="id">
            <input type="hidden" id="deleted_by" name="deleted_by" value="{{ $login_userId ?? ''}}">
            <div class="mt-3">
              <input type="checkbox" name="delete_all_user" id="delete_all_drivers"> @lang('Delete his all users')
            </div>
            <div class="row mt-3 text-center">
              <div class="col-lg-6">
                <button data-dismiss="modal" type="button" class="btn btn-sm btn-outline px-5 closeModalButton" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
              </div>
              <div class="col-lg-6">
                <button type="submit" class="btn  btn_deleteUser btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">
                  <div class="spinner-border btn_spinner spinner-border-sm text-white d-none"></div>
                  <span id="add_btn">@lang('lang.delete')</span>
                </button>
              </div>
            </div>
          </form>
        </div>
        @elseif($user_role_static == user_roles(3))
        <div class="modal-body">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2" />
            <path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8" />
          </svg>
          <button class="btn p-0 float-right closeModalButton" data-dismiss="modal">
            <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>

          <div class="mt-3">
            <h6>@lang('Really want to delete that user')</h6>
          </div>

          <form method="post" id="DeleteData" action="deleteUsers">
            <input type="hidden" id="user_id" name="id">
            <input type="hidden" id="deleted_by" name="deleted_by" value="{{ $login_userId ?? ''}}">
            <div class="my-2">
              <div class="row mt-3 text-center">
                <div class="col-lg-6">
                  <button data-dismiss="modal" type="button" class="btn btn-sm btn-outline px-5 closeModalButton" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn  btn_deleteUser btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">
                    <div class="spinner-border btn_spinner spinner-border-sm text-white d-none"></div>
                    <span id="add_btn">@lang('lang.delete')</span>
                  </button>
                  <!-- <button class="btn btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">@lang('lang.delete')</button> -->
                </div>
              </div>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
  <!-- Delete admin Modal End -->


  <script>
    $(document).ready(function() {
      const maxLength = 150;
      const textarea = $('#address');
      const charCountElement = $('#charCount');
      const charCountContainer = $('#charCountContainer');
      const submitButton = $('#btn_save');

      textarea.on('input', function() {
        const currentLength = textarea.val().length;
        const charCount = Math.max(maxLength - currentLength); // Ensure non-negative count

        charCountElement.text(charCount);

        if (currentLength > 0) {
          charCountContainer.show();
        } else {
          charCountContainer.hide();
        }

        if (currentLength > maxLength) {
          const exceededCount = currentLength - maxLength;
          charCountElement.css('color', 'red'); // Set text color to red
          charCountElement.text(`Your limit exceeded by ${exceededCount} characters`);
          submitButton.prop('disabled', true);
        } else if (currentLength === maxLength) {
          charCountElement.css('color', ''); // Reset text color
          charCountElement.text(''); // Clear the message
          submitButton.prop('disabled', false);
        } else {
          charCountElement.css('color', ''); // Reset text color
          charCountElement.text(`${maxLength - currentLength}`);
          submitButton.prop('disabled', false);
        }

      });

      // Add a click event handler to the submit button
      $('#btn_save').click(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var isValid = true;

        if ($('#admin_id').val() === null) {
          $('#adminError').removeClass('d-none'); // Display the error message
          isValid = false;
        } else {
          $('#adminError').addClass('d-none'); // Hide the error message
        }

        // Validate email field
        var email = $('#email').val();
        if (!validateEmail(email)) {
          $('#emailError').removeClass('d-none'); // Display the email error message
          isValid = false;
        } else {
          $('#emailError').addClass('d-none'); // Hide the email error message
        }

        // Validate name field
        var name = $('#name').val();
        if (name.trim() === '') {
          $('#nameError').removeClass('d-none'); // Display the name error message
          isValid = false;
        } else {
          $('#nameError').addClass('d-none'); // Hide the name error message
        }

        if (isValid) {
          $('#formData').submit(); // Trigger the form submission if all fields are valid
        }
      });

      // Add input event handlers to the name and email fields
      $('#name').on('input', function() {
        $('#nameError').addClass('d-none'); // Hide the name error message when input is provided
      });

      $('#email').on('input', function() {
        $('#emailError').addClass('d-none'); // Hide the email error message when input is provided
      });

      // Add a change event handler to the admin select element
      $('#admin_id').change(function() {
        if ($(this).val() !== null) {
          $('#adminError').addClass('d-none'); // Hide the error message when admin is selected
        }
      });
    });

    // Email validation function
    function validateEmail(email) {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
    }
  </script>