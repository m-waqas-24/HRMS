@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Leave Settings</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addleavemodal">Add Leave Type</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Leaves Types</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-leavestypes">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Leaves Type</th>
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leavestatus as $status)
                                        <tr>
                                            <td>{{ $status->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a  href="{{ route('admin.leavestatus.edit', $status) }}" class="action-btns1"><i class="feather feather-edit primary text-primary"></i></a>
                                                    {{-- <a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a> --}}
                                                </div>
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