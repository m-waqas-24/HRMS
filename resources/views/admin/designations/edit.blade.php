@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Designations</div>
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
                        <h4 class="card-title">Edit Designation</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.designations.update', $designation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">Edit Department</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="department" class="form-control form-select required-field">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $depart)
                                        <option value="{{ $depart->id }}" {{ $depart->id == $designation->department_id ? 'selected' : '' }}>{{ $depart->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">Designation Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="name" value="{{ $designation->name }}" type="text" class="form-control required-field"  placeholder="designation name">
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