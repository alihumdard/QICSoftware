@extends('layouts.main')

@section('main-section')
@php
$currentDate = time();
@endphp
<style>
    .own-card-padding {
        padding: 2.1rem 2.2rem !important;
    }

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
    <div class="bg-white rounded">
        <div class="page-header px-3 py-2">
            <h3 class="page-title font-weight-bold">
                <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.54 0H5.92C7.33 0 8.46 1.15 8.46 2.561V5.97C8.46 7.39 7.33 8.53 5.92 8.53H2.54C1.14 8.53 0 7.39 0 5.97V2.561C0 1.15 1.14 0 2.54 0ZM2.54 11.4697H5.92C7.33 11.4697 8.46 12.6107 8.46 14.0307V17.4397C8.46 18.8497 7.33 19.9997 5.92 19.9997H2.54C1.14 19.9997 0 18.8497 0 17.4397V14.0307C0 12.6107 1.14 11.4697 2.54 11.4697ZM17.4601 0H14.0801C12.6701 0 11.5401 1.15 11.5401 2.561V5.97C11.5401 7.39 12.6701 8.53 14.0801 8.53H17.4601C18.8601 8.53 20.0001 7.39 20.0001 5.97V2.561C20.0001 1.15 18.8601 0 17.4601 0ZM14.0801 11.4697H17.4601C18.8601 11.4697 20.0001 12.6107 20.0001 14.0307V17.4397C20.0001 18.8497 18.8601 19.9997 17.4601 19.9997H14.0801C12.6701 19.9997 11.5401 18.8497 11.5401 17.4397V14.0307C11.5401 12.6107 12.6701 11.4697 14.0801 11.4697Z" fill="white" />
                    </svg>
                </span>
                <span>@lang('Admin Dashboard')</span>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-3 col-md-6 mb-4">
            <div class=" card shadow h-100   " style="border-radius: 20px;">
                <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                    <div>
                        <h6 class="font-weight-bold" style="color: #184A45FF;"><span>@lang('Active Users')</span></h6>
                        <h5 style="color: #E45F00;">{{ $usersCount ?? $usersCount}}</h5>
                    </div>
                    <div>
                        <svg width="3.5em" height="3.5em" viewBox="0 0 70 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="35" cy="35.6431" r="35" fill="#184A45FF" fill-opacity="0.3" />
                            <path d="M45.5005 30.3705C46.2701 30.3705 46.9745 29.9822 47.4913 29.3546C48.0396 28.6886 48.3789 27.7581 48.3789 26.7211C48.3789 25.636 48.2707 24.67 47.8489 24.0234C47.4654 23.4355 46.754 23.0717 45.5005 23.0717C44.247 23.0717 43.5356 23.4355 43.1521 24.0234C42.7303 24.67 42.6222 25.636 42.6222 26.7211C42.6222 27.7581 42.9615 28.6886 43.5098 29.3547C44.0265 29.9823 44.731 30.3705 45.5005 30.3705ZM48.5906 30.2586C47.807 31.2104 46.715 31.7991 45.5005 31.7991C44.286 31.7991 43.1941 31.2104 42.4105 30.2587C41.6587 29.3455 41.1936 28.0941 41.1936 26.7211C41.1936 25.3964 41.3495 24.1804 41.9579 23.2477C42.6045 22.2564 43.6896 21.6431 45.5005 21.6431C47.3114 21.6431 48.3964 22.2564 49.0431 23.2477C49.6515 24.1804 49.8075 25.3964 49.8075 26.7211C49.8075 28.0941 49.3424 29.3455 48.5906 30.2586Z" fill="#28a745" />
                            <path d="M51.567 38.7643C51.5361 36.8098 51.406 35.5719 50.8469 34.8053C50.3361 34.1048 49.3755 33.6976 47.685 33.366C47.3006 33.6655 46.5827 34.0681 45.5008 34.0681C44.4187 34.0681 43.7007 33.6654 43.3163 33.366C42.2276 33.5796 41.4417 33.8247 40.8835 34.1595C41.07 33.6035 41.1905 33.0245 41.2449 32.4395C41.8481 32.2269 42.5615 32.0536 43.4077 31.9009L43.8237 31.8258L44.0885 32.1548C44.0897 32.1562 44.4675 32.6395 45.5008 32.6395C46.5339 32.6395 46.9117 32.1562 46.9128 32.1548L47.1776 31.8258L47.5937 31.9009C49.8842 32.3144 51.2013 32.8778 51.9965 33.9683C52.7772 35.0387 52.9546 36.4982 52.9901 38.742L52.9917 38.8402C52.9959 39.1 53.0001 39.3572 53.0001 39.3703L52.9163 39.7023C52.9128 39.7091 51.7212 42.0984 45.5008 42.0984C45.2778 42.0984 45.0621 42.095 44.8518 42.0891C44.753 41.5897 44.6175 41.1033 44.4303 40.6463C44.7653 40.6614 45.1214 40.6698 45.5008 40.6698C49.9672 40.6698 51.2632 39.5369 51.5712 39.1593C51.5708 38.9909 51.5697 38.9276 51.5686 38.8626L51.567 38.7643Z" fill="#28a745" />
                            <path d="M35.501 35.7717C36.4794 35.7717 37.373 35.2807 38.0266 34.4868C38.7119 33.6545 39.1358 32.4943 39.1358 31.2037C39.1358 29.8649 38.9998 28.6692 38.4695 27.8564C37.9776 27.1022 37.0771 26.6356 35.501 26.6356C33.9249 26.6356 33.0244 27.1022 32.5325 27.8564C32.0023 28.6692 31.8664 29.8648 31.8664 31.2037C31.8664 32.4944 32.2902 33.6545 32.9755 34.4868C33.6291 35.2807 34.5226 35.7717 35.501 35.7717ZM39.1259 35.3908C38.2054 36.5088 36.9243 37.2003 35.501 37.2003C34.0777 37.2003 32.7966 36.5088 31.8762 35.3909C30.9875 34.3114 30.4377 32.8304 30.4377 31.2037C30.4377 29.6252 30.6215 28.1797 31.3383 27.0807C32.0933 25.9231 33.3674 25.207 35.501 25.207C37.6345 25.207 38.9086 25.9231 39.6637 27.0807C40.3805 28.1796 40.5643 29.6252 40.5643 31.2037C40.5643 32.8304 40.0146 34.3114 39.1259 35.3908Z" fill="#28a745" />
                            <path d="M42.9939 45.6748C42.9559 43.2783 42.7935 41.7565 42.0934 40.7966C41.4428 39.9045 40.2342 39.3941 38.1064 38.9823C37.6778 39.3315 36.8248 39.8419 35.5007 39.8419C34.1764 39.8419 33.3233 39.3315 32.8947 38.9823C30.7901 39.3897 29.5845 39.8939 28.929 40.7688C28.2272 41.7056 28.0537 43.1849 28.0103 45.5096L28.0086 45.596C28.0055 45.7643 28.0026 45.9162 28.0017 46.2045C28.3461 46.6509 29.9103 48.1341 35.5007 48.1341C41.091 48.1341 42.6552 46.6508 42.9995 46.2044C42.9989 45.9892 42.9974 45.8938 42.9958 45.7982L42.9938 45.6748L42.9939 45.6748ZM43.243 39.9595C44.1646 41.2233 44.3744 42.9668 44.4169 45.6525L44.4189 45.7759C44.4237 46.0709 44.4284 46.3594 44.4284 46.4107L44.3447 46.7427C44.3404 46.7507 42.9385 49.5628 35.5007 49.5628C28.0626 49.5628 26.6607 46.7507 26.6565 46.7427L26.5728 46.4107C26.5728 46.2519 26.5788 45.9347 26.5856 45.5737L26.5873 45.4873C26.6363 42.8638 26.8613 41.1555 27.7906 39.915C28.7306 38.6603 30.2923 38.0038 32.9934 37.5162L33.4085 37.4413L33.6742 37.7701C33.6757 37.772 34.1773 38.4133 35.5007 38.4133C36.8238 38.4133 37.3254 37.772 37.3269 37.7701L37.5926 37.4413L38.0077 37.5162C40.74 38.0094 42.3067 38.6757 43.243 39.9595Z" fill="#28a745" />
                            <path d="M25.4993 30.3705C24.7298 30.3705 24.0253 29.9822 23.5086 29.3546C22.9602 28.6886 22.621 27.7581 22.621 26.7211C22.621 25.636 22.7292 24.67 23.1509 24.0234C23.5345 23.4355 24.2459 23.0717 25.4993 23.0717C26.7529 23.0717 27.4643 23.4355 27.8478 24.0234C28.2695 24.67 28.3777 25.636 28.3777 26.7211C28.3777 27.7581 28.0384 28.6886 27.4901 29.3547C26.9734 29.9823 26.2689 30.3705 25.4993 30.3705ZM22.4093 30.2586C23.1929 31.2104 24.2849 31.7991 25.4993 31.7991C26.7138 31.7991 27.8058 31.2104 28.5894 30.2587C29.3412 29.3455 29.8063 28.0941 29.8063 26.7211C29.8063 25.3964 29.6503 24.1804 29.042 23.2477C28.3953 22.2564 27.3103 21.6431 25.4993 21.6431C23.6885 21.6431 22.6035 22.2564 21.9568 23.2477C21.3484 24.1804 21.1924 25.3964 21.1924 26.7211C21.1924 28.0941 21.6575 29.3455 22.4093 30.2586Z" fill="#28a745" />
                            <path d="M19.433 38.7643C19.464 36.8098 19.5941 35.5719 20.1531 34.8053C20.664 34.1048 21.6245 33.6976 23.315 33.366C23.6994 33.6655 24.4174 34.0681 25.4993 34.0681C26.5814 34.0681 27.2994 33.6654 27.6838 33.366C28.7725 33.5796 29.5584 33.8247 30.1165 34.1595C29.93 33.6035 29.8096 33.0245 29.7552 32.4395C29.1519 32.2269 28.4386 32.0536 27.5923 31.9009L27.1763 31.8258L26.9115 32.1548C26.9104 32.1562 26.5326 32.6395 25.4993 32.6395C24.4662 32.6395 24.0883 32.1562 24.0872 32.1548L23.8224 31.8258L23.4064 31.9009C21.1158 32.3144 19.7988 32.8778 19.0035 33.9683C18.2229 35.0387 18.0455 36.4982 18.01 38.742L18.0084 38.8402C18.0042 39.1 18 39.3572 18 39.3703L18.0837 39.7023C18.0873 39.7091 19.2789 42.0984 25.4993 42.0984C25.7222 42.0984 25.938 42.095 26.1482 42.0891C26.247 41.5897 26.3826 41.1033 26.5698 40.6463C26.2348 40.6614 25.8787 40.6698 25.4993 40.6698C21.0329 40.6698 19.7369 39.5369 19.4288 39.1593C19.4293 38.9909 19.4304 38.9276 19.4314 38.8626L19.433 38.7643Z" fill="#28a745" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3 col-md-6 mb-4">
            <div class=" card shadow h-100" style="border-radius: 20px;">
                <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                    <div>
                        <h6 class="font-weight-bold" style="color: #184A45FF;"><span>@lang('Total Quotations')</span></h6>
                        <h5 style="color: #E45F00;">{{ $totalQuotion ?? ''}}</h5>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="3.5em" viewBox="0 0 384 512">
                            <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                            <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" fill="#27ae60" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 " style="border-radius: 20px;">
                <div class=" own-card-padding  card-body d-flex justify-content-between" style="border-top:none !important;">
                    <div>
                        <h6 class="font-weight-bold" style="color: #184A45FF;"><span>@lang('Contracts')</span></h6>
                        <h5 style="color: #E45F00;">{{ $totalContract ?? ''}}</h5>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="3.5em" viewBox="0 0 576 512">
                            <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM288 368a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm211.3-43.3c-6.2-6.2-16.4-6.2-22.6 0L416 385.4l-28.7-28.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l40 40c6.2 6.2 16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6z" fill="#184A45FF" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-3 col-md-6 mb-4">
            <div class="  card shadow h-100" style="border-radius: 20px;">
                <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                    <div>
                        <h6 class="font-weight-bold" style="color: #184A45FF;"><span>@lang('lang.total_invoices')</span></h6>
                        <h5 style="color: #E45F00;">{{ $totalInvoice ?? ''}}</h5>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" height="3.5em" viewBox="0 0 384 512">
                            <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm54.2 253.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.7 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 349l-9.8 32.8z" fill="#3498db" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row bg-white pb-0 px-3 pt-4 mb-4 " style="border-radius: 20px;">

        <div class="col-lg-7 col-md-12 col-xl-8">
            <div class="row mb-2 mt-2">
                <div class="col-lg-5 col-md-5">
                    <div>
                        <span class="text-muted font-weight-bold">@lang('lang.date'):</span>
                        <input type="date" class=" date-input font-weight-semibold" value="{{ date('Y-m-d') }}" id="datePickerInput">
                    </div>
                </div>
            </div>

            <div class="row justify-content-evenly">
                <div class="col-xl-4 col-lg-6 col-md-4">
                    <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.2 -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); width:100% height:auto">
                        <p class="progress_para pt-4 font-weight-bold" style="font-size: medium !important;">@lang('Completed Quotations') </p>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center">
                                <canvas id="canvas" class="progress_charts" style="position: relative;"></canvas>
                            </div>
                            <span id="procent"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-4">
                    <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);  -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                        <p class="progress_para font-weight-bold pt-4" style="font-size: medium !important;">@lang('Closed Contracts') </p>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center">
                                <canvas id="canvas1" class="progress_charts" style="position: relative;"></canvas>
                            </div>
                            <span id="procent1"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-4">
                    <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);-moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                        <p class="progress_para pt-4 font-weight-bold" style="font-size: medium !important;">@lang('Paid Invoices') </p>
                        <div class="mt-4">
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
                    <h6 class="font-weight-bold">Users Today Progress: </h6>
                </div>
            </div>

            <div class="row pt-1 scroller justify-content-evenly" style="height: 360px; overflow: auto; overflow-x: hidden;">
                <style>
                    span.pro {
                        display: block;
                        position: absolute;
                        left: 50%;
                        font-size: 30px;
                        font-weight: 600;
                        transform: translate(-50%, -50%);
                        color: #E45F00;
                    }
                </style>
                @foreach($users as $key => $value)
                <div class="col-xl-4 col-lg-6 col-md-4 col-sm-12 mb-4">
                    <div class="prgrss-chart" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                        <div class="text-left pt-1 pl-1">
                            <img style="border-radius: 50% !important; width: 30px; height: 30px;" src="{{ (isset($value['user_pic'])) ? asset('storage/' . $value['user_pic']) : 'assets/images/user.png'}}" alt="profile">
                            <span class="progress_para text-wrap pt-2">{{ $value['name'] ?? $value['name'] }} </span>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-center">
                                <canvas class="progress_charts" id="can{{ $key }}" style="position: relative;"></canvas>
                            </div>
                            <span class="pro" id="pro{{ $key }}"></span>
                        </div>
                    </div>
                </div>
                @endforeach
                <script>
                    @foreach($users as $key => $value)
                    @php
                    // Ensure $value['user_quote_percentage'] is a number, default to 0 if not set or not a number
                    $percentage = isset($value['user_quote_percentage']) && is_numeric($value['user_quote_percentage']) ? $value['user_quote_percentage'] : 0;
                    @endphp

                    arcMove('can{{ $key }}', 'pro{{ $key }}', @json($percentage));
                    @endforeach

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

                                spanProcent.innerHTML = procent.toFixed() + '%';

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
                </script>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 col-xl-4">
            @include('aside')
        </div>
    </div>

</div>

@include('charts')
<!-- content-wrapper ends -->
@if(Session::has('subscription_active'))
<script>
    showAlert('Congratulations!', @json(session('subscription_active')), 'success');
</script>
@endif

@endsection