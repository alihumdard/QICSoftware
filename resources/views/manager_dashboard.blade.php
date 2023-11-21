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

  .border-left-primary {
    border-left: 4px solid #007bff !important;
  }

  .border-left-success {
    border-left: 4px solid #28a745 !important;
  }

  .border-left-info {
    border-left: 4px solid #17a2b8 !important;
  }

  .border-left-warning {
    border-left: 4px solid #ffc107 !important;
  }

  .bg-theme {
    background-color: #184A45FF !important;
  }
</style>
@php
$tripStatus = config('constants.TRIP_STATUS');
$tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
$quote_status = config('constants.QUOTE_STATUS_' . app()->getLocale());
@endphp

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
        <span>@lang('Manager Dashboard')</span>
      </h3>
    </div>
  </div>

  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card  border-left-primary shadow h-100 py-1">
        <div class="card-body" style="border: none !important;">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Earnings </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-1">
        <div class="card-body" style="border: none !important;">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Super Admins</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">215,00</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-1">
        <div class="card-body" style="border: none !important;">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Ac.
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-1">
        <div class="card-body" style="border: none !important;">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">1807</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->

  <div class="row ">
    <!-- Area Chart -->
    <!-- <div class="col-sm-12 ">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div> -->

    <div class=" col-xl-6 col-lg-6 mb-4">
      <div class="card shadow mb-4 h-100 ">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Rolse Statistics</h6>
        </div>
        <div class="card-body">

          <h4 class="small font-weight-bold">Inactive Super Admin <span class="float-right">80%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <h4 class="small font-weight-bold">Active Admins <span class="float-right">Complete!</span></h4>
          <div class="progress mb-3">
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <h4 class="small font-weight-bold">Inactive Admins <span class="float-right">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <h4 class="small font-weight-bold">Active Users <span class="float-right">40%</span></h4>
          <div class="progress mb-3">
            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <h4 class="small font-weight-bold">Inactive Users <span class="float-right">80%</span></h4>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>


        </div>
      </div>
    </div>
    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6 mb-4">
      <div class="card shadow mb-4 h-100 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Software Sources</h6>
          <!-- <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div> -->
        </div>
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="qic_PieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Quotations
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Contracts
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Invoices
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- Page level plugins -->
<!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->

<script src=" {{ asset('assets/js/demo/chart-area-demo.js')}}"></script>
<script src=" {{ asset('assets/js/demo/chart-pie-demo.js')}}"></script>

@include('charts')
@endsection