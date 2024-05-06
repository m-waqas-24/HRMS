@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Holidays</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create holidays')
                        <a href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#holidaymodal"><i class="feather feather-plus"></i> Add Holiday</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Holidays Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Title</th>
                                        <th class="border-bottom-0 text-uppercase">Date</th>
                                        <th class="border-bottom-0 text-uppercase">Days</th>
                                        @if(Gate::check('edit holidays') || Gate::check('delete holidays'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($holidays as $holiday)
                                    <tr>
                                        <td class="font-weight-semibold">{{ $holiday->title }}</td>
                                        <td>
                                        @if (\Carbon\Carbon::parse($holiday->start_date)->isSameDay(\Carbon\Carbon::parse($holiday->end_date)))
                                            {{ \Carbon\Carbon::parse($holiday->start_date)->format('d F Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($holiday->start_date)->format('d F Y') . " To " . \Carbon\Carbon::parse($holiday->end_date)->format('d F Y') }}
                                        @endif
                                        <td>
                                            ({{ \Carbon\Carbon::parse($holiday->start_date)->diffInDays($holiday->end_date) + 1 }} days)
                                        </td>
                                         @if(Gate::check('edit holidays') || Gate::check('delete holidays'))
                                        <td>
                                            @can('edit holidays')
                                            <a class="btn btn-primary btn-icon btn-sm" href="{{ route('admin.holidays.edit', $holiday) }}">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete holidays')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deleteholiday_{{ $holiday->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deleteholiday_{{ $holiday->id }}" action="{{ route('admin.holidays.destroy', $holiday) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->


            @can('create holidays')
            <!-- HOLIDAY MODAL -->
            <div class="modal fade"  id="holidaymodal">
                <div class="modal-dialog modal-lg" role="document">	
                    <form action="{{ route('admin.holidays.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Holidays</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label">Enter Occasion</label>
                                    <input class="form-control required-field" name="title" placeholder="Enter occasion title">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">From</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input name="start_date" class="form-control required-field" type="date" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="feather feather-calendar"></i>
                                            </div>
                                        </div><input name="end_date" class="form-control required-field" type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END HOLIDAY MODAL -->
            @endcan

@endsection
