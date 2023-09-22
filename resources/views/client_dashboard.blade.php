@extends('layouts.main')

@section('main-section')
@php
$tripStatus = config('constants.TRIP_STATUS');
$tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
$expDate = strtotime($user->sub_exp_date);
$currentDate = time();
$secondsLeft = $expDate - $currentDate;
$daysLeft = ceil($secondsLeft / (60 * 60 * 24));
@endphp
<style>
    .position-absolute {
        position: absolute;
        display: flex;
        z-index: 100;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
        bottom: 5.5rem;
    }

    /* Hide the default arrow icon for the date input */
    input[type="date"]::-webkit-calendar-picker-indicator {
        /* Set the color to transparent */
        background: none;
        color: transparent;
        padding: 0px;
        /* Optional: remove any padding that may affect the icon positioning */
        font-size: larger;
    }

    /* Add a custom background (caret down icon) */
    input[type="date"] {
        background-image: url('assets/images/caret.png');
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 20px 20px;
        /* Adjust the size of the icon */
        border: none;
    }

    /* Hide the default arrow icon for the date input */
    input[type="month"]::-webkit-calendar-picker-indicator {
        /* Set the color to transparent */
        background: none;
        color: transparent;
        padding: 0px;
        /* Optional: remove any padding that may affect the icon positioning */
        font-size: larger;
    }

    /* Add a custom background (caret down icon) */
    input[type="month"] {
        background-image: url('assets/images/caret.png');
        background-repeat: no-repeat;
        background-position: right center;
        background-size: 20px 20px;
        /* Adjust the size of the icon */
        border: none;
    }

    span#procent {
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 30px;
        font-weight: 600;
        transform: translate(-50%, -50%);
        color: #3949AB;
        margin-top: 33px;
    }

    span#procent::after {
        content: '%';
    }

    span#procent1 {
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 30px;
        font-weight: 600;
        transform: translate(-50%, -50%);
        color: #3949AB;
        margin-top: 33px;
    }

    span#procent1::after {
        content: '%';
    }

    span#procent2 {
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        font-size: 30px;
        font-weight: 600;
        transform: translate(-50%, -50%);
        color: #3949AB;
        margin-top: 33px;
    }

    span#procent2::after {
        content: '%';
    }
</style>

