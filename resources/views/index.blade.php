@extends('layouts.main')

@section('main-section')

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
</style>
@php
  $tripStatus = config('constants.TRIP_STATUS');
  $tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
@endphp
<style>
    /* Hide the default arrow icon for the date input */
input[type="date"]::-webkit-calendar-picker-indicator {
/* Set the color to transparent */
background: none;
color: transparent;
  padding: 0px; /* Optional: remove any padding that may affect the icon positioning */
  font-size: larger;
}
/* Add a custom background (caret down icon) */
input[type="date"] {
  background-image: url('assets/images/caret.png');
  background-repeat: no-repeat;
  background-position: right center;
  background-size: 20px 20px; /* Adjust the size of the icon */
  border: none;
}
    /* Hide the default arrow icon for the date input */
    input[type="month"]::-webkit-calendar-picker-indicator {
/* Set the color to transparent */
background: none;
color: transparent;
  padding: 0px; /* Optional: remove any padding that may affect the icon positioning */
  font-size: larger;
}
/* Add a custom background (caret down icon) */
input[type="month"] {
  background-image: url('assets/images/caret.png');
  background-repeat: no-repeat;
  background-position: right center;
  background-size: 20px 20px; /* Adjust the size of the icon */
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
    <div class="bg-white pb-0 px-3 pt-2" style="border-radius: 20px;">
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
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3); 
            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('lang.revenue')</span></h6>
                  <h5 style="color: #E45F00;">{{ isset($revenue) ?  $revenue : '' }}</h5>
                </div>
                <div>
                  <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                    <path d="M39.3403 46.9571C34.8131 46.9571 30.8991 44.3959 28.9511 40.6442H38.222C38.9074 40.6442 39.5387 40.2654 39.8273 39.6522C40.4225 38.4618 39.5568 37.0368 38.222 37.0368H27.7607C27.6705 36.4416 27.6164 35.8464 27.6164 35.2332C27.6164 34.6199 27.6705 34.0247 27.7607 33.4295H38.222C38.9074 33.4295 39.5387 33.0507 39.8273 32.4375C40.4406 31.229 39.5748 29.8221 38.222 29.8221H28.9511C30.8991 26.0704 34.8311 23.5092 39.3403 23.5092C41.5949 23.5092 43.7052 24.1585 45.5089 25.2588C46.4108 25.8179 47.5832 25.7277 48.3407 24.9702C49.3869 23.9241 49.1524 22.2106 47.8898 21.435C45.4007 19.9018 42.4607 19 39.3403 19C32.2699 19 26.2817 23.5272 24.0451 29.8221H18.8144C18.129 29.8221 17.4977 30.2009 17.1911 30.8141C16.5959 32.0226 17.4616 33.4295 18.8144 33.4295H23.2154C23.1432 34.0247 23.1072 34.6199 23.1072 35.2332C23.1072 35.8464 23.1432 36.4416 23.2154 37.0368H18.8144C18.129 37.0368 17.4977 37.4156 17.2091 38.0289C16.5959 39.2373 17.4616 40.6442 18.8144 40.6442H24.0451C26.2817 46.9391 32.2699 51.4663 39.3403 51.4663C42.4787 51.4663 45.4007 50.5825 47.8898 49.0314C49.1343 48.2558 49.3688 46.5242 48.3227 45.4781C47.5651 44.7205 46.3927 44.6304 45.4909 45.2075C43.7052 46.3258 41.613 46.9571 39.3403 46.9571Z" fill="#452C88" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
              -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
              -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('lang.admins')</span></h6>
                  <h5 style="color: #E45F00;">{{ $clientsCount ?? $clientsCount}}</h5>
                </div>
                <div>
                  <svg width="70" height="71" viewBox="0 0 70 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35.6431" r="35" fill="#452C88" fill-opacity="0.3" />
                    <path d="M45.5005 30.3705C46.2701 30.3705 46.9745 29.9822 47.4913 29.3546C48.0396 28.6886 48.3789 27.7581 48.3789 26.7211C48.3789 25.636 48.2707 24.67 47.8489 24.0234C47.4654 23.4355 46.754 23.0717 45.5005 23.0717C44.247 23.0717 43.5356 23.4355 43.1521 24.0234C42.7303 24.67 42.6222 25.636 42.6222 26.7211C42.6222 27.7581 42.9615 28.6886 43.5098 29.3547C44.0265 29.9823 44.731 30.3705 45.5005 30.3705ZM48.5906 30.2586C47.807 31.2104 46.715 31.7991 45.5005 31.7991C44.286 31.7991 43.1941 31.2104 42.4105 30.2587C41.6587 29.3455 41.1936 28.0941 41.1936 26.7211C41.1936 25.3964 41.3495 24.1804 41.9579 23.2477C42.6045 22.2564 43.6896 21.6431 45.5005 21.6431C47.3114 21.6431 48.3964 22.2564 49.0431 23.2477C49.6515 24.1804 49.8075 25.3964 49.8075 26.7211C49.8075 28.0941 49.3424 29.3455 48.5906 30.2586Z" fill="#452C88" />
                    <path d="M51.567 38.7643C51.5361 36.8098 51.406 35.5719 50.8469 34.8053C50.3361 34.1048 49.3755 33.6976 47.685 33.366C47.3006 33.6655 46.5827 34.0681 45.5008 34.0681C44.4187 34.0681 43.7007 33.6654 43.3163 33.366C42.2276 33.5796 41.4417 33.8247 40.8835 34.1595C41.07 33.6035 41.1905 33.0245 41.2449 32.4395C41.8481 32.2269 42.5615 32.0536 43.4077 31.9009L43.8237 31.8258L44.0885 32.1548C44.0897 32.1562 44.4675 32.6395 45.5008 32.6395C46.5339 32.6395 46.9117 32.1562 46.9128 32.1548L47.1776 31.8258L47.5937 31.9009C49.8842 32.3144 51.2013 32.8778 51.9965 33.9683C52.7772 35.0387 52.9546 36.4982 52.9901 38.742L52.9917 38.8402C52.9959 39.1 53.0001 39.3572 53.0001 39.3703L52.9163 39.7023C52.9128 39.7091 51.7212 42.0984 45.5008 42.0984C45.2778 42.0984 45.0621 42.095 44.8518 42.0891C44.753 41.5897 44.6175 41.1033 44.4303 40.6463C44.7653 40.6614 45.1214 40.6698 45.5008 40.6698C49.9672 40.6698 51.2632 39.5369 51.5712 39.1593C51.5708 38.9909 51.5697 38.9276 51.5686 38.8626L51.567 38.7643Z" fill="#452C88" />
                    <path d="M35.501 35.7717C36.4794 35.7717 37.373 35.2807 38.0266 34.4868C38.7119 33.6545 39.1358 32.4943 39.1358 31.2037C39.1358 29.8649 38.9998 28.6692 38.4695 27.8564C37.9776 27.1022 37.0771 26.6356 35.501 26.6356C33.9249 26.6356 33.0244 27.1022 32.5325 27.8564C32.0023 28.6692 31.8664 29.8648 31.8664 31.2037C31.8664 32.4944 32.2902 33.6545 32.9755 34.4868C33.6291 35.2807 34.5226 35.7717 35.501 35.7717ZM39.1259 35.3908C38.2054 36.5088 36.9243 37.2003 35.501 37.2003C34.0777 37.2003 32.7966 36.5088 31.8762 35.3909C30.9875 34.3114 30.4377 32.8304 30.4377 31.2037C30.4377 29.6252 30.6215 28.1797 31.3383 27.0807C32.0933 25.9231 33.3674 25.207 35.501 25.207C37.6345 25.207 38.9086 25.9231 39.6637 27.0807C40.3805 28.1796 40.5643 29.6252 40.5643 31.2037C40.5643 32.8304 40.0146 34.3114 39.1259 35.3908Z" fill="#452C88" />
                    <path d="M42.9939 45.6748C42.9559 43.2783 42.7935 41.7565 42.0934 40.7966C41.4428 39.9045 40.2342 39.3941 38.1064 38.9823C37.6778 39.3315 36.8248 39.8419 35.5007 39.8419C34.1764 39.8419 33.3233 39.3315 32.8947 38.9823C30.7901 39.3897 29.5845 39.8939 28.929 40.7688C28.2272 41.7056 28.0537 43.1849 28.0103 45.5096L28.0086 45.596C28.0055 45.7643 28.0026 45.9162 28.0017 46.2045C28.3461 46.6509 29.9103 48.1341 35.5007 48.1341C41.091 48.1341 42.6552 46.6508 42.9995 46.2044C42.9989 45.9892 42.9974 45.8938 42.9958 45.7982L42.9938 45.6748L42.9939 45.6748ZM43.243 39.9595C44.1646 41.2233 44.3744 42.9668 44.4169 45.6525L44.4189 45.7759C44.4237 46.0709 44.4284 46.3594 44.4284 46.4107L44.3447 46.7427C44.3404 46.7507 42.9385 49.5628 35.5007 49.5628C28.0626 49.5628 26.6607 46.7507 26.6565 46.7427L26.5728 46.4107C26.5728 46.2519 26.5788 45.9347 26.5856 45.5737L26.5873 45.4873C26.6363 42.8638 26.8613 41.1555 27.7906 39.915C28.7306 38.6603 30.2923 38.0038 32.9934 37.5162L33.4085 37.4413L33.6742 37.7701C33.6757 37.772 34.1773 38.4133 35.5007 38.4133C36.8238 38.4133 37.3254 37.772 37.3269 37.7701L37.5926 37.4413L38.0077 37.5162C40.74 38.0094 42.3067 38.6757 43.243 39.9595Z" fill="#452C88" />
                    <path d="M25.4993 30.3705C24.7298 30.3705 24.0253 29.9822 23.5086 29.3546C22.9602 28.6886 22.621 27.7581 22.621 26.7211C22.621 25.636 22.7292 24.67 23.1509 24.0234C23.5345 23.4355 24.2459 23.0717 25.4993 23.0717C26.7529 23.0717 27.4643 23.4355 27.8478 24.0234C28.2695 24.67 28.3777 25.636 28.3777 26.7211C28.3777 27.7581 28.0384 28.6886 27.4901 29.3547C26.9734 29.9823 26.2689 30.3705 25.4993 30.3705ZM22.4093 30.2586C23.1929 31.2104 24.2849 31.7991 25.4993 31.7991C26.7138 31.7991 27.8058 31.2104 28.5894 30.2587C29.3412 29.3455 29.8063 28.0941 29.8063 26.7211C29.8063 25.3964 29.6503 24.1804 29.042 23.2477C28.3953 22.2564 27.3103 21.6431 25.4993 21.6431C23.6885 21.6431 22.6035 22.2564 21.9568 23.2477C21.3484 24.1804 21.1924 25.3964 21.1924 26.7211C21.1924 28.0941 21.6575 29.3455 22.4093 30.2586Z" fill="#452C88" />
                    <path d="M19.433 38.7643C19.464 36.8098 19.5941 35.5719 20.1531 34.8053C20.664 34.1048 21.6245 33.6976 23.315 33.366C23.6994 33.6655 24.4174 34.0681 25.4993 34.0681C26.5814 34.0681 27.2994 33.6654 27.6838 33.366C28.7725 33.5796 29.5584 33.8247 30.1165 34.1595C29.93 33.6035 29.8096 33.0245 29.7552 32.4395C29.1519 32.2269 28.4386 32.0536 27.5923 31.9009L27.1763 31.8258L26.9115 32.1548C26.9104 32.1562 26.5326 32.6395 25.4993 32.6395C24.4662 32.6395 24.0883 32.1562 24.0872 32.1548L23.8224 31.8258L23.4064 31.9009C21.1158 32.3144 19.7988 32.8778 19.0035 33.9683C18.2229 35.0387 18.0455 36.4982 18.01 38.742L18.0084 38.8402C18.0042 39.1 18 39.3572 18 39.3703L18.0837 39.7023C18.0873 39.7091 19.2789 42.0984 25.4993 42.0984C25.7222 42.0984 25.938 42.095 26.1482 42.0891C26.247 41.5897 26.3826 41.1033 26.5698 40.6463C26.2348 40.6614 25.8787 40.6698 25.4993 40.6698C21.0329 40.6698 19.7369 39.5369 19.4288 39.1593C19.4293 38.9909 19.4304 38.9276 19.4314 38.8626L19.433 38.7643Z" fill="#452C88" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('lang.users')</span></h6>
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
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('Total Quotations')</span></h6>
                  <h5 style="color: #E45F00;">{{ $totalQuotion ?? $totalRoutes}}</h5>
                </div>
                <div>
                  <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                    <path d="M39.477 49.5H24.875C22.4618 49.5 20.5 47.5382 20.5 45.125C20.5 42.7118 22.4618 40.75 24.875 40.75H37.125C40.5025 40.75 43.25 38.0025 43.25 34.625C43.25 31.2475 40.5025 28.5 37.125 28.5H28.6183C27.934 29.8492 27.0993 31.0253 26.2488 32H37.125C38.5723 32 39.75 33.1777 39.75 34.625C39.75 36.0723 38.5723 37.25 37.125 37.25H24.875C20.5333 37.25 17 40.7833 17 45.125C17 49.4667 20.5333 53 24.875 53H41.6628C40.863 51.9885 40.1 50.8177 39.477 49.5ZM22.25 18C19.3555 18 17 20.3555 17 23.25C17 28.829 22.25 32 22.25 32C22.25 32 27.5 28.8273 27.5 23.25C27.5 20.3555 25.1445 18 22.25 18ZM22.25 25.875C20.801 25.875 19.625 24.699 19.625 23.25C19.625 21.801 20.801 20.625 22.25 20.625C23.699 20.625 24.875 21.801 24.875 23.25C24.875 24.699 23.699 25.875 22.25 25.875Z" fill="#452C88" />
                    <path d="M46.75 39C43.8555 39 41.5 41.3555 41.5 44.25C41.5 49.829 46.75 53 46.75 53C46.75 53 52 49.8273 52 44.25C52 41.3555 49.6445 39 46.75 39ZM46.75 46.875C45.301 46.875 44.125 45.699 44.125 44.25C44.125 42.801 45.301 41.625 46.75 41.625C48.199 41.625 49.375 42.801 49.375 44.25C49.375 45.699 48.199 46.875 46.75 46.875Z" fill="#452C88" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
              -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
              -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('lang.completed_contracts')</span></h6>
                  <h5 style="color: #E45F00;">{{ $completedContract ?? $completedContract}}</h5>
                </div>
                <div>
                  <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                    <path d="M45.3636 46.0455C46.7973 46.0455 47.9545 44.8882 47.9545 43.4545C47.9545 42.0209 46.7973 40.8636 45.3636 40.8636C43.93 40.8636 42.7727 42.0209 42.7727 43.4545C42.7727 44.8882 43.93 46.0455 45.3636 46.0455ZM47.9545 30.5H43.6364V34.8182H51.34L47.9545 30.5ZM24.6364 46.0455C26.07 46.0455 27.2273 44.8882 27.2273 43.4545C27.2273 42.0209 26.07 40.8636 24.6364 40.8636C23.2027 40.8636 22.0455 42.0209 22.0455 43.4545C22.0455 44.8882 23.2027 46.0455 24.6364 46.0455ZM48.8182 27.9091L54 34.8182V43.4545H50.5455C50.5455 46.3218 48.2309 48.6364 45.3636 48.6364C42.4964 48.6364 40.1818 46.3218 40.1818 43.4545H29.8182C29.8182 46.3218 27.5036 48.6364 24.6364 48.6364C21.7691 48.6364 19.4545 46.3218 19.4545 43.4545H16V24.4545C16 22.5373 17.5373 21 19.4545 21H43.6364V27.9091H48.8182ZM19.4545 24.4545V40H20.7673C21.7173 38.9464 23.0991 38.2727 24.6364 38.2727C26.1736 38.2727 27.5555 38.9464 28.5055 40H40.1818V24.4545H19.4545ZM22.9091 32.2273L25.5 29.6364L28.0909 32.2273L34.1364 26.1818L36.7273 28.7727L28.0909 37.4091L22.9091 32.2273Z" fill="#452C88" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-4 col-sm-6 mb-2">
            <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex justify-content-between">
                <div>
                  <h6 style="color: #452C88;"><span>@lang('lang.total_invoices')</span></h6>
                  <h5 style="color: #E45F00;">{{ $totalInvoice ?? $totalInvoice}}</h5>
                </div>
                <div>
                  <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35.0001" r="35" fill="#452C88" fill-opacity="0.3" />
                    <path d="M44.4542 49.5292C43.1709 49.9084 41.6542 50.0834 39.8751 50.0834H31.1251C29.3459 50.0834 27.8292 49.9084 26.5459 49.5292C26.8667 45.7375 30.7605 42.7479 35.5001 42.7479C40.2396 42.7479 44.1334 45.7375 44.4542 49.5292Z" stroke="#452C88" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M39.8751 20.9167H31.1251C23.8334 20.9167 20.9167 23.8334 20.9167 31.1251V39.8751C20.9167 45.3876 22.5792 48.4063 26.5459 49.5292C26.8667 45.7376 30.7605 42.748 35.5001 42.748C40.2397 42.748 44.1334 45.7376 44.4542 49.5292C48.4209 48.4063 50.0834 45.3876 50.0834 39.8751V31.1251C50.0834 23.8334 47.1667 20.9167 39.8751 20.9167ZM35.5001 38.6646C32.6126 38.6646 30.2792 36.3168 30.2792 33.4293C30.2792 30.5418 32.6126 28.2084 35.5001 28.2084C38.3876 28.2084 40.7209 30.5418 40.7209 33.4293C40.7209 36.3168 38.3876 38.6646 35.5001 38.6646Z" stroke="#452C88" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M40.7207 33.4292C40.7207 36.3167 38.3874 38.6646 35.4999 38.6646C32.6124 38.6646 30.2791 36.3167 30.2791 33.4292C30.2791 30.5417 32.6124 28.2084 35.4999 28.2084C38.3874 28.2084 40.7207 30.5417 40.7207 33.4292Z" stroke="#452C88" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
            </div>
          </div>        
        </div>
        <div class="row mt-4">
          <div class="col-lg-12 col-xl-8 col-md-12">
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
              <div class="col-lg-4 col-md-4">
                <div class="prgrss-chart pb-4" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                  <p class="progress_para pt-2 mb-0">@lang('Quotations sent') </p>
                  <div class="mt-5">
                    <div class="d-flex justify-content-center">
                      <canvas id="canvas" class="progress_charts" style="position: relative;" ></canvas>
                    </div>
                    <span id="procent"></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="prgrss-chart pb-4" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                  <p class="progress_para pt-2 mb-0">@lang('lang.completed_contracts')</p>
                  <div class="mt-5">
                      <div class="d-flex justify-content-center">
                        <canvas id="canvas1" class="progress_charts" style="position: relative;" ></canvas>
                      </div>
                    <span id="procent1"></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="prgrss-chart pb-4" style="box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                  <p class="progress_para pt-2 mb-0">@lang('lang.invoices_sent') </p>
                  <div class="mt-5">
                    <div class="d-flex justify-content-center">
                      <canvas id="canvas2" class="progress_charts" style="position: relative;" ></canvas>
                    </div>
                    <span id="procent2"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4 text-right">
              <div class="offset-lg-5 col-lg-5 col-md-5">
                <div class="row">
                  <div class="col-lg-8 col-xl-8 col-sm-6 text-left text-lg-right text-xl-right text-sm-right">
                    <span class="text-muted font-weight-semibold">@lang('lang.previous_month'):</span>
                  </div>
                  <div class="col-lg-4 col-xl-4 col-sm-6">
                    <input type="month" class=" date-input" value="{{ date('Y-m') }}" id="monthPickerInput">
                  </div>
                  <!-- <b>{{ date('F, Y', strtotime('previous month')) }}</b>
                  <span style="border: 1px solid #ACADAE; cursor: pointer ;padding: 0px 6px;">
                    <i class="fa fa-caret-down"></i>
                  </span> -->
                </div>
              </div>
              <canvas id="Chart-Line" class="mb-2 admin-chart"></canvas>
            </div>
          </div>
          <div class="col-lg-12 col-xl-4 col-md-12">
            
            @include('aside')
          </div>
          <!-- <div class="row mt-4 ml-1">
            <div class="col-lg-6 bg-white px-0">
              
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
    
    drawChart("canvas", "procent",{{ $sentQuote_percent }});
    drawChart("canvas1", "procent1",{{ $compCT_percent }});
    drawChart("canvas2", "procent2",{{ $compINV_percent }});


    function drawChart(canvasId, spanId,percentage) {
        var can = document.getElementById(canvasId),
            spanProcent = document.getElementById(spanId),
            c = can.getContext('2d');

        var posX = can.width / 2,
            posY = can.height / 2,
            fps = 1000 / 200,
            procent = 0,
            oneProcent = 360 / 100,
            result = oneProcent * percentage;

        c.lineCap = 'round';
        arcMove();

        function arcMove() {
            var degrees = 0;
            var arcInterval = setInterval(function() {
                degrees += 1;
                c.clearRect(0, 0, can.width, can.height);
                procent = degrees / oneProcent;

                document.getElementById(spanId).innerHTML = procent.toFixed();

                c.beginPath();
                c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + 360));
                c.strokeStyle = '#ECEAF3';
                c.lineWidth = '15';
                c.stroke();

                c.beginPath();
                c.strokeStyle = '#452C88';
                c.lineWidth = '15';
                c.arc(posX, posY, 65, (Math.PI / 180) * 270, (Math.PI / 180) * (270 + degrees));
                c.stroke();

                if (degrees >= result) clearInterval(arcInterval);
            }, fps);
        }
    }

    // Function to make the AJAX call and update the charts
    function updateCharts(selectedDate, user_id) {
        var apiname = 'trip_charts';
        var apiurl = "{{ end_url('') }}" + apiname;  
        var bearerToken = "{{session('user')}}";

        $.ajax({
            url: apiurl + `?selected_date=${selectedDate}&id=${user_id}`,
            type: 'GET',
            data: {
                selected_date: selectedDate,
                id: user_id,
            },
            headers: {
                'Authorization': 'Bearer ' + bearerToken
            },
            contentType: false,
            processData: false,
            beforeSend: function() {
                // Add any loading or UI updates before the API call
            },
            success: function(response) {
                if (response.status === 'success') {
                    var data = response.data; // Access the 'data' object from the response
                    drawChart("canvas", "procent",data.actvTrp_percentage,true);
                    drawChart("canvas1", "procent1",data.compTrp_percentage,true);
                    drawChart("canvas2", "procent2",data.pendTrp_percentage,true);
                } else {
                    // Handle other status cases if needed
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:" +error);
            }
        });
    }

    // Bind the AJAX call to the date picker change event
    $('#datePickerInput').change(function () {
        var selectedDate = $(this).val();
        var user_id = "{{$user->id}}";
        updateCharts(selectedDate, user_id);
    });

</script>
<script>
  var ourLineChart = document.getElementById('Chart-Line').getContext('2d');
  var myChart = new Chart(ourLineChart, {
    type: 'line',
    data: {
      labels: ['1', '5', '10', '15', '20', '25', '30'],
      datasets: [{
          data: [50, 10, 30, 15, 25, 24, 50, 20],
          label: 'Line 1',
          fill: true,
          backgroundColor: "rgba(54, 100, 235, 0.2)",
          borderWidth: 3,
          borderColor: "#5C4B9D"
        },
        {
          data: [20, 35, 18, 28, 40, 12, 10],
          label: 'Line 2',
          fill: true,
          backgroundColor: "rgba(100, 99, 132, 0.2)",
          borderWidth: 3,
          borderColor: "#EAE7F1"
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>
<!-- content-wrapper ends -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/top_divs_chart.js"></script>
@include('charts')

@endsection