@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employees</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="List View"><a href="{{ route('admin.employe-list') }}"><i class="feather feather-list"></i></a></button>
                        @can('create employee ')
                        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary me-3"><i class="feather feather-plus"></i> Add New Employee</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">

            @foreach($employes as $employe)
            <div class="col-xl-4 col-lg-6">
                <div class="card border p-0 shadow-none">
                    <span class="bookmark-sideright-ribbone-primary-right">
                        <span> {{ $employe->companyDetail->designation->name }}</span>
                    </span>
                    <div class="d-flex align-items-center p-4 mt-5">
                        <a href="{{ route('admin.employee.show', $employe) }}">
                            @if(!isset($employe->user->avatar))
                        <div class="avatar avatar-lg brround d-block cover-image" data-bs-image-src="{{ asset('assets/user.jpg') }}" >
                            @else
                        <div class="avatar avatar-lg brround d-block cover-image" data-bs-image-src="{{ asset('storage/'.$employe->user->avatar) }}" >
                            @endif
                        </a>
                        </div>
                        <div class="wrapper ms-3">
                            <p class="mb-0 mt-1 text-dark font-weight-semibold"><a href="{{ route('admin.employee.show', $employe) }}">{{ $employe->name }}</a></p>
                            <small class="text-muted">{{ $employe->user->email }}</small>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="d-flex mb-3">
                            <span class="icon-style-circle1 fa fa-map-signs f px-2"></span>
                            <div class="h6 mb-0 ms-3 mt-1 text-break">{{ Str::limit($employe->address,60) }}</div>
                        </div>
                        <div class="d-flex">
                            <span class="icon-style-circle1 ri-phone-line"></span>
                            <div class="h6 mb-0 ms-3 mt-1">{{ $employe->number }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <!-- END ROW -->


    </div>
</div><!-- end app-content-->


@endsection