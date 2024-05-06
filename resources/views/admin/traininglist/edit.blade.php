@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Training</div>
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
                        <h4 class="card-title">Edit Training</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.traininglists.update', $traininglist) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Company:</label>
                                    <select required id="company_id" name="company" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Select Company </option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $traininglist->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
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
                                    <label class="form-label">Trainer Option:</label>
                                    <select required id="company_id" name="trainer_option" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Select Option </option>
                                        <option value="1" {{ $traininglist->company_id == 1 ? 'selected' : '' }}>Internal</option>
                                        <option value="2" {{ $traininglist->company_id == 2 ? 'selected' : '' }}>External</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Trainer Type:</label>
                                    <select required id="company_id" name="training_type" class="form-control form-select" >
                                        <option value="">Select Type </option>
                                        @foreach ($trainingTypes as $type )
                                            <option value="{{ $type->id }}"  {{ $traininglist->training_type == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Trainer:</label>
                                    <select required id="company_id" name="trainer" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Select Trainer </option>
                                        @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}" {{ $traininglist->trainer_id == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Training Cost:</label>
                                    <input required type="number" class="form-control"  placeholder="Enter Training Cost" name="cost" value="{{ $traininglist->cost }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Employe:</label>
                                    <select required id="company_id" name="employee" class="form-control form-select" >
                                        <option value="">Select Employe </option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{ $traininglist->employee_id == $employe->id ? 'selected' : '' }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Start Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Contact" name="start_date" value="{{ $traininglist->start_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">End Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Contact" name="end_date"  value="{{ $traininglist->end_date }}">
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