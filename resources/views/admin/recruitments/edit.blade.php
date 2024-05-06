@extends('admin.layouts.app')

@section('content')


<div class="app-content main-content mt-3">
    <div class="side-app main-container">

        <div class="card">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a  href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a  href="{{ route('admin.recruitments.index') }}">Recruitments</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Job</li>
                </ol>
            </nav>
        </div>

        <form action="{{ route('admin.recruitments.update', $recruitment) }}" method="POST">
            @csrf
           @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company Name</label>
                            <select required name="company" id="" class="form-control custom-select select2">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id === $recruitment->company_id ? "selected" : "" }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Job Title</label>
                            <input class="form-control" name="title" value="{{ $recruitment->title }}" placeholder="Job Title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Job Type:</label>
                            <select name="Job_type"  class="form-control custom-select select2" data-placeholder="Select Job Type">
                                <option label="Select Job Type"></option>
                                <option value="1" {{ $recruitment->job_type === 1 ? "selected" : "" }}>Full-Time</option>
                                <option value="2" {{ $recruitment->job_type === 2 ? "selected" : "" }}>Part-Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">No.of Vacancy</label>
                            <input class="form-control" name="vacancy" value="{{ $recruitment->vacancy }}" placeholder="Vacancy">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Last Date To Apply</label>
                            <div class="input-group">
                                <input class="form-control" name="last_date" value="{{ $recruitment->last_date }}" placeholder="DD-MM-YYY" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enter City:</label>
                            <input class="form-control" name="city" value="{{ $recruitment->city }}" placeholder="City">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select required name="status" id="" class="form-control custom-select select2">
                                <option value="">Select Job Status</option>
                                <option value="1" {{ $recruitment->status_id == 1 ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $recruitment->status_id == 0 ? "selected" : "" }}>InActive</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Description:</label>
                            <textarea name="desc" id="textarea" cols="30" class="form-control" placeholder="Enter Job Description" rows="10">{{ $recruitment->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg" >Update</button>
                </div>
            </div>
        </form>

    </div>

    </div>
</div>

@endsection