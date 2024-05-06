@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Complaints</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create complaints')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addcomplaints"><i class="feather feather-plus"></i> </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{ $error }}
                @endforeach
        </div>
    @endif

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Complaints</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Complaint From</th>
                                        <th class="border-bottom-0 text-uppercase">Complaint Against</th>
                                        <th class="border-bottom-0 text-uppercase">Title</th>
                                        <th class="border-bottom-0 text-uppercase">Complaint Date</th>
                                        <th class="border-bottom-0 text-uppercase">Description</th>
                                        @if(Gate::check('edit complaints') || Gate::check('delete complaints'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                    <tr>
                                        <td> {{ $complaint->employe->name }} </td>
                                        <td> {{ $complaint->againstEmploye->name }} </td>
                                        <td> {{ Str::limit($complaint->title, 20) }} </td>
                                        <td> {{ \Carbon\Carbon::parse($complaint->date)->format('d F, Y')  }} </td>
                                        <td> {{ Str::limit($complaint->description, 20) }} </td>
                                        @if(Gate::check('edit complaints') || Gate::check('delete complaints'))
                                        <td>
                                            @can('edit complaints')
                                            <a href="{{ route('admin.complaints.edit', $complaint) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete complaints')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deletecomplaint_{{ $complaint->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletecomplaint_{{ $complaint->id }}" action="{{ route('admin.complaints.destroy', $complaint) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
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

                @can('create complaints')
                <!-- ADD complaints MODAL -->
                    <div class="modal fade"  id="addcomplaints">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.complaints.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Complaint</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Complaint From:</label>
                                                        <select name="employee" class="form-control form-select required-field" >
                                                            @if(Auth::user()->type == 'employee')
                                                            <option value="{{ Auth::user()->employe->id }}">{{ Auth::user()->employe->name }}</option>
                                                            @else
                                                            <option value="">Choose....</option>
                                                            @foreach($employes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Complaint To:</label>
                                                        <select id="company_id" name="against_employee" onchange="updateBranches()" class="form-control form-select required-field" >
                                                            <option value="">Choose....</option>
                                                            @foreach($againstemployes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Title:</label>
                                                        <input type="text" class="form-control required-field"  placeholder="Enter Complaint Title" name="title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Complaint Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Complaint Title" name="date">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Description:</label>
                                                        <textarea name="description" placeholder="Description" class="form-control" id="" cols="10" rows="1"></textarea>
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
                @endcan



@endsection
