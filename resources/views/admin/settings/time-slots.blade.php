@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Time Slots</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create attendance-timeslots')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtimeslot"><i class="feather feather-plus"></i>  Create Time-Slot</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-4 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">

                            @include('admin.settings.setting-links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-lg-12">  
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Time Slots</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Name</th>
                                        <th class="border-bottom-0 text-uppercase">Time</th>
                                        <th class="border-bottom-0 text-uppercase">Late Mins</th>
                                        @if(Gate::check('edit attendance-timeslots'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timeSlots as $timeSlot)
                                    <tr>
                                        <td>{{ $timeSlot->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">Clock-In: <strong>{{ \Carbon\Carbon::parse($timeSlot->start_time)->format("h:i A") }}</strong> </h6>
                                                    <h6 class="mb-1 fs-14">Clock-Out: <strong>{{ \Carbon\Carbon::parse($timeSlot->end_time)->format("h:i A") }}</strong> </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $timeSlot->late_minute }} mins</td>
                                        @if(Gate::check('edit attendance-timeslots') )
                                        <td>
                                            @can('edit attendance-timeslots')
                                            <a href="{{ route('admin.edit.time-slots', $timeSlot->id) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                        </td>
                                        @endif
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

            {{-- @can('create branches') --}}
		            <!-- ADD time slots options MODAL -->
					<div class="modal fade"  id="addtimeslot">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.store.time-slots') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Create Time Slot </h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Slot Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Slot Name" >
									</div>
									<div class="form-group">
										<label class="form-label">Check-In Time</label>
										<input type="time" name="start_time" class="form-control required-field" placeholder="Enter Branch Name" >
									</div>
									<div class="form-group">
										<label class="form-label">Check-Out Time</label>
										<input type="time" name="end_time" class="form-control required-field" placeholder="Enter Branch Name" >
									</div>
									<div class="form-group">
										<label class="form-label">Late Minutes</label>
										<input type="number" name="late_minute" class="form-control required-field" placeholder="Enter Late Minutes" >
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit"  class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						</div>
					</div>
					<!-- END ADD time slots MODAL -->
            {{-- @endcan --}}


@endsection