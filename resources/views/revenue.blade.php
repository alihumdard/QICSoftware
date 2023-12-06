@extends('layouts.main')

@section('main-section')
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
          <span>@lang('Revenue')</span>
        </h3>

        <hr class="mt-3 mb-2">
        <div class="px-2">
          <div class="table-responsive">
            <div id="table_reload">
              <table id="revenue-table" class="display" style="width:100%">
                <thead class="text-white" style="background-color: #184A45;">
                  <tr style="font-size: small;">
                    <th>#</th>
                    <th> @lang('lang.date') </th>
                    <th> @lang('Amount') </th>
                    <th> @lang('Currency Code') </th>
                    <th> @lang('Currency Name') </th>
                    <th> @lang('Currency Type') </th>
                  </tr>
                </thead>
                <tbody id="tableData">
                  @foreach($data as $key => $value)
                  <tr style="font-size: small;">
                    <td><b>{{ $key + 1 }}</b></td>
                    <td><b>{{date('F, d Y')}}</b></td>
                    <td><b>{{ ($value['total_amount']) ? $value['total_amount'].'/-' :'' }}</b></td>
                    <td><b>{{ $value['code'] ?? ''}}</b></td>
                    <td><b>{{ $value['name'] ?? '' }}</b></td>
                    <td><b>{{ $value['type'] ?? '' }}</b></td>
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
  <script>
    var revenue_table = $('#revenue-table').DataTable();
    $('#filter_by_sts_revenue').on('change', function() {
      let selectedStatus = $(this).val();
      revenue_table.column(7).search(selectedStatus).draw();
    });
  </script>
  @endsection