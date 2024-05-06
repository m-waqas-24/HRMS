@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card" >
                    <div class="card-body">
                        {{-- <h6 class="card-title"> Details</h6> --}}
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">Employee Name: </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $traininglist->employe->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">Training Type: </span>
                                        </td>
                                        <td class="py-2 px-0">{{ $traininglist->trainingType->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">Trainer: </span>
                                        </td>
                                        <td class="py-2 px-0"> {{ $traininglist->trainer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">Training Cost: </span>
                                        </td>
                                        <td class="py-2 px-0">
                                            {{ $traininglist->cost }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">Start Date </span>
                                        </td>
                                        <td class="py-2 px-0">{{ \Carbon\Carbon::parse($traininglist->start_date)->format('d F, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-0">
                                            <span class="font-weight-bold ">End Date: </span>
                                        </td>
                                        <td class="py-2 px-0">{{ \Carbon\Carbon::parse($traininglist->end_date)->format('d F, Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" >
                    <form action="{{ route('admin.traininglists.updateStatus', $traininglist) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h6 class="card-title">Update Status</h6>
                            <p class="border-bottom"></p>
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Peformance</label>
                                        <select name="performance" class="form-control form-select" id="">
                                            <option value="1" {{ $traininglist->performance == 1 ? 'selected' : '' }}>Not Concluded</option>
                                            <option value="2" {{ $traininglist->performance == 2 ? 'selected' : '' }}>Satisfactory</option>
                                            <option value="3" {{ $traininglist->performance == 3 ? 'selected' : '' }}>Average</option>
                                            <option value="4" {{ $traininglist->performance == 4 ? 'selected' : '' }}>Poor</option>
                                            <option value="5" {{ $traininglist->performance == 5 ? 'selected' : '' }}>Excellent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control form-select" id="">
                                            <option value="1" {{ $traininglist->status == 1 ? 'selected' : '' }}>Pending</option>
                                            <option value="2" {{ $traininglist->status == 2 ? 'selected' : '' }}>Started</option>
                                            <option value="3" {{ $traininglist->status == 3 ? 'selected' : '' }}>Completed</option>
                                            <option value="4" {{ $traininglist->status == 4 ? 'selected' : '' }}>Training</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <textarea name="remarks" class="form-control" placeholder="Remarks" id="" cols="30" rows="10">{{ $traininglist->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection