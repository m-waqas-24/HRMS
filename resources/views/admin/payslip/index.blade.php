@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employee Payslips</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list mt-3 mt-lg-0">
                        {{-- <button  class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal">
                            <i class="las la-file-excel"></i>  Download Monthly Excel Report
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="file-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5 text-uppercase">#Emp ID</th>
                                        <th class="border-bottom-0 text-uppercase">NAME</th>
                                        <th class="border-bottom-0 text-uppercase">Salary Month</th>
                                        {{-- <th class="border-bottom-0 text-uppercase">Status</th> --}}
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payslips as $pay)
                                    <tr>
                                        <td>{{ $pay->employe->empID }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14"><a href=""> {{ $pay->employe->name }} </a></h6>
                                                    <p class="text-muted mb-0 fs-12"> {{ $pay->employe->user->email }} </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $pay->Month->name }}
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-icon btn-sm" href="{{ route('admin.show.payslips',  $pay->id) }}">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                        </td>
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

@endsection


