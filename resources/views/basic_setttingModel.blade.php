<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        float: right;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.default:checked+.slider {
        background-color: #444;
    }

    input.primary:checked+.slider {
        background-color: #2196F3;
    }

    input.success:checked+.slider {
        background-color: #8bc34a;
    }

    input.info:checked+.slider {
        background-color: #3de0f5;
    }

    input.warning:checked+.slider {
        background-color: #FFC107;
    }

    input.danger:checked+.slider {
        background-color: #f44336;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .custom-checkbox {
        min-height: 1rem;
        padding-left: 0;
        margin-right: 0;
        cursor: pointer;
    }

    .custom-checkbox .custom-control-indicator {
        content: "";
        display: inline-block;
        position: relative;
        width: 30px;
        height: 10px;
        background-color: #818181;
        border-radius: 15px;
        margin-right: 10px;
        -webkit-transition: background .3s ease;
        transition: background .3s ease;
        vertical-align: middle;
        margin: 0 16px;
        box-shadow: none;
    }

    .custom-checkbox .custom-control-indicator:after {
        content: "";
        position: absolute;
        display: inline-block;
        width: 18px;
        height: 18px;
        background-color: #f1f1f1;
        border-radius: 21px;
        box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
        left: -2px;
        top: -4px;
        -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
        transition: left .3s ease, background .3s ease, box-shadow .1s ease;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-indicator {
        background-color: #84c7c1;
        background-image: none;
        box-shadow: none !important;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-indicator:after {
        background-color: #84c7c1;
        left: 15px;
    }

    .custom-checkbox .custom-control-input:focus~.custom-control-indicator {
        box-shadow: none !important;
    }

    .label {
        margin-bottom: 0 !important;
    }
</style>
<div class="modal fade" id="services_modal" tabindex="-1" role="dialog" aria-labelledby="services_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #184A45FF; border-radius: 12px 12px 0px 0px;">
                <h5 class="modal-title mx-auto text-white" id="inovicedetaillable"><span>@lang('Add Basic Setting of Software')</span></h5>
                <button class="btn p-0 close-serviceModel" data-dismiss="modal">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.8403 6L6.84033 18M6.84033 6L18.8403 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-1">

                <div id="mdl-spinnerMail" class="d-none">
                    <div style="height:85vh" class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border  " role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div id="data-mailData" class="">
                    <form action="basicSettings" method="post" class="apiform">
                        <div class="container pt-5">
                            <div class="card mb-5">
                                <div class="card-header font-weight-bold text-uppercase fs-5 text-center">Choose Servies</div>
                                <div class="card-block  table-responsive p-0">
                                    <table class="table text-center table-bordered m-0">
                                        <thead class="table-dark ">
                                            <tr>
                                                <th>Select</th>
                                                <th>Name</th>
                                                <th>Service Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th colspan="4">
                                                    <button class="btn btn-default">Select Services For Qoutations</button>
                                                </th>
                                            </tr>
                                            @foreach($def_serv_q as $key => $val)
                                            <tr>
                                                <td>
                                                    <label class="custom-control custom-checkbox" style="margin: 0 !important;">
                                                        <input type="checkbox" name="services[]" value="{{ $val['id'] ?? '' }}" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $val['title'] ?? '' }}</td>
                                                <td>{{ $val['type'] ?? '' }}</td>
                                                <td class="text-success font-weight-bold">{{ ($val['status'] == 1) ? 'Active': 'Deactive' }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5">
                                                    <button class="btn btn-default">Select Services For Contracts</button>
                                                </th>
                                            </tr>
                                            @foreach($def_serv_c as $key => $val)
                                            <tr>
                                                <td>
                                                    <label class="custom-control custom-checkbox" style="margin: 0 !important;">
                                                        <input type="checkbox" name="services[]" value="{{ $val['id'] ?? '' }}" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $val['title'] ?? '' }}</td>
                                                <td>{{ $val['type'] ?? '' }}</td>
                                                <td class="text-success font-weight-bold">{{ ($val['status'] == 1) ? 'Active': 'Deactive' }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5">
                                                    <button class="btn btn-default">Select Services For Invoices</button>
                                                </th>
                                            </tr>

                                            @foreach($def_serv_i as $key => $val)
                                            <tr>
                                                <td>
                                                    <label class="custom-control custom-checkbox" style="margin: 0 !important;">
                                                        <input type="checkbox" name="services[]" value="{{ $val['id'] ?? '' }}" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $val['title'] ?? '' }}</td>
                                                <td>{{ $val['type'] ?? '' }}</td>
                                                <td class="text-success font-weight-bold">{{ ($val['status'] == 1) ? 'Active': 'Deactive' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">
                                                    <button class="btn btn-default btn-link">Approve All</button>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row ">
                                <div class="col-lg-6 mb-4 mt-5 mt-md-0">
                                    <div class="card">
                                        <!-- Default panel contents -->
                                        <div class="card-header font-weight-bold text-uppercase fs-5 text-center bg-black text-white">Choose Currencies</div>

                                        <ul class="list-group list-group-flush">
                                            @foreach($def_curn as $key => $val)
                                            <li class="list-group-item align-items-center ">
                                                {{$val['name'] ?? ''}}
                                                <label class="switch " style="margin: 0 !important;">
                                                    <input type="checkbox" name="currencies[]" value="{{ $val['id'] ?? '' }}" class="success">
                                                    <span class="slider"></span>
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4 mt-5 mt-md-0">
                                    <div class="card">
                                        <div class="card-header font-weight-bold text-uppercase fs-5 text-center bg-black text-white "> Choose Locations </div>
                                        <ul class="list-group list-group-flush">
                                            @foreach($def_loca as $key => $val)
                                            <li class="list-group-item">
                                                {{$val['name'] ?? ''}}
                                                <label class="switch " style="margin: 0 !important;">
                                                    <input type="checkbox" name="loactions[]" value="{{ $val['id'] ?? '' }}" class="success">
                                                    <span class="slider round"></span>
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="row justify-content-end mt-2  ">
                                    <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                        <button data-dismiss="modal" id="btn_skipp_setting" class="btn btn-block btn-primary text-white close-serviceModel" style="border-radius: 8px;">
                                            <span id="text">@lang('Skip Now')</span>
                                        </button>
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                        <button type="submit" id="btn_save_setting" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                                            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                            <span id="text">@lang("Save Setting's")</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>