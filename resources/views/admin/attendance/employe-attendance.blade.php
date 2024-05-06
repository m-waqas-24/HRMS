@extends('admin.layouts.app')

@section('content')

	<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">Attendance</div>
							</div>
							<div class="page-rightheader ms-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
									<div class="d-flex">
										<div class="header-datepicker me-3">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="feather feather-calendar"></i>
													</div>
												</div><input class="form-control fc-datepicker"  type="text">
											</div>
										</div>
									</div>
									<div class="d-lg-flex">
										{{-- <div class="btn-list">
											<button  class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#clockinmodal">Clock In</button>
											<button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
											<button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
											<button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>
										</div> --}}
									</div>
								</div>
							</div>
						</div>
						<!-- END PAGE HEADER -->

						<!-- ROW -->
						<div class="row">
							@if(Auth::user()->type == 'employee')
							<div class="col-xl-3 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="countdowntimer mt-0">
											<span id="clocktimer2" class="border-0"></span>
											<label class="form-label">Current Time</label>
										</div>
										<div class="btn-list text-center mt-5">
											<a  
												@if($existingCheckIn) 
													onclick="event.preventDefault(); checkInExist();" 
												@else 
													onclick="confirmCheckIn();" 
												@endif 
											class="btn ripple @if($existingCheckIn) btn-outline-primary @else btn-primary @endif">Clock in</a>
											<a  
												@if($existingCheckOut) 
													onclick="event.preventDefault(); checkOutExist();" 
												@else 
													onclick="confirmCheckOut();" 
												@endif 
											class="btn ripple @if($existingCheckOut) btn-outline-primary @else btn-primary @endif">Clock Out</a>
										</div>
									</div>
								</div>
							</div>
							@endif
							<div class=" @if(Auth::user()->type == 'company') col-md-12 @else col-xl-9 col-md-12 col-lg-12  @endif ">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Days Overview This Month</h4>
									</div>
									<div class="card-body pt-0 pb-3">
										<div class="row mb-0 pb-0">
											<div class="col-md-6 col-xl-2 text-center py-5">
												<span class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $totalWorkingDays }}</span>
												<h5 class="mb-0 mt-3">Total Working Days</h5>
											</div>
											<div class="col-md-6 col-xl-2 text-center py-5 ">
												<span class="avatar avatar-md bradius fs-20 bg-success-transparent">{{ $totalPresentDays }}</span>
												<h5 class="mb-0 mt-3">Present Days</h5>
											</div>
											<div class="col-md-6 col-xl-2 text-center py-5">
												<span class="avatar avatar-md bradius fs-20 bg-danger-transparent"> {{ $totalAbsentDays }} </span>
												<h5 class="mb-0 mt-3">Absent Days</h5>
											</div>
											<div class="col-md-6 col-xl-2 text-center py-5">
												<span class="avatar avatar-md bradius fs-20 bg-warning-transparent">{{ $totalHalfDays }}</span>
												<h5 class="mb-0 mt-3">Half Days</h5>
											</div>
											<div class="col-md-6 col-xl-2 text-center py-5 ">
												<span class="avatar avatar-md bradius fs-20 bg-orange-transparent"> {{ $totalLateDays }} </span>
												<h5 class="mb-0 mt-3">Late Days</h5>
											</div>
											<div class="col-md-6 col-xl-2 text-center py-5">
												<span class="avatar avatar-md bradius fs-20 bg-pink-transparent">{{ $totalHolidays }} </span>
												<h5 class="mb-0 mt-3">Holidays</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END ROW -->

						<!-- ROW -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header  border-0">
										<h4 class="card-title">Attendance Overview</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-xl-5">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label">From:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="feather feather-calendar"></i>
																	</div>
																</div><input class="form-control fc-datepicker" placeholder="19 Feb 2020" type="text">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label">To:</label>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="feather feather-calendar"></i>
																	</div>
																</div><input class="form-control fc-datepicker" placeholder="19 Feb 2020" type="text">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-3">
												<div class="form-group">
													<label class="form-label">Month:</label>
													<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Month">
														<option label="Select Month"></option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group">
													<label class="form-label">Year:</label>
													<select name="attendance"  class="form-control custom-select select2" data-placeholder="Select Year">
														<option label="Select Year"></option>
														<option value="1">2024</option>
														<option value="2">2023</option>
														<option value="3">2022</option>
														<option value="4">2021</option>
														<option value="5">2020</option>
														<option value="6">2019</option>
														<option value="7">2018</option>
														<option value="8">2017</option>
														<option value="9">2016</option>
														<option value="10">2015</option>
														<option value="11">2014</option>
														<option value="12">2013</option>
														<option value="13">2012</option>
														<option value="14">2011</option>
														<option value="15">2019</option>
														<option value="16">2010</option>
													</select>
												</div>
											</div>
											<div class="col-md-12 col-lg-12 col-xl-2">
												<div class="form-group mt-5">
													<a  href="javascript:void(0);" class="btn btn-primary btn-block">Search</a>
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="emp-attendance">
												<thead>
													<tr>
														<th class="border-bottom-0">Date</th>
														<th class="border-bottom-0">Status</th>
														<th class="border-bottom-0">Clock-In</th>
														<th class="border-bottom-0">Clock-Out</th>
														{{-- <th class="border-bottom-0">Progress</th> --}}
														<th class="border-bottom-0">Hours</th>
													</tr>
												</thead>
												<tbody>
													@foreach($attendances as $attendance)
													<tr>
														<td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('d-F-Y') }}</td>
														<td>
															@if($attendance->is_late)
															<span class="badge badge-warning">Late</span>
															@elseif(!$attendance->late)
															<span class="badge badge-success">Present</span>
															@else
															<span class="badge badge-danger">Absent</span>
															@endif
														</td>
														<td>  {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : ''}}</td>
														<td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') : '' }}</td>
														<td>
															@if($attendance->total_hours || $attendance->total_minutes)
															<div class="d-flex">
																<div class="me-3 mt-0 mt-sm-1 d-block">
																	<h6 class="mb-1 fs-14">{{ $attendance->total_hours ? 'Total: ' . $attendance->total_hours . 'h :' : '' }}  {{ $attendance->total_minutes ? $attendance->total_minutes . 'mins' : '' }}</h6>
																	<p class="text-muted mb-0 fs-12">{{ $attendance->overtime_hours ? 'OverTime:' . $attendance->overtime_hours . 'h :' : '' }}  {{ $attendance->overtime_minutes ? $attendance->overtime_minutes . 'mins' : '' }}</p>
																</div>
															</div>
															@else
																<div class="progress progress-md mb-3">
																	<div class="progress-bar progress-bar-indeterminate bg-teal"></div>
																</div>
															@endif
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
						<!-- END ROW -->

					</div>
				</div><!-- end app-content-->

@endsection


@section('scripts')

<script>
    function confirmCheckIn() {
        Swal.fire({
            title: "Confirm Check-in?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.employe.checkIn') }}";
            }
        });
    }

	function checkInExist(){
				Swal.fire({
				title: "Oops!",
				text: "You already check in for today!",
				icon: "question"
				});
	}
    function confirmCheckOut() {
        Swal.fire({
            title: "Confirm Check-Out?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href="{{ route('admin.employe.checkOut') }}"
            }
        });
    }

	function checkOutExist(){
				Swal.fire({
				title: "Oops!",
				text: "You already check out for today!",
				icon: "question"
				});
	}


</script>

@endsection