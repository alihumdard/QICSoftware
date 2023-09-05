@extends('layouts.main')

@section('main-section')
@php
$tripStatus = config('constants.TRIP_STATUS');
$tripStatus_trans = config('constants.TRIP_STATUS_' . app()->getLocale());
@endphp
<!-- partial -->
	<div class="content-wrapper py-0 my-2">
		<div style="border: none;">
			<div class="bg-white" style="border-radius: 20px;">
				<div class="p-3">
					<div class="row mb-0 mb-lg-3">
						<div class="col-lg-6 col-sm-6 col-xl-6">
							<h3 class="page-title">
								<span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
									<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M13.4109 0.76862L13.4119 1.51824C16.1665 1.73414 17.9862 3.6112 17.9891 6.48975L18 14.9155C18.0039 18.054 16.0322 19.985 12.8718 19.99L5.15189 20C2.0112 20.004 0.0148232 18.027 0.0108739 14.8796L1.32771e-05 6.55272C-0.00393603 3.65517 1.75153 1.78311 4.50618 1.53024L4.50519 0.780614C4.5042 0.340834 4.83002 0.00999952 5.26445 0.00999952C5.69887 0.00900002 6.02469 0.338835 6.02568 0.778615L6.02666 1.47826L11.8914 1.47027L11.8904 0.770619C11.8894 0.330839 12.2152 0.00100402 12.6497 4.52073e-06C13.0742 -0.000994979 13.4099 0.32884 13.4109 0.76862ZM1.52149 6.86157L16.4696 6.84158V6.49175C16.4272 4.34283 15.349 3.21539 13.4139 3.04748L13.4148 3.81709C13.4148 4.24688 13.0801 4.58771 12.6556 4.58771C12.2212 4.58871 11.8944 4.24888 11.8944 3.81909L11.8934 3.0095L6.02864 3.01749L6.02962 3.82609C6.02962 4.25687 5.70479 4.5967 5.27037 4.5967C4.83595 4.5977 4.50914 4.25887 4.50914 3.82809L4.50815 3.05847C2.58286 3.25138 1.51754 4.38281 1.5205 6.55072L1.52149 6.86157ZM12.2399 11.4043V11.4153C12.2498 11.8751 12.625 12.2239 13.0801 12.2139C13.5244 12.2029 13.8789 11.8221 13.869 11.3623C13.8483 10.9225 13.4918 10.5637 13.0485 10.5647C12.5944 10.5747 12.2389 10.9445 12.2399 11.4043ZM13.0554 15.892C12.6013 15.882 12.235 15.5032 12.234 15.0435C12.2241 14.5837 12.5884 14.2029 13.0426 14.1919H13.0525C13.5165 14.1919 13.8927 14.5707 13.8927 15.0405C13.8937 15.5102 13.5185 15.891 13.0554 15.892ZM8.17213 11.4203C8.19187 11.8801 8.56804 12.2389 9.02221 12.2189C9.46651 12.1979 9.82096 11.8181 9.80122 11.3583C9.79036 10.9085 9.42505 10.5587 8.98075 10.5597C8.52658 10.5797 8.17114 10.9605 8.17213 11.4203ZM9.02617 15.8471C8.57199 15.8671 8.19681 15.5082 8.17608 15.0485C8.17608 14.5887 8.53053 14.2089 8.9847 14.1879C9.429 14.1869 9.79529 14.5367 9.80517 14.9855C9.8259 15.4463 9.47046 15.8261 9.02617 15.8471ZM4.10434 11.4553C4.12408 11.915 4.50025 12.2749 4.95442 12.2539C5.39872 12.2339 5.75317 11.8531 5.73244 11.3933C5.72257 10.9435 5.35725 10.5937 4.91197 10.5947C4.4578 10.6147 4.10335 10.9955 4.10434 11.4553ZM4.95837 15.8521C4.5042 15.8731 4.12902 15.5132 4.10828 15.0535C4.1073 14.5937 4.46274 14.2129 4.91691 14.1929C5.3612 14.1919 5.7275 14.5417 5.73738 14.9915C5.75811 15.4513 5.40366 15.8321 4.95837 15.8521Z" fill="white" />
									</svg>
								</span>
								<span>@lang('lang.calendar')</span>
							</h3>
						</div>
						<div class="col-lg-6 col-sm-6 col-xl-6 text-right">
							<h3>
								<a href="/calender">
									<svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M19.2487 1.92213L19.2501 2.98409C23.1526 3.28994 25.7304 5.94911 25.7346 10.0271L25.75 21.9636C25.7556 26.4097 22.9623 29.1453 18.4851 29.1524L7.5485 29.1666C3.09919 29.1722 0.27099 26.3715 0.265395 21.9126L0.250009 10.1163C0.244415 6.01141 2.73133 3.35932 6.63374 3.00109L6.63234 1.93912C6.63094 1.3161 7.09252 0.847415 7.70796 0.847415C8.32339 0.845999 8.78496 1.31326 8.78636 1.93629L8.78776 2.92746L17.0961 2.91613L17.0947 1.92496C17.0933 1.30194 17.5549 0.834671 18.1703 0.833255C18.7718 0.831839 19.2474 1.29911 19.2487 1.92213ZM2.40543 10.5538L23.582 10.5255V10.0299C23.5218 6.98559 21.9944 5.38839 19.2529 5.15051L19.2543 6.2408C19.2543 6.84966 18.7802 7.3325 18.1787 7.3325C17.5633 7.33392 17.1003 6.85249 17.1003 6.24363L17.0989 5.0967L8.79056 5.10803L8.79196 6.25354C8.79196 6.86382 8.33178 7.34524 7.71635 7.34524C7.10092 7.34666 6.63794 6.86665 6.63794 6.25637L6.63654 5.16609C3.90905 5.43937 2.39984 7.04223 2.40403 10.1134L2.40543 10.5538ZM17.5899 16.9893V17.0049C17.6039 17.6562 18.1354 18.1504 18.7802 18.1363C19.4096 18.1207 19.9117 17.5812 19.8978 16.9299C19.8684 16.3068 19.3634 15.7985 18.7354 15.7999C18.092 15.8141 17.5885 16.338 17.5899 16.9893ZM18.7452 23.347C18.1018 23.3328 17.5829 22.7962 17.5815 22.1448C17.5675 21.4935 18.0836 20.954 18.727 20.9384H18.741C19.3984 20.9384 19.9313 21.4751 19.9313 22.1406C19.9327 22.8061 19.4012 23.3456 18.7452 23.347ZM11.8272 17.012C11.8551 17.6633 12.3881 18.1717 13.0315 18.1433C13.6609 18.1136 14.163 17.5755 14.1351 16.9242C14.1197 16.287 13.6021 15.7914 12.9727 15.7928C12.3293 15.8212 11.8258 16.3606 11.8272 17.012ZM13.0371 23.2833C12.3937 23.3116 11.8621 22.8033 11.8328 22.1519C11.8328 21.5006 12.3349 20.9625 12.9783 20.9328C13.6077 20.9314 14.1267 21.4269 14.1406 22.0627C14.17 22.7155 13.6665 23.2535 13.0371 23.2833ZM6.06447 17.0615C6.09244 17.7129 6.62535 18.2226 7.26876 18.1929C7.89818 18.1646 8.40032 17.6251 8.37095 16.9738C8.35696 16.3366 7.83944 15.841 7.20862 15.8424C6.56521 15.8707 6.06307 16.4102 6.06447 17.0615ZM7.27436 23.2903C6.63095 23.3201 6.09944 22.8103 6.07006 22.159C6.06866 21.5077 6.5722 20.9682 7.21561 20.9399C7.84503 20.9384 8.36396 21.434 8.37794 22.0712C8.40732 22.7225 7.90518 23.262 7.27436 23.2903Z" fill="#323C47" />
									</svg>
								</a>
							</h3>
						</div>
					</div>
					<div class="row mb-2">
						<!-- <div class="col-lg-4"></div> -->
						<div class="col-lg-12">
							<div class="row mx-1">
								<div class="col-lg-9 col-sm-6 mb-1 pr-0" style="text-align: right;">
									<a href="/create_trip">
										<button class="btn add-btn text-white" style="background-color: #E45F00;"><span><i class="fa fa-plus"></i> @lang('lang.create_trip')</span></button>
									</a>
								</div>
								<div class="col-lg-3 col-sm-6 pr-0">
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
											@foreach($tripStatus_trans as $key => $value)
												<option value="{{$value}}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<!-- <div class="col-lg-4 px-1">
								<div class="input-group">
									<div class="input-group-prepend">
									<div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
										<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.6752 0.558058C13.4311 0.313981 13.0354 0.313981 12.7913 0.558058L8.81386 4.53553C8.56978 4.77961 8.56978 5.17534 8.81386 5.41942C9.05794 5.6635 9.45366 5.6635 9.69774 5.41942L13.2333 1.88388L16.7688 5.41942C17.0129 5.6635 17.4086 5.6635 17.6527 5.41942C17.8968 5.17534 17.8968 4.77961 17.6527 4.53553L13.6752 0.558058ZM12.6083 14C12.6083 14.3452 12.8881 14.625 13.2333 14.625C13.5785 14.625 13.8583 14.3452 13.8583 14H12.6083ZM12.6083 1V14H13.8583V1H12.6083Z" fill="#323C47" />
										<path d="M5.625 1C5.625 0.654822 5.34518 0.375 5 0.375C4.65482 0.375 4.375 0.654822 4.375 1H5.625ZM4.55806 14.4419C4.80214 14.686 5.19786 14.686 5.44194 14.4419L9.41942 10.4645C9.6635 10.2204 9.6635 9.82466 9.41942 9.58058C9.17534 9.3365 8.77961 9.3365 8.53553 9.58058L5 13.1161L1.46447 9.58058C1.22039 9.3365 0.82466 9.3365 0.580583 9.58058C0.336505 9.82466 0.336505 10.2204 0.580583 10.4645L4.55806 14.4419ZM4.375 1V14H5.625V1H4.375Z" fill="#323C47" />
										</svg>
									</div>
									</div>
									<select name="sort_by" id="sort_by" class="form-select" style="border-left: none;">
									<option value="">
										@lang('lang.sort_by')
									</option>
									</select>
								</div>
								</div> -->
							</div>
						</div>
					</div>
					<hr>
					<div class="px-2">
						<div class="table-responsive">
							<table id="canlendar-table" class="display" style="width:100%">
								<thead class="text-secondary" style="background-color: #E9EAEF;">
									<tr style="font-size: small;">
										<th>#</th>
										<th>@lang('lang.trip_date')</th>
										<th>@lang('lang.trip_title')</th>
										<th>@lang('lang.start_point')</th>
										<th>@lang('lang.end_point')</th>

										@if($user->role != 'Client' && $user->role != 'Admin')
										<th>@lang('lang.description')</th>
										@endif

										@if($user->role != 'Driver')
										<th></th>
										<th>@lang('lang.driver_name')</th>
										@endif

										<th>@lang('lang.status')</th>
										<th>@lang('lang.actions')</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key => $value)
									<tr style="font-size: small;">
										<td>{{ $value['id'] }}</td>
										<td>{{ date('M d, Y', strtotime($value['trip_date']))}}</td>
										<td>{{ $value['title'] }}</td>
										<td>{{ $value['start_point'] }}</td>
										<td>{{ $value['end_point'] }}</td>

										@if($user->role != 'Client' && $user->role != 'Admin')
										<td>
											<div class="row">
												<div class="col-12 col-sm-12 col-lg-6 my-auto">
													{{ $value['desc'] }}
												</div>
											</div>
										</td>
										@endif

										@if($user->role != 'Driver')
										<td><img src="{{ (isset($value['driver_pic'])) ? asset('storage/' . $value['driver_pic']) : 'assets/images/user.png'}}" style="width: 45px; height: 45px; border-radius: 38px; object-fit: cover;" alt="text"></td>
										<td>{{ $value['driver_name'] }}</td>
										@endif

										<td>
											<button class="btn btn_status">
											@if ($value['status'] == $tripStatus['In Progress'])
												<span data-client_id="{{$value['id']}}">
												<div style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 4px; background: #E9EBF3; border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
												<div style="text-align: center; color: #233A85; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
												</div>
											</span>
											@elseif ($value['status'] == $tripStatus['Pending'])
												<span data-client_id="{{$value['id']}}">
												<div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 15px; padding-right: 13px; background: rgba(77, 77, 77, 0.12); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
												<div style="text-align: center; color: #8F9090; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
												</div>
											</span>
											@elseif ($value['status'] == $tripStatus['Completed'])
												<span data-client_id="{{$value['id']}}">
												<div style="width: 100%; height: 100%; padding: 5px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
												<div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
												</div>
											</span>
											@elseif ($value['status'] == $tripStatus['Deleted'])
												<span data-client_id="{{$value['id']}}">
												<div style="width: 100%; height: 100%; padding-top: 6px; padding-bottom: 7px; padding-left: 15px; padding-right: 13px; background: rgba(77, 77, 77, 0.12); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
												<div style="text-align: center; color: #8F9090; font-size: 14px; font-weight: 500; word-wrap: break-word">{{$tripStatus_trans[$value['status']]}}</div>
												</div>
											</span>
											@endif
											</button>
										</td>
										<td class="d-flex py-4">
											@if($user->role != user_roles('3') && $value['status'] == $tripStatus['Pending'])
											<form method="POST" action="/create_trip" class="mb-0">
												@csrf
												<input type="hidden" name="id" value="{{$value['id']}}">
												<button id="btn_edit_announcement" class="btn p-0">
													<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
														<path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
													</svg>
												</button>
											</form>
											<button class="btn p-0" data-toggle="modal" data-target="#deleteroute">
												<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle opacity="0.1" cx="18" cy="18" r="18" fill="#DF6F79" />
													<path fill-rule="evenodd" clip-rule="evenodd" d="M23.4909 13.743C23.7359 13.743 23.94 13.9465 23.94 14.2054V14.4448C23.94 14.6975 23.7359 14.9072 23.4909 14.9072H13.0497C12.804 14.9072 12.6 14.6975 12.6 14.4448V14.2054C12.6 13.9465 12.804 13.743 13.0497 13.743H14.8866C15.2597 13.743 15.5845 13.4778 15.6684 13.1036L15.7646 12.6739C15.9141 12.0887 16.4061 11.7 16.9692 11.7H19.5708C20.1277 11.7 20.6252 12.0887 20.7692 12.6431L20.8721 13.1029C20.9555 13.4778 21.2802 13.743 21.654 13.743H23.4909ZM22.5577 22.4943C22.7495 20.707 23.0852 16.4609 23.0852 16.418C23.0975 16.2883 23.0552 16.1654 22.9713 16.0665C22.8812 15.9739 22.7672 15.9191 22.6416 15.9191H13.9032C13.777 15.9191 13.6569 15.9739 13.5735 16.0665C13.489 16.1654 13.4473 16.2883 13.4534 16.418C13.4546 16.4259 13.4666 16.5755 13.4868 16.8255C13.5762 17.9364 13.8255 21.0303 13.9865 22.4943C14.1005 23.5729 14.8081 24.2507 15.8332 24.2753C16.6242 24.2936 17.4391 24.2999 18.2724 24.2999C19.0573 24.2999 19.8544 24.2936 20.6699 24.2753C21.7305 24.257 22.4376 23.5911 22.5577 22.4943Z" fill="#D11A2A" />
												</svg>
											</button>
											@endif

											@if ($user->role != user_roles('3') &&$value['status'] == $tripStatus['Completed'])
											<form method="POST" action="/create_trip" class="mb-0">
												@csrf
												<input type="hidden" name="id" value="{{$value['id']}}">
												<input type="hidden" name="dashboard_data" value="1">
												<button class="btn p-0">
												<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
													<path d="M23.2857 12.8571V12H20.7143V16.2857H21.5714V14.5714H22.8572V13.7143H21.5714V12.8571H23.2857Z" fill="#452C88" />
													<path d="M21.5715 21.4285V23.1428H14.7143V21.4285H13.8571V23.1428C13.8571 23.3701 13.9475 23.5881 14.1082 23.7489C14.2689 23.9096 14.487 23.9999 14.7143 23.9999H21.5715C21.7988 23.9999 22.0168 23.9096 22.1776 23.7489C22.3383 23.5881 22.4286 23.3701 22.4286 23.1428V21.4285H21.5715Z" fill="#452C88" />
													<path d="M20.2857 20.1428L19.6797 19.5368L18.5714 20.6451V17.1428H17.7143V20.6451L16.606 19.5368L16 20.1428L18.1429 22.2857L20.2857 20.1428Z" fill="#452C88" />
													<path d="M18.5715 16.2857H16.8572V12H18.5715C18.9123 12.0004 19.2392 12.136 19.4802 12.377C19.7212 12.618 19.8568 12.9448 19.8572 13.2857V15C19.8568 15.3409 19.7212 15.6677 19.4802 15.9087C19.2392 16.1498 18.9123 16.2854 18.5715 16.2857ZM17.7143 15.4286H18.5715C18.6851 15.4285 18.794 15.3833 18.8744 15.3029C18.9547 15.2226 18.9999 15.1136 19 15V13.2857C18.9999 13.1721 18.9547 13.0632 18.8744 12.9828C18.794 12.9025 18.6851 12.8573 18.5715 12.8571H17.7143V15.4286Z" fill="#452C88" />
													<path d="M15.1429 12H13V16.2857H13.8571V15H15.1429C15.3701 14.9997 15.5879 14.9093 15.7486 14.7486C15.9093 14.5879 15.9997 14.3701 16 14.1429V12.8571C15.9998 12.6299 15.9094 12.412 15.7487 12.2513C15.588 12.0907 15.3701 12.0003 15.1429 12ZM13.8571 14.1429V12.8571H15.1429L15.1433 14.1429H13.8571Z" fill="#452C88" />
												</svg>
												</button>
											</form>
											@endif

											@if($user->role == user_roles('3') && $value['status'] != $tripStatus['Deleted'])
											<form method="POST" action="/driver_map" class="mb-0">
												@csrf
												<input type="hidden" name="id" value="{{$value['id']}}">
												<button class="btn p-0">
													<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88"/>
														<path fill-rule="evenodd" clip-rule="evenodd" d="M17.7941 24.7919C17.7943 24.7919 17.7944 24.792 18 24.5L17.7941 24.7919ZM18.2059 24.7919L18.2071 24.7909L18.2104 24.7886L18.2217 24.7805C18.2315 24.7735 18.2455 24.7634 18.2635 24.7501C18.2995 24.7237 18.3515 24.6849 18.4172 24.6345C18.5485 24.5335 18.7347 24.3855 18.9575 24.195C19.4028 23.8143 19.9967 23.2617 20.5916 22.5735C21.7728 21.2071 23 19.257 23 17.0275C23 15.6948 22.4737 14.4162 21.5363 13.4733C20.5988 12.5302 19.3268 12 18 12C16.6733 12 15.4013 12.5302 14.4637 13.4733C13.5263 14.4162 13 15.6948 13 17.0275C13 19.257 14.2272 21.2071 15.4084 22.5735C16.0033 23.2617 16.5972 23.8143 17.0425 24.195C17.2653 24.3855 17.4515 24.5335 17.5828 24.6345C17.6485 24.6849 17.7005 24.7237 17.7365 24.7501C17.7545 24.7634 17.7685 24.7735 17.7783 24.7805L17.7896 24.7886L17.7929 24.7909L17.7941 24.7919C17.9175 24.8787 18.0825 24.8787 18.2059 24.7919ZM18 24.5L18.2059 24.7919C18.2057 24.7919 18.2056 24.792 18 24.5ZM19.7857 17C19.7857 17.9862 18.9862 18.7857 18 18.7857C17.0138 18.7857 16.2143 17.9862 16.2143 17C16.2143 16.0138 17.0138 15.2143 18 15.2143C18.9862 15.2143 19.7857 16.0138 19.7857 17Z" fill="#452C88"/>
													</svg>	
												</button>
												</form>
												@endif
											@if($user->role != user_roles('3') && $value['status'] == $tripStatus['Completed'])
											<button  class="btn duplicate_trip p-0"  data-id="{{$value['id']}}">
												<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle opacity="0.1" cx="18" cy="18" r="18" fill="#452C88" />
													<path d="M23.6234 12.7663L22.2337 11.3766C21.9926 11.1355 21.6656 11 21.3246 11H16.7143C16.0042 11 15.4286 11.5756 15.4286 12.2857V13.5714H13.2857C12.5756 13.5714 12 14.1471 12 14.8571V23.4286C12 24.1387 12.5756 24.7143 13.2857 24.7143H19.2857C19.9958 24.7143 20.5714 24.1387 20.5714 23.4286V22.1429H22.7143C23.4244 22.1429 24 21.5672 24 20.8571V13.6754C24 13.3344 23.8645 13.0074 23.6234 12.7663ZM19.125 23.4286H13.4464C13.4038 23.4286 13.3629 23.4116 13.3328 23.3815C13.3026 23.3514 13.2857 23.3105 13.2857 23.2679V15.0179C13.2857 14.9752 13.3026 14.9344 13.3328 14.9042C13.3629 14.8741 13.4038 14.8571 13.4464 14.8571H15.4286V20.8571C15.4286 21.5672 16.0042 22.1429 16.7143 22.1429H19.2857V23.2679C19.2857 23.3105 19.2688 23.3514 19.2386 23.3815C19.2085 23.4116 19.1676 23.4286 19.125 23.4286ZM22.5536 20.8571H16.875C16.8324 20.8571 16.7915 20.8402 16.7614 20.8101C16.7312 20.7799 16.7143 20.7391 16.7143 20.6964V12.4464C16.7143 12.4038 16.7312 12.3629 16.7614 12.3328C16.7915 12.3026 16.8324 12.2857 16.875 12.2857H19.7143V14.6429C19.7143 14.9979 20.0021 15.2857 20.3571 15.2857H22.7143V20.6964C22.7143 20.7391 22.6974 20.7799 22.6672 20.8101C22.6371 20.8402 22.5962 20.8571 22.5536 20.8571ZM22.7143 14H21V12.2857H21.258C21.3006 12.2857 21.3415 12.3026 21.3717 12.3328L22.6672 13.6283C22.6821 13.6433 22.694 13.661 22.7021 13.6805C22.7101 13.7 22.7143 13.7209 22.7143 13.742V14Z" fill="#452C88" />
												</svg>
											</button>
											@endif
											<button  data-id="{{ $value['id'] }}" id="tripDetail_btn" class="btn p-0 tripDetail_view" data-toggle="modal" data-target="#tripdetail">
												<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
												<circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
												<path d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z" fill="black" />
												</svg>
											</button>
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
</div>
<!-- content-wrapper ends -->
<!-- Delete Client Modal -->
<div class="modal fade" id="deleteroute" tabindex="-1" aria-labelledby="deleterouteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- <div class="modal-header">
          <h5 class="modal-title" id="deleterouteLabel"></h5>
        </div> -->
			<div class="modal-body">
				<svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="4" y="4" width="48" height="48" rx="24" fill="#FEE4E2"/>
					<path d="M32 22V21.2C32 20.0799 32 19.5198 31.782 19.092C31.5903 18.7157 31.2843 18.4097 30.908 18.218C30.4802 18 29.9201 18 28.8 18H27.2C26.0799 18 25.5198 18 25.092 18.218C24.7157 18.4097 24.4097 18.7157 24.218 19.092C24 19.5198 24 20.0799 24 21.2V22M26 27.5V32.5M30 27.5V32.5M19 22H37M35 22V33.2C35 34.8802 35 35.7202 34.673 36.362C34.3854 36.9265 33.9265 37.3854 33.362 37.673C32.7202 38 31.8802 38 30.2 38H25.8C24.1198 38 23.2798 38 22.638 37.673C22.0735 37.3854 21.6146 36.9265 21.327 36.362C21 35.7202 21 34.8802 21 33.2V22" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<rect x="4" y="4" width="48" height="48" rx="24" stroke="#FEF3F2" stroke-width="8"/>
				</svg>
			<div class="float-right">
				<button class="btn p-0" data-dismiss="modal">
				<svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				</button>
			</div>
				<div class="mt-3">
					<h6>@lang('lang.really_want_to_delete_route')</h6>
				</div>
				<div class="row mt-3 text-center">
					<div class="col-lg-6">
						<button class="btn btn-sm btn-outline px-5" data-toggle="modal" data-target="#deleteroute" style="background-color: #ffffff; border: 1px solid #D0D5DD; border-radius: 8px; width: 100%;">Cancel</button>
					</div>
					<div class="col-lg-6">
						<button class="btn btn-sm btn-outline text-white px-5" data-toggle="modal" data-target="#deleteroute" style="background-color: #D92D20; border-radius: 8px; width: 100%;">Delete</button>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
                </div> -->
		</div>
	</div>
