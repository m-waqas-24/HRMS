@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Trainer</div>
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
                        <h4 class="card-title">Edit Trainer</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.trainers.update', $trainer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Company:</label>
                                    <select required id="company_id" name="company" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Select Branch </option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->id == $trainer->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
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
                                    <label class="form-label">Name:</label>
                                    <input required type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $trainer->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email:</label>
                                    <input required type="email" class="form-control"  placeholder="Enter Email" name="email" value="{{ $trainer->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Contact:</label>
                                    <input required type="text" class="form-control"  placeholder="Enter Contact" name="contact" value="{{ $trainer->contact }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expertise:</label>
                                        <input required type="text" class="form-control" placeholder="Enter Expertise" name="expertise" value="{{ $trainer->expertise }}">
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