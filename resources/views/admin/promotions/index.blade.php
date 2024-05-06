@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Promotions</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create promotions')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addpromotions"><i class="feather feather-plus"></i> Add</a>
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
                        <h4 class="card-title">Promotions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Emp Name</th>
                                        {{-- <th class="border-bottom-0 text-uppercase">Company</th> --}}
                                        <th class="border-bottom-0 text-uppercase">Designation</th>
                                        <th class="border-bottom-0 text-uppercase">Promotion Title</th>
                                        <th class="border-bottom-0 text-uppercase">Promotion Date</th>
                                        <th class="border-bottom-0 text-uppercase">Description</th>
                                        @if(Gate::check('edit promotions') || Gate::check('delete promotions'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promotions as $promotion)
                                    <tr>
                                        <td> {{ $promotion->employe->name }} </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $promotion->employe->companyDetail->designation->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $promotion->employe->companyDetail->designation->department->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ Str::limit($promotion->title, 20) }} </td>
                                        <td> {{ \Carbon\Carbon::parse($promotion->date)->format('d F, Y')  }} </td>
                                        <td> {{ Str::limit($promotion->description, 20) }} </td>
                                        @if(Gate::check('edit promotions') || Gate::check('delete promotions'))
                                        <td>
                                            @can('edit promotions')
                                            <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete promotions')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deletepromotions_{{ $promotion->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletepromotions_{{ $promotion->id }}" action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" style="display: none">
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
                    <div class="modal fade"  id="addpromotions">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data">
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
                                                        <label class="form-label">Designation:</label>
                                                        <select id="designation" name="designation" class="form-control form-select required-field" >
                                                            <option value="">Select Designation </option>
                                                            @foreach($designations as $designation)
                                                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Promotion Title:</label>
                                                        <input type="text" class="form-control required-field"  placeholder="Enter Promotion Title" name="title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Promotion Date:</label>
                                                        <input type="date" class="form-control required-field"  placeholder="Enter Training Cost" name="date">
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



@endsection