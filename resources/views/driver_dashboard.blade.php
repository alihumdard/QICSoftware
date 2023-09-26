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

    .table-scroll::-webkit-scrollbar-track {
        display: none;
    }
</style>
@php
$tripStatus = config('constants.TRIP_STATUS');
$tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
@endphp
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
                <div class="col-lg-12 col-xl-4 mb-3">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 style="color: #452C88;"><span>@lang('Total Quotations')</span></h6>
                                <h5 style="color: #E45F00;">{{ $totalQuotion ?? '' }}</h5>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 384 512">
                                    <circle cx="35" cy="35" r="35" fill="#452C88" fill-opacity="0.3" />
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" fill="#27ae60" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4 mb-3">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 style="color: #452C88;"><span>@lang('Total Contracts')</span></h6>
                                <h5 style="color: #E45F00;">{{ $totalContract ?? ''}}</h5>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 576 512">
                                    <path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384v38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM288 368a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm211.3-43.3c-6.2-6.2-16.4-6.2-22.6 0L416 385.4l-28.7-28.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l40 40c6.2 6.2 16.4 6.2 22.6 0l72-72c6.2-6.2 6.2-16.4 0-22.6z" fill="#3498db" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4 mb-3">
                    <div class=" bg-white p-3" style="border-radius: 20px; box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);
                            -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 style="color: #452C88;"><span>@lang('Total Invoices')</span></h6>
                                <h5 style="color: #E45F00;">{{ $totalInvoice ?? ''}}</h5>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="4em" viewBox="0 0 384 512">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm54.2 253.8c-6.1 20.3-24.8 34.2-46 34.2H80c-8.8 0-16-7.2-16-16s7.2-16 16-16h8.2c7.1 0 13.3-4.6 15.3-11.4l14.9-49.5c3.4-11.3 13.8-19.1 25.6-19.1s22.2 7.7 25.6 19.1l11.6 38.6c7.4-6.2 16.8-9.7 26.8-9.7c15.9 0 30.4 9 37.5 23.2l4.4 8.8H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-6.1 0-11.6-3.4-14.3-8.8l-8.8-17.7c-1.7-3.4-5.1-5.5-8.8-5.5s-7.2 2.1-8.8 5.5l-8.8 17.7c-2.9 5.9-9.2 9.4-15.7 8.8s-12.1-5.1-13.9-11.3L144 349l-9.8 32.8z" fill="#e0218a" />
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
                                <b>@lang('Closed Contracts')</b>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-scroll bg-white mt-2" style="height: 350px; overflow: auto; border-radius: 15px; box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25); 
                            -webkit-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);
                            -moz-box-shadow: 0px 0px 3px 0.75px rgba(0,0,0,0.25);">
                        <table class="table">
                            <thead style="background-color: #E9EAEF;">
                                <tr>
                                    <th>@lang('Start date')</th>
                                    <th>@lang('End date')</th>
                                    <th>@lang('Client name')</th>
                                    <th>@lang('Ammount')</th>
                                    <th>@lang('Location')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($completedCOT_detail as $key => $value)
                                <tr>
                                    <td>{{ $value['start_date'] ?? ''}}</td>
                                    <td>{{ $value['end_date'] ?? ''}}</td>
                                    <td class="text-wrap">{{ $value['client_name'] ?? ''}}</td>
                                    <td class="text-wrap">{{ $value['amount'] ?? ''}}</td>
                                    <td class="text-wrap">{{ $value['location'] ?? ''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xl-4 mt-4">
                    <h5>@lang('Today Quotations')</h5>
                    @include('aside')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection