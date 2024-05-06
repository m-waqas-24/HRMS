@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Time Slot</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Edit Time Slot</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.update.time-slots', $timeslot->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
										<label class="form-label">Slot Name</label>
										<input type="text" name="name" value="{{ $timeslot->name }}" class="form-control required-field" placeholder="Enter Slot Name" >
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
										<label class="form-label">Check-In Time</label>
										<input type="time" name="start_time" value="{{ $timeslot->start_time }}" class="form-control required-field" placeholder="Enter Branch Name" >
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
										<label class="form-label">Check-Out Time</label>
										<input type="time" name="end_time" value="{{ $timeslot->end_time }}" class="form-control required-field" placeholder="Enter Branch Name" >
									</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
										<label class="form-label">Late Minutes</label>
										<input type="number" name="late_minute" value="{{ $timeslot->late_minute }}" class="form-control required-field" placeholder="Enter Late Minutes" >
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4 ">Update</button>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection