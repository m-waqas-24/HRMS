@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Resignations</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addresignations"><i class="feather feather-plus"></i> Add</a>
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
                        <h4 class="card-title">Resignations</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Emp Name</th>
                                        <th class="border-bottom-0 text-uppercase">Resignations Date</th>
                                        <th class="border-bottom-0 text-uppercase">Last Working Day</th>
                                        <th class="border-bottom-0 text-uppercase">Reason</th>
                                        @if(Gate::check('edit resignation') || Gate::check('delete resignation'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resignations as $resignation)
                                    <tr>
                                        <td> {{ $resignation->employe->name }} </td>
                                        <td> {{ \Carbon\Carbon::parse($resignation->resig_date)->format('d F, Y')  }} </td>
                                        <td> {{ \Carbon\Carbon::parse($resignation->last_date)->format('d F, Y')  }} </td>
                                        <td> {{ Str::limit($resignation->reason, 20) }} </td>
                                        @if(Gate::check('edit resignation') || Gate::check('delete resignation'))
                                        <td>
                                            @can('edit resignation')
                                            <a href="{{ route('admin.resignations.edit', $resignation) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete resignation')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deleteresignation_{{ $resignation->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deleteresignation_{{ $resignation->id }}" action="{{ route('admin.resignations.destroy', $resignation) }}" method="POST" style="display: none">
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


                    <!-- ADD Training MODAL -->
                    <div class="modal fade"  id="addresignations">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.resignations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Promotions</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Employe:</label>
                                                        <select id="employe" name="employee" class="form-control form-select required-field" >
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
                                                        <label class="form-label">Resignation Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Resignation Date" name="date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Last Working Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Resignation Date" name="last_date">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Reason:</label>
                                                        <textarea name="reason" placeholder="Reason" class="form-control required-field" id="" cols="10" rows="1"></textarea>
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
