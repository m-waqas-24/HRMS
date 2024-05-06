@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Job View</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    {{-- <div class="btn-list">
                        <a  href="javascript:void(0);" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addjobmodal"><i class="feather feather-plus fs-15 my-auto me-2"></i>Add New Job</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-3 col-md-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Overview</h4>
                    </div>
                    <div class="card-body pb-0 pt-3">
                        <div class="mt-3">
                            <label class="form-label mb-0">vacancy:</label>
                            <p class="text-muted">{{ $recruitment->vacancy }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="form-label mb-0">Job Type:</label>
                            <p class="text-muted">
                                @if($recruitment->job_type == 1)
                                Full-Time
                                @elseif($recruitment->job_type == 2)
                                Part-Time
                                @endif
                            </p>
                        </div>
                        <div class="mt-3">
                            <label class="form-label mb-0">Posted Date:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($recruitment->created_at)->format('d F, Y') }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="form-label mb-0">Last Date To Apply:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($recruitment->last_date)->format('d F, Y') }}</p>
                        </div>
                    </div>
                    <div class="card-footer border-top-0">
                        {{-- <div class="btn-list">
                            <a href="job-apply.html" class="btn btn-primary"><i class="feather feather-check my-auto me-2"></i>Apply Now</a>
                            <a  href="javascript:void(0);" class="btn btn-outline-primary"><i class="feather feather-phone-call  my-auto me-2"></i>Contact Now</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5">
                            <a class="text-dark"  href="javascript:void(0);">
                            <h3 class="mb-2">{{ $recruitment->title }}</h3></a>
                            <div class="d-flex">
                                <ul class="mb-0 d-md-flex">
                                    <li class="me-5">
                                        <a class="icons"  href="javascript:void(0);"><i class="si si-briefcase text-muted me-1"></i> {{ $recruitment->company->name }}</a>
                                    </li>
                                    <li class="me-5">
                                        <a class="icons"  href="javascript:void(0);"><i class="si si-location-pin text-muted me-1"></i> {{ $recruitment->city }}</a>
                                    </li>
                                    {{-- <li class="me-5" data-bs-placement="top" data-bs-toggle="tooltip" title="Views">
                                        <a class="icons"  href="javascript:void(0);"><i class="si si-eye text-muted me-1"></i> 765</a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                        <h5 class="mb-4 font-weight-semibold">Description</h5>
                        
                        {!! $recruitment->description !!}

                    </div>
                    <div class="card-body">
                        <div class="list-id">
                            <div class="row">
                                <div class="col">
                                    <a class="mb-0">Job ID : {{ $recruitment->jobID }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="icons">
                            <a class="btn btn-primary icons mt-2 mb-2" data-bs-target="#apply" data-bs-toggle="modal"  href="javascript:void(0);"><i class="si si-check me-1"></i>Apply</a>
                            <a class="btn btn-warning icons mt-2 mb-2"  href="javascript:void(0);"><i class="si si-share me-1"></i> Share Job</a>
                            <a class="btn btn-success icons mt-2 mb-2"  href="javascript:void(0);"><i class="si si-printer me-1"></i> Print</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection