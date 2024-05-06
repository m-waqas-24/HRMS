@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Leaves</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create leaves')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addleaves"><i class="feather feather-plus"></i> Add</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{ $error }}
                    @endforeach
            </div>
        @endif

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Leaves Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Employee</th>
                                        <th class="border-bottom-0 text-uppercase">Leave Type</th>
                                        <th class="border-bottom-0 text-uppercase">Applied on</th>
                                        <th class="border-bottom-0 text-uppercase">Duration</th>
                                        <th class="border-bottom-0 text-uppercase">Status</th>
                                        <th class="border-bottom-0 text-uppercase">Reason</th>
                                        @if(Gate::check('edit leaves') || Gate::check('delete leaves'))
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($leaves as $leave)
                                    <tr>
                                        <td><strong>{{ $leave->employe->name }}</strong></td>
                                        <td>{{ $leave->leaveType->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('d F, Y') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ \Carbon\Carbon::parse($leave->start_date)->format('d F, Y') }} To {{ \Carbon\Carbon::parse($leave->end_date)->format('d F, Y') }}</h6>
                                                    <p class="text-muted mb-0 fs-12">Total: ({{ $leave->total_days }} Days)</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($leave->status == 1)
                                            <span class="badge badge-secondary">Pending</span>
                                            @elseif($leave->status == 2)
                                            <span class="badge badge-success">Approved</span>
                                            @elseif($leave->status == 3)
                                            <span class="badge badge-danger">Reject</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($leave->reason, 20) }}</td>
                                        @if(Gate::check('edit leaves') || Gate::check('delete leaves'))
                                        <td>
                                        <div class="d-flex">
                                            @can('edit leaves')
                                            <a  href="{{ route('admin.leaves.editwithId',$leave->id) }}" class="action-btns1"><i class="feather feather-edit primary text-primary"></i></a>
                                            @endcan
                                            @can('delete leaves')
                                            <a href="#" class="action-btns1" title="Delete"  onclick="confirmDelete(event, 'deleteleave_{{ $leave->id }}');">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </a>
                                            <form id="deleteleave_{{ $leave->id }}');" action="{{ route('admin.leaves.destroywithId', $leave->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
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

                    <!-- ADD Training MODAL -->
                    <div class="modal fade" id="addleaves">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.leaves.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Leave</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Employe:</label>
                                                        <select name="employee" class="form-control form-select required-field" >
                                                            @if(Auth::user()->type == 'employee')
                                                            <option value="{{ Auth::user()->employe->id }}">{{ Auth::user()->employe->name }}</option>
                                                            @else
                                                            <option value="">Select Employe </option>
                                                            @foreach($employes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Leave Type:</label>
                                                        <select name="leave_type" class="form-control form-select required-field" >
                                                            <option value="">Select Type </option>
                                                            @foreach($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Start Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Resignation Date" name="start_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">End Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Resignation Date" name="end_date">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Reason:</label>
                                                        <textarea name="reason" placeholder="Leave Reason" class="form-control required-field" id="" cols="10" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- END ADD trainer MODAL -->

@endsection