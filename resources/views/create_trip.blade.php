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
                        <span>{{ ($duplicate_trip ?? '' ==1) ? 'Duplicate Trip' : ((isset($data['id'])) ? 'Update Trip' : 'Create Trip') }}</span>
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
                                    <label for="client_id">@lang('lang.clients') </label>
                                    <select required name="client_id" id="client_id" class="form-select" onchange="getDrivers(this.value)">
                                        <option disabled selected>@lang('lang.select_client') </option>
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
                                <label for="driver_id">@lang('lang.drivers')</label>
                                <select required name="driver_id" id="driver_id" class="form-select">
                                    <option disabled selected>@lang('lang.select_driver')</option>
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
                                <label for="trip_desc">@lang('lang.trip_description')</label>
                                <textarea name="desc" id="trip_desc" class="form-control" placeholder="@lang('lang.trip_description')">{{ $data['desc'] ?? '' }}</textarea>
                                <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">250</span> /250</p>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <label for="start_address">@lang('lang.start_point')</label>
                                <select required name="start_point" id="start_address" class="form-select">
                                    @if(isset($data['start_point']) && $data['start_point'] != '')
                                    <option value="{{ $data['start_point'] }}" selected>{{ $data['start_point'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <label for="end_address">@lang('lang.end_point')</label>
                                <select name="end_point" id="end_address" class="form-select">
                                    @if(isset($data['end_point']) && $data['end_point'] != '')
                                    <option value="{{ $data['end_point'] }}" selected>{{ $data['end_point'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-lg-4 mt-4">
                                <div class="row pt-2">
                                    <div class="col-lg-6 mb-2">
                                        <button id="btn-add-newAddress" type="button"  class="btn btn-sm text-white" style="background-color: #E45F00; padding: 6px 12px 6px 12px; width: 100%;"><span>@lang('lang.add_new_address')</span></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="importAddress" class="custom-button pt-1 mb-0">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22.8 14.4C22.4817 14.4 22.1765 14.5264 21.9515 14.7515C21.7264 14.9765 21.6 15.2817 21.6 15.6V20.4C21.6 20.7183 21.4736 21.0235 21.2485 21.2485C21.0235 21.4736 20.7183 21.6 20.4 21.6H3.6C3.28174 21.6 2.97652 21.4736 2.75147 21.2485C2.52643 21.0235 2.4 20.7183 2.4 20.4V15.6C2.4 15.2817 2.27357 14.9765 2.04853 14.7515C1.82348 14.5264 1.51826 14.4 1.2 14.4C0.88174 14.4 0.576515 14.5264 0.351472 14.7515C0.126428 14.9765 0 15.2817 0 15.6V20.4C0 21.3548 0.379285 22.2705 1.05442 22.9456C1.72955 23.6207 2.64522 24 3.6 24H20.4C21.3548 24 22.2705 23.6207 22.9456 22.9456C23.6207 22.2705 24 21.3548 24 20.4V15.6C24 15.2817 23.8736 14.9765 23.6485 14.7515C23.4235 14.5264 23.1183 14.4 22.8 14.4ZM11.148 16.452C11.2621 16.5612 11.3967 16.6469 11.544 16.704C11.6876 16.7675 11.843 16.8003 12 16.8003C12.157 16.8003 12.3124 16.7675 12.456 16.704C12.6033 16.6469 12.7379 16.5612 12.852 16.452L17.652 11.652C17.878 11.426 18.0049 11.1196 18.0049 10.8C18.0049 10.4804 17.878 10.174 17.652 9.948C17.426 9.72204 17.1196 9.59509 16.8 9.59509C16.4804 9.59509 16.174 9.72204 15.948 9.948L13.2 12.708V1.2C13.2 0.88174 13.0736 0.576515 12.8485 0.351472C12.6235 0.126428 12.3183 0 12 0C11.6817 0 11.3765 0.126428 11.1515 0.351472C10.9264 0.576515 10.8 0.88174 10.8 1.2V12.708L8.052 9.948C7.94011 9.83611 7.80729 9.74736 7.6611 9.68681C7.51491 9.62626 7.35823 9.59509 7.2 9.59509C7.04177 9.59509 6.88509 9.62626 6.7389 9.68681C6.59271 9.74736 6.45989 9.83611 6.348 9.948C6.23611 10.0599 6.14736 10.1927 6.08681 10.3389C6.02626 10.4851 5.99509 10.6418 5.99509 10.8C5.99509 10.9582 6.02626 11.1149 6.08681 11.2611C6.14736 11.4073 6.23611 11.5401 6.348 11.652L11.148 16.452Z" fill="white" />
                                            </svg>
                                            <span>@lang('lang.import')</span>
                                        </label>
                                        <input type="file" id="importAddress" multiple size="50" style="display: none;">
                                        <p class="float-right mr-3" style="font-size: smaller;"><a href="{{ asset('storage/excel_files/template_for_scooble.xlsx') }}" download="template_for_scooble.xlsx">@lang('lang.download_sample')!</a></p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- table of address -->
                        <div class="table-responsive py-2">
                            <table id="table_address" class="table text-center">
                                <thead style="background-color: #E9EAEF;">
                                    <tr>
                                        <th></th>
                                        <th>@lang('lang.address')</th>
                                        <th>@lang('lang.description')</th>
                                        <th>@lang('lang.picture')</th>
                                        <th>@lang('lang.signature')</th>
                                        <th>@lang('lang.note')</th>
                                        <th>@lang('lang.validation')</th>
                                        <th>@lang('lang.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data['addresses'])
                                    @foreach($data['addresses'] as $address)
                                    <tr>
                                        <td class="draggable-row first-column">
                                            <div class="d-none">{{ ($duplicate_trip ==1) ? '' : ((isset($address['id'])) ? $address['id'] : '') }}</div>
                                            <svg width="30" height="40" viewBox="0 0 25 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="19" cy="6" r="5.5" stroke="#230B34" />
                                                <circle cx="1.875" cy="2.25" r="1.25" fill="#9FA2B4" />
                                                <circle cx="5.625" cy="2.25" r="1.25" fill="#9FA2B4" />
                                                <circle cx="1.875" cy="6" r="1.25" fill="#9FA2B4" />
                                                <circle cx="5.625" cy="6" r="1.25" fill="#9FA2B4" />
                                                <circle cx="1.875" cy="9.75" r="1.25" fill="#9FA2B4" />
                                                <circle cx="5.625" cy="9.75" r="1.25" fill="#9FA2B4" />
                                            </svg>
                                        </td>
                                        <td class="address-name text-wrap my-auto">{{ $address['title'] }}</td>
                                        <td class="text-wrap">{{ $address['desc'] }}</td>
                                        <td>
                                            <input type="checkbox" name="picture" {{ $address['trip_pic'] ? 'checked' : '' }} id="picture">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="signature" {{ $address['trip_signature'] ? 'checked' : '' }} id="signature">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="note" {{ $address['trip_note'] ? 'checked' : '' }} id="note">
                                        </td>
                                        <td>
                                            <div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 24px; padding-right: 23px; background-color: {{ ($address['status'] == 'Valid') ? '#31A6132E' : '#F3E8E9' }}; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                                                <div style="text-align: center; color: {{ ($address['status'] == 'Valid') ? '#31A613' :     '#D11A2A' }}; font-size: 14px; font-weight: 500; word-wrap: break-word">{{ $address['status'] }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn p-0 edit-icon" id="{{$address['id']}}">
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#452C88" />
                                                </svg>
                                            </button>
                                            <button type="button" class="btn p-0 delete-row">
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.491 13.743C23.7361 13.743 23.9401 13.9465 23.9401 14.2054V14.4448C23.9401 14.6975 23.7361 14.9072 23.491 14.9072H13.0498C12.8041 14.9072 12.6001 14.6975 12.6001 14.4448V14.2054C12.6001 13.9465 12.8041 13.743 13.0498 13.743H14.8867C15.2599 13.743 15.5846 13.4778 15.6685 13.1036L15.7647 12.6739C15.9142 12.0887 16.4062 11.7 16.9693 11.7H19.5709C20.1278 11.7 20.6253 12.0887 20.7693 12.6431L20.8723 13.1029C20.9556 13.4778 21.2803 13.743 21.6541 13.743H23.491ZM22.5578 22.4943C22.7496 20.707 23.0853 16.4609 23.0853 16.418C23.0976 16.2883 23.0553 16.1654 22.9714 16.0665C22.8813 15.9739 22.7673 15.9191 22.6417 15.9191H13.9033C13.7771 15.9191 13.657 15.9739 13.5737 16.0665C13.4891 16.1654 13.4474 16.2883 13.4536 16.418C13.4547 16.4259 13.4667 16.5755 13.4869 16.8255C13.5764 17.9364 13.8256 21.0303 13.9866 22.4943C14.1006 23.5729 14.8083 24.2507 15.8333 24.2753C16.6243 24.2936 17.4392 24.2999 18.2725 24.2999C19.0574 24.2999 19.8545 24.2936 20.67 24.2753C21.7306 24.257 22.4377 23.5911 22.5578 22.4943Z" fill="#D11A2A" />
                                                </svg>
                                            </button>
                                            <button type="button"  class=" btn btnView-address  p-0" data-toggle="modal" data-target="#viewlocation" >
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <circle opacity="0.1" cx="18" cy="18" r="18" fill="#E45F00" />
                                                    <rect x="12" y="12" width="12" height="12" fill="url(#pattern0)" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                            <use xlink:href="#image0_360_2649" transform="scale(0.00195312)" />
                                                        </pattern>
                                                        <image id="image0_360_2649" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAFFmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDYwLCAyMDIwLzA1LzEyLTE2OjA0OjE3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMiAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTAzLTI3VDEyOjQwOjAyKzA1OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wMy0yN1QxMjo0MzoxNSswNTowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpmYmMzMWNhOS01MjQzLTM4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" />
                                                    </defs>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>

                            </table>
                            <div class="col-lg-4 float-right text-right">
                                <button type="submit" id="btn_save_trip" class="btn text-white" style="background-color: rgb(35, 58, 133); width: 100%; border-radius: 8px;">
                                <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.save_trip')</span>
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