@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Training List</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create traininglist')
                            <a href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addtraining"><i class="feather feather-plus"></i> Add Training</a>
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
                        <h4 class="card-title">Training Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Company</th>
                                        <th class="border-bottom-0 text-uppercase">Training Type</th>
                                        <th class="border-bottom-0 text-uppercase">Trainer</th>
                                        <th class="border-bottom-0 text-uppercase">Cost</th>
                                        <th class="border-bottom-0 text-uppercase">Employee</th>
                                        <th class="border-bottom-0 text-uppercase">Duration</th>
                                        @if(Gate::check('edit traininglist') || Gate::check('delete traininglist'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trainingLists as $list)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $list->company->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $list->branch->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $list->trainingType->name ?? '' }}</h6>
                                                    <p class="text-muted mb-0 fs-12">
                                                        @if($list->trainer_option == 1)
                                                        Internal
                                                        @elseif($list->trainer_option == 2)
                                                        External
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $list->trainer->name }}
                                        </td>
                                        <td>
                                            {{ $list->cost }}
                                        </td>
                                        <td>
                                            {{ $list->employe->name }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($list->start_date)->format('d F, Y') . " To " . \Carbon\Carbon::parse($list->end_date)->format('d F, Y') }}
                                        </td>
                                        @if(Gate::check('edit traininglist') || Gate::check('delete traininglist'))
                                        <td>
                                            @can('show traininglist')
                                            <a href="{{ route('admin.traininglists.show', $list) }}" class="btn btn-success btn-icon btn-sm">
                                                <i class="feather feather-eye" ></i>
                                            </a>
                                            @endcan
                                            @can('edit traininglist')
                                            <a href="{{ route('admin.traininglists.edit', $list) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete traininglist')
                                            <a href="#" class="action-btns1" title="Delete" onclick="confirmDelete(event, 'deletetr_{{ $leave->id }}');">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </a>
                                            <form id="deletetr_{{ $leave->id }}');" action="{{ route('admin.traininglists.destroy', $list) }}" method="POST" style="display: none">
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

                @can('create traininglist')
                <!-- ADD Training MODAL -->
                    <div class="modal fade"  id="addtraining">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.traininglists.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Training</h5>
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
                                                            <option value="">Select Company </option>
                                                            @foreach($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Branch:</label>
                                                        <select id="branch_id" name="branch" class="form-control form-select required-field" >
                                                            <option value="">Select Branch </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Training Option:</label>
                                                        <select id="company_id" name="trainer_option"  class="form-control form-select required-field" >
                                                            <option value="">Select Option </option>
                                                            <option value="1">Internal</option>
                                                            <option value="2">External</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Training Type:</label>
                                                        <select id="company_id" name="training_type" class="form-control form-select required-field" >
                                                            <option value="">Select Type </option>
                                                            @foreach ($trainingTypes as $type )
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Trainer:</label>
                                                        <select id="company_id" name="trainer" class="form-control form-select required-field" >
                                                            <option value="">Select Trainer </option>
                                                            @foreach($trainers as $trainer)
                                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Training Cost:</label>
                                                        <input type="number" class="form-control required-field"  placeholder="Enter Training Cost" name="cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Employe:</label>
                                                        <select id="company_id" name="employee" class="form-control form-select required-field" >
                                                            <option value="">Select Employe </option>
                                                            @foreach($employes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Start Date:</label>
                                                        <input type="date" class="form-control  required-field"  placeholder="Enter Contact" name="start_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">End Date:</label>
                                                        <input required type="date" class="form-control  required-field"  placeholder="Enter Contact" name="end_date">
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