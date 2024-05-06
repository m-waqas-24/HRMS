@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Transfers</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create transfer')
                        <a href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addtransfers"><i class="feather feather-plus"></i> </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->


    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <button  class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{ $error }}
                @endforeach
        </div>
    @endif

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Transfers</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Emp Name</th>
                                        <th class="border-bottom-0 text-uppercase">Previous Company</th>
                                        <th class="border-bottom-0 text-uppercase">New Company</th>
                                        <th class="border-bottom-0 text-uppercase">Transfer Date</th>
                                        <th class="border-bottom-0 text-uppercase">Description</th>
                                        @if(Gate::check('edit transfer') || Gate::check('delete transfer'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transfers as $transfer)
                                    <tr>
                                        <td> {{ $transfer->employe->name }} </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $transfer->prevCompany->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $transfer->prevBranch->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $transfer->company->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $transfer->branch->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{ \Carbon\Carbon::parse($transfer->date)->format('d F, Y')  }} </td>
                                        <td> {{ Str::limit($transfer->description, 20) }} </td>
                                        @if(Gate::check('edit transfer') || Gate::check('delete transfer'))
                                        <td>
                                            @can('edit transfer')
                                            <a href="{{ route('admin.transfers.edit', $transfer) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            @can('delete transfer')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deletetransfer_{{ $transfer->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletetransfer_{{ $transfer->id }}" action="{{ route('admin.transfers.destroy', $transfer) }}" method="POST" style="display: none">
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
                    <div class="modal fade"  id="addtransfers">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('admin.transfers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Transfer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
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
                                                        <label class="form-label">Transfer Date:</label>
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