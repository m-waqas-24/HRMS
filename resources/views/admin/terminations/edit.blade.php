@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Termination</div>
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
                        <h4 class="card-title">Edit Termination</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.terminations.update', $termination) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Employe:</label>
                                    <select required id="employe" name="employee" class="form-control form-select" >
                                        <option value="">Choose Employe</option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{ $employe->id == $termination->emp_id ? 'selected' : '' }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Termination Type:</label>
                                    <select required id="company_id" name="termination_type" class="form-control form-select" >
                                        <option value="">Choose Type</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $termination->termination_type ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Notice Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Complaint Title" name="notice_date" value="{{ $termination->notice_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Termination Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Complaint Title" name="terminat_date" value="{{ $termination->terminat_date }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                    <textarea name="description" placeholder="Description" class="form-control" id="" cols="10" rows="10">{{ $termination->description }}</textarea>
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

