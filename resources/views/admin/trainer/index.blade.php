@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Trainer List</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create trainer')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addtrainer"><i class="feather feather-plus"></i> Add Trainer</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Trainer Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Company</th>
                                        <th class="border-bottom-0 text-uppercase">Branch</th>
                                        <th class="border-bottom-0 text-uppercase">Name</th>
                                        <th class="border-bottom-0 text-uppercase">Contact</th>
                                        <th class="border-bottom-0 text-uppercase">Email</th>
                                        <th class="border-bottom-0 text-uppercase">Expertise</th>
                                        @if(Gate::check('edit trainer') || Gate::check('delete trainer'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trainers as $trainer)
                                    <tr>
                                        <td>{{ $trainer->company->name }}</td>
                                        <td>{{ $trainer->branch->name }}</td>
                                        <td>{{ $trainer->name }}</td>
                                        <td>{{ $trainer->contact }}</td>
                                        <td>{{ $trainer->email }}</td>
                                        <td>{{ Str::limit($trainer->expertise, 20) }}</td>
                                        @if(Gate::check('edit trainer') || Gate::check('delete trainer'))
                                        <td>
                                            @can('edit trainer')
                                            <a href="{{ route('admin.trainers.edit', $trainer) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete trainer')
                                            <a href="#" class="action-btns1" title="Delete" onclick="confirmDelete(event, 'deletetrain_{{ $trainer->id }}');">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </a>
                                            <form id="deletetrain_{{ $trainer->id }}');" action="{{ route('admin.trainers.destroy', $trainer) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                        @endcan
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

                    <!-- ADD trainer MODAL -->
                        <div class="modal fade"  id="addtrainer">
                            <div class="modal-dialog modal-lg" role="document">
                                <form action="{{ route('admin.trainers.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create Trainer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Company:</label>
                                                            <select id="company_id" name="company" onchange="updateBranches()" class="form-control form-select required-field" >
                                                                <option value="">Select Branch </option>
                                                                @foreach($companies as $company)
                                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Branch:</label>
                                                            <select id="branch_id" name="branch" class="form-control form-select  required-field" >
                                                                <option value="">Select Branch </option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Name:</label>
                                                            <input type="text" class="form-control required-field" placeholder="Enter Name" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email:</label>
                                                            <input required type="email" class="form-control required-field"  placeholder="Enter Email" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Contact:</label>
                                                            <input type="text" class="form-control  required-field"  placeholder="Enter Contact" name="contact">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Expertise:</label>
                                                                <input type="text" class="form-control  required-field" placeholder="Enter Expertise" name="expertise">
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <!-- END ADD trainer MODAL -->

@endsection

@section('scripts')


<script>

    function updateBranches(){
        var company_id = document.getElementById('company_id').value;

        if(company_id){

            var branches = {!! json_encode($branches) !!}

            var branchesOptions = branches.filter(function(branch){
                return branch.company_id == company_id;
            });

            var branchesDropdown = '';
            branchesOptions.forEach(function(branch){
                branchesDropdown += `<option value="${branch.id}"> ${branch.name} </option>`;
            });

            var branchDropdown = document.getElementById('branch_id');
            branchDropdown.innerHTML = branchesDropdown;

        }
    }


</script>

@endsection