</div>
<!-- Delete Client Modal End -->

<!-- duplicateroute Client Modal -->
<div class="modal fade" id="duplicateroute" tabindex="-1" aria-labelledby="duplicaterouteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header pb-0" style="border-bottom: none;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</button>
			</div>
			<!-- <div class="modal-header">
          <h5 class="modal-title" id="duplicaterouteLabel"></h5>
        </div> -->
			<div class="modal-body pt-0">
				<svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect x="4" y="4" width="48" height="48" rx="24" fill="#DF6F79" fill-opacity="0.6" />
					<path d="M28 18C26.0222 18 24.0888 18.5865 22.4443 19.6853C20.7998 20.7841 19.5181 22.3459 18.7612 24.1732C18.0043 26.0004 17.8063 28.0111 18.1922 29.9509C18.578 31.8907 19.5304 33.6725 20.9289 35.0711C22.3275 36.4696 24.1093 37.422 26.0491 37.8078C27.9889 38.1937 29.9996 37.9957 31.8268 37.2388C33.6541 36.4819 35.2159 35.2002 36.3147 33.5557C37.4135 31.9112 38 29.9778 38 28C38 26.6868 37.7413 25.3864 37.2388 24.1732C36.7362 22.9599 35.9997 21.8575 35.0711 20.9289C34.1425 20.0003 33.0401 19.2638 31.8268 18.7612C30.6136 18.2587 29.3132 18 28 18ZM28 36C26.4178 36 24.871 35.5308 23.5554 34.6518C22.2398 33.7727 21.2145 32.5233 20.609 31.0615C20.0035 29.5997 19.845 27.9911 20.1537 26.4393C20.4624 24.8874 21.2243 23.462 22.3431 22.3431C23.462 21.2243 24.8874 20.4624 26.4393 20.1537C27.9911 19.845 29.5997 20.0035 31.0615 20.609C32.5233 21.2145 33.7727 22.2398 34.6518 23.5554C35.5308 24.871 36 26.4177 36 28C36 30.1217 35.1571 32.1566 33.6569 33.6568C32.1566 35.1571 30.1217 36 28 36Z" fill="#D11A2A" />
					<path d="M27.9998 33C28.552 33 28.9998 32.5523 28.9998 32C28.9998 31.4477 28.552 31 27.9998 31C27.4475 31 26.9998 31.4477 26.9998 32C26.9998 32.5523 27.4475 33 27.9998 33Z" fill="#D11A2A" />
					<path d="M27.9998 22.9998C27.7345 22.9998 27.4802 23.1051 27.2926 23.2926C27.1051 23.4802 26.9998 23.7345 26.9998 23.9998V28.9998C26.9998 29.265 27.1051 29.5193 27.2926 29.7069C27.4802 29.8944 27.7345 29.9998 27.9998 29.9998C28.265 29.9998 28.5193 29.8944 28.7069 29.7069C28.8944 29.5193 28.9998 29.265 28.9998 28.9998V23.9998C28.9998 23.7345 28.8944 23.4802 28.7069 23.2926C28.5193 23.1051 28.265 22.9998 27.9998 22.9998Z" fill="#D11A2A" />
					<rect x="2" y="2" width="52" height="52" rx="26" stroke="#DF6F79" stroke-opacity="0.2" stroke-width="4" />
				</svg>
				<div class="mt-3">
					<h6>Really want to duplicate trip?</h6>
					<p style="color: #475467;">All the trip data will reset when you click continue.</p>
				</div>
				<div class="row mt-3 text-center">
					<div class="col-lg-12">
					<form method="POST" action="/create_trip" class="mb-0">
						@csrf
						<input id="inp_trip" type="hidden" name="id" value="">
						<input  type="hidden" name="duplicate_trip" value="1">
						<button class="btn btn-lg btn-outline text-white" data-toggle="modal" data-target="#duplicateroute" style="background-color: #233A85; border-radius: 8px; width: 100%;">Continue</button>
					</form>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
                </div> -->
		</div>
	</div>
</div>
<!-- duplicateroute Client Modal End -->
@if($user->role == user_roles('1'))
  <script>
    var users_table = $('#canlendar-table').DataTable();
    $('#filter_by_sts_routes').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(6).search(selectedStatus).draw();
    });
  </script>

  @else
  <script>
    var users_table = $('#canlendar-table').DataTable();
    $('#filter_by_sts_routes').on('change', function() {
        var selectedStatus = $(this).val();
        users_table.column(6).search(selectedStatus).draw();
    });
  </script>
  @endif
  @include('tripdetail_modal')
@endsection