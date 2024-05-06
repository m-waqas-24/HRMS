@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Holidays</div>
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
                        <h4 class="card-title">Edit Holiday</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.holidays.update', $holiday) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">Enter Occasion</label>
                                </div>
                                <div class="col-md-9">
                                    <input required name="title" value="{{ $holiday->title }}" type="text" class="form-control"  placeholder="Occasion email" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">From</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" required name="start_date" value="{{ $holiday->start_date }}" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mb-0 mt-2">To</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" required name="end_date" value="{{ $holiday->end_date }}" class="form-control"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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