@extends('layouts.main')

@section('main-section')
<style>
    tbody tr {
        cursor: move;
    }

    tbody tr td:first-child {
        cursor: grab;
    }

    .modal-backdrop.show {
        opacity: 0 !important;
    }

    .draggable-modal .modal-dialog {
        pointer-events: none;
    }

    .draggable-modal .modal-content {
        pointer-events: auto;
    }

    .form-group .form-check {
        margin-bottom: 5px;
    }


    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
    }

    #map {
        height: 400px;
        width: 100%;
    }
    .d-view_map {
    width: 100%;
    height: 400px; 
    }

    .custom-button {
        width: 100%;
        height: 30px;
        display: inline-block;
        padding: 30px 12px 30px 12px;
        background-color: #233A85;
        color: white;
        cursor: pointer;
        /* border-radius: 4px; */
        border: none;
        text-align: center;
        text-decoration: none;
        /* font-size: 16px; */
        border-radius: 3px;
    }

    .custom-button:hover {
        background-color: #233A85;
    }

    .custom-button:active {
        background-color: #233A85;
    }
    #addAddressModal .modal-header {
        padding: 0.5rem 1rem;
    }

    #addAddressModal .modal-title {
        font-size: 1rem; 
        margin-bottom: 0; 
    }
</style>

    <div class="content-wrapper py-0 my-2">
        <div style="border: none;">
            <div class="bg-white" style="border-radius: 20px;">
                <div class="p-3">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6667 0H3.33333C2.44928 0 1.60143 0.35119 0.976311 0.976311C0.35119 1.60143 0 2.44928 0 3.33333V16.6667C0 17.5507 0.35119 18.3986 0.976311 19.0237C1.60143 19.6488 2.44928 20 3.33333 20H16.6667C17.5507 20 18.3986 19.6488 19.0237 19.0237C19.6488 18.3986 20 17.5507 20 16.6667V3.33333C20 2.44928 19.6488 1.60143 19.0237 0.976311C18.3986 0.35119 17.5507 0 16.6667 0ZM17.7778 16.6667C17.7778 16.9614 17.6607 17.244 17.4523 17.4523C17.244 17.6607 16.9614 17.7778 16.6667 17.7778H3.33333C3.03865 17.7778 2.75603 17.6607 2.54766 17.4523C2.33929 17.244 2.22222 16.9614 2.22222 16.6667V3.33333C2.22222 3.03865 2.33929 2.75603 2.54766 2.54766C2.75603 2.33929 3.03865 2.22222 3.33333 2.22222H16.6667C16.9614 2.22222 17.244 2.33929 17.4523 2.54766C17.6607 2.75603 17.7778 3.03865 17.7778 3.33333V16.6667Z" fill="white" />
                                <path d="M13.3333 8.88888H11.1111V6.66665C11.1111 6.37197 10.994 6.08935 10.7857 5.88098C10.5773 5.67261 10.2947 5.55554 9.99999 5.55554C9.7053 5.55554 9.42269 5.67261 9.21431 5.88098C9.00594 6.08935 8.88888 6.37197 8.88888 6.66665V8.88888H6.66665C6.37197 8.88888 6.08935 9.00594 5.88098 9.21431C5.67261 9.42269 5.55554 9.7053 5.55554 9.99999C5.55554 10.2947 5.67261 10.5773 5.88098 10.7857C6.08935 10.994 6.37197 11.1111 6.66665 11.1111H8.88888V13.3333C8.88888 13.628 9.00594 13.9106 9.21431 14.119C9.42269 14.3274 9.7053 14.4444 9.99999 14.4444C10.2947 14.4444 10.5773 14.3274 10.7857 14.119C10.994 13.9106 11.1111 13.628 11.1111 13.3333V11.1111H13.3333C13.628 11.1111 13.9106 10.994 14.119 10.7857C14.3274 10.5773 14.4444 10.2947 14.4444 9.99999C14.4444 9.7053 14.3274 9.42269 14.119 9.21431C13.9106 9.00594 13.628 8.88888 13.3333 8.88888Z" fill="white" />
                            </svg>
                        </span>
                        <span>{{ ($duplicate_trip ?? '' ==1) ? 'Duplicate Contract' : ((isset($data['id'])) ? 'Update Contract' : 'Add Contract') }}</span>
                    </h3>
                </div>

                <div class="container" id="home">
                    <form action="tripStore" id="saveTrip" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-lg-{{ $user->role === 'Client' ? '4' : '3' }} col-sm-8 my-2">
                                <label for="title">@lang('lang.title')</label>
                                <input required type="text" maxlength="60" name="title" id="title" value="{{ $data['title'] ?? '' }}" placeholder="@lang('lang.title')" class="form-control">
                                <span id="title_error" class="error-message text-danger"></span>
                                <input type="hidden" name="id" id="trip_id" value="{{ ($duplicate_trip ==1) ? '' : ((isset($data['id'])) ? $data['id'] : '') }}" />
                                <input type="hidden" name="duplicate_trip" id="duplicate_trip" value="{{ $duplicate_trip ?? ''}}" />

                            </div>

                            <div class="col-lg-{{ $user->role === 'Client' ? '4' : '3' }} col-sm-4 my-2">
                                <label for="trip_date">@lang('lang.date')</label>
                                <input required type="date" name="trip_date" id="trip_date" value="{{ ($duplicate_trip ?? '' == 1) ? date('Y-m-d') : ((isset($data['id'])) ? $data['trip_date'] : date('Y-m-d') ) }}" min="{{ ($duplicate_trip ?? '' == 1) ? date('Y-m-d') : ((isset($data['id'])) ? $data['trip_date'] : date('Y-m-d') ) }}" class="form-control">
                                <span id="trip_date_error" class="error-message text-danger"></span>
                            </div>

                            @if(isset($client_list) && $client_list != '')
                            <div class="col-lg-{{ $user->role === 'Client' ? '4' : '3' }} my-2">
                                <label for="client_id">@lang('lang.admins') </label>
                                <select required name="client_id" id="client_id" class="form-select" onchange="getDrivers(this.value)">
                                    <option disabled selected> Select @lang('lang.admins') </option>
                                    @foreach($client_list as $value)
                                    <option value="{{ $value['id'] }}" {{ isset($data['client_id']) && $data['client_id'] == $value['id'] ? 'selected' : '' }}>
                                        {{ $value['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                                <span id="client_id_error" class="error-message text-danger"></span>
                            </div>
                            @endif

                            <div class="col-lg-{{ $user->role === 'Client' ? '4' : '3' }} my-2">
                                <label for="driver_id">@lang('lang.users')</label>
                                <select required name="driver_id" id="driver_id" class="form-select">
                                    <option disabled selected> Select @lang('lang.users')</option>
                                    @forelse($driver_list as $value)
                                    <option value="{{ $value['id'] }}" {{ isset($data['driver_id']) && $data['driver_id'] == $value['id'] ? 'selected' : '' }}>
                                        {{ $value['name'] }}
                                    </option>
                                    @empty
                                    <!-- Code to handle the case when $driver_list is empty or null -->
                                    @endforelse
                                </select>
                                <span id="driver_id_error" class="error-message text-danger"></span>
                            </div>

                            <div class="col-lg-12 mb-2">
                                <label for="trip_desc">@lang('lang.contract_desc')</label>
                                <textarea name="desc" id="trip_desc" class="form-control" placeholder="@lang('lang.trip_description')">{{ $data['desc'] ?? '' }}</textarea>
                                <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">250</span> /250</p>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <label for="start_address">@lang('lang.client_name')</label>
                                <input required type="text" maxlength="100" name="" id="" value="{{ $data['title'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <label for="end_address">@lang('lang.contract_category')</label>
                                <select required name="start_point"  class="form-select">
                                <option disabled selected> Select @lang('lang.quote_category')</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <label for="end_address">@lang('lang.contract_amount')</label>
                                <input required type="number" min="1" name="" id="" value="{{ $data['title'] ?? 1 }}" placeholder="@lang('lang.quoted_amount')" class="form-control">
                            </div>
                        </div>

                        <!-- table of address -->
                        <div class="table-responsive   mt-3 ">
                            <div class=" offset-lg-10  offset-md-6 col-lg-2 col-md-6 col-sm-12 d-flex justify-content-end  text-right mt-2 mb-5">
                                <button type="submit" id="btn_save_trip" class="btn btn-block active text-white" style="background-color:#184A45FF;  border-radius: 8px;">
                                <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.save_contract')</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--add address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-white" style="border-radius: 10px;">
                <div class="modal-header" style="border: none;">
                    <h5 class="modal-title" id="myModalLabel">@lang('lang.add_address')</h5>
                    <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body" style="border: none;">
                    <form id="address-from">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" required id="addressTile" class="form-control" maxlength="60" placeholder="@lang('lang.enter_address_name')" style="border-right: none;">
                                <div class="input-group-append">
                                    <button type="button" id="map_button" data-toggle="modal" data-target="#addlocation" onclick="addAddress_map()" class="input-group-text bg-white p-2" style="border: 1px solid #CED4DA; border-left: none;">
                                        <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 0C3.35 0 0 3.35 0 7.5C0 12.5 7.5 20 7.5 20C7.5 20 15 12.5 15 7.5C15 3.35 11.65 0 7.5 0ZM7.5 2.5C10.275 2.5 12.5 4.75 12.5 7.5C12.5 10.275 10.275 12.5 7.5 12.5C4.75 12.5 2.5 10.275 2.5 7.5C2.5 4.75 4.75 2.5 7.5 2.5Z" fill="#ACADAE" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="validation-error-title"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" required="" id="addressDesc" placeholder="@lang('lang.enter_address_description')"></textarea>
                            <p id="charCountContainer1" class="text-secondary text-right" style="display: none;"><span id="charCount1">250</span> /250</p>
                            <div class="validation-error-desc"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" id="addressPicture" type="checkbox" />
                                <label class="form-check-label" for="pictureCheckbox">@lang('lang.picture')</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="addressSignature" type="checkbox">
                                <label class="form-check-label" for="signatureCheckbox">@lang('lang.signature')</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="addressNote" type="checkbox">
                                <label class="form-check-label" for="noteCheckbox">@lang('lang.note')</label>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" id="btn_address_detail" data-row-id='' class="btn btn-primary mr-3 ml-auto px-4 mb-3" style="background-color: #E45F00; border-radius: 5px;">@lang('lang.save')</button>
            </div>
        </div>
    </div>
</div>
<!-- addlocation Modal -->
<div class="modal fade" id="addlocation" tabindex="-1" aria-labelledby="viewlocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewlocationLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map"></div>
                <div class="mt-3">
                    <h6>@lang('lang.your_location')</h6>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col-lg-12">
                        <button type="button" id="address_confirm" data-dismiss="modal" class="btn text-white" style="background-color: #233A85; width: 70%;">@lang('lang.confirm_location')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- addlocation Modal End -->
<!-- viewlocation Modal -->
<div class="modal fade" id="viewlocation" tabindex="-1" aria-labelledby="viewlocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewlocationLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="text-center">
    <div class="spinner-border text-primary" role="status" id="map_spinner">
      <span class="visually-hidden mt-5">Loading...</span>
    </div>
  </div>
            <div class="d-view_map" id="view_map"></div>
                <div class="mt-3">
                    <h6>@lang('lang.address')</h6>
                </div>
                <!-- <div class="row mt-3 text-center">
                    <div class="col-lg-12">
                        <button type="button" id="address_confirm" data-dismiss="modal" class="btn text-white" style="background-color: #233A85; width: 70%;">@lang('lang.confirm_location')</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- viewlocation Modal End -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3YWssMkDiW3F1noE6AVbiJEL40MR0IFU&libraries=places"></script>
<script>

$(document).ready(function() {


    const maxLength = 250;
    const textarea = $('#trip_desc');
    const charCountElement = $('#charCount');
    const charCountContainer = $('#charCountContainer');
    const submitButton = $('#btn_save_trip');

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


const maximumLength = 250;
    const textarea1 = $('#addressDesc');
    const charCountElement1 = $('#charCount1');
    const charCountContainer1 = $('#charCountContainer1');
    const submitButton1 = $('#btn_address_detail');

textarea1.on('input', function() {
    const currentLength = textarea1.val().length;
    const charCount = Math.max(maximumLength - currentLength); // Ensure non-negative count

    charCountElement1.text(charCount);

    if (currentLength > 0) {
        charCountContainer1.show();
    } else {
        charCountContainer1.hide();
    }

    if (currentLength > maximumLength) {  
    const exceededCount = currentLength - maximumLength;
    charCountElement1.css('color', 'red'); // Set text color to red
    charCountElement1.text(`Your limit exceeded by ${exceededCount} characters`);
    submitButton1.prop('disabled', true);
} else if (currentLength === maximumLength) {
    charCountElement1.css('color', ''); // Reset text color
    charCountElement1.text(''); // Clear the message
    submitButton1.prop('disabled', false);
} else {
    charCountElement1.css('color', ''); // Reset text color
    charCountElement1.text(`${maximumLength - currentLength}`);
    submitButton1.prop('disabled', false);
}

});

    $('#btn_save_trip').click(function(event) {
        var title = $('#title').val();
        var tripDate = $('#trip_date').val();
        var clientId = $('#client_id').val();
        var driverId = $('#driver_id').val();
        var startPoint = $('#start_address').val();

        // Reset error messages
        $('.error-message text-danger').text('');

        // Check if inputs are empty and display error messages
        if (title === '') {
            $('#title_error').text('*Please enter a title.');
            event.preventDefault(); // Prevent form submission
        }

        if (tripDate === '') {
            $('#trip_date_error').text('*Please enter a trip date.');
            event.preventDefault(); // Prevent form submission
        }

        if (clientId === null) { // Modified condition to check if client is not selected
            $('#client_id_error').text('*Please select a client.');
            event.preventDefault(); // Prevent form submission
        }

        if (driverId === null) { // Modified condition to check if driver is not selected
            $('#driver_id_error').text('*Please select a driver.');
            event.preventDefault(); // Prevent form submission
        }
    });
     // Hide error messages on input change
     $('#title').on('input', function() {
        $('#title_error').text('');
    });

    $('#trip_date').on('input', function() {
        $('#trip_date_error').text('');
    });

    $('#client_id').on('input', function() {
        $('#client_id_error').text('');
    });

    $('#driver_id').on('change', function() { // Updated event name to 'input'
        $('#driver_id_error').text('');
    });
});

function addAddress_map() {
    // Set the initial location
    var initialLocation = {
        lat: 0,
        lng: 0
    };

    // Create the map
    var map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 12
    });

    // Initialize the marker variable
    var marker = null;

    // Check if there is an address in the input field
    var inputAddress = $('#addressTile').val();

    if (inputAddress.trim() !== '') {
        // If there is an address in the input field, geocode and show that location
        geocodeAddress(inputAddress);
    } else {
        // If the input is empty, get the user's current location
        getUserLocation();
    }

    // Add a click event listener to the map
    map.addListener('click', function (event) {
        // Retrieve the clicked coordinates
        var clickedLocation = event.latLng;

        // Perform geocoding to get the value of the location
        geocodeLatLng(clickedLocation);

        // Remove previous marker, if any
        if (marker) {
            marker.setMap(null);
        }

        // Create a new marker at the clicked location
        marker = new google.maps.Marker({
            position: clickedLocation,
            map: map,
            title: 'Selected Location'
        });

        // Update the address input field with the selected location's address
        updateAddressField(clickedLocation);
    });

    function geocodeAddress(address) {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status === 'OK' && results[0]) {
                var location = results[0].geometry.location;

                // Center the map on the geocoded location
                map.setCenter(location);

                // Create a marker at the geocoded location
                marker = new google.maps.Marker({
                    map: map,
                    position: location,
                    title: 'Selected Location'
                });
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Center the map on the user's location
                map.setCenter(userLocation);

                // Create a marker at the user's location
                marker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: 'Your Location'
                });

                // Update the address input field with the user's current address
                geocodeLatLng(userLocation);
            }, function () {
                console.log('Error: The Geolocation service failed.');
            });
        } else {
            console.log('Error: Your browser doesn\'t support geolocation.');
        }
    }

    function geocodeLatLng(location) {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({
            'location': location
        }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    var address = results[0].formatted_address;
                    $('#addressTile').val(address);
                    console.log('Selected location:', address);
                } else {
                    console.log('No results found');
                }
            } else {
                console.log('Geocoder failed due to: ' + status);
            }
        });
    }

    function updateAddressField(location) {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({
            'location': location
        }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    var address = results[0].formatted_address;
                    $('#addressTile').val(address);
                    console.log('Selected location:', address);
                } else {
                    console.log('No results found');
                }
            } else {
                console.log('Geocoder failed due to: ' + status);
            }
        });
    }
}



    function getDrivers(clientId) {
        $.ajax({
            url: '/get_drivers/' + clientId,
            type: 'GET',
            success: function(response) {
                var drivers = response;

                var options = '';
                drivers.forEach(function(driver) {
                    options += '<option value="' + driver.id + '">' + driver.name + '</option>';
                });
                if (options) {
                    $('#driver_id_error').text('');
                    $('#driver_id').html(options);
                }else{
                    $('#driver_id_error').text('*Client do not have any driver.');
                    $('#driver_id').html('');
                }

            },
            error: function(xhr, status, error) {
                // Handle the error
            }
        });
    }
