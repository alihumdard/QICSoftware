@extends('layouts.main')
@section('main-section')
@php
$temp_status = config('constants.TEMP_STATUS');
@endphp
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
          <span>@lang('Transactional Settings ')</span>
        </h3>

        <div class="container" id="home">
          <form action="invoiceStore" id="formData" method="post">
            <div class="row">
              @csrf
              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-1" class="mt-1" class="form-label" for="client_name">@lang('Transactional Email')</label>
                <input required type="email" maxlength="100" name="client_name" id="client_name" value="{{ $data['client_name'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                <span id="client_name_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-1" for="client_name">@lang('Transactional Password')</label>
                <input required type="text" maxlength="100" name="client_name" id="client_name" value="{{ $data['client_name'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                <span id="client_name_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-1" for="client_name">@lang('Mail Port')</label>
                <input required type="text" maxlength="100" name="client_name" id="client_name" value="{{ $data['client_name'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                <span id="client_name_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-1" for="client_name">@lang('Mail Host')</label>
                <input required type="text" maxlength="100" name="client_name" id="client_name" value="{{ $data['client_name'] ?? '' }}" placeholder="@lang('lang.client_name')" class="form-control">
                <span id="client_name_error" class="error-message text-danger"></span>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="mt-1" for="client_name">@lang('Mail Encryption')</label>
                <select id="mail_encryption" name="mail_encryption" class="form-select">
                  <option value="ssl">SSL</option>
                  <option value="tsl">TSL</option>
                </select>
                <span id="client_name_error" class="error-message text-danger"></span>
              </div>

              <div class="mt-3">
                <div class="row justify-content-end mt-2  ">

                  <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                    <button type="submit" id="btn_save_quotation" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                      <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                      <span id="text">@lang('Save')</span>
                    </button>
                  </div>
                </div>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection