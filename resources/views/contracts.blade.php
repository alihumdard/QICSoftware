@extends('layouts.main')

@section('main-section')
@php
$qouteStatus = config('constants.QUOTE_STATUS');
$qouteStatus_trans = config('constants.QUOTE_STATUS_' . app()->getLocale());
@endphp
<!-- partial -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3YWssMkDiW3F1noE6AVbiJEL40MR0IFU&libraries=places"></script>
<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5.46997 9C7.40297 9 8.96997 7.433 8.96997 5.5C8.96997 3.567 7.40297 2 5.46997 2C3.53697 2 1.96997 3.567 1.96997 5.5C1.96997 7.433 3.53697 9 5.46997 9Z" stroke="white" stroke-width="1.5" />
              <path d="M16.97 15H19.97C21.07 15 21.97 15.9 21.97 17V20C21.97 21.1 21.07 22 19.97 22H16.97C15.87 22 14.97 21.1 14.97 20V17C14.97 15.9 15.87 15 16.97 15Z" stroke="white" stroke-width="1.5" />
              <path d="M11.9999 5H14.6799C16.5299 5 17.3899 7.29 15.9999 8.51L8.00995 15.5C6.61995 16.71 7.47994 19 9.31994 19H11.9999" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M5.48622 5.5H5.49777" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M18.4862 18.5H18.4978" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span>@lang('lang.contracts')</span>
        </h3>
        <div class="row mb-2">
          <!-- <div class="col-lg-4"></div> -->
          <div class="col-lg-12">
            <div class="row mx-1">
              <div class="col-lg-6 col-md-12 col-sm-12 my-2 pr-0" style="text-align: right;">
                <a>
                  <button class="btn content-background add-btn text-white"><span><i class=" fa-regular fa-file-lines"></i> @lang('Create Contracts')</span></button>
                </a>
                <a href="{{ route('add_contract') }}">
                  <button class="btn add-btn text-white" style="background-color: #E95C20FF;"><span><i class="fa fa-plus"></i> @lang('Add Contracts')</span></button>
                </a>
              </div>
              <div class="col-lg-3  col-md-6 col-sm-12 pr-0 my-2">
                <div class="input-group">
                  <div class="input-group-prepend d-none d-md-block d-sm-block d-lg-block">
                    <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                      <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.56221 14.0648C7.58971 14.3147 7.52097 14.5814 7.36287 14.7563C7.29927 14.8336 7.22373 14.8949 7.14058 14.9367C7.05742 14.9785 6.96827 15 6.87825 15C6.78822 15 6.69907 14.9785 6.61592 14.9367C6.53276 14.8949 6.45722 14.8336 6.39363 14.7563L3.63713 11.4151C3.56216 11.3263 3.50516 11.2176 3.47057 11.0977C3.43599 10.9777 3.42477 10.8496 3.43779 10.7235V6.45746L0.145116 1.34982C0.0334875 1.17612 -0.0168817 0.955919 0.005015 0.737342C0.0269117 0.518764 0.119294 0.319579 0.261975 0.183308C0.392582 0.0666576 0.536937 0 0.688166 0H10.3118C10.4631 0 10.6074 0.0666576 10.738 0.183308C10.8807 0.319579 10.9731 0.518764 10.995 0.737342C11.0169 0.955919 10.9665 1.17612 10.8549 1.34982L7.56221 6.45746V14.0648ZM2.09047 1.66644L4.81259 5.88254V10.4819L6.1874 12.1484V5.8742L8.90953 1.66644H2.09047Z" fill="#323C47" />
                      </svg>
                    </div>
                  </div>
                  <select name="filter_by_loc" id="filter_by_loc" class="form-select select-group">
                    <option value="">
                      @lang('Filter By Locations')
                    </option>
                    @foreach($location as $key => $value)
                    <option value="{{$value}}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 pr-0 my-2">
                <div class="input-group">
                  <div class="input-group-prepend d-none d-md-block d-sm-block d-lg-block">
                    <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                      <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.56221 14.0648C7.58971 14.3147 7.52097 14.5814 7.36287 14.7563C7.29927 14.8336 7.22373 14.8949 7.14058 14.9367C7.05742 14.9785 6.96827 15 6.87825 15C6.78822 15 6.69907 14.9785 6.61592 14.9367C6.53276 14.8949 6.45722 14.8336 6.39363 14.7563L3.63713 11.4151C3.56216 11.3263 3.50516 11.2176 3.47057 11.0977C3.43599 10.9777 3.42477 10.8496 3.43779 10.7235V6.45746L0.145116 1.34982C0.0334875 1.17612 -0.0168817 0.955919 0.005015 0.737342C0.0269117 0.518764 0.119294 0.319579 0.261975 0.183308C0.392582 0.0666576 0.536937 0 0.688166 0H10.3118C10.4631 0 10.6074 0.0666576 10.738 0.183308C10.8807 0.319579 10.9731 0.518764 10.995 0.737342C11.0169 0.955919 10.9665 1.17612 10.8549 1.34982L7.56221 6.45746V14.0648ZM2.09047 1.66644L4.81259 5.88254V10.4819L6.1874 12.1484V5.8742L8.90953 1.66644H2.09047Z" fill="#323C47" />
                      </svg>
                    </div>
                  </div>
                  <select name="filter_by_sts" id="filter_by_sts_routes" class="form-select select-group">
                    <option value="">
                      @lang('lang.filter_by_status')
                    </option>
                    @foreach($qouteStatus_trans as $key => $value)
                    <option value="{{$value}}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="px-2">
          <div class="table-responsive">
            <table id="qoute-table" class="display" style="width:100%">
              <thead class="table-dark" style="background-color: #184A45;">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th>@lang('Start Date')</th>
                  <th>@lang('End Date')</th>
                  @if(isset($user->role) && $user->role == user_roles('1'))
                  <th>@lang('Admin Name')</th>
                  @endif
                  @if(isset($user->role) && ($user->role == user_roles('1') || $user->role == user_roles('2')))
                  <th>@lang('User Name')</th>
                  @endif
                  <th>@lang('lang.client_name')</th>
                  <th>@lang('Location')</th>
                  <th>@lang('Amount')</th>
                  <th>@lang('Categoies')</th>
                  <th>@lang('Contract Status')</th>
                  <th>@lang('lang.actions')</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach($contracts as $key => $value)

                <tr style="font-size: small;">
                  <td>{{ ++$key }}</td>
                  <td>{{ date('M d, Y', strtotime($value['start_date']))}}</td>
                  <td>{{ date('M d, Y', strtotime($value['end_date']))}}</td>
                  @if(isset($user->role) && $user->role == user_roles('1'))
                  <td>{{ $value['admin_name'] ?? ''}} </td>
                  @endif
                  @if(isset($user->role) && ($user->role == user_roles('1') || $user->role == user_roles('2')))
                  <td>{{ $value['user_name'] ?? ''}} </td>
                  @endif
                  <td>{{ $value['client_name'] ?? '' }}</td>
                  <td>{{ $value['location']['name'] ?? ''}}</td>
                  <td>{{ $value['amount'].' ('.$value['currency']['code'].') ' ?? '' }}</td>
                  <td>{{ $value['service']['service_title'] ?? '' }}</td>
                  <td>
                    <button class="btn btn_status_c">
                      @if ($value['status'] == $qouteStatus['In Progress'])
                      <span data-contract_id="{{$value['id']}}">
                        <div class="bg-info text-white f-w-bold rounded-1" data-toggle="modal" data-target="#contract_sts_modal" style="width: 100%; height: 100%; padding-top: 7px; padding-bottom: 7px; padding-left: 12px; padding-right: 13px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center; font-size: 14px; font-weight:700; word-wrap: break-word">{{$qouteStatus_trans[$value['status']]}}</div>
                        </div>
                      </span>
                      @elseif ($value['status'] == $qouteStatus['Pending'])
                      <span data-contract_id="{{$value['id']}}">
                        <div class="bg-secondary text-white f-w-bold rounded-1 " style="width: 100%; height: 100%; padding-top: 7px; padding-bottom: 7px; padding-left: 23px; padding-right: 23px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center;  font-size: 14px; font-weight: 700; word-wrap: break-word">{{$qouteStatus_trans[$value['status']]}}</div>
                        </div>
                      </span>
                      @elseif ($value['status'] == $qouteStatus['Completed'])
                      <span data-contract_id="{{$value['id']}}">
                        <div class="bg-success text-white f-w-bold rounded-1" style="width: 100%; height: 100%; padding-top: 7px; padding-bottom: 7px; padding-left: 15px; padding-right: 13px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="font-size: 14px; font-weight: 700; word-wrap: break-word">{{$qouteStatus_trans[$value['status']]}}</div>
                        </div>
                      </span>
                      @elseif ($value['status'] == $qouteStatus['Deleted'])
                      <span data-contract_id="{{$value['id']}}">
                        <div class="bg-danger text-white f-w-bold rounded-1" style="width: 100%; height: 100%; padding-top: 7px; padding-bottom: 7px; padding-left: 25px; padding-right: 25px;   justify-content: center; align-items: center; display: inline-flex">
                          <div style="text-align: center; font-size: 14px; font-weight: 700; word-wrap: break-word">{{$qouteStatus_trans[$value['status']]}}</div>
                        </div>
                      </span>
                      @endif
                    </button>
                  </td>


                  <td class="">
                    <div class="d-flex my-auto">

                      @if($value['status'] == $qouteStatus['Pending'])
                      <form method="POST" action="/add_contract" class="mb-0">
                        @csrf
                        <input type="hidden" name="id" value="{{$value['id']}}">
                        <button id="btn_edit_announcement" class="btn p-0">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
                          </svg>
                        </button>
                      </form>
                      @endif
                      <a href="{{ asset('storage/'.$value['file']) }}" download="Contract{{$value['id']}}_for_{{$value['client_name']}}">

                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
                          <path d="M23.2857 12.8571V12H20.7143V16.2857H21.5714V14.5714H22.8572V13.7143H21.5714V12.8571H23.2857Z" fill="#452C88" />
                          <path d="M21.5715 21.4285V23.1428H14.7143V21.4285H13.8571V23.1428C13.8571 23.3701 13.9475 23.5881 14.1082 23.7489C14.2689 23.9096 14.487 23.9999 14.7143 23.9999H21.5715C21.7988 23.9999 22.0168 23.9096 22.1776 23.7489C22.3383 23.5881 22.4286 23.3701 22.4286 23.1428V21.4285H21.5715Z" fill="#452C88" />
                          <path d="M20.2857 20.1428L19.6797 19.5368L18.5714 20.6451V17.1428H17.7143V20.6451L16.606 19.5368L16 20.1428L18.1429 22.2857L20.2857 20.1428Z" fill="#452C88" />
                          <path d="M18.5715 16.2857H16.8572V12H18.5715C18.9123 12.0004 19.2392 12.136 19.4802 12.377C19.7212 12.618 19.8568 12.9448 19.8572 13.2857V15C19.8568 15.3409 19.7212 15.6677 19.4802 15.9087C19.2392 16.1498 18.9123 16.2854 18.5715 16.2857ZM17.7143 15.4286H18.5715C18.6851 15.4285 18.794 15.3833 18.8744 15.3029C18.9547 15.2226 18.9999 15.1136 19 15V13.2857C18.9999 13.1721 18.9547 13.0632 18.8744 12.9828C18.794 12.9025 18.6851 12.8573 18.5715 12.8571H17.7143V15.4286Z" fill="#452C88" />
                          <path d="M15.1429 12H13V16.2857H13.8571V15H15.1429C15.3701 14.9997 15.5879 14.9093 15.7486 14.7486C15.9093 14.5879 15.9997 14.3701 16 14.1429V12.8571C15.9998 12.6299 15.9094 12.412 15.7487 12.2513C15.588 12.0907 15.3701 12.0003 15.1429 12ZM13.8571 14.1429V12.8571H15.1429L15.1433 14.1429H13.8571Z" fill="#452C88" />
                        </svg>
                      </a>

                      <button data-id="{{ $value['id'] }}" data-role="{{ $user->role}}" id="contractDetail_btn" class="btn p-0 contractDetail_view" data-toggle="modal" data-target="#contractdetail">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z" fill="black" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<!-- Quote Status Modal -->
