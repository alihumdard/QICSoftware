@extends('layouts.main')

@section('main-section')

    <style>

        .draggablecards {
            cursor: grab;
        }

        .draggablecards.dragging {
            /* opacity: 0.9; */
        }

        .droppable {
            background-color: lightgray;
        }

        .draggablecards:hover {
            /* background-color: gray; */
        }

        #map {
                height: 100%;
                width: 100%;
            }

        .file-input {
            position: relative;
            display: inline-block;
        }

        .file-input input[type="file"] {
        position: absolute;
        left: -9999px;
        }

        .camera-icon {
        display: inline-block;
        width: 24px;
        height: 24px;
        background-size: cover;
        vertical-align: middle;
        margin-right: 5px;
        }

        .upload-text {
        display: inline-block;
        vertical-align: middle;
        }

        .opacity-60 {
            opacity: 0.6;
        }

        .navy-border {
            border: 1px solid navy;
        }

        .zoom-in {
            animation: zoomIn 0.5s ease;
        }

        @keyframes zoomIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        #snackbar {
            visibility: hidden; /* Hidden by default. Visible on click */
            min-width: 250px; /* Set a default minimum width */
            margin-left: -125px; /* Divide value of min-width by 2 */
            background-color: #28a745;
            color: #fff; /* White text color */
            text-align: center; /* Centered text */
            border-radius: 2px; /* Rounded borders */
            padding: 16px; /* Padding */
            position: fixed; /* Sit on top of the screen */
            z-index: 1; /* Add a z-index if needed */
            left: 50%; /* Center the snackbar */
            bottom: 30px; /* 30px from the bottom */
        }

        #snackbar.show {
            visibility: visible; /* Show the snackbar */
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    .no-drag {
        user-drag: none;
        user-select: none;
    }


    </style>
@php
    $tripStatus = config('constants.TRIP_STATUS');
    $tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());

    $addressStatus = config('constants.ADDRESS_STATUS');
    $adrsStatus_trans = config('constants.ADDRESS_STATUS_' . app()->getLocale());
    $currentDate = strtotime('today');
    $tripDate = strtotime($data['trip_date']);
    $remainingDays = ($tripDate - $currentDate) / (60 * 60 * 24);
