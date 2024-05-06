@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Settings</div>
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

            <div class="col-xl-4 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">

                            @include('system-settings.links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header  border-0">
                                <h4 class="card-title">System Settings</h4>
                            </div>
                            <div class="card-body">
                               <form action="{{ route('admin.system-setting.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Currency Symbol:</label>
                                            <div class="input-group">
                                                <input type="text" name="currency_symbol" class="form-control" value="{{ @$system->currency_symbol }}" placeholder="Enter Currency Symbol e.g Rs or $" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Currency Symbol Position:</label>
                                            <div class="input-group d-flex align-items-center">
                                                <input type="radio" name="currency_position" value="1" @if(@$system->currency_position == 1) checked @endif class="me-1" id="Pre"> <strong>Pre</strong>
                                                <input type="radio" class="ms-4 me-1" value="2" @if(@$system->currency_position == 2) checked @endif name="currency_position" id="Post"> <strong>Post</strong>
                                            </div>
                                        </div>
                                    </div>

                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">EmployeeID Prefix:</label>
                                                <div class="input-group">
                                                    <input type="text" name="employee_prefix" class="form-control" value="{{ @$system->emp_prefix }}" placeholder="Enter Employee Prefix e.g #EMP" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Invoice Prefix:</label>
                                            <div class="input-group">
                                                <input type="text" name="invoice_prefix" class="form-control" value="{{ @$system->inv_prefix }}" placeholder="Enter Invoice Prefix e.g #INV" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary mt-4 ">Save Changes</button>
                                </div>
                                <span id="error" class="text-danger"></span>
                               </form>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>

        </div>
        <!-- END ROW -->
    </div>
</div><!-- end app-content-->


@endsection
