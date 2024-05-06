@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Awards</div>
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
                        <h4 class="card-title">Edit Awards</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.awards.update', $award) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Employee Name</label>
                                    <select name="employee" class="form-control form-select required-field" >
                                        <option value="">Select Employee</option>
                                        @foreach($employees as $employe)
                                        <option value="{{ $employe->id }}" {{ $employe->id == $award->emp_id ? 'selected' : "" }}>{{ $employe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Award Types</label>
                                    <select name="award_type" class="form-control custom-select required-field">
                                        <option value="">Choose Award Type</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $award->type_id ? 'selected' : "" }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Gift Types</label>
                                    <select name="gift"  class="form-control custom-select required-field">
                                        <option value="">Choose Gift</option>
                                        @foreach($gifts as $gift)
                                        <option value="{{ $gift->id }}" {{ $gift->id == $award->gift_id ? "selected" : ""  }}> {{ $gift->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date:</label>
                            <div class="input-group">
                                <input type="date" name="date" value="{{ $award->date }}"  class="form-control required-field" placeholder="select dates"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Award Description:</label>
                            <textarea class="form-control" rows="3" name="description" placeholder="Description....">{{ $award->desc }}</textarea>
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