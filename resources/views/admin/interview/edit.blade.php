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
                        <a  href="{{ route('admin.recruitments.index') }}">Interviews</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Interview</li>
                </ol>
            </nav>
        </div>

        <form action="{{ route('admin.interviews.update', $interview) }}" method="POST">
            @csrf
           @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Candidate </label>
                            <select required name="candidate" id="" class="form-control custom-select select2">
                                <option value="">Select Candidate</option>
                                @foreach($candidates as $candidate)
                                <option value="{{ $candidate->id }}" {{ $candidate->id == $interview->candidate_id ? "selected" : "" }}>{{ $candidate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Interviewer </label>
                            <select required name="interviewer" id="" class="form-control custom-select select2">
                                <option value="">Select Interviewer</option>
                                @foreach($employes as $employe)
                                <option value="{{ $employe->id }}" {{ $employe->id == $interview->emp_id ? "selected" : "" }}>{{ $employe->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Interviewer Date and Time:</label>
                            <input required type="datetime-local" class="form-control" name="datetime" value="{{ $interview->date_time }}">
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