@endphp
<!-- partial -->
    <div class="content-wrapper py-0 my-2">
        <div class="container-fluid px-0">
            <div class="bg-white p-3" style="border-radius: 20px;">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                        <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.14286 0C12.9257 0 16 3.04 16 6.8C16 11.8971 9.14286 19.4286 9.14286 19.4286C9.14286 19.4286 2.28571 11.8971 2.28571 6.8C2.28571 3.04 5.36 0 9.14286 0ZM9.14286 4.57143C8.53665 4.57143 7.95527 4.81224 7.52661 5.2409C7.09796 5.66955 6.85714 6.25093 6.85714 6.85714C6.85714 7.15731 6.91626 7.45453 7.03113 7.73185C7.146 8.00916 7.31437 8.26114 7.52661 8.47339C7.95527 8.90204 8.53665 9.14286 9.14286 9.14286C9.74907 9.14286 10.3304 8.90204 10.7591 8.47339C11.1878 8.04473 11.4286 7.46335 11.4286 6.85714C11.4286 6.25093 11.1878 5.66955 10.7591 5.2409C10.3304 4.81224 9.74907 4.57143 9.14286 4.57143ZM18.2857 19.4286C18.2857 21.9543 14.1943 24 9.14286 24C4.09143 24 0 21.9543 0 19.4286C0 17.9543 1.39429 16.64 3.55429 15.8057L4.28571 16.8457C3.05143 17.36 2.28571 18.0686 2.28571 18.8571C2.28571 20.4343 5.36 21.7143 9.14286 21.7143C12.9257 21.7143 16 20.4343 16 18.8571C16 18.0686 15.2343 17.36 14 16.8457L14.7314 15.8057C16.8914 16.64 18.2857 17.9543 18.2857 19.4286Z" fill="white" />
                        </svg>
                    </span>
                    <span>@lang('lang.map')</span>
                </h3>
                <div id="trip_start_end" class="row my-0">
                    <div class="col-lg-3">
                        <span style="color: #ACADAE; font-size: smaller;">@lang('lang.today'): </span> <span> {{ date('d F, Y') }}</span>
                    </div>
                        @if($data['status'] != $tripStatus['Completed'])
                            <div class="col-lg-9 mb-2 text-right" id ="btn-trip_manage">
                            @if($data['status'] == $tripStatus['Pending'])
                                <button id="btn_start-trip" class="btn text-white  btn-info btn-md" data-toggle="modal" data-target="#starttripmodal" style=" background-color: #0F771A;"><span>@lang('lang.start_trip')</span></button>
                            @elseif($data['trip_date'] && $data['status'] == $tripStatus['In Progress'])
                                <button id="btn_started-trip" style="background-color: #0F771A; opacity: 0.5;" disabled class="btn text-white btn-md"><span>@lang('lang.trip_started')</span></button>
                            @endif   
                                <button id="btn-end_trip" class="btn btn-md text-white" style="background-color: #233A85;" ><span>@lang('lang.end_trip')</span></button>
                            </div>
                        @else
                        <div class="col-lg-9 mb-2 text-right">
                        <button class="btn btn-md text-white" style="background-color: #233A85;"><span>@lang('lang.trip_completed')</span></button>
                        </div>
                        @endif
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-12">
                        <div class="text-center">
                            <h5>@lang('lang.trips') / @lang('lang.routes')</h5>
                        </div>
                        <hr class="my-0">
                        <div class="mb-2 mx-3">
                            <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="0.715942" width="10.4583" height="10.4583" rx="2" fill="#E45F00" />
                            </svg>
                            <span>{{ $data['title'] ?? ''}}</span>
                        </div>

                        <div style="overflow-y: auto; height: 200px; position: relative">
                            <div class="px-1 text-center" style="font-size: small; position: relative;" id="address-container">
                                @isset($data['addresses'])
                                @foreach($data['addresses'] as $address)
                                    <div id="address_card_{{$address['id']}}" class="draggable {{($data['trip_date'] && $data['status'] == $tripStatus['Pending']) ? 'draggablecards' : '' }} {{($address['address_status']==4) ? 'opacity-50' : ''}}">
                                    <input type="hidden" data-address-status="{{$address['address_status']}}" data-address-desc ="{{ $address['desc'] ?? ''}}" data-address-title="{{ $address['title'] }}" data-trip-pic="{{$address['trip_pic']}}" data-trip-signature="{{$address['trip_signature']}}" data-trip-note="{{$address['trip_note']}}">
                                    <div class="card bg-white" style="  position: relative;border-radius: 10px; border: none; box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);" draggable="true">
                                            <div class="card-body py-1 px-1">
                                                <div class="d-flex justify-content-between border-bottom">
                                                    <p style="color: #ACADAE; font-size: smaller;">{{ date('d F, Y', strtotime($data['trip_date']))}}</p>
                                                    <div style="position: absolute; display:flex; justify-content:center; width:100%; left:-0% ">
                                                    <svg width="10" height="10"  viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="4" cy="4" r="4" fill="#233A85" />
                                                    </svg>
                                                    </div>
                                                    <div style="margin-left: 40%;">
                                                    <span id="span_address_status" style="color: #233A85; font-size: smaller; font-weight: 600;">{{ $adrsStatus_trans[$address['address_status']] }}</span>
                                                    </div>
                                                    <svg id="svg_skip_address" class="{{ ($address['address_status'] == 1 ||$address['address_status'] == 2) ? 'skip_address' : ''}}" data-address_id="{{$address['id']}}" style="cursor: pointer !important;" class="pt-1"  width="17" height="20" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.14076 4.76329C2.28309 -0.258295 9.72273 -0.252496 10.8593 4.76909C11.5261 7.71478 9.69373 10.2082 8.08752 11.7506C6.922 12.8755 5.07805 12.8755 3.9067 11.7506C2.30628 10.2082 0.473925 7.70898 1.14076 4.76329Z" stroke="#5D626B" stroke-width="1" stroke-opacity="0.3" />
                                                        <path d="M7.16002 7.35533L4.86377 5.05908" stroke="#5D626B" stroke-width="1" stroke-opacity="0.3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M7.13658 5.08228L4.84033 7.3785" stroke="#5D626B" stroke-width="1" stroke-opacity="0.3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <div >
                                                    <span id="span_address_title" style="font-size: small;">{{ $address['title'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0" style="font-size: larger; color: #452C88;">|</p>
                                    </div>
                                @endforeach

                                @endisset
                            </div>
                        </div>
                      @if($data['trip_date'] && $data['status'] == $tripStatus['Pending'])
                        <div class="mt-1 text-right">
                            <button id="btn-update_address" class="btn btn-sm text-white" data-toggle="modal" data-target="#updatemodal" style="background-color: #233A85;"><span>@lang('lang.update')</span></button>
                            <button id="btn-optimize_address" class="btn btn-sm text-white" data-toggle="modal" data-target="#optimizemodal"  style="background-color: #233A85;"><span>@lang('lang.optimize')</span></button>
                        </div>
                       @endif
                        <hr class="my-1">

                        <div class="card" id="card_way_point" style="border-radius: 20px;">
                            <div class="card-header text-center text-white" style="border-radius: 12px 12px 0px 0px; background: linear-gradient(180deg, #452C88 0%, #6A53A4 100%);">
                                <h6><span>@lang('lang.active_waypoint')</span></h6>
                            </div>
                            <div class="card-body px-2 py-0">
                                <p id="way_point_title" class="mb-1 text-center" style="font-size: small;"></p>
                                <textarea name="desc" id="text_address-desc" class="form-control" rows="" disabled></textarea>
                                <div>
                                    <div id="pic_required" >
                                        <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.53111 3.9191L3.93818 3L5.53111 2.0809C5.62087 2.0291 5.65158 1.91449 5.59978 1.82473L5.22454 1.17516C5.17275 1.08551 5.05802 1.05469 4.96825 1.10648L3.37532 2.02559V0.1875C3.37532 0.0839062 3.2913 0 3.18771 0H2.43724C2.33365 0 2.24962 0.0839062 2.24962 0.1875V2.0257L0.656692 1.1066C0.566926 1.0548 0.4522 1.08563 0.400403 1.17527L0.0251685 1.82473C-0.0266283 1.91438 0.00407479 2.0291 0.0938404 2.0809L1.68677 3L0.0938404 3.9191C0.00407479 3.9709 -0.0266283 4.08563 0.0251685 4.17527L0.400403 4.82484C0.4522 4.91449 0.566926 4.9452 0.656692 4.89352L2.24962 3.97441V5.8125C2.24962 5.91609 2.33365 6 2.43724 6H3.18771C3.2913 6 3.37532 5.91609 3.37532 5.8125V3.9743L4.96825 4.8934C5.05802 4.9452 5.17275 4.91449 5.22454 4.82473L5.59978 4.17516C5.65158 4.08551 5.62087 3.9709 5.53111 3.9191Z" fill="#D11A2A" />
                                        </svg>
                                        <span style="font-size: small;">@lang('lang.picture_required')</span>
                                    </div>
                                    <div id="signature_required">
                                        <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.53111 3.9191L3.93818 3L5.53111 2.0809C5.62087 2.0291 5.65158 1.91449 5.59978 1.82473L5.22454 1.17516C5.17275 1.08551 5.05802 1.05469 4.96825 1.10648L3.37532 2.02559V0.1875C3.37532 0.0839062 3.2913 0 3.18771 0H2.43724C2.33365 0 2.24962 0.0839062 2.24962 0.1875V2.0257L0.656692 1.1066C0.566926 1.0548 0.4522 1.08563 0.400403 1.17527L0.0251685 1.82473C-0.0266283 1.91438 0.00407479 2.0291 0.0938404 2.0809L1.68677 3L0.0938404 3.9191C0.00407479 3.9709 -0.0266283 4.08563 0.0251685 4.17527L0.400403 4.82484C0.4522 4.91449 0.566926 4.9452 0.656692 4.89352L2.24962 3.97441V5.8125C2.24962 5.91609 2.33365 6 2.43724 6H3.18771C3.2913 6 3.37532 5.91609 3.37532 5.8125V3.9743L4.96825 4.8934C5.05802 4.9452 5.17275 4.91449 5.22454 4.82473L5.59978 4.17516C5.65158 4.08551 5.62087 3.9709 5.53111 3.9191Z" fill="#D11A2A" />
                                        </svg>
                                        <span  style="font-size: small;">@lang('lang.signature_required')</span>
                                    </div>
                                    <div id="note_required">
                                        <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.53111 3.9191L3.93818 3L5.53111 2.0809C5.62087 2.0291 5.65158 1.91449 5.59978 1.82473L5.22454 1.17516C5.17275 1.08551 5.05802 1.05469 4.96825 1.10648L3.37532 2.02559V0.1875C3.37532 0.0839062 3.2913 0 3.18771 0H2.43724C2.33365 0 2.24962 0.0839062 2.24962 0.1875V2.0257L0.656692 1.1066C0.566926 1.0548 0.4522 1.08563 0.400403 1.17527L0.0251685 1.82473C-0.0266283 1.91438 0.00407479 2.0291 0.0938404 2.0809L1.68677 3L0.0938404 3.9191C0.00407479 3.9709 -0.0266283 4.08563 0.0251685 4.17527L0.400403 4.82484C0.4522 4.91449 0.566926 4.9452 0.656692 4.89352L2.24962 3.97441V5.8125C2.24962 5.91609 2.33365 6 2.43724 6H3.18771C3.2913 6 3.37532 5.91609 3.37532 5.8125V3.9743L4.96825 4.8934C5.05802 4.9452 5.17275 4.91449 5.22454 4.82473L5.59978 4.17516C5.65158 4.08551 5.62087 3.9709 5.53111 3.9191Z" fill="#D11A2A" />
                                        </svg>
                                        <span  style="font-size: small;">@lang('lang.note_required')</span>
                                    </div>
                                </div>
                                <div class="text-right mt-1">
                                    <button id="show-map-button" class="btn p-0 btn-sm">
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7941 24.7919C17.7943 24.7919 17.7944 24.792 18 24.5L17.7941 24.7919ZM18.2059 24.7919L18.2071 24.7909L18.2104 24.7886L18.2217 24.7805C18.2315 24.7735 18.2455 24.7634 18.2635 24.7501C18.2995 24.7237 18.3515 24.6849 18.4172 24.6345C18.5485 24.5335 18.7347 24.3855 18.9575 24.195C19.4028 23.8143 19.9967 23.2617 20.5916 22.5735C21.7728 21.2071 23 19.257 23 17.0275C23 15.6948 22.4737 14.4162 21.5363 13.4733C20.5988 12.5302 19.3268 12 18 12C16.6733 12 15.4013 12.5302 14.4637 13.4733C13.5263 14.4162 13 15.6948 13 17.0275C13 19.257 14.2272 21.2071 15.4084 22.5735C16.0033 23.2617 16.5972 23.8143 17.0425 24.195C17.2653 24.3855 17.4515 24.5335 17.5828 24.6345C17.6485 24.6849 17.7005 24.7237 17.7365 24.7501C17.7545 24.7634 17.7685 24.7735 17.7783 24.7805L17.7896 24.7886L17.7929 24.7909L17.7941 24.7919C17.9175 24.8787 18.0825 24.8787 18.2059 24.7919ZM18 24.5L18.2059 24.7919C18.2057 24.7919 18.2056 24.792 18 24.5ZM19.7857 17C19.7857 17.9862 18.9862 18.7857 18 18.7857C17.0138 18.7857 16.2143 17.9862 16.2143 17C16.2143 16.0138 17.0138 15.2143 18 15.2143C18.9862 15.2143 19.7857 16.0138 19.7857 17Z" fill="#452C88" />
                                        </svg>
                                    </button>
                                    <button id="btn-waypoint_details" data-address_id="" class="btn d-none p-0 btn-sm" data-toggle="modal" data-target="#picsignnotemodal">
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
                                            <path d="M22.7679 16.7143H18.9107V12.8571C18.9107 12.3838 18.5269 12 18.0536 12H17.1964C16.7231 12 16.3393 12.3838 16.3393 12.8571V16.7143H12.4821C12.0088 16.7143 11.625 17.0981 11.625 17.5714V18.4286C11.625 18.9019 12.0088 19.2857 12.4821 19.2857H16.3393V23.1429C16.3393 23.6162 16.7231 24 17.1964 24H18.0536C18.5269 24 18.9107 23.6162 18.9107 23.1429V19.2857H22.7679C23.2412 19.2857 23.625 18.9019 23.625 18.4286V17.5714C23.625 17.0981 23.2412 16.7143 22.7679 16.7143Z" fill="#E45F00" />
                                        </svg>
                                    </button>
                                    <button id="btn-next_waypoint"  data-address_id="" class="btn  d-none p-0 btn-sm">
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#109CF1" fill-opacity="0.3" />
                                            <path d="M18.4808 18.6373L13.3824 23.7357C13.03 24.0881 12.4602 24.0881 12.1115 23.7357L11.2643 22.8885C10.9119 22.5361 10.9119 21.9663 11.2643 21.6176L14.8782 18.0037L11.2643 14.3899C10.9119 14.0375 10.9119 13.4677 11.2643 13.119L12.1078 12.2643C12.4602 11.9119 13.03 11.9119 13.3786 12.2643L18.477 17.3627C18.8332 17.7151 18.8332 18.2849 18.4808 18.6373ZM25.6785 17.3627L20.5801 12.2643C20.2277 11.9119 19.6579 11.9119 19.3093 12.2643L18.462 13.1115C18.1097 13.4639 18.1097 14.0337 18.462 14.3824L22.0759 17.9963L18.462 21.6101C18.1097 21.9625 18.1097 22.5323 18.462 22.881L19.3093 23.7282C19.6617 24.0806 20.2315 24.0806 20.5801 23.7282L25.6785 18.6298C26.0309 18.2849 26.0309 17.7151 25.6785 17.3627Z" fill="#109CF1" fill-opacity="0.3" />
                                        </svg>
                                    </button>
                                    <button id="btn-complete_waypoint" data-address_id=""  class="btn d-none p-0 btn-sm">
                                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#31A613" fill-opacity="0.3" />
                                            <path d="M23.0507 12.2332C22.1581 11.7366 21.0338 12.0597 20.54 12.9504L17.1126 19.1183L15.1511 17.1568C14.4302 16.4359 13.2616 16.4359 12.5407 17.1568C11.8198 17.8777 11.8198 19.0463 12.5407 19.7672L16.2329 23.4595C16.5819 23.8093 17.0526 24.0013 17.5382 24.0013L17.7938 23.9829C18.3671 23.9026 18.8701 23.5583 19.1517 23.0515L23.767 14.7439C24.2627 13.8523 23.9414 12.7289 23.0507 12.2332Z" fill="#31A613" fill-opacity="0.3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-8 col-12">
                        <div id="map" class="d-none d-lg-block d-sm-block">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Tripend  start-->
    <div class="modal fade" id="tripend" tabindex="-1" role="dialog" aria-labelledby="updatemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header pb-0" style="border-bottom: none;">
            <button type="button" id="btn_endrtrip-close" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body px-5 pb-5 pt-0">
                <p style="font-size: larger;">@lang('lang.are_you_sure_to_end_the_trip')?</p>
                <div class="row mt-3">
                    <div class="col-lg-6 mb-2">
                        <button data-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                    <div class="col-lg-6">
                        <form class="status_update"  id="form_statusUpdate" action="updateTrip_status" method="POST" >
                                <input type="hidden" name="id" value="{{$data['id'] ?? ''}}">
                                <input type="hidden" name="status" value="{{$tripStatus['Completed'] ?? ''}}">
                                <button  class="btn btn-sm btn_statusUpdate px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                                <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                                </button>
                        </form> 
                    </div>
                </div>
        </div>
        </div>
    </div>
    </div>
    <!-- Trip-End  end-->

    
    <!-- UpdateModal start -->
    <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="updatemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header pb-0" style="border-bottom: none;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body px-5 pb-5 pt-0">
                <p style="font-size: larger;">@lang('lang.you_want_to_update_route')?</p>
                <div class="row mt-3">
                    <div class="col-lg-6 mb-2">
                        <button data-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                    
                    <div class="col-lg-6">
                        <button id="btn_addressUpdate"  class="btn btn-sm btn_addressUpdate px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                            <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                        </button>
                    </div>
                </div>
        </div>
        </div>
    </div>
    </div>
    <!-- UpdateModal end-->

    <!-- optimizemodal start-->
    <div class="modal fade" id="optimizemodal" tabindex="-1" role="dialog" aria-labelledby="optimizemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header pb-0" style="border-bottom: none;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body px-5 pb-5 pt-0">
                <p style="font-size: larger;">@lang('lang.really_want_to_optimize')?</p>
                <div class="row mt-3">
                    <div class="col-lg-6 mb-2">
                        <button data-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                    <div class="col-lg-6">
                    <button id="btn_optimize_addresses" class="btn btn-sm px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">@lang('lang.yes'), @lang('lang.confirm')</button>
                    </div>
                </div>
        </div>
        </div>
    </div>
    </div>
    <!-- optimizemodal end-->

        <!-- starttripmodal start-->
    <div class="modal fade" id="starttripmodal" tabindex="-1" role="dialog" aria-labelledby="starttripmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header pb-0" style="border-bottom: none;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body px-5 pb-5 pt-0">
        @if ($remainingDays > 0)
            <h4 style="font-size: larger;">@lang('lang.you_cannot_start_the_trip_now').</h5>
            <p>@lang('lang.there') {{ $remainingDays }} {{ $remainingDays == 1 ? 'day' : 'days' }} @lang('lang.remaining_until_the_trip').</p>
                <div class="row mt-3">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">   
                    <button data-dismiss="modal" class="btn btn-sm px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">@lang('lang.ok')</button>
                    </div>
                </div>
        @elseif ($remainingDays < 0)
            <h4 style="font-size: larger;">@lang('lang.trip_delayed'): @lang('lang.start_date_passed')</h5>
            <p>@lang('lang.sorry'), @lang('lang.you_cant_start_the_trip_now'). @lang('lang.youre') {{ abs($remainingDays) }} {{ $remainingDays == -1 ? 'day' : 'days' }} @lang('lang.late'). @lang('lang.please_contact_your_owner').</p>
                <div class="row mt-3">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">   
                    <button data-dismiss="modal" class="btn btn-sm px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">@lang('lang.ok')</button>
                    </div>
                </div>       
        @else
                <h4 style="font-size: larger;">@lang('lang.really_want_to_start')?</h4>
                <div class="row mt-3">
                    <div class="col-lg-6 mb-2">
                        <button id="btn_status-close" data-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                    <div class="col-lg-6">
                        <form class="status_update"  id="form_statusUpdate" action="updateTrip_status" method="POST" >
                            <input type="hidden" name="id" value="{{$data['id'] ?? ''}}">
                            <input type="hidden" name="status" value="{{$tripStatus['In Progress'] ?? ''}}">
                            <button  class="btn btn-sm btn_statusUpdate px-5 text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                            </button>
                        </form>    
                </div>
                </div>
        @endif    
        </div>
        </div>
    </div>
    </div>
        <!-- starttripmodal -->

    <!-- skipwaypointmodal start -->
    <div class="modal fade" id="skipwaypointmodal" tabindex="-1" role="dialog" aria-labelledby="skipwaypointmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header pb-0" style="border-bottom: none;">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body px-5 pb-5 pt-0">
                <p style="font-size: larger;">@lang('lang.you_really_want_to_skip_this_waypoint')?</p>
                <form class="status_update"  id="skip_address" action="updateTrip_status" method="POST" >
                    <input type="hidden" name="status" id="address_status" value="{{$addressStatus['Skipped'] ?? ''}}">
                    <input type="hidden" name="id" value="{{$data['id'] ?? ''}}">
                    <input type="hidden" name="address_id" id="address_id">
                    <textarea name="skiped_address_desc" id="skiped_address_desc" cols="" rows="" placeholder="Write reason here..." class="form-control"></textarea>
                    <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">150</span> /150</p>
                    <div id="error_message" style="display: none; color: red;"></div>
                    <div class="row mt-3">
                        <div class="col-lg-6 mb-2">
                        <button type="reset" id="btn_modal-close" data-bs-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                    </div>
                        <div class="col-lg-6">
                        <button  class="btn btn-sm px-5 btn_statusUpdate text-white py-2" id="btn_save" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                        </button>
                        </div>
                    </div>
                </form> 
        </div>
        </div>
    </div>
    </div>
    <!-- skipwaypointmodal End -->

    <!-- completewaypointmodal start -->
    <div class="modal fade" id="completepointmodal" tabindex="-1" role="dialog" aria-labelledby="skipwaypointmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header pb-0" style="border-bottom: none;">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                    <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
                </svg>
                </button>
            </div>
            <div class="modal-body px-5 pb-5 pt-0">
                    <p style="font-size: larger;">@lang('lang.you_have_completed_this_waypoint')?</p>
                    <form class="status_update"  id="complete_address" action="updateTrip_status" method="POST" >
                        <input type="hidden" name="status" id="address_status" value="{{$addressStatus['Completed'] ?? ''}}">
                        <input type="hidden" name="id" value="{{$data['id'] ?? ''}}">
                        <input type="hidden" name="address_id" id="address_id">
                        <div class="row mt-3">
                            <div class="col-lg-6 mb-2">
                            <button type="reset" id="btn_modal-close" data-bs-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                        </div>
                            <div class="col-lg-6">
                            <button  class="btn btn-sm px-5 btn_statusUpdate text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                                <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                            </button>
                            </div>
                        </div>
                    </form> 
            </div>
            </div>
        </div>
    </div>
    <!-- completewaypointmodal End -->

       <!-- nextwaypointmodal start -->
       <div class="modal fade " id="nextpointmodal" tabindex="-1" role="dialog" aria-labelledby="skipwaypointmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header pb-0" style="border-bottom: none;">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                    <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
                </svg>
                </button>
            </div>
            <div class="modal-body px-5 pb-5 pt-0">
                    <p style="font-size: larger;">@lang('lang.you_want_to_move_waypoint')?</p>
                    <form class="status_update"  id="next_address" action="updateTrip_status" method="POST" >
                        <input type="hidden" name="id" value="{{$data['id'] ?? ''}}">
                        <input type="hidden" name="next_waypoint" id="next_waypoint" value="yes">
                        <input type="hidden" name="status" id="address_status" value="{{$addressStatus['On Going'] ?? ''}}">
                        
                        <div class="row mt-3">
                            <div class="col-lg-6 mb-2">
                            <button type="reset" id="btn_modal-close" data-bs-dismiss="modal" class="btn btn-sm btn-outline px-5 py-2" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">@lang('lang.cancel')</button>
                        </div>
                            <div class="col-lg-6">
                            <button  class="btn btn-sm px-5 btn_statusUpdate text-white py-2" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                                <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.yes'), @lang('lang.confirm')</span>
                            </button>
                            </div>
                        </div>
                    </form> 
            </div>
            </div>
        </div>
    </div>
    <!-- completewaypointmodal End -->


        <!-- picsignnotemodal -->
    <div class="modal fade" id="picsignnotemodal" tabindex="-1" role="dialog" aria-labelledby="picsignnotemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md " role="document">
        <div class="modal-content">
        <div class="modal-header pt-1 pb-2 pr-1" style="border-bottom: none;">
            <button type="button" id="btn_complete_add" class="close d-none" data-dismiss="modal" aria-label="Close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
            </svg>
            </button>
        </div>
        <div class="modal-body   pt-0">
                <form   id="complete_waypoint" action="completeWaypoint" method="POST" >
                    <input type="hidden" id="complete_add_id" name="address_id" >
                    <!-- <input type="hidden" name="status"  value="{{ $tripStatus['Completed'] ?? ''}}"> -->
                    <input type="hidden" id="driv_signature" name="driv_signature">
                    <input type="hidden" name="required-fields" id="required-fields" data-trip-pic="0" data-trip-signature="0" data-trip-note="0">
                    <div class="file-input" style="width: 100%;">
                        <label for="file" class="p-5 text-center" style="border-radius: 10px; background-color: #F8F8F8; width: 100%; height:126px !important">
                            <input type="file" id="file" name="address_pic" accept="image/*">
                            <p class="camera-icon">
                                <svg width="42" height="35" viewBox="0 0 42 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2938 5.41268C11.4286 5.22532 11.5783 4.99595 11.7692 4.68667C11.8761 4.51336 12.2664 3.86782 12.3302 3.76348C13.9071 1.18395 15.0534 0 17.1205 0H24.7295C26.7966 0 27.9429 1.18395 29.5198 3.76348C29.5836 3.86782 29.9739 4.51336 30.0808 4.68667C30.2717 4.99595 30.4214 5.22532 30.5562 5.41268C30.645 5.53624 30.7227 5.63442 30.786 5.70682H36.1432C39.295 5.70682 41.85 8.26185 41.85 11.4136V28.5341C41.85 31.6859 39.295 34.2409 36.1432 34.2409H5.70682C2.55503 34.2409 0 31.6859 0 28.5341V11.4136C0 8.26185 2.55503 5.70682 5.70682 5.70682H11.064C11.1273 5.63442 11.205 5.53624 11.2938 5.41268ZM5.70682 9.51136C4.65622 9.51136 3.80455 10.363 3.80455 11.4136V28.5341C3.80455 29.5847 4.65622 30.4364 5.70682 30.4364H36.1432C37.1938 30.4364 38.0455 29.5847 38.0455 28.5341V11.4136C38.0455 10.363 37.1938 9.51136 36.1432 9.51136H30.4364C29.1726 9.51136 28.3203 8.81971 27.4677 7.63431C27.2715 7.36156 27.0771 7.06374 26.8432 6.68476C26.7251 6.49337 26.329 5.83823 26.2738 5.74788C25.4134 4.34046 24.8945 3.80455 24.7295 3.80455H17.1205C16.9555 3.80455 16.4366 4.34046 15.5762 5.74788C15.521 5.83823 15.1249 6.49337 15.0068 6.68476C14.7729 7.06374 14.5785 7.36156 14.3823 7.63431C13.5297 8.81971 12.6774 9.51136 11.4136 9.51136H5.70682ZM34.2409 15.2182C35.2915 15.2182 36.1432 14.3665 36.1432 13.3159C36.1432 12.2653 35.2915 11.4136 34.2409 11.4136C33.1903 11.4136 32.3386 12.2653 32.3386 13.3159C32.3386 14.3665 33.1903 15.2182 34.2409 15.2182ZM20.925 28.5341C15.672 28.5341 11.4136 24.2757 11.4136 19.0227C11.4136 13.7697 15.672 9.51136 20.925 9.51136C26.178 9.51136 30.4364 13.7697 30.4364 19.0227C30.4364 24.2757 26.178 28.5341 20.925 28.5341ZM20.925 24.7295C24.0768 24.7295 26.6318 22.1745 26.6318 19.0227C26.6318 15.8709 24.0768 13.3159 20.925 13.3159C17.7732 13.3159 15.2182 15.8709 15.2182 19.0227C15.2182 22.1745 17.7732 24.7295 20.925 24.7295Z" fill="#D9D9D9"/>
                                </svg>
                            </p>
                            <br>
                            <p class="upload-text" style="color: #D9D9D9;">@lang('lang.upload_image')</p>
                            <p id="selected-file-name"></p>
                            <img id="image-preview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 100px; display: none;">
                        </label>
                    </div>
                    <div  class="d-none" id="error_message_pic" style=" color: red;">* @lang('lang.picture_is_requried') </div>
                    <div id="signature-pad" class="mb-2 rounded-lg" style=" border: 2px solid gray; width: 100%;">
                        <canvas id="driver_signature" style="width: 100%; height: 100%;"></canvas>
                    </div>
                    <div style="width: 100%;">
                        <div class="row mb-2">
                            <div class="col-lg-12" id="signature-div">
                                <button type="button" id="signature-btn" class="btn text-center p-2" style="border-radius: 10px; background-color: #F8F8F8; width: 100%; height:55px !important">
                                    <p class="mt-3 mb-0" style="color: #D9D9D9;">@lang('lang.signature')</p>
                                </button>
                            </div>
                            <div class="col-lg-2 p-0 my-2">
                                <div class="">
                                    <button type="button" class="btn p-2 btn-secondary" style="display: none;" id="clear-btn">
                                        @lang('lang.clear')
                                        <!-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="12" fill="#E5E5E5"/>
                                            <path d="M12 10.8891L15.8891 7L17 8.11094L13.1109 12L17 15.8891L15.8891 17L12 13.1109L8.11094 17L7 15.8891L10.8891 12L7 8.11094L8.11094 7L12 10.8891Z" fill="#4F4F4F"/>
                                        </svg> -->
                                    </button>
                                    <br>
                                    <!-- <button type="button" class="btn p-1" id="save-btn">
                                        <i class="fa fa-download text-secondary"></i>
                                    </button> -->
                                </div>
                            </div>
                        <div class="d-none" id="error_message_sigature" style=" color: red;">* @lang('lang.signature_is_requried') </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="address_note"  id="address_note" placeholder="write note here ...."></textarea>
                        <p id="charCountContainer1" class="text-secondary text-right" style="display: none;"><span id="charCount1">150</span> /150</p>
                        <div class="d-none" id="error_message_note" style=" color: red;"> * @lang('lang.description_is_requried') </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-lg-6 "></div>
                        <div class="col-lg-6 ">
                        <button  class="btn btn-sm  btn_statusUpdate text-white" id="picsignnot-btn" style="background-color: #233A85; border-radius: 8px; width: 100%;">
                            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                <span id="text">@lang('lang.submit')</span>
                        </button>   
                    </div>
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>
        <!-- picsignnotemodal -->
        <!-- toat address update -->
        <div id="snackbar"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            const maxLength = 150;
    const textarea = $('#skiped_address_desc');
    const charCountElement = $('#charCount');
    const charCountContainer = $('#charCountContainer');
    const submitButton = $('#btn_save');

    textarea.on('input', function() {
        const currentLength = textarea.val().length;
        const charCount = Math.max(maxLength - currentLength, 0); // Ensure non-negative count

        charCountElement.text(charCount);

        if (currentLength > 0) {
            charCountContainer.show();
        } else {
            charCountContainer.hide();
        }

        if (currentLength > maxLength) {
            submitButton.prop('disabled', true);
        } else {
            submitButton.prop('disabled', false);
        }
    });

    // Enable textarea when content is deleted after exceeding limit
    textarea.on('keyup', function() {
        const currentLength = textarea.val().length;

        if (currentLength > maxLength) {
            textarea.val(textarea.val().substring(0, maxLength)); // Truncate content
            submitButton.prop('disabled', true);
        } else {
            submitButton.prop('disabled', false);
        }
    });

    const maxLength1 = 150;
    const textarea1 = $('#address_note');
    const charCountElement1 = $('#charCount1');
    const charCountContainer1 = $('#charCountContainer1');
    const submitButton1 = $('#picsignnot-btn');

    textarea1.on('input', function() {
        const currentLength = textarea1.val().length;
        const charCount = Math.max(maxLength1 - currentLength, 0); // Ensure non-negative count

        charCountElement1.text(charCount);

        if (currentLength > 0) {
            charCountContainer1.show();
        } else {
            charCountContainer1.hide();
        }

        if (currentLength > maxLength1) {
            submitButton1.prop('disabled', true);
        } else {
            submitButton1.prop('disabled', false);
        }
    });

    // Enable textarea1 when content is deleted after exceeding limit
    textarea1.on('keyup', function() {
        const currentLength = textarea1.val().length;

        if (currentLength > maxLength1) {
            textarea1.val(textarea1.val().substring(0, maxLength1)); // Truncate content
            submitButton1.prop('disabled', true);
        } else {
            submitButton1.prop('disabled', false);
        }
    });
        });
    </script>
    <script>
        // map and routes creating start here...            
        var dragItem = null;
        var map;

        function handleDragStart(e) {
            dragItem = this;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
            this.classList.add('dragging');
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = 'move';
            this.classList.add('droppable');
            return false;
        }

        function handleDragLeave() {
            this.classList.remove('droppable');
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (dragItem !== this && dragItem.parentNode === this.parentNode) {
                var dragIndex = Array.from(dragItem.parentNode.children).indexOf(dragItem);
                var dropIndex = Array.from(this.parentNode.children).indexOf(this);

                if (dragIndex < dropIndex) {
                this.parentNode.insertBefore(dragItem, this.nextSibling);
                } else {
                this.parentNode.insertBefore(dragItem, this);
                }

                var addressElements = document.querySelectorAll('#address-container .card-body span');
                var addresses = [];
                addressElements.forEach(function (element) {
                addresses.push(element.textContent);
                });

                // generateRoute(addresses);
            }
            this.classList.remove('droppable');
            dragItem.classList.remove('dragging');
            return false;
        }

        function generateRoute(addresses) {
            console.log(addresses);
            var geocoder = new google.maps.Geocoder();
            var locations = [];

            // Convert address strings to coordinates using geocoding
            $.each(addresses, function(index, address) {
                geocoder.geocode({ address: address }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var location = results[0].geometry.location;
                    locations.push(location);

                    // Create markers for each location
                    var marker = new google.maps.Marker({
                    position: location,
                    map: map
                    });

                    // Set the map center to the first location
                    if (locations.length === 1) {
                    map.setCenter(location);
                    }

                    // Calculate and display the route
                    if (locations.length > 1) {
                    var directionsService = new google.maps.DirectionsService();
                    var directionsDisplay = new google.maps.DirectionsRenderer({
                        suppressMarkers: true, // Hide default markers
                        map: map
                    });

                    var origin = locations[0];
                    var destination = locations[locations.length - 1];

                    var waypoints = locations.slice(1, locations.length - 1).map(function(location) {
                        return {
                        location: location,
                        stopover: true
                        };
                    });

                    var request = {
                        origin: origin,
                        destination: destination,
                        waypoints: waypoints,
                        optimizeWaypoints: true,
                        travelMode: google.maps.TravelMode.DRIVING
                    };

                    directionsService.route(request, function (result, status) {
                        if (status === google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(result);
                        } else {
                        console.log("Directions request failed: " + status);
                        }
                    });
                    }
                } else {
                    console.log("Geocode was not successful for the following reason: " + status);
                }
                });
            });
        }

        function initializeMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12
            });

            var draggableItems = document.querySelectorAll('.draggablecards');
            draggableItems.forEach(function (item) {
                item.addEventListener('dragstart', handleDragStart, false);
                item.addEventListener('dragover', handleDragOver, false);
                item.addEventListener('dragleave', handleDragLeave, false);
                item.addEventListener('drop', handleDrop, false);
            });

            var addressElements = document.querySelectorAll('#address-container .card-body span');
            var addresses = [];
            addressElements.forEach(function (element) {
                addresses.push(element.textContent);
            });

            generateRoute(addresses);
        }

        // Load the Google Maps API asynchronously
        function loadGoogleMaps() {
            var script = document.createElement('script');
            script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyA3YWssMkDiW3F1noE6AVbiJEL40MR0IFU&libraries=places";
            script.onload = initializeMap;
            document.body.appendChild(script);
        }

        loadGoogleMaps();

        function generate_Waypoint_Route(destinationName) {
            var geocoder = new google.maps.Geocoder();
            var userLocation;

            // Get the user's current location using the Geolocation API
            navigator.geolocation.getCurrentPosition(function(position) {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Convert the destination name to coordinates using geocoding
                geocoder.geocode({ address: destinationName }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var destinationLocation = results[0].geometry.location;

                        // Create a map centered around the user's location
                        var map = new google.maps.Map(document.createElement('div'), {
                            center: userLocation,
                            zoom: 12
                        });

                        // Create markers for user location and destination
                        new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            title: "Your Location"
                        });
                        new google.maps.Marker({
                            position: destinationLocation,
                            map: map,
                            title: destinationName
                        });

                        // Calculate and display the route
                        var directionsService = new google.maps.DirectionsService();
                        var directionsDisplay = new google.maps.DirectionsRenderer({
                            suppressMarkers: true, // Hide default markers
                            map: map
                        });

                        var origin = userLocation;
                        var destination = destinationLocation;

                        var request = {
                            origin: origin,
                            destination: destination,
                            travelMode: google.maps.TravelMode.DRIVING
                        };

                        directionsService.route(request, function (result, status) {
                            if (status === google.maps.DirectionsStatus.OK) {
                                directionsDisplay.setDirections(result);
                            } else {
                                console.log("Directions request failed: " + status);
                            }
                        });

                        // Open the map in a new tab/window
                        window.open(`https://www.google.com/maps/dir/?api=1&origin=${userLocation.lat},${userLocation.lng}&destination=${destinationLocation.lat()},${destinationLocation.lng()}`);
                    } else {
                        console.log("Geocode was not successful for the following reason: " + status);
                    }
                });
            }, function(error) {
                console.error('Error getting user location:', error);
            });
        }

        // Call the function when the button is clicked
        document.getElementById('show-map-button').addEventListener('click', function() {
            var destinationName = document.getElementById('way_point_title').textContent;
            generate_Waypoint_Route(destinationName);
        });

        // extra things of page is here 
        $(document).ready(function() {

            $('#btn_addressUpdate, #btn_optimize_addresses').on('click', function () {
                var buttonId = $(this).attr('id');

                if (buttonId === 'btn_addressUpdate') {
                    update_address_order();
                } else if (buttonId === 'btn_optimize_addresses') {
                    optimize_addresses();
                }
            });

            get_waypoint();

            function update_address_order() {

                var update_address = [];
                $('.draggable').each(function(index) {
                    var item = {
                        id: this.id.replace("address_card_", ""), 
                        order_no: ++index
                    };

                    update_address.push(item);
                });

                if(update_address){

                    var apiname = 'addressesUpdate';
                    var apiurl = "{{ end_url('') }}" + apiname;
                    var bearerToken = "{{session('user')}}";
                    
                    $.ajax({
                        url: apiurl,
                        type: 'POST',
                        data: JSON.stringify(update_address),
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + bearerToken
                        },
                        beforeSend: function() {
                            $('.btn_addressUpdate #spinner').removeClass('d-none');
                            $('.btn_addressUpdate').prop('disabled', true);
                        },
                        success: function(response) {
                            $('.btn_addressUpdate').prop('disabled', false);
                            $('.btn_addressUpdate #spinner').addClass('d-none');
                            $('.close').trigger('click');

                            $("#snackbar").text('Trip Adresses Successfully Updated  ....');
                            var x = document.getElementById("snackbar");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

                            // showAlert("Success", response.message, response.status);
                            addresses =  response.data;
                            generateRoute(addresses) 
                        },
                        error: function(xhr, status, error) {
                            console.log(status);
                        }
                    });
                }
            }

            function optimize_addresses(){
                var addressElements = document.querySelectorAll('#address-container .card-body span');
                var addresses = [];
                addressElements.forEach(function (element) {
                    addresses.push(element.textContent);
                });

                generateRoute(addresses);

                $('.close').trigger('click');
                $("#snackbar").text('Trip Adresses Optimized Successfully  ....');
                let x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            function get_waypoint() {

                var check_end_trip = [];

                $(".draggable").each(function() {
                    let addressStatus  = $(this).find('input[data-address-status]').attr('data-address-status');
                    let tripPic        = $(this).find('input[data-trip-pic]').attr('data-trip-pic');
                    let tripSignature  = $(this).find('input[data-trip-signature]').attr('data-trip-signature');
                    let tripNote       = $(this).find('input[data-trip-note]').attr('data-trip-note');
                    let waypoint_title = $(this).find('input[data-address-title]').attr('data-address-title');
                    let waypoint_desc  = $(this).find('input[data-address-desc]').attr('data-address-desc');
                    
                    if (addressStatus == 1) {
                        
                        let addressId      = this.id.replace("address_card_", "");
                        // $('#card_way_point').removeClass('d-none');

                        if(addressId){
                            $('#complete_add_id').val(addressId);
                            $('#btn-next_waypoint').attr('data-address_id','').addClass('d-none');
                            $('#btn-complete_waypoint').attr('data-address_id','').addClass('d-none');
                            $('#btn-waypoint_details').removeClass('d-none').attr('data-address_id',addressId).fadeIn('fast');
                        }

                        $("#way_point_title").text(waypoint_title);
                        $("#text_address-desc").text(waypoint_desc);

                        if (tripPic== 1) {
                            $("#pic_required").removeClass('d-none');
                            $('#required-fields').attr('data-trip-pic','1');
                        }else{
                            $("#pic_required").addClass('d-none');
                            $('#required-fields').attr('data-trip-pic','0');
                        }

                        if (tripSignature == 1) {
                            $("#signature_required").removeClass('d-none');
                            $('#required-fields').attr('data-trip-signature','1');
                        }else{
                            $("#signature_required").addClass('d-none');
                            $('#required-fields').attr('data-trip-signature','0');
                        }
                        
                        if (tripNote == 1) {
                            $("#note_required").removeClass('d-none');
                            $('#required-fields').attr('data-trip-note','1');
                        }else{
                            $("#note_required").addClass('d-none');
                            $('#required-fields').attr('data-trip-note','0');
                        }

                        check_end_trip.push('no');
                    }
                else if (addressStatus == 2){
                    check_end_trip.push('no');
                }
                else{
                        check_end_trip.push('yes');
                    }
                });

                if (check_end_trip.includes('no')) {
                    $("#btn-optimize_address").removeClass('d-none');
                    $("#btn-update_address").removeClass('d-none');
                    // $('#card_way_point').addClass('d-none');
                } else {
                        $("#btn-optimize_address").addClass('d-none');
                        $("#btn-update_address").addClass('d-none');
                        $('#btn-next_waypoint').attr('data-address_id','').addClass('d-none');
                        $('#btn-waypoint_details').attr('data-address_id','').addClass('d-none');
                        $('#btn-complete_waypoint').attr('data-address_id','').addClass('d-none');
                }
            }
        
            // hidding the errors messages 
            $('#skiped_address_desc').on('input',function(){
                $('#error_message').text('*This field is required. Please write a reason.').hide();
            });

            $('#address_note').on('input',function(){
                $('#error_message_note').addClass('d-none');
            });

            $('#file').on('change',function(){
                $('#error_message_pic').addClass('d-none');
            });

            $('#signature-pad').on('mousedown touchstart pointerdown', function () {
                $('#error_message_sigature').addClass('d-none');
            });

            // Get the signature button and the signature pad (canvas)
            const signatureButton = document.getElementById('signature-btn');
            const signaturePad = document.getElementById('signature-pad');
            const signatureClear = document.getElementById('clear-btn');
            const signatureDiv = document.getElementById('signature-div');
        
            // Hide the signature pad initially
            signaturePad.style.display = 'none';
        
            // Add a click event listener to the signature button
            signatureButton.addEventListener('click', function () {
                // Toggle the display of the signature pad when the button is clicked
                if (signaturePad.style.display === 'none') {
                    signaturePad.style.display = 'block';
                    signatureClear.style.display = 'block';
                    signatureDiv.classList.remove("col-lg-12");
                    signatureDiv.classList.add("col-lg-10");
                } else {
                    signaturePad.style.display = 'none';
                    signatureClear.style.display = 'none';
                    signatureDiv.classList.add("col-lg-12");
            }
            });
    
            // upload files setting...
            const fileInput = document.getElementById('file');
            const uploadText = document.querySelector('.upload-text');
            const selectedFileName = document.getElementById('selected-file-name');

            fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            if (file) {
                uploadText.textContent = file.name;
            } else {
                uploadText.textContent = 'Upload Image';
            }
            });

            // Reset file input and upload text when the modal is closed
            $('#updatemodal, #optimizemodal').on('hidden.bs.modal', function() {
            fileInput.value = '';
            uploadText.textContent = 'Upload Image';
            });

            // const fileInput1 = document.getElementById('file1');
            const uploadText1 = document.querySelector('.upload-text1');
            const selectedFileName1 = document.getElementById('selected-file-name1');
            
            function showAlert(title, message, type) {  
                    
                    swal({
                        position: 'bottom-end',
                        title: title,
                        text: message,
                        icon: type,
                        showConfirmButton: false,
                        timer: 1500,
                        showClass: {
                            popup: 'swal2-show',
                            backdrop: 'swal2-backdrop-show',
                            icon: 'swal2-icon-show'
                        },
                        hideClass: {
                            popup: 'swal2-hide',
                            backdrop: 'swal2-backdrop-hide',
                            icon: 'swal2-icon-hide'
                        },
                        onOpen: function() {
                            $('.swal2-popup').css('animation', 'swal2-show 0.5s');
                        },
                        onClose: function() {
                            $('.swal2-popup').css('animation', 'swal2-hide 0.5s');
                        }
                    });
                
            }


        });
  </script>


    @endsection