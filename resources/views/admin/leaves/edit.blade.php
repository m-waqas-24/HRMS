@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Leave</div>
               
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
                        <h4 class="card-title">Edit Leave</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.leaves.updatewithId', $leave->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Status:</label>
                                    <select name="status" class="form-control form-select" >
                                        <option value="">Select Status </option>
                                        @foreach($leaveStatus as $status)
                                        <option value="{{ $status->id }}" {{ $leave->status ==  $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Employe:</label>
                                    <select required id="employe" name="employee" class="form-control form-select" >
                                        <option value="">Select Employe </option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{ $employe->id == $leave->emp_id ? 'selected' : '' }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Leave Type:</label>
                                    <select required id="employe" name="leave_type" class="form-control form-select" >
                                        <option value="">Select Type </option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $leave->leave_type ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Start Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Resignation Date" name="start_date" value="{{ $leave->start_date  }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">End Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Resignation Date" name="end_date" value="{{ $leave->end_date  }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Reason:</label>
                                    <textarea name="reason" placeholder="Leave Reason" class="form-control" id="" cols="10" rows="10">{{ $leave->reason  }}</textarea>
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