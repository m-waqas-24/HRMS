@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Transfer</div>
                @include('admin.breadcrumbs')
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
                        <h4 class="card-title">Edit Transfer</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.transfers.update', $transfer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Employe:</label>
                                    <select required id="employe" name="employee" class="form-control form-select" >
                                        <option value="">Select Employe </option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{ $employe->id == $transfer->emp_id ? 'selected' : ''  }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Company:</label>
                                    <select required id="company_id" name="company" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Select Company </option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $transfer->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Branch:</label>
                                    <select required id="branch_id" name="branch" class="form-control form-select" >
                                        <option value="">Select Branch </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Transfer Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Training Cost" name="date" value="{{ $transfer->date }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                    <textarea name="description" class="form-control" placeholder="Description" id="" cols="30" rows="10">{{ $transfer->description }}</textarea>
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