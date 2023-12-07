@php
use App\Models\User;
$user = null;
if (session()->has('user_details')) {
$user_id = session('user_details')->id;
$user = User::find($user_id);
$notifications = NULL;
}
@endphp

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
  <title>TSP CRM</title>
  @include('layouts.scripts')
  <style>
    * {
      scrollbar-width: thin;
      scrollbar-color: #452C85 #F5F5F5;
    }

    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #ffffff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 1;
      transition: opacity 0.5s ease;
    }

    .preloader .spinner {
      width: 50px;
      height: 50px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    .modal-backdrop {
      /* z-index: 1 !important; */
      display: none;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }


    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.2);
      }

      100% {
        transform: scale(1);
      }
    }


    @keyframes fadeOut {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }

    ::-webkit-scrollbar {
      width: 5px;
    }

    ::-webkit-scrollbar:horizontal {
      height: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #452C85;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
      background-color: #FFFFF5;
    }

    ::-webkit-scrollbar-track:horizontal {
      display: none;
    }

    ::-webkit-scrollbar-horizontal {
      display: none;
    }

    .version {
      position: absolute;
      bottom: 0;
      left: 6rem;
    }

    .dismiss-btn {
      background-color: #233A85;
      color: #FFFFFF;
      border-radius: 10px;
      box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
      -webkit-box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
      -moz-box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
    }

    .dismiss-btn:hover {
      background-color: #233A85;
      color: #FFFFFF;
      border-radius: 10px;
    }

    body {
      zoom: 90%;
    }

    .menu-acitve {
      background-color: #C0C0C0 !important;
    }
  </style>
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"> -->
  <!-- <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script> -->
</head>