<div class="modal fade" id="contract_sts_modal" tabindex="-1" aria-labelledby="contract_Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-white" style="border-radius: 10px;">
      <div class="modal-header pb-0" style="border: none;">
        <h5 class="modal-title" id="user_stsLabel"></h5>
        <button type="button" id="closeicon" class="close" data-bs-dismiss="modal" aria-label="Close">
          <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>

      <form id="formData" method="post" action="contractStatus">
        <input type="hidden" id="contract_id" name="id">
        <div class="modal-body pt-0">
          <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="4" width="48" height="48" rx="24" fill="#D1FADF" />
            <path d="M23.5 28L26.5 31L32.5 25M38 28C38 33.5228 33.5228 38 28 38C22.4772 38 18 33.5228 18 28C18 22.4772 22.4772 18 28 18C33.5228 18 38 22.4772 38 28Z" stroke="#039855" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#ECFDF3" stroke-width="8" />
          </svg>
          <select name="status" id="status" class="form-select mt-3">
            <option disabled selected> select status </option>
            @foreach($qouteStatus_trans as $key => $value)
            <option value="{{$key}}">{{ $value }}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm text-white px-5" id="change_sts" type="submit" style="background-color: #233A85; border-radius: 8px;">
            <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
            <span id="add_btn">@lang('lang.ok')</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Quote Status Modal End -->

