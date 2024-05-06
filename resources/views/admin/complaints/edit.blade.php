@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Complaint</div>
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
                        <h4 class="card-title">Edit Complaint</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Complaint From:</label>
                                    <select required id="employe" name="employee" class="form-control form-select" >
                                        <option value="">Choose....</option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{  $employe->id == $complaint->emp_id ? 'selected' : '' }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Complaint To:</label>
                                    <select required id="company_id" name="against_employee" onchange="updateBranches()" class="form-control form-select" >
                                        <option value="">Choose....</option>
                                        @foreach($employes as $employe)
                                        <option value="{{ $employe->id }}" {{  $employe->id == $complaint->against_emp_id ? 'selected' : '' }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title:</label>
                                    <input required type="text" class="form-control"  placeholder="Enter Complaint Title" name="title" value="{{ $complaint->title }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Complaint Date:</label>
                                    <input required type="date" class="form-control"  placeholder="Enter Complaint Title" name="date" value="{{ $complaint->date }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description:</label>
                                    <textarea name="description" placeholder="Description" class="form-control" id="" cols="10" rows="10">{{ $complaint->description }}</textarea>
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