<body style="background-color: #F5F5F5;">
  <div class="preloader">
    <div class="spinner"></div>
  </div>
  <div class="sidebar">
    <div class="navbar-brand brand-logo d-none mx-5 px-2 mb-2" id="logo-full-img">
      <img src="assets/images/Logo.svg" alt="logo">
    </div>
    <div class="navbar-brand brand-logo mb-2 mx-2" id="logo-img">
      <img src="assets/images/scooble.svg" style="width: 100%; " alt="logo">
    </div>
    <div class="logo_details py-2" style="border-top: 1px solid #FFFFFF45; border-bottom: 1px solid #FFFFFF45;">
      <!-- <i class="bx bxl-audible icon"></i> -->
      <div class="pl-3 pr-2" id="profile_img">
        <img style="border-radius: 12px !important; object-fit: cover; width: 45px; height: 45px;" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : 'assets/images/user.png'}}" alt="profile">
      </div>
      <div class="logo_name d-none" id="logo-name">
        <div class="nav-profile-text d-flex flex-column text-wrap">
          <span class="mb-1" style="font-size: small;">{{(isset($user->name)) ? $user->name : 'Guest'}}</span>
          <span class="text-secondary text-white text-small">
            {{ $user->role ?? 'Guest'}}
          </span>
        </div>
      </div>
    </div>
    <ul class="nav-list pl-0 sidebar_list">
      @if(view_permission('index'))
      <li>
        <a href="{{ route('dashboard') }}" class="{{(request()->routeIs('dashboard')) ? 'menu-acitve' : ''}}">
          <i class="mt-3 ml-3">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M15.317 0H12.3519C11.115 0 10.1237 1.035 10.1237 2.3049V5.373C10.1237 6.65099 11.115 7.67699 12.3519 7.67699H15.317C16.5452 7.67699 17.5452 6.65099 17.5452 5.373V2.3049C17.5452 1.035 16.5452 0 15.317 0ZM2.22823 1.7589e-05H5.19336C6.43029 1.7589e-05 7.42159 1.03502 7.42159 2.30492V5.37301C7.42159 6.65101 6.43029 7.67701 5.19336 7.67701H2.22823C1.00007 7.67701 0 6.65101 0 5.37301V2.30492C0 1.03502 1.00007 1.7589e-05 2.22823 1.7589e-05ZM2.22823 10.3229H5.19336C6.43029 10.3229 7.42159 11.3498 7.42159 12.6278V15.6959C7.42159 16.9649 6.43029 17.9999 5.19336 17.9999H2.22823C1.00007 17.9999 0 16.9649 0 15.6959V12.6278C0 11.3498 1.00007 10.3229 2.22823 10.3229ZM12.3519 10.3229H15.317C16.5452 10.3229 17.5452 11.3498 17.5452 12.6278V15.6959C17.5452 16.9649 16.5452 17.9999 15.317 17.9999H12.3519C11.115 17.9999 10.1237 16.9649 10.1237 15.6959V12.6278C10.1237 11.3498 11.115 10.3229 12.3519 10.3229Z" fill="white" />
            </svg>
          </i>
          <span class="link_name">@lang('lang.dashboard')</span>
        </a>
      </li>
      @endif

      @if(view_permission('quotations'))
      <li>
        <a href="{{ route('quotations') }}" class="{{(request()->routeIs(['quotations','add_quotation','create_quotation'])) ? 'menu-acitve' : ''}}">
          <i class="ml-3 fa-regular fa-file-lines"></i>
          <span class="link_name">@lang('lang.quotations')</span>
        </a>
      </li>
      @endif

      @if(view_permission('contracts'))
      <li>
        <a href="{{ route('contracts') }}" class="{{(request()->routeIs(['contracts','add_contract'])) ? 'menu-acitve' : ''}}">
          <i class="ml-3 fa-solid fa-file-signature" style="color: #fefffa;"></i>
          <span class="link_name">@lang('lang.contracts')</span>
        </a>
      </li>
      @endif

      @if(view_permission('invoices'))
      <li>
        <a href="{{ route('invoices') }}" class="{{(request()->routeIs(['invoices', 'add_invoice'])) ? 'menu-acitve' : ''}}">
          <i class=" ml-3 fa-solid fa-receipt"></i>
          <span class="link_name">@lang('lang.invoices')</span>
        </a>
      </li>
      @endif

      @if(view_permission('users'))
      <li>
        <a href="{{ route('users') }}" class="{{(request()->routeIs('users')) ? 'menu-acitve' : ''}}">
          <i class="mt-3 ml-3">
            <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.543 5.49893C17.0059 5.49893 17.4297 5.26539 17.7405 4.88785C18.0704 4.48718 18.2744 3.92745 18.2744 3.30369C18.2744 2.65093 18.2094 2.06985 17.9556 1.68087C17.7249 1.32719 17.297 1.1084 16.543 1.1084C15.7889 1.1084 15.361 1.32719 15.1303 1.68087C14.8766 2.06983 14.8115 2.65092 14.8115 3.30369C14.8115 3.92749 15.0156 4.48721 15.3455 4.88789C15.6563 5.26542 16.08 5.49893 16.543 5.49893ZM18.4018 5.43166C17.9304 6.00417 17.2735 6.35831 16.543 6.35831C15.8124 6.35831 15.1555 6.00419 14.6842 5.43169C14.2319 4.88236 13.9521 4.12961 13.9521 3.30368C13.9521 2.50677 14.046 1.77532 14.4119 1.21426C14.8009 0.617907 15.4536 0.249023 16.543 0.249023C17.6323 0.249023 18.285 0.617907 18.674 1.21426C19.04 1.77531 19.1338 2.50678 19.1338 3.30368C19.1338 4.12961 18.8541 4.88236 18.4018 5.43166Z" fill="white" />
              <path d="M20.1921 10.5484C20.1735 9.37262 20.0953 8.62797 19.759 8.16683C19.4517 7.74545 18.8738 7.50051 17.8569 7.301C17.6257 7.48115 17.1938 7.72338 16.543 7.72338C15.8921 7.72338 15.4602 7.48113 15.2289 7.30099C14.574 7.42949 14.1013 7.57695 13.7655 7.77833C13.8777 7.44388 13.9502 7.09561 13.9829 6.74368C14.3458 6.61578 14.7748 6.51157 15.2839 6.41968L15.5342 6.37451L15.6935 6.57242C15.6941 6.57324 15.9214 6.864 16.543 6.864C17.1644 6.864 17.3917 6.57324 17.3924 6.57242L17.5517 6.37451L17.802 6.41968C19.1798 6.6684 19.9721 7.00734 20.4505 7.6633C20.9201 8.3072 21.0268 9.18518 21.0482 10.5349L21.0491 10.594C21.0516 10.7503 21.0542 10.905 21.0542 10.9129L21.0038 11.1126C21.0016 11.1167 20.2849 12.554 16.543 12.554C16.4089 12.554 16.2791 12.5519 16.1526 12.5484C16.0932 12.2479 16.0116 11.9553 15.8991 11.6804C16.1006 11.6896 16.3148 11.6946 16.543 11.6946C19.2297 11.6946 20.0093 11.0131 20.1947 10.7859C20.1944 10.6847 20.1937 10.6466 20.1931 10.6074L20.1921 10.5484Z" fill="white" />
              <path d="M10.5277 8.74822C11.1163 8.74822 11.6538 8.45283 12.047 7.97526C12.4592 7.47459 12.7142 6.77673 12.7142 6.00032C12.7142 5.19497 12.6324 4.47575 12.3134 3.98677C12.0175 3.53307 11.4758 3.25243 10.5277 3.25243C9.57961 3.25243 9.03792 3.53307 8.74201 3.98677C8.42307 4.47574 8.34131 5.19495 8.34131 6.00032C8.34131 6.77674 8.5963 7.47464 9.00851 7.9753C9.40166 8.45284 9.93917 8.74822 10.5277 8.74822ZM12.7083 8.51907C12.1546 9.19163 11.3839 9.6076 10.5277 9.6076C9.67151 9.6076 8.90089 9.19163 8.34721 8.51912C7.81263 7.86979 7.48193 6.97887 7.48193 6.00033C7.48193 5.05083 7.59246 4.18125 8.02365 3.52017C8.47784 2.8238 9.24426 2.39307 10.5277 2.39307C11.8111 2.39307 12.5775 2.8238 13.0318 3.52017C13.463 4.18123 13.5736 5.05083 13.5736 6.00033C13.5736 6.97887 13.2429 7.86975 12.7083 8.51907Z" fill="white" />
              <path d="M15.0351 14.7053C15.0122 13.2637 14.9145 12.3483 14.4934 11.7708C14.102 11.2342 13.375 10.9271 12.095 10.6794C11.8372 10.8895 11.3241 11.1965 10.5275 11.1965C9.73091 11.1965 9.21776 10.8895 8.95992 10.6794C7.69393 10.9245 6.96868 11.2278 6.57437 11.7541C6.15221 12.3176 6.04786 13.2075 6.02172 14.6059L6.02074 14.6579C6.01882 14.7591 6.01709 14.8505 6.01654 15.0239C6.22372 15.2925 7.16469 16.1847 10.5275 16.1847C13.8904 16.1847 14.8313 15.2924 15.0384 15.0239C15.0381 14.8944 15.0372 14.837 15.0362 14.7795L15.035 14.7053L15.0351 14.7053ZM15.1849 11.2673C15.7393 12.0275 15.8655 13.0763 15.8911 14.6919L15.8923 14.7661C15.8952 14.9436 15.898 15.1171 15.898 15.1479L15.8476 15.3477C15.8451 15.3525 15.0018 17.0441 10.5275 17.0441C6.05318 17.0441 5.2099 15.3525 5.20735 15.3477L5.15698 15.1479C5.15698 15.0524 5.16061 14.8617 5.16474 14.6445L5.16572 14.5925C5.1952 13.0144 5.33056 11.9867 5.88958 11.2405C6.45505 10.4857 7.39449 10.0908 9.01931 9.79753L9.26902 9.75244L9.42886 9.95027C9.42973 9.95136 9.73147 10.3372 10.5275 10.3372C11.3235 10.3372 11.6252 9.95136 11.6261 9.95027L11.7859 9.75244L12.0356 9.79753C13.6792 10.0942 14.6217 10.495 15.1849 11.2673Z" fill="white" />
              <path d="M4.51125 5.49893C4.04834 5.49893 3.62457 5.26539 3.31373 4.88785C2.98386 4.48718 2.77978 3.92745 2.77978 3.30369C2.77978 2.65093 2.84485 2.06985 3.09858 1.68087C3.32928 1.32719 3.75723 1.1084 4.51125 1.1084C5.26532 1.1084 5.69326 1.32719 5.92396 1.68087C6.17766 2.06983 6.24269 2.65092 6.24269 3.30369C6.24269 3.92749 6.03863 4.48721 5.70877 4.88789C5.39794 5.26542 4.97419 5.49893 4.51125 5.49893ZM2.65243 5.43166C3.1238 6.00417 3.78069 6.35831 4.51125 6.35831C5.24183 6.35831 5.89871 6.00419 6.37007 5.43169C6.82232 4.88236 7.10208 4.12961 7.10208 3.30368C7.10208 2.50677 7.00827 1.77532 6.64232 1.21426C6.25333 0.617907 5.60065 0.249023 4.51125 0.249023C3.42192 0.249023 2.76923 0.617907 2.38023 1.21426C2.01425 1.77531 1.92041 2.50678 1.92041 3.30368C1.92041 4.12961 2.20017 4.88236 2.65243 5.43166Z" fill="white" />
              <path d="M0.862034 10.5484C0.880637 9.37262 0.958902 8.62797 1.29521 8.16683C1.60251 7.74545 2.18033 7.50051 3.19724 7.301C3.42848 7.48115 3.86034 7.72338 4.51118 7.72338C5.16211 7.72338 5.59401 7.48113 5.82526 7.30099C6.48014 7.42949 6.95292 7.57695 7.28867 7.77833C7.17648 7.44388 7.10402 7.09561 7.07128 6.74368C6.70841 6.61578 6.27933 6.51157 5.77025 6.41968L5.52001 6.37451L5.3607 6.57242C5.36004 6.57324 5.13276 6.864 4.51118 6.864C3.88972 6.864 3.66243 6.57324 3.66176 6.57242L3.50247 6.37451L3.25222 6.41968C1.87432 6.6684 1.08207 7.00734 0.603678 7.6633C0.134089 8.3072 0.0273576 9.18518 0.00601073 10.5349L0.00505904 10.594C0.00252157 10.7503 0 10.905 0 10.9129L0.0503685 11.1126C0.0525253 11.1167 0.769295 12.554 4.51117 12.554C4.64529 12.554 4.77508 12.5519 4.90155 12.5484C4.96099 12.2479 5.04253 11.9553 5.15512 11.6804C4.9536 11.6896 4.73942 11.6946 4.51118 11.6946C1.82444 11.6946 1.04483 11.0131 0.859517 10.7859C0.859803 10.6847 0.860437 10.6466 0.861072 10.6074L0.862034 10.5484Z" fill="white" />
            </svg>
          </i>
          <span class="link_name">@lang('lang.users')</span>
        </a>
      </li>
      @endif

      @if(view_permission('admins'))
      <li>
        <a href="{{ route('admins') }}" class="{{(request()->routeIs('admins')) ? 'menu-acitve' : ''}}">
          <i class="mt-3 ml-3">
            <svg width="15" height="22" viewBox="0 0 15 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.71206 18.615H6.60217V14.7249C4.55965 14.9507 2.93787 16.5725 2.71206 18.615ZM7.58141 14.7249V18.615H11.4715C11.2457 16.5725 9.62393 14.9507 7.58141 14.7249ZM11.4716 19.5942C11.4032 20.2135 11.2066 20.7934 10.9092 21.3076L11.7568 21.7979C12.2154 21.0052 12.4776 20.0848 12.4776 19.1046C12.4776 16.1301 10.0663 13.7188 7.09179 13.7188C4.11728 13.7188 1.70593 16.1301 1.70593 19.1046C1.70593 20.0848 1.96822 21.0052 2.42676 21.7979L3.27439 21.3076C2.97695 20.7934 2.78041 20.2135 2.71201 19.5942H11.4716Z" fill="white" />
              <path d="M8.56067 19.1046C8.56067 19.9159 7.90305 20.5735 7.0918 20.5735C6.28054 20.5735 5.62292 19.9159 5.62292 19.1046C5.62292 18.2934 6.28054 17.6357 7.0918 17.6357C7.90305 17.6357 8.56067 18.2934 8.56067 19.1046Z" fill="white" />
              <path d="M10.8053 17.5596C10.6654 17.0372 10.9754 16.5003 11.4978 16.3603L12.4437 16.1069C12.966 15.9669 13.503 16.2769 13.643 16.7993L14.1499 18.691C14.2898 19.2135 13.9799 19.7504 13.4575 19.8904L12.5116 20.1438C11.9892 20.2838 11.4522 19.9738 11.3122 19.4514L10.8053 17.5596Z" fill="white" />
              <path d="M0.540498 16.7993C0.680482 16.2769 1.21745 15.9669 1.73983 16.1069L2.68574 16.3603C3.20811 16.5003 3.51814 17.0372 3.37816 17.5596L2.87125 19.4514C2.73127 19.9738 2.1943 20.2838 1.67192 20.1439L0.726066 19.8904C0.203648 19.7504 -0.106367 19.2135 0.0336111 18.691L0.540498 16.7993Z" fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.6853 7.84338V6.37451H3.66455V7.84338C3.66455 9.73627 5.19903 11.2707 7.09192 11.2707C8.9848 11.2707 10.5193 9.73627 10.5193 7.84338V6.37451H11.4985V7.84338C11.4985 10.2771 9.52564 12.25 7.09192 12.25C4.65819 12.25 2.6853 10.2771 2.6853 7.84338Z" fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.09484 4.90545H12.1101C12.1453 4.81561 12.1833 4.7097 12.2212 4.58847L12.2271 4.56952C12.3592 4.14683 12.4776 3.76755 12.4776 2.99434C12.4776 2.60225 12.2229 2.27209 11.8857 2.01103C11.544 1.74654 11.0774 1.52009 10.5577 1.33551C9.51685 0.965858 8.20417 0.743652 7.09179 0.743652C5.97942 0.743652 4.66674 0.965858 3.62589 1.33551C3.10616 1.52009 2.63955 1.74654 2.29789 2.01103C1.96068 2.27209 1.70593 2.60225 1.70593 2.99434C1.70593 3.71216 1.82599 4.09047 1.94932 4.47924C1.96083 4.51547 1.97234 4.55175 1.98379 4.58842C2.02164 4.70965 2.05964 4.81556 2.09484 4.90545ZM5.1333 3.43658C5.1333 3.16617 5.3525 2.94696 5.62292 2.94696H8.56066C8.83108 2.94696 9.05029 3.16617 9.05029 3.43658C9.05029 3.70699 8.83108 3.92621 8.56066 3.92621H5.62292C5.3525 3.92621 5.1333 3.70699 5.1333 3.43658Z" fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.20602 6.0858C2.22825 5.96937 2.33484 5.88477 2.45925 5.88477H11.7243C11.8487 5.88477 11.9553 5.96937 11.9775 6.0858L11.9776 6.08639L11.9778 6.08698L11.978 6.0884L11.9786 6.09173L11.98 6.10064C11.9811 6.10754 11.9822 6.11641 11.9834 6.12703C11.9856 6.14833 11.9877 6.17692 11.988 6.21174C11.9886 6.28141 11.9821 6.37674 11.9557 6.48901C11.9024 6.71595 11.7693 7.00444 11.4645 7.2848C10.8603 7.84062 9.61882 8.33288 7.09178 8.33288C4.56473 8.33288 3.32329 7.84062 2.71905 7.2848C2.41426 7.00444 2.28118 6.71595 2.22781 6.48901C2.20142 6.37674 2.19501 6.28141 2.19559 6.21174C2.19589 6.17692 2.19794 6.14833 2.20019 6.12703C2.20132 6.11641 2.2025 6.10754 2.20352 6.10064L2.20494 6.09173L2.20553 6.0884L2.20578 6.08698L2.20592 6.08639L2.20602 6.0858Z" fill="white" />
            </svg>
          </i>
          <span class="link_name">@lang('lang.admins')</span>
        </a>
      </li>
      @endif

      @if(view_permission('super_admins'))
      <li>
        <a href="{{ route('superAdmins') }}" class="{{(request()->routeIs('superAdmins')) ? 'menu-acitve' : ''}}">
          <i class="mt-3 ml-3">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18.1401 21.62C17.2601 21.88 16.2201 22 15.0001 22H9.00011C7.78011 22 6.74011 21.88 5.86011 21.62C6.08011 19.02 8.75011 16.97 12.0001 16.97C15.2501 16.97 17.9201 19.02 18.1401 21.62Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M15 2H9C4 2 2 4 2 9V15C2 18.78 3.14 20.85 5.86 21.62C6.08 19.02 8.75 16.97 12 16.97C15.25 16.97 17.92 19.02 18.14 21.62C20.86 20.85 22 18.78 22 15V9C22 4 20 2 15 2ZM12 14.17C10.02 14.17 8.42 12.56 8.42 10.58C8.42 8.60002 10.02 7 12 7C13.98 7 15.58 8.60002 15.58 10.58C15.58 12.56 13.98 14.17 12 14.17Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M15.5799 10.58C15.5799 12.56 13.9799 14.17 11.9999 14.17C10.0199 14.17 8.41992 12.56 8.41992 10.58C8.41992 8.60002 10.0199 7 11.9999 7C13.9799 7 15.5799 8.60002 15.5799 10.58Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </i>
          <span class="link_name">@lang('lang.super_admins')</span>
        </a>
      </li>
      @endif

      @if(view_permission('revenue'))
      <li>
        <a href="{{ route('revenue') }}" class="{{(request()->routeIs('revenue')) ? 'menu-acitve' : ''}}">
          <i class="ml-3 fas fa-coins"></i>
          <span class="link_name">@lang('Revenue')</span>
        </a>
      </li>
      @endif

      @if(view_permission('currencies'))
      <li>
        <a href="{{ route('currencies') }}" class="{{(request()->routeIs('currencies')) ? 'menu-acitve' : ''}}">
          <i class=" ml-3 fas fa-money-bill"></i>
          <span class="link_name">@lang('Currencies')</span>
        </a>
      </li>
      @endif

      @if(view_permission('locations'))
      <li>
        <a href="{{ route('locations') }}" class="{{(request()->routeIs('locations')) ? 'menu-acitve' : ''}}">
          <i class=" ml-3 fas fa-map-marker-alt"></i>
          <span class="link_name">@lang('Locations')</span>
        </a>
      </li>
      @endif

      @if(view_permission('services'))
      <li>
        <a href="{{ route('services') }}" class="{{(request()->routeIs('services')) ? 'menu-acitve' : ''}}">
          <i class=" ml-3 fas fa-people-arrows"></i>
          <span class="link_name">@lang('Services')</span>
        </a>
      </li>
      @endif

      @if(view_permission('transactional'))
      <li>
        <a href="{{ route('transactional') }}" class="{{(request()->routeIs('transactional')) ? 'menu-acitve' : ''}}">
          <i class=" ml-3 fa-solid fa-envelope-open-text"></i>
          <span class="link_name">@lang('Transactional')</span>
        </a>
      </li>
      @endif

      @if(view_permission('settings'))
      <li>
        <a href="{{ route('settings') }}" class="{{(request()->routeIs('settings')) ? 'menu-acitve' : ''}} scroll-item">
          <i class="mt-3 ml-3">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.4023 13.5801C20.76 13.7701 21.036 14.0701 21.2301 14.3701C21.6083 14.9901 21.5776 15.7501 21.2097 16.4201L20.4943 17.6201C20.1162 18.2601 19.411 18.6601 18.6855 18.6601C18.3278 18.6601 17.9292 18.5601 17.6022 18.3601C17.3365 18.1901 17.0299 18.1301 16.7029 18.1301C15.6911 18.1301 14.8429 18.9601 14.8122 19.9501C14.8122 21.1001 13.872 22.0001 12.6968 22.0001H11.3069C10.1215 22.0001 9.18125 21.1001 9.18125 19.9501C9.16081 18.9601 8.31259 18.1301 7.30085 18.1301C6.96361 18.1301 6.65702 18.1901 6.40153 18.3601C6.0745 18.5601 5.66572 18.6601 5.31825 18.6601C4.58245 18.6601 3.87729 18.2601 3.49917 17.6201L2.79402 16.4201C2.4159 15.7701 2.39546 14.9901 2.77358 14.3701C2.93709 14.0701 3.24368 13.7701 3.59115 13.5801C3.87729 13.4401 4.06125 13.2101 4.23498 12.9401C4.74596 12.0801 4.43937 10.9501 3.57071 10.4401C2.55897 9.87012 2.23194 8.60012 2.81446 7.61012L3.49917 6.43012C4.09191 5.44012 5.35913 5.09012 6.38109 5.67012C7.27019 6.15012 8.425 5.83012 8.9462 4.98012C9.10972 4.70012 9.20169 4.40012 9.18125 4.10012C9.16081 3.71012 9.27323 3.34012 9.4674 3.04012C9.84553 2.42012 10.5302 2.02012 11.2763 2.00012H12.7172C13.4735 2.00012 14.1582 2.42012 14.5363 3.04012C14.7203 3.34012 14.8429 3.71012 14.8122 4.10012C14.7918 4.40012 14.8838 4.70012 15.0473 4.98012C15.5685 5.83012 16.7233 6.15012 17.6226 5.67012C18.6344 5.09012 19.9118 5.44012 20.4943 6.43012L21.179 7.61012C21.7718 8.60012 21.4447 9.87012 20.4228 10.4401C19.5541 10.9501 19.2475 12.0801 19.7687 12.9401C19.9322 13.2101 20.1162 13.4401 20.4023 13.5801ZM9.10972 12.0101C9.10972 13.5801 10.4076 14.8301 12.0121 14.8301C13.6165 14.8301 14.8838 13.5801 14.8838 12.0101C14.8838 10.4401 13.6165 9.18012 12.0121 9.18012C10.4076 9.18012 9.10972 10.4401 9.10972 12.0101Z" fill="white" />
            </svg>
          </i>
          <span class="link_name">@lang('lang.settings')</span>
        </a>
        <!-- <span class="tooltip">@lang('lang.settings')</span> -->
      </li>
      @endif

      @if(view_permission('logout'))
      <div class="profile text-center mb-2">
        <a href="/logout">
          <!-- <span class="mx-auto text-white">
          @lang('lang.logout')
        </span>
        <i class="bx bx-log-out" id="log_out"></i> -->
          <div id="logout_icon" class="">
            <button class="btn" style="background-color: #FFFFFF;">
              <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.7907 5.75V3.375C13.7907 2.74511 13.5457 2.14102 13.1096 1.69562C12.6734 1.25022 12.0819 1 11.4651 1H3.32558C2.7088 1 2.11728 1.25022 1.68115 1.69562C1.24502 2.14102 1 2.74511 1 3.375V17.625C1 18.2549 1.24502 18.859 1.68115 19.3044C2.11728 19.7498 2.7088 20 3.32558 20H11.4651C12.0819 20 12.6734 19.7498 13.1096 19.3044C13.5457 18.859 13.7907 18.2549 13.7907 17.625V15.25" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.72095 10.5H21M21 10.5L17.5116 6.9375M21 10.5L17.5116 14.0625" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
          </div>
          <div class="mx-auto d-none" id="logout_btn">
            <button class="btn" style="background-color: #FFFFFF; width: 70%; height: 50px;">
              <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.7907 5.75V3.375C13.7907 2.74511 13.5457 2.14102 13.1096 1.69562C12.6734 1.25022 12.0819 1 11.4651 1H3.32558C2.7088 1 2.11728 1.25022 1.68115 1.69562C1.24502 2.14102 1 2.74511 1 3.375V17.625C1 18.2549 1.24502 18.859 1.68115 19.3044C2.11728 19.7498 2.7088 20 3.32558 20H11.4651C12.0819 20 12.6734 19.7498 13.1096 19.3044C13.5457 18.859 13.7907 18.2549 13.7907 17.625V15.25" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.72095 10.5H21M21 10.5L17.5116 6.9375M21 10.5L17.5116 14.0625" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span style="color: #452C88;">@lang('lang.logout')</span>
            </button>
          </div>
        </a>
      </div>
      @endif

      <div class="text-white text-center">
        <span>V 1.0.0</span>
      </div>

    </ul>
  </div>
  <section class="home-section">
    <i class="menu btn-menu-openClose open-btn-menu" id="btn" style=" cursor: pointer;  left: 63;">
      <!-- <svg width="40" height="50" id="open-icon" viewBox="0 0 15 39" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 5.19807C0 2.88825 2.50083 1.44493 4.50083 2.60048L13.5008 7.80048C14.4286 8.33651 15 9.32662 15 10.3981V28.6019C15 29.6734 14.4286 30.6635 13.5008 31.1995L4.50083 36.3995C2.50083 37.5551 0 36.1118 0 33.8019V5.19807Z" fill="#184A45FF" />
        <path d="M7.58929 16.638C7.5 16.5469 7.35714 16.5469 7.28571 16.638L6.92857 17.0026C6.83929 17.0755 6.83929 17.2214 6.92857 17.3125L8.66071 19.026L4.21429 19.026C4.10714 19.026 4 19.1172 4 19.2448L4 19.7552C4 19.8646 4.10714 19.974 4.21429 19.974L8.66071 19.974L6.92857 21.6693C6.83929 21.7604 6.83929 21.9062 6.92857 21.9792L7.28571 22.3437C7.35714 22.4349 7.5 22.4349 7.58929 22.3437L10.2321 19.6458C10.3214 19.5547 10.3214 19.4271 10.2321 19.3359L7.58929 16.638ZM11.0714 16.2187L11.0714 22.7812C11.0714 22.8906 11.1786 23 11.2857 23L11.7857 23C11.9107 23 12 22.8906 12 22.7812L12 16.2188C12 16.0911 11.9107 16 11.7857 16L11.2857 16C11.1786 16 11.0714 16.0911 11.0714 16.2187Z" fill="white" />
      </svg>
      <svg width="40" height="50" class="d-none close-btn-menu" id="close-icon" viewBox="0 0 15 37" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 3.21168C0 0.74256 2.50083 -0.800304 4.50083 0.434943L13.5008 5.99358C14.4286 6.56658 15 7.62497 15 8.77035L15 28.2296C15 29.375 14.4286 30.4334 13.5008 31.0064L4.50083 36.565C2.50083 37.8003 0 36.2575 0 33.7883L0 3.21168Z" fill="#184A45FF" />
        <path d="M7.41071 20.362C7.5 20.4531 7.64286 20.4531 7.71429 20.362L8.07143 19.9974C8.16071 19.9245 8.16071 19.7786 8.07143 19.6875L6.33929 17.974L10.7857 17.974C10.8929 17.974 11 17.8828 11 17.7552V17.2448C11 17.1354 10.8929 17.026 10.7857 17.026L6.33929 17.026L8.07143 15.3307C8.16071 15.2396 8.16071 15.0938 8.07143 15.0208L7.71429 14.6563C7.64286 14.5651 7.5 14.5651 7.41071 14.6563L4.7679 17.3542C4.6786 17.4453 4.6786 17.5729 4.7679 17.6641L7.41071 20.362ZM3.9286 20.7813L3.9286 14.2188C3.9286 14.1094 3.8214 14 3.7143 14H3.2143C3.0893 14 3 14.1094 3 14.2188L3 20.7812C3 20.9089 3.0893 21 3.2143 21H3.7143C3.8214 21 3.9286 20.9089 3.9286 20.7813Z" fill="white" />
      </svg> -->
    </i>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 row">
        <div class="navbar-menu-wrapper col-12 col-lg-12 col-sm-12 d-flex" style="background-color: #F5F5F5 !important; justify-content: flex-end;">
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item mx-1" style="">
              <form action="/lang_change" method="post">
                @csrf
                <select id="lang-select" class="form-select" style="font-size: 11px;" name="lang" onchange="this.form.submit()">
                  <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                  <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>Turkish</option>
                </select>
              </form>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <div class="nav-profile-image">
                  <button class="btn content-background btn-sm text-white">
                    <i class="fa fa-plus" style="font-size: 20px;"></i>
                  </button>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">


                @if(view_permission('quotations'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="{{ route('quotations') }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <i class="ml-3 fa-regular fa-file-lines"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.quotations')</p>
                  </div>
                </a>
                @endif

                @if(view_permission('contracts'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="{{ route('contracts') }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <i class=" ml-3  fa-solid fa-file-signature"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.contracts')</p>
                  </div>
                </a>
                @endif

                @if(view_permission('invoices'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="{{ route('invoices') }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <i class=" ml-3 fa-solid fa-receipt"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.invoices')</p>
                  </div>
                </a>
                @endif

                @if(view_permission('users'))
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="{{ '/users' }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon ml-2">
                      <svg width="40" height="32" viewBox="0 0 27 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15246 34.6808H12.5431V27.2902C8.66263 27.7192 5.58148 30.8003 5.15246 34.6808ZM14.4035 27.2902V34.6808H21.7942C21.3652 30.8003 18.284 27.7192 14.4035 27.2902ZM21.7943 36.5412C21.6643 37.7177 21.2909 38.8194 20.7258 39.7963L22.3362 40.7279C23.2074 39.2219 23.7057 37.4732 23.7057 35.611C23.7057 29.9599 19.1245 25.3787 13.4733 25.3787C7.82218 25.3787 3.24097 29.9599 3.24097 35.611C3.24097 37.4732 3.73928 39.2219 4.61043 40.7279L6.22082 39.7963C5.65571 38.8194 5.28232 37.7177 5.15237 36.5412H21.7943Z" fill="#452C88" />
                        <path d="M16.264 35.6108C16.264 37.1521 15.0146 38.4015 13.4734 38.4015C11.9321 38.4015 10.6827 37.1521 10.6827 35.6108C10.6827 34.0696 11.9321 32.8202 13.4734 32.8202C15.0146 32.8202 16.264 34.0696 16.264 35.6108Z" fill="#452C88" />
                        <path d="M20.5285 32.6761C20.2626 31.6836 20.8516 30.6635 21.844 30.3975L23.6411 29.916C24.6336 29.6501 25.6537 30.2391 25.9197 31.2315L26.8827 34.8256C27.1486 35.8182 26.5597 36.8382 25.5672 37.1042L23.7701 37.5857C22.7777 37.8516 21.7575 37.2627 21.4916 36.2701L20.5285 32.6761Z" fill="#452C88" />
                        <path d="M1.02687 31.2307C1.29282 30.2382 2.31298 29.6492 3.30543 29.9152L5.10251 30.3967C6.09496 30.6626 6.68397 31.6828 6.41802 32.6752L5.45497 36.2693C5.18902 37.2618 4.16886 37.8507 3.17641 37.5849L1.37942 37.1033C0.386901 36.8374 -0.202083 35.8173 0.0638563 34.8248L1.02687 31.2307Z" fill="#452C88" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10141 14.2159V11.4252H6.96184V14.2159C6.96184 17.8121 9.87713 20.7274 13.4733 20.7274C17.0696 20.7274 19.9848 17.8121 19.9848 14.2159V11.4252H21.8453V14.2159C21.8453 18.8396 18.0971 22.5878 13.4733 22.5878C8.84962 22.5878 5.10141 18.8396 5.10141 14.2159Z" fill="#452C88" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.97984 8.63467H23.0075C23.0744 8.46397 23.1465 8.26277 23.2184 8.03245L23.2297 7.99645C23.4806 7.1934 23.7057 6.47281 23.7057 5.00383C23.7057 4.25891 23.2217 3.63166 22.5811 3.13569C21.932 2.63319 21.0455 2.20297 20.058 1.85229C18.0806 1.15 15.5867 0.727844 13.4733 0.727844C11.36 0.727844 8.86607 1.15 6.88862 1.85229C5.9012 2.20297 5.0147 2.63319 4.3656 3.13569C3.72496 3.63166 3.24097 4.25891 3.24097 5.00383C3.24097 6.36758 3.46906 7.08632 3.70338 7.82492C3.72524 7.89375 3.7471 7.96268 3.76886 8.03235C3.84077 8.26268 3.91295 8.46388 3.97984 8.63467ZM9.75247 5.84402C9.75247 5.33029 10.1689 4.91381 10.6827 4.91381H16.264C16.7777 4.91381 17.1942 5.33029 17.1942 5.84402C17.1942 6.35776 16.7777 6.77424 16.264 6.77424H10.6827C10.1689 6.77424 9.75247 6.35776 9.75247 5.84402Z" fill="#452C88" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.19109 10.877C4.23332 10.6558 4.43583 10.4951 4.67219 10.4951H22.2745C22.5108 10.4951 22.7133 10.6558 22.7556 10.877L22.7558 10.8781L22.756 10.8792L22.7565 10.8819L22.7576 10.8883L22.7603 10.9052C22.7623 10.9183 22.7645 10.9351 22.7666 10.9553C22.7709 10.9958 22.7748 11.0501 22.7754 11.1163C22.7765 11.2486 22.7643 11.4297 22.7142 11.643C22.6128 12.0742 22.3599 12.6223 21.7809 13.1549C20.6329 14.2109 18.2743 15.1461 13.4733 15.1461C8.6723 15.1461 6.31374 14.2109 5.16576 13.1549C4.58671 12.6223 4.33387 12.0742 4.23248 11.643C4.18234 11.4297 4.17016 11.2486 4.17127 11.1163C4.17183 11.0501 4.17574 10.9958 4.18002 10.9553C4.18216 10.9351 4.18439 10.9183 4.18634 10.9052L4.18904 10.8883L4.19016 10.8819L4.19062 10.8792L4.1909 10.8781L4.19109 10.877Z" fill="#452C88" />
                      </svg>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.users')</p>
                  </div>
                </a>
                @endif

                <div class="dropdown-divider"></div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <div class="nav-profile-image" style="margin-top: 6px;">
                  <div class="preview-thumbnail">
                    <i class="" style="color:#67748E; position: relative;">
                      <svg width="25" height="25" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3158 0.315918C6.48571 0.315918 1.75945 5.04218 1.75945 10.8723V17.1812L0.515364 18.4252C0.0121758 18.9284 -0.138341 19.6851 0.133979 20.3426C0.406299 21.0001 1.04785 21.4287 1.75945 21.4287H22.8722C23.5839 21.4287 24.2253 21.0001 24.4977 20.3426C24.7701 19.6851 24.6195 18.9284 24.1163 18.4252L22.8722 17.1812V10.8723C22.8722 5.04218 18.1459 0.315918 12.3158 0.315918Z" fill="#67748E" />
                        <path d="M12.3163 28.4664C9.40122 28.4664 7.03809 26.1034 7.03809 23.1882H17.5945C17.5945 26.1034 15.2314 28.4664 12.3163 28.4664Z" fill="#67748E" />
                      </svg>
                    </i>
                    <span class="badge bg-danger text-white" style="position: absolute; top: 1.2rem; right: 0.1rem; border-radius: 50%;">{{ $count ?? 0 }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <div class="row pt-2">
                  <div class="col-lg-6">
                    <b class="ellipsis ml-1">@lang('lang.notifications')</b>
                  </div>
                  <div class="col-lg-6 text-right pr-4">
                    <form id="form-notification" method="post" action="notifications">
                      @csrf
                      <input type="hidden" name="all_read" value="all-read">
                      <p id="all-read" style="cursor:pointer; color: #ACADAE; font-size: small;">Mark all as read</p>
                    </form>
                  </div>

                  <script>
                    $('#all-read').on('click', function(e) {
                      e.preventDefault();
                      $('#form-notification').submit();
                    });
                  </script>
                  @if($notifications)
                  @foreach($notifications as $key => $value)
                  <a href="/notifications" style="text-decoration: none !important;">
                    <div class="dropdown-divider"></div>
                    <div class="p-2" style="width: 100%; height: 100%; background: rgba(69, 44, 136, 0.06); border-left: 3px solid #452C88;">
                      <div class="row">
                        <div class="col-lg-10">
                          <p style="font-size: 11px;" class="mb-0">{{$value['title']}}</p>
                        </div>
                        <div class="col-lg-2 p-1 text-center">
                          <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.93979 3.99943L7.8041 1.14179C7.92953 1.01635 8 0.846231 8 0.668843C8 0.491455 7.92953 0.321332 7.8041 0.1959C7.67867 0.0704672 7.50854 0 7.33116 0C7.15377 0 6.98365 0.0704672 6.85821 0.1959L4.00057 3.06021L1.14292 0.1959C1.01749 0.0704672 0.847368 -1.32164e-09 0.66998 0C0.492592 1.32165e-09 0.322469 0.0704672 0.197036 0.1959C0.0716041 0.321332 0.0011368 0.491455 0.0011368 0.668843C0.0011368 0.846231 0.0716041 1.01635 0.197036 1.14179L3.06134 3.99943L0.197036 6.85708C0.134602 6.919 0.0850471 6.99267 0.0512292 7.07385C0.0174113 7.15502 0 7.24208 0 7.33002C0 7.41795 0.0174113 7.50502 0.0512292 7.58619C0.0850471 7.66737 0.134602 7.74104 0.197036 7.80296C0.258961 7.8654 0.332634 7.91495 0.413807 7.94877C0.494979 7.98259 0.582045 8 0.66998 8C0.757915 8 0.844981 7.98259 0.926153 7.94877C1.00733 7.91495 1.081 7.8654 1.14292 7.80296L4.00057 4.93866L6.85821 7.80296C6.92014 7.8654 6.99381 7.91495 7.07498 7.94877C7.15616 7.98259 7.24322 8 7.33116 8C7.41909 8 7.50616 7.98259 7.58733 7.94877C7.6685 7.91495 7.74218 7.8654 7.8041 7.80296C7.86653 7.74104 7.91609 7.66737 7.94991 7.58619C7.98373 7.50502 8.00114 7.41795 8.00114 7.33002C8.00114 7.24208 7.98373 7.15502 7.94991 7.07385C7.91609 6.99267 7.86653 6.919 7.8041 6.85708L4.93979 3.99943Z" fill="#323C47" />
                          </svg>
                        </div>
                        <div class="col-lg-12">
                          <p style="font-size: 11px; color: #8F9090;" class="mb-0">{{ implode(' ', array_slice(explode(' ', $value['desc']), 0, 5)) }} ...</p>
                        </div>
                        <div class="col-lg-10">
                          <p style="font-size: 11px;" class="mb-0">{{table_date($value['created_at'])}}</p>
                        </div>
                        <div class="col-lg-2 p-1 text-center">
                          <svg width="13" height="3" viewBox="0 0 13 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="1.5" cy="1.5" r="1.5" fill="#452C88" />
                            <circle cx="6.5" cy="1.5" r="1.5" fill="#452C88" />
                            <circle cx="11.5" cy="1.5" r="1.5" fill="#452C88" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </a>
                  @endforeach
                  @endif

                  <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <div class="nav-profile-image">
                  <div class="preview-thumbnail">
                    <img style="border-radius: 50% !important; width: 30px;  height: 30px; object-fit: cover;" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : 'assets/images/user.png'}}" alt="profile">
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <img style="border-radius: 12px !important; object-fit: cover; width: 45px; height: 45px;" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : 'assets/images/user.png'}}" alt="profile">
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <div class="nav-profile-text d-flex flex-column text-wrap">
                      <span class="mb-1 text-dark mx-4" style="font-size: large; color: #452C85;">{{(isset($user->name)) ? $user->name : 'Guest'}}</span>
                      <span class="text-secondary mx-4 text-small">{{(isset($user->role)) ? $user->role : 'Guest'}}</span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="/settings">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25.5028 16.9751C25.9499 17.2126 26.2948 17.5876 26.5375 17.9626C27.0102 18.7376 26.9719 19.6876 26.512 20.5251L25.6178 22.0251C25.1451 22.8251 24.2637 23.3251 23.3567 23.3251C22.9096 23.3251 22.4114 23.2001 22.0026 22.9501C21.6705 22.7376 21.2872 22.6626 20.8785 22.6626C19.6138 22.6626 18.5535 23.7001 18.5152 24.9376C18.5152 26.3751 17.3399 27.5001 15.8709 27.5001H14.1335C12.6517 27.5001 11.4764 26.3751 11.4764 24.9376C11.4509 23.7001 10.3906 22.6626 9.12594 22.6626C8.70439 22.6626 8.32115 22.7376 8.00179 22.9501C7.59301 23.2001 7.08203 23.3251 6.6477 23.3251C5.72793 23.3251 4.8465 22.8251 4.37384 22.0251L3.4924 20.5251C3.01975 19.7126 2.9942 18.7376 3.46685 17.9626C3.67125 17.5876 4.05448 17.2126 4.48881 16.9751C4.8465 16.8001 5.07644 16.5126 5.2936 16.1751C5.93233 15.1001 5.54909 13.6876 4.46326 13.0501C3.19859 12.3376 2.78981 10.7501 3.51795 9.51262L4.37384 8.03762C5.11476 6.80012 6.69879 6.36262 7.97624 7.08762C9.08762 7.68762 10.5311 7.28762 11.1826 6.22512C11.387 5.87512 11.502 5.50012 11.4764 5.12512C11.4509 4.63762 11.5914 4.17512 11.8341 3.80012C12.3068 3.02512 13.1627 2.52512 14.0952 2.50012H15.8964C16.8417 2.50012 17.6976 3.02512 18.1703 3.80012C18.4002 4.17512 18.5535 4.63762 18.5152 5.12512C18.4896 5.50012 18.6046 5.87512 18.809 6.22512C19.4605 7.28762 20.904 7.68762 22.0282 7.08762C23.2928 6.36262 24.8896 6.80012 25.6178 8.03762L26.4737 9.51262C27.2146 10.7501 26.8058 12.3376 25.5284 13.0501C24.4425 13.6876 24.0593 15.1001 24.7108 16.1751C24.9152 16.5126 25.1451 16.8001 25.5028 16.9751ZM11.387 15.0126C11.387 16.9751 13.0094 18.5376 15.015 18.5376C17.0206 18.5376 18.6046 16.9751 18.6046 15.0126C18.6046 13.0501 17.0206 11.4751 15.015 11.4751C13.0094 11.4751 11.387 13.0501 11.387 15.0126Z" fill="#452C88" />
                      </svg>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.settings')</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="/logout">
                  <div class="preview-thumbnail">
                    <div class="preview-icon">
                      <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.3488 6.7V3.85C16.3488 3.09413 16.0548 2.36922 15.5315 1.83475C15.0081 1.30027 14.2983 1 13.5581 1H3.7907C3.05056 1 2.34073 1.30027 1.81738 1.83475C1.29402 2.36922 1 3.09413 1 3.85V20.95C1 21.7059 1.29402 22.4308 1.81738 22.9653C2.34073 23.4997 3.05056 23.8 3.7907 23.8H13.5581C14.2983 23.8 15.0081 23.4997 15.5315 22.9653C16.0548 22.4308 16.3488 21.7059 16.3488 20.95V18.1" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5.46542 12.4H25.0003M25.0003 12.4L20.8143 8.125M25.0003 12.4L20.8143 16.675" stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.logout')</p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->

      <!-- partial:partials/_sidebar.html -->
      <script>
        $(document).ready(function() {
          let activeMenuItem = $(document).find('.menu-acitve');
          if (activeMenuItem.length) {
            let position = activeMenuItem.offset().top - 80;
            $('.sidebar').animate({
              scrollTop: position
            }, 0);
          }
          // let selectedMenu = $(document).find('.menu-acitve');
          // if (selectedMenu.length) {
          //   let selectedPosit = selectedMenu.offset().top -80;
          //   alert(selectedPosit)
          //   $('.btn-menu-openClose').css('top', selectedPosit);
          // }
        });

        showPreloader();
        $(window).on('load', function() {
          hidePreloader();
        });

        function showPreloader() {
          $('.preloader').show(); // Show the preloader element
        }

        function hidePreloader() {
          $('.preloader').fadeOut('fast', function() {
            $(this).remove();
          });
        }

        window.onload = function() {
          const sidebar = document.querySelector(".sidebar");
          const closeBtn = document.querySelector(".btn-menu-openClose");
          const searchBtn = document.querySelector(".bx-search");

          // Initial check for screen size and adjust sidebar accordingly
          if (window.innerWidth >= 991) {
            sidebar.classList.add("open");
            setLargeScreenStyles();
          }

          closeBtn.addEventListener("click", function() {
            sidebar.classList.toggle("open");
            menuBtnChange();
          });

          function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
              setLargeScreenStyles();
            } else {
              setSmallScreenStyles();
            }
          }

          function setLargeScreenStyles() {
            sidebar.style.width = "250px";
            closeBtn.classList.replace("menu", "menu-alt-right");
            $('#logo-name').removeClass('d-none');
            $('#logo-full-img').removeClass('d-none');
            $('#logo-img').addClass('d-none');
            $('#profile_img').addClass('pl-5');
            $('#profile_img').removeClass('pl-3');
            $('#close-icon').removeClass('d-none');
            $('#open-icon').addClass('d-none');
            $('.btn-menu-openClose').css('left', 235);
            $('#logout_btn').addClass('d-block');
            $('#logout_btn').removeClass('d-none');
            $('#logout_icon').removeClass('d-block');
            $('#logout_icon').addClass('d-none');
            $('.content-wrapper').css('padding', '.75rem .2rem');
          }

          function setSmallScreenStyles() {
            sidebar.style.width = "78px";
            closeBtn.classList.replace("menu-alt-right", "menu");
            $('#logo-name').addClass('d-none');
            $('#logo-full-img').addClass('d-none');
            $('#logo-img').removeClass('d-none');
            $('#profile_img').addClass('pl-3');
            $('#profile_img').removeClass('pl-5');
            $('#close-icon').addClass('d-none');
            $('#open-icon').removeClass('d-none');
            $('.btn-menu-openClose').css('left', 63);
            $('.content-wrapper').css('padding', '.75rem .2rem');
            $('#logout_btn').removeClass('d-block');
            $('#logout_btn').addClass('d-none');
            $('#logout_icon').addClass('d-block');
          }

          // Listen for window resize events to update sidebar behavior
          window.addEventListener("resize", function() {
            if (window.innerWidth >= 991) {
              sidebar.classList.add("open");
              setLargeScreenStyles();
            } else {
              sidebar.classList.remove("open");
              setSmallScreenStyles();
            }
          });
        };
      </script>