@if($user->role == user_roles('1'))
<script>
  var users_table = $('#qoute-table').DataTable({});

  $('#filter_by_sts_routes').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(9).search(selectedStatus).draw();
  });

  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(6).search(selectedLocation).draw();
  });
</script>
@elseif($user->role == user_roles('2'))
<script>
  var users_table = $('#qoute-table').DataTable();
  $('#filter_by_sts_routes').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(8).search(selectedStatus).draw();
  });
  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(5).search(selectedLocation).draw();
  });
</script>
@elseif($user->role == user_roles('3'))
<script>
  var users_table = $('#qoute-table').DataTable();
  $('#filter_by_sts_routes').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(7).search(selectedStatus).draw();
  });
  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(4).search(selectedLocation).draw();
  });
</script>
@endif
<script>
  $(document).on('click', '.btn_status_c', function() {
    var id = $(this).find('span').attr('data-contract_id');
    $('#contract_id').val(id);
    $('#contract_sts_modal').modal('show');
  });

  function downloadPDF() {
    // Create a link element
    var link = document.createElement('a');

    // Set the link's attributes
    link.href = pdfUrl;
    link.target = '_blank';
    link.download = 'pdf_templates.pdf';

    // Simulate a click on the link to trigger the download
    link.click();
  }
</script>
@include('contractdetail_modal')

@endsection