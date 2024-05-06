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
                        <a  href="{{ route('admin.recruitments.index') }}">Candidates</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Candidate</li>
                </ol>
            </nav>
        </div>

        


        <form action="{{ route('admin.candidates.update', $candidate) }}" method="POST" enctype="multipart/form-data">
            @csrf
           @method('PUT')
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Applied For</label>
                            <select name="job" class="form-control form-select" >
                                <option value="">Select Job </option>
                                @foreach($jobs as $job)
                                <option value="{{ $job->id }}" {{ $job->id == $candidate->job_id ? 'selected' : '' }}>{{ $job->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $candidate->name }}" class="form-control" placeholder="Enter Candidate Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone:</label>
                            <input class="form-control" name="phone" value="{{ $candidate->phone }}" type="text" placeholder="Enter Candidate Phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Resume\CV:</label>
                            <input class="form-control" name="resume" value="{{ asset('storage/'.$candidate->file) }}" type="file" >
                            <iframe src="{{ asset('storage/'.$candidate->file) }}" width="100%" height="400px"></iframe>
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