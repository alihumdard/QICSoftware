@extends('layouts.main')

@section('main-section')
<!-- partial -->
<div class="content-wrapper py-0 my-2">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title pb-3">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23.1783 16.5241L19.5521 3.01716C19.1579 1.54862 17.353 1.00759 16.2133 2.01629L13.9278 4.039C11.3845 6.28991 8.35111 7.91891 5.06775 8.79698C2.31938 9.53199 0.690561 12.3597 1.42698 15.1028C2.16341 17.8459 4.99058 19.4819 7.73896 18.7469C11.0223 17.8688 14.4654 17.7657 17.7956 18.4459L20.7882 19.0571C22.2806 19.3619 23.5725 17.9926 23.1783 16.5241Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M7.53931 8.09998L11.7001 23.5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span>@lang('Revenue')</span>
        </h3>

        <hr class="mt-3 mb-2">
        <div class="px-2">
          <div class="table-responsive">
            <table id="users-table" class="display" style="width:100%">
              <thead class="text-white" style="background-color: #184A45;">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th> @lang('lang.date') </th>
                  <th> @lang('Amount') </th>
                  <th> @lang('Currency Code') </th>
                  <th> @lang('Currency Name') </th>
                  <th> @lang('Currency Type') </th>
                </tr>
              </thead>
              <tbody id="tableData">

                @foreach($data as $key => $value)
                <tr style="font-size: small;">
                  <td><b>{{ $key + 1 }}</b></td>
                  <td><b>{{date('F, d Y')}}</b></td>
                  <td><b>{{ ($value['total_amount']) ? $value['total_amount'].'/-' :'' }}</b></td>
                  <td><b>{{ $value['code'] ?? ''}}</b></td>
                  <td><b>{{ $value['name'] ?? '' }}</b></td>
                  <td><b>{{ $value['type'] ?? '' }}</b></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- deleteAnnoncement Modal -->
  <div class="modal fade" id="deleteAnnoncement" tabindex="-1" aria-labelledby="deleterouteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="deleterouteLabel"></h5>
        </div> -->
        <div class="modal-body">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2" />
            <path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8" />
          </svg>
          <div class="float-right">
            <button class="btn p-0" data-dismiss="modal">
              <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                <input type="hidden" id="annoucement_id" name="annoucement_id">
                <input type="hidden" id="user_id" name="id" value="{{$user->id}}">
                <button type="submit" class="btn  btn_deleteUser btn-sm btn-outline text-white px-5" style="background-color: #D92D20; border-radius: 8px; width: 100%;">
                  <div class="spinner-border btn_spinner spinner-border-sm text-white d-none"></div>
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
  <!-- deleteAnnoncement Modal End -->

  <!-- content-wrapper ends -->
  <script>
    $(document).ready(function() {

      const maxLength = 250;
      const textarea = $('#desc');
      const charCountElement = $('#charCount');
      const charCountContainer = $('#charCountContainer');
      const submitButton = $('#submitBtn');

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

      // // Enable textarea when content is deleted after exceeding limit
      // textarea.on('keyup', function() {
      //     // const currentLength = textarea.val().length;

      //     if (currentLength > maxLength) {
      //         textarea.val(textarea.val().substring(0, maxLength)); // Truncate content
      //         charCountElement.css('color', 'red'); // Set text color to red
      //         charCountElement.text('Your limit exceeded');
      //         submitButton.prop('disabled', true);
      //     } else {
      //         charCountElement.css('color', ''); // Reset text color
      //         submitButton.prop('disabled', false);
      //     }
      // });

      // Add input event handler to clear error messages
      $('#title, #start_date, #end_date, #desc').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.error-message').text('');
      });

      $('#submitBtn').on('click', function(e) {
        e.preventDefault();

        // Reset the error messages and styles
        $('.error-message').text('');
        $('.is-invalid').removeClass('is-invalid');

        // Flag to track if any validation error occurs
        var hasErrors = false;

        // Validate the title input
        var titleInput = $('#title');
        var titleError = $('#title-error');
        if (titleInput.val().trim() === '') {
          titleError.text('*Title is required.');
          hasErrors = true;
        }

        // Validate the start date input
        var startDateInput = $('#start_date');
        var startDateError = $('#start-date-error');
        if (startDateInput.val().trim() === '') {
          startDateError.text('*Start date is required.');
          hasErrors = true;
        }

        // Validate the end date input
        var endDateInput = $('#end_date');
        var endDateError = $('#end-date-error');
        if (endDateInput.val().trim() === '') {
          endDateError.text('*End date is required.');
          hasErrors = true;
        }

        // Validate the description input
        var descInput = $('#desc');
        var descError = $('#desc-error');
        if (descInput.val().trim() === '') {
          descError.text('*Description is required.');
          hasErrors = true;
        }

        var typeInput = $('.type');
        var typeError = $('#type-error');
        var selectedType = typeInput.filter(':checked').val();

        if (!selectedType) {
          typeError.text('*Select one of them.');
          hasErrors = true;
        }

        // Scroll to the first error message
        if (hasErrors) {
          $('html, body').animate({
            scrollTop: $('.is-invalid:first').offset().top
          }, 500);
        } else {
          // If no errors, allow form submission
          $('#formData').submit();
        }
      });
    });
  </script>


  <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("start_date").setAttribute("min", today);
  </script>
  <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("start_date").setAttribute("min", today);
  </script>
  <script>
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);

    var endDateInput = document.getElementById("end_date");
    endDateInput.setAttribute("min", tomorrow.toISOString().split('T')[0]);
  </script>

  <script>
    // Get the input elements
    var startDateInput = document.getElementById("start_date");
    var endDateInput = document.getElementById("end_date");

    // Add event listener to "start_date" input
    startDateInput.addEventListener("change", function() {
      // Get the selected start_date value
      var selectedStartDate = new Date(startDateInput.value);

      // Update "end_date" min attribute to disable previous dates
      var minEndDate = selectedStartDate.toISOString().split('T')[0];
      endDateInput.setAttribute("min", minEndDate);

      // If the current end_date is before the selected start_date, update end_date to the selected start_date
      var selectedEndDate = new Date(endDateInput.value);
      if (selectedEndDate < selectedStartDate) {
        endDateInput.value = minEndDate;
      }
    });
  </script>
  <script>
    // Function to scroll to the form
    function scrollToForm() {
      const formElement = document.getElementById('formData');
      formElement.scrollIntoView({
        behavior: 'smooth',
        top: 0
      });
    }
  </script>

  @endsection