</script>
<script>
    $(document).on('click', '.btnView-address', function() {
    // Get the address from the second column of the clicked table row
    var address = $(this).closest('tr').find('.address-name').text().trim();
    
    // Call the viewAddress_map function with the retrieved address
    viewAddress_map(address);

    });

    function viewAddress_map(address) {
  // Show the spinner
  $('#map_spinner').show();
  $('#view_map').removeClass('.d-view_map');

  // Create the map
  var map = new google.maps.Map(document.getElementById('view_map'), {
    zoom: 12, // Set a default zoom level
  });

  // Create a geocoder instance
  var geocoder = new google.maps.Geocoder();

  // Geocode the provided address
  geocoder.geocode({ address: address }, function (results, status) {
    if (status === 'OK') {
      // Get the location coordinates
      var location = results[0].geometry.location;

      // Define a custom zoom level lookup table
      var zoomLevels = {
        country: 6,
        administrative_area_level_1: 8,
        administrative_area_level_2: 10,
        locality: 12,
      };

      // Calculate the zoom level based on the address type
      var zoomLevel = 14; // Default zoom level
      for (var i = 0; i < results[0].address_components.length; i++) {
        var component = results[0].address_components[i];
        if (component.types[0] in zoomLevels) {
          zoomLevel = zoomLevels[component.types[0]];
          break;
        }
      }

      // Center the map on the location with the calculated zoom level
      map.setCenter(location);
      map.setZoom(zoomLevel);

      // Create a marker at the location
      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Selected Location',
        draggable: false, // Disable dragging
      });

      // Hide the spinner once the map is loaded
      $('#map_spinner').hide();
      $('#view_map').addClass('.d-view_map');
    } else {
      console.log('Geocoder failed due to: ' + status);

      // Hide the spinner if there's an error
      $('#map_spinner').hide();
      $('#view_map').addClass('.d-view_map');
    }
  });
}



$('#addAddressModal').on('hidden.bs.modal', function () {
  alert('Working'); // Just for testing purposes
  let form = $('#address-form'); // Fixed the typo here
  form[0].reset();
});


</script>

@endsection