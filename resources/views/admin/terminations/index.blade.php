@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Terminations</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create termination')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addterminations"><i class="feather feather-plus"></i> </a>
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
                        <h4 class="card-title">Terminations</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">EMP NAME</th>
                                        <th class="border-bottom-0 text-uppercase">Termination Type</th>
                                        <th class="border-bottom-0 text-uppercase">Notice Date</th>
                                        <th class="border-bottom-0 text-uppercase">Termination Date</th>
                                        <th class="border-bottom-0 text-uppercase">Description</th>
                                        @if(Gate::check('edit termination') || Gate::check('delete termination'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($terminations as $termination)
                                    <tr>
                                        <td> <strong>{{ $termination->employe->name }}</strong> </td>
                                        <td> {{ $termination->terminationType->name }} </td>
                                        <td> {{ \Carbon\Carbon::parse($termination->notice_date)->format('d F, Y')  }} </td>
                                        <td> {{ \Carbon\Carbon::parse($termination->terminat_date)->format('d F, Y')  }} </td>
                                        <td> {{ Str::limit($termination->description, 20) }} </td>
                                        @if(Gate::check('edit termination') || Gate::check('delete termination'))
                                        <td>
                                            @can('edit termination')
                                            <a href="{{ route('admin.terminations.edit', $termination) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete termination')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deletetermination_{{ $termination->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletetermination_{{ $termination->id }}" action="{{ route('admin.terminations.destroy', $termination) }}" method="POST" style="display: none">
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

                @can('create termination')
                <!-- ADD Training MODAL -->
                    <div class="modal fade"  id="addterminations">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.terminations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Termination</h5>
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
                                                            <option value="">Choose Employe</option>
                                                            @foreach($employes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Termination Type:</label>
                                                        <select id="company_id" name="termination_type" class="form-control form-select required-field" >
                                                            <option value="">Choose Type</option>
                                                            @foreach($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Notice Date:</label>
                                                        <input type="date" class="form-control required-field" placeholder="Enter Complaint Title" name="notice_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Termination Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Complaint Title" name="terminat_date">
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
