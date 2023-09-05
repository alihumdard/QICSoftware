@extends('layouts.main')

@section('main-section')
<style>
  img {
    position: relative;
  }

  .edit-button {
    position: absolute;
    bottom: 50px;
    left: 560px;
    right: 450px;
  }

  .dropzone {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    display: inline-block;
  }

  .file-input-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    cursor: pointer;
    transition: opacity 0.3s ease;
  }

  .file-input-container:hover {
    opacity: 1;
  }

  .upload-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  .upload-icon svg {
    width: 30px;
    height: 30px;
    fill: #233A85;
  }
</style>
<!-- partial -->
  <div class="content-wrapper py-0 my-2">
    <div style="border: none;">
      <div class="bg-white" style="border-radius: 20px;">
        <div class="p-3">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
              <i class="fa fa-gear"></i>
            </span>
            <span>@lang('lang.settings')</span>
          </h3>
          <form id="formData" action="userStore" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="role" value="{{$user->role}}">
            <input type="hidden" name="email" value="{{$user->email}}">
            <input type="hidden" name="email" value="{{$user->email}}">
            @if( $user->role == user_roles('3'))
              <input type="hidden" id="client_id" name="client_id" value="{{isset($user->client_id) ? $user->client_id : ''}}">
              <input type="hidden" id="added_user_id" name="added_user_id" value="{{isset($user->added_user_id) ? $user->added_user_id : ''}}">
            @endif
            <div class="row mb-3">
              <div class="col-lg-12 text-center">
                <div id="dropzone" class="dropzone">
                  <img id="profileImage" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : 'assets/images/user.png'}}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;" alt="text">
                  <div class="file-input-container">
                    <input class="file-input" type="file" name="user_pic" id="fileInput1">
                    <div class="upload-icon" onclick="document.getElementById('fileInput1').click()">
                      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="18" cy="18" r="18" fill="#233A85" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="white" />
                      </svg>
                    </div>
                  </div>
                </div>
                <p class="error-image text-danger d-none">* The user pic should be less than or equal to 1024KB.</P>

                <p>{{ $user->email }}</p>
              </div>
            </div>
            <!-- </form> -->

            <div class="row">
                <div class="col-lg-6 col-sm-12 mt-3" style="width: 100%;">
                  <label class="mb-0" style="color: #452C88;" for="name"><span><b>@lang('lang.full_name')</b></span></label>
                  <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name" placeholder="@lang('lang.enter_your_name')">
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="phone"><span><b>@lang('lang.phone_number')</b></span></label>
                  <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="phone" placeholder="@lang('lang.enter_your_number')">
                </div>
                <!-- <div class="col-lg-6 col-sm-4 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="country"><span><b>@lang('lang.country')</b></span></label>
                  <input type="text" class="form-control" value="{{$user->country}}" name="country" id="country" placeholder="@lang('lang.enter_country')">
                </div>
                <div class="col-lg-6 col-sm-4 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="city"><span><b>@lang('lang.city')</b></span></label>
                  <input type="text" class="form-control" name="city"   value="{{$user->city}}" id="city" placeholder="@lang('lang.enter_city')">
                </div>
                <div class="col-lg-6 col-sm-4 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="state"><span><b>@lang('lang.state')</b></span></label>
                  <input type="text" class="form-control"  value="{{$user->state}}" name="state" id="state" placeholder="@lang('lang.state')">
                </div>
                <div class="col-lg-6 col-sm-6 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="zip_code"><span><b>@lang('lang.zip_code')</b></span></label>
                  <input type="text" class="form-control" value="{{$user->zip_code}}" name="zip_code" id="zip_code" placeholder="@lang('lang.enter_zip_code')">
                </div> -->
                <!-- <div class="col-lg-4 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="old_password"><span>@lang('lang.old_password')</span></label>
                  <input type="text" class="form-control" name="old_password" id="old_password" placeholder="@lang('lang.enter_old_password')">
                </div> -->
                <div class="col-lg-4 col-sm-6 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="address"><span><b>@lang('lang.address')</b></span></label>
                  <input type="text" class="form-control"  value="{{$user->address}}" name="address" id="address" placeholder="@lang('lang.address')">
                </div>
                <div class="col-lg-4 col-sm-6 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="new_password"><span><b>@lang('lang.new_password')</b></span></label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="@lang('lang.enter_new_password')">
                </div>
                <div class="col-lg-4 col-sm-6 mt-3">
                  <label class="mb-0" style="color: #452C88;" for="confirm_password"><span><b>@lang('lang.confirm_password')</b></span></label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="@lang('lang.confirm_password')">
                  <small id="passwordError" style="color: red;"></small> <!-- Error message element -->
                  <small id="passwordSuccess" style="color: green;"></small> <!-- Success message element -->
                </div>
                <div class="col-lg-4 mt-3"></div>
                <div class="col-lg-4 mt-3"></div>
                <div class="col-lg-4 mt-3 my-4 text-right">
                  <button class="btn text-white btn-md px-4" type="submit" name="update" style="background-color: #E45F00;" onclick="validateForm(event)">
                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                    <span id="add_btn">@lang('lang.update')</span>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <script>
      // Get references to the necessary elements
      const fileInput = document.getElementById('fileInput1');
      const profileImage = document.getElementById('profileImage');
      const form = document.getElementById('myForm');

    // Handle file input change
fileInput.addEventListener('change', function(event) {
  const file = event.target.files[0];
  const reader = new FileReader();
  if (!$('.error-image').hasClass('d-none')) {
  $('.error-image').addClass('d-none');
}

  // Check the file size and type of file
if (file.type.startsWith('image/')) {
  if (file.size <= 1048576) {
    reader.readAsDataURL(file);

    reader.onload = function(e) {
      profileImage.src = e.target.result;
      form.action = "userStore?id={{$user->id}}&role={{$user->role}}&email={{$user->email}}";
    };
  } else {
    $('.error-image').removeClass('d-none').text('The user pic should be less than or equal to 1024KB');
    console.log("Image size exceeds the limit of 1 MB.");
    fileInput.value = "";
  }
} else {
  $('.error-image').removeClass('d-none').text('Please select an image file.');
  console.log("Please select an image file.");
  fileInput.value = "";
}


});


      // Function to validate password and confirm_password fields
      function validatePassword() {
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');
        const passwordError = document.getElementById('passwordError');
        const passwordSuccess = document.getElementById('passwordSuccess');

        const passwordValue = passwordInput.value;
        const confirmValue = confirmInput.value;

        if (passwordValue === confirmValue) {
          // Passwords match, clear error message and display success message
          passwordError.textContent = '';
          passwordSuccess.textContent = 'Passwords match';
        } else {
          // Passwords do not match, display error message and clear success message
          passwordError.textContent = 'Passwords do not match';
          passwordSuccess.textContent = '';
        }
      }

      // Function to validate the form before submitting
      function validateForm(event) {
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');

        const passwordValue = passwordInput.value;
        const confirmValue = confirmInput.value;

        if (passwordValue !== confirmValue) {
          // Passwords do not match, prevent form submission
          event.preventDefault();
          swal({
            title: "Danger!",
            text: "Passwords do not match",
            icon: "warning"
          });
        }
      }

      // Add event listeners for input change
      document.getElementById('password').addEventListener('input', validatePassword);
      document.getElementById('confirm_password').addEventListener('input', validatePassword);
    </script>


    @endsection