<!-- partial -->
<div class="content-wrapper py-0 my-2">
    <div class="bg-white p-3 mb-3" style="border-radius: 20px;">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.54 0H5.92C7.33 0 8.46 1.15 8.46 2.561V5.97C8.46 7.39 7.33 8.53 5.92 8.53H2.54C1.14 8.53 0 7.39 0 5.97V2.561C0 1.15 1.14 0 2.54 0ZM2.54 11.4697H5.92C7.33 11.4697 8.46 12.6107 8.46 14.0307V17.4397C8.46 18.8497 7.33 19.9997 5.92 19.9997H2.54C1.14 19.9997 0 18.8497 0 17.4397V14.0307C0 12.6107 1.14 11.4697 2.54 11.4697ZM17.4601 0H14.0801C12.6701 0 11.5401 1.15 11.5401 2.561V5.97C11.5401 7.39 12.6701 8.53 14.0801 8.53H17.4601C18.8601 8.53 20.0001 7.39 20.0001 5.97V2.561C20.0001 1.15 18.8601 0 17.4601 0ZM14.0801 11.4697H17.4601C18.8601 11.4697 20.0001 12.6107 20.0001 14.0307V17.4397C20.0001 18.8497 18.8601 19.9997 17.4601 19.9997H14.0801C12.6701 19.9997 11.5401 18.8497 11.5401 17.4397V14.0307C11.5401 12.6107 12.6701 11.4697 14.0801 11.4697Z" fill="white" />
                    </svg>
                </span>
                <span>@lang('lang.dashboard')</span>
            </h3>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 mb-2">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                        -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                        -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 style="color: #452C88;"><span>@lang('Active Users')</span></h6>
                                <h5 style="color: #E45F00;">{{ $driversCount ?? $driversCount}}</h5>
                            </div>
                            <div>
                                <svg width="70" height="71" viewBox="0 0 70 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="35" cy="35.6432" r="35" fill="#452C88" fill-opacity="0.3" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7707 48.0805H34.6138V41.2375C31.0208 41.6347 28.168 44.4875 27.7707 48.0805ZM36.3364 41.2375V48.0805H43.1794C42.7822 44.4875 39.9293 41.6347 36.3364 41.2375ZM43.1795 49.8031C43.0592 50.8924 42.7135 51.9125 42.1902 52.817L43.6813 53.6795C44.4879 52.2852 44.9493 50.666 44.9493 48.9418C44.9493 43.7094 40.7075 39.4676 35.4751 39.4676C30.2426 39.4676 26.0009 43.7094 26.0009 48.9418C26.0009 50.666 26.4622 52.2852 27.2688 53.6795L28.7599 52.817C28.2367 51.9125 27.891 50.8924 27.7706 49.8031H43.1795Z" fill="#452C88" />
                                    <path d="M38.059 48.9417C38.059 50.3687 36.9022 51.5255 35.4751 51.5255C34.048 51.5255 32.8912 50.3687 32.8912 48.9417C32.8912 47.5146 34.048 46.3578 35.4751 46.3578C36.9022 46.3578 38.059 47.5146 38.059 48.9417Z" fill="#452C88" />
                                    <path d="M42.0075 46.2243C41.7612 45.3054 42.3066 44.3609 43.2255 44.1146L44.8895 43.6688C45.8084 43.4226 46.753 43.9679 46.9992 44.8868L47.8909 48.2146C48.1371 49.1336 47.5918 50.0781 46.6729 50.3244L45.0089 50.7703C44.09 51.0164 43.1454 50.4711 42.8992 49.5521L42.0075 46.2243Z" fill="#452C88" />
                                    <path d="M23.9508 44.8861C24.197 43.9671 25.1416 43.4218 26.0605 43.668L27.7245 44.1139C28.6434 44.3601 29.1887 45.3046 28.9425 46.2236L28.0508 49.5513C27.8046 50.4703 26.86 51.0156 25.9411 50.7695L24.2772 50.3236C23.3582 50.0773 22.8129 49.1328 23.0591 48.2138L23.9508 44.8861Z" fill="#452C88" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7234 29.1319V26.548H29.446V29.1319C29.446 32.4617 32.1453 35.161 35.475 35.161C38.8048 35.161 41.5041 32.4617 41.5041 29.1319V26.548H43.2267V29.1319C43.2267 33.4131 39.7562 36.8835 35.475 36.8835C31.1939 36.8835 27.7234 33.4131 27.7234 29.1319Z" fill="#452C88" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.685 23.9642H44.3028C44.3647 23.8062 44.4316 23.6199 44.4981 23.4066L44.5086 23.3733C44.7409 22.6298 44.9493 21.9626 44.9493 20.6024C44.9493 19.9127 44.5012 19.3319 43.908 18.8727C43.307 18.4074 42.4862 18.0091 41.5719 17.6844C39.741 17.0341 37.4318 16.6432 35.4751 16.6432C33.5183 16.6432 31.2092 17.0341 29.3782 17.6844C28.464 18.0091 27.6432 18.4074 27.0422 18.8727C26.449 19.3319 26.0009 19.9127 26.0009 20.6024C26.0009 21.8651 26.212 22.5306 26.429 23.2145C26.4492 23.2782 26.4695 23.342 26.4896 23.4065C26.5562 23.6198 26.6231 23.8061 26.685 23.9642ZM32.0299 21.3804C32.0299 20.9047 32.4155 20.5191 32.8912 20.5191H38.059C38.5346 20.5191 38.9202 20.9047 38.9202 21.3804C38.9202 21.856 38.5346 22.2417 38.059 22.2417H32.8912C32.4155 22.2417 32.0299 21.856 32.0299 21.3804Z" fill="#452C88" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.8806 26.0404C26.9197 25.8356 27.1072 25.6868 27.3261 25.6868H43.6241C43.843 25.6868 44.0305 25.8356 44.0696 26.0404L44.0698 26.0414L44.07 26.0425L44.0704 26.045L44.0715 26.0508L44.074 26.0665C44.0758 26.0787 44.0779 26.0942 44.0798 26.1129C44.0838 26.1504 44.0874 26.2007 44.0879 26.2619C44.089 26.3845 44.0777 26.5522 44.0313 26.7497C43.9374 27.1489 43.7033 27.6564 43.1671 28.1495C42.1042 29.1273 39.9204 29.9932 35.4751 29.9932C31.0298 29.9932 28.846 29.1273 27.7831 28.1495C27.2469 27.6564 27.0128 27.1489 26.9189 26.7497C26.8725 26.5522 26.8612 26.3845 26.8622 26.2619C26.8628 26.2007 26.8664 26.1504 26.8703 26.1129C26.8723 26.0942 26.8744 26.0787 26.8762 26.0665L26.8787 26.0508L26.8797 26.045L26.8802 26.0425L26.8804 26.0414L26.8806 26.0404Z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 mb-2">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                                    -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                                        -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0" style="color: #452C88;"><span>@lang('Quotations')</span></h6>
                                <h5 class="mb-0" style="color: #E45F00;">{{ $totalQuotion ?? ''}}</h5>
                            </div>
                            <div>
                                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                                    <path d="M40.4768 49.4998H25.8749C23.4617 49.4998 21.5 47.538 21.5 45.1248C21.5 42.7116 23.4617 40.7498 25.8749 40.7498H38.1249C41.5023 40.7498 44.2498 38.0024 44.2498 34.6249C44.2498 31.2474 41.5023 28.4999 38.1249 28.4999H29.6182C28.9339 29.8492 28.0992 31.0252 27.2487 31.9999H38.1249C39.5721 31.9999 40.7498 33.1776 40.7498 34.6249C40.7498 36.0721 39.5721 37.2499 38.1249 37.2499H25.8749C21.5332 37.2499 18 40.7831 18 45.1248C18 49.4665 21.5332 52.9997 25.8749 52.9997H42.6626C41.8628 51.9882 41.0998 50.8175 40.4768 49.4998ZM23.25 18C20.3555 18 18 20.3555 18 23.25C18 28.8289 23.25 31.9999 23.25 31.9999C23.25 31.9999 28.4999 28.8272 28.4999 23.25C28.4999 20.3555 26.1444 18 23.25 18ZM23.25 25.8749C21.801 25.8749 20.625 24.699 20.625 23.25C20.625 21.801 21.801 20.625 23.25 20.625C24.699 20.625 25.8749 21.801 25.8749 23.25C25.8749 24.699 24.699 25.8749 23.25 25.8749Z" fill="#452C88" />
                                    <path d="M47.7502 39.0001C44.8557 39.0001 42.5002 41.3555 42.5002 44.25C42.5002 49.829 47.7502 53 47.7502 53C47.7502 53 53.0002 49.8272 53.0002 44.25C53.0002 41.3555 50.6447 39.0001 47.7502 39.0001ZM47.7502 46.875C46.3012 46.875 45.1252 45.699 45.1252 44.25C45.1252 42.801 46.3012 41.625 47.7502 41.625C49.1992 41.625 50.3752 42.801 50.3752 44.25C50.3752 45.699 49.1992 46.875 47.7502 46.875Z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 mb-2">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0" style="color: #452C88;"><span>@lang('Contracts')</span></h6>
                                <h5 class="mb-0" style="color: #E45F00;">{{ $totalContract ?? ''}}</h5>
                            </div>
                            <div>
                                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                                    <path d="M45.3636 46.0455C46.7973 46.0455 47.9545 44.8882 47.9545 43.4546C47.9545 42.0209 46.7973 40.8636 45.3636 40.8636C43.93 40.8636 42.7727 42.0209 42.7727 43.4546C42.7727 44.8882 43.93 46.0455 45.3636 46.0455ZM47.9545 30.5H43.6364V34.8182H51.34L47.9545 30.5ZM24.6364 46.0455C26.07 46.0455 27.2273 44.8882 27.2273 43.4546C27.2273 42.0209 26.07 40.8636 24.6364 40.8636C23.2027 40.8636 22.0455 42.0209 22.0455 43.4546C22.0455 44.8882 23.2027 46.0455 24.6364 46.0455ZM48.8182 27.9091L54 34.8182V43.4546H50.5455C50.5455 46.3218 48.2309 48.6364 45.3636 48.6364C42.4964 48.6364 40.1818 46.3218 40.1818 43.4546H29.8182C29.8182 46.3218 27.5036 48.6364 24.6364 48.6364C21.7691 48.6364 19.4545 46.3218 19.4545 43.4546H16V24.4545C16 22.5373 17.5373 21 19.4545 21H43.6364V27.9091H48.8182ZM19.4545 24.4545V40H20.7673C21.7173 38.9464 23.0991 38.2727 24.6364 38.2727C26.1736 38.2727 27.5555 38.9464 28.5055 40H40.1818V24.4545H19.4545ZM22.9091 32.2273L25.5 29.6364L28.0909 32.2273L34.1364 26.1818L36.7273 28.7727L28.0909 37.4091L22.9091 32.2273Z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-sm-6 col-md-6 mb-2">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-0" style="color: #452C88;"><span>@lang('Invoices')</span></h6>
                                <h5 class="mb-0" style="color: #E45F00;">{{ $totalInvoice ?? ''}}</h5>
                            </div>
                            <div>
                                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                                    <path d="M45.3636 46.0455C46.7973 46.0455 47.9545 44.8882 47.9545 43.4546C47.9545 42.0209 46.7973 40.8636 45.3636 40.8636C43.93 40.8636 42.7727 42.0209 42.7727 43.4546C42.7727 44.8882 43.93 46.0455 45.3636 46.0455ZM47.9545 30.5H43.6364V34.8182H51.34L47.9545 30.5ZM24.6364 46.0455C26.07 46.0455 27.2273 44.8882 27.2273 43.4546C27.2273 42.0209 26.07 40.8636 24.6364 40.8636C23.2027 40.8636 22.0455 42.0209 22.0455 43.4546C22.0455 44.8882 23.2027 46.0455 24.6364 46.0455ZM48.8182 27.9091L54 34.8182V43.4546H50.5455C50.5455 46.3218 48.2309 48.6364 45.3636 48.6364C42.4964 48.6364 40.1818 46.3218 40.1818 43.4546H29.8182C29.8182 46.3218 27.5036 48.6364 24.6364 48.6364C21.7691 48.6364 19.4545 46.3218 19.4545 43.4546H16V24.4545C16 22.5373 17.5373 21 19.4545 21H43.6364V27.9091H48.8182ZM19.4545 24.4545V40H20.7673C21.7173 38.9464 23.0991 38.2727 24.6364 38.2727C26.1736 38.2727 27.5555 38.9464 28.5055 40H40.1818V24.4545H19.4545ZM22.9091 32.2273L25.5 29.6364L28.0909 32.2273L34.1364 26.1818L36.7273 28.7727L28.0909 37.4091L22.9091 32.2273Z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 col-md-12 col-xl-8">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div>
                                <span class="text-muted font-weight-semibold">@lang('lang.show'):</span>
                                <input type="date" class=" date-input" value="{{ date('Y-m-d') }}" id="datePickerInput">
                                <!-- <b>{{ date('d-m, F Y') }}</b>
                                    <span style="border: 1px solid #ACADAE; cursor: pointer ;padding: 0px 6px;">
                                        <i class="fa fa-caret-down"></i>
                                    </span> -->
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-evenly" style="margin-top: 30px !important;">
                        <div class="col-lg-4 col-md-4 " style="width: 100% !important;">
                            <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); width:100% height:auto">
                                <p class="progress_para pt-2">@lang('Completed Quotations') </p>
                                <div class="mt-5">
                                    <div class="d-flex justify-content-center">
                                        <canvas id="canvas" class="progress_charts" style="position: relative;"></canvas>
                                    </div>
                                    <span id="procent"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                                <p class="progress_para pt-2">@lang('Closed Contracts') </p>
                                <div class="mt-5">
                                    <div class="d-flex justify-content-center">
                                        <canvas id="canvas1" class="progress_charts" style="position: relative;"></canvas>
                                    </div>
                                    <span id="procent1"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                                <p class="progress_para pt-2">@lang('Paid Invoices') </p>
                                <div class="mt-5">
                                    <div class="d-flex justify-content-center">
                                        <canvas id="canvas2" class="progress_charts" style="position: relative;"></canvas>
                                    </div>
                                    <span id="procent2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 text-left">
                        <div>
                            <h5>Today Progress</h5>
                        </div>
                    </div>
                    <div class="row pt-1 scroller" style="height: 360px; overflow: auto; overflow-x: hidden;">
                        <style>
                            span.pro {
                                display: block;
                                position: absolute;
                                left: 50%;
                                /* top: 35%; */
                                font-size: 30px;
                                font-weight: 600;
                                transform: translate(-50%, -50%);
                                color: #3949AB;
                                /* margin-top: -4px; */
                            }

                            span.pro::after {
                                content: '%';
                            }
                        </style>
                        @foreach($drivers as $key => $value)
                        <div class="col-lg-4 col-md-4 mb-3">
                            <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
                                    -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
                                    -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                                <div class="text-left pt-1 pl-1">
                                    <img style="border-radius: 50% !important; width: 30px; height: 30px;" src="{{ (isset($value['user_pic'])) ? asset('storage/' . $value['user_pic']) : 'assets/images/user.png'}}" alt="profile">
                                    <span class="progress_para text-wrap pt-2">{{ $value['name'] ?? $value['name'] }} </span>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-center">
                                        <canvas class="can progress_charts" id="can{{ $key }}" style="position: relative;"></canvas>
                                    </div>
                                    <span class="pro" id="pro{{ $key }}"></span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <script>
                            function arcMove(canvasId, spanId, percentage) {
                                var canvas = document.getElementById(canvasId);
                                var spanProcent = document.getElementById(spanId);
                                var c = canvas.getContext('2d');

                                var posX = canvas.width / 2;
                                var posY = canvas.height / 2;
                                var fps = 1000 / 200;
                                var procent = 0;
                                var oneProcent = 360 / 100;
                                var result = oneProcent * percentage;

                                c.lineCap = 'round';
                                arcMoveAnimation();

                                function arcMoveAnimation() {
                                    var degrees = 0;
                                    var arcInterval = setInterval(function() {
                                        degrees += 1;
                                        c.clearRect(0, 0, canvas.width, canvas.height);
                                        procent = degrees / oneProcent;

                                        spanProcent.innerHTML = procent.toFixed();

                                        c.beginPath();
                                        c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + 360));
                                        c.strokeStyle = '#FCEFE5';
                                        c.lineWidth = '15';
                                        c.stroke();

                                        c.beginPath();
                                        c.strokeStyle = '#E45F00';
                                        c.lineWidth = '15';
                                        c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + degrees));
                                        c.stroke();

                                        if (degrees >= result) clearInterval(arcInterval);
                                    }, fps);
                                }
                            }

                            // Call the arcMove function for each chart with unique IDs.
                            @foreach($drivers as $key => $value)
                            arcMove('can{{ $key }}', 'pro{{ $key }}', {
                                {
                                    $value['driv_active_percentage'] ?? 0
                                }
                            });
                            @endforeach
                        </script>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xl-4">
                    @include('aside')
                </div>
            </div>
        </div>
    </div>
</div>
@include('charts')
<!-- content-wrapper ends -->
@if(Session::has('subscription_active'))
<script>
    alert();
    showAlert('Congratulations!', {
        {
            session('subscription_active')
        }
    }, 'success');
</script>
@endif

@endsection