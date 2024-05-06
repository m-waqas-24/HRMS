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
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Company Settings</h4>
                    </div>
                    <div class="card-body">
                       <form id="company-form" action="{{ route('admin.company-setting.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Logo Dark:</label>
                                    <div class="input-group">
                                        <input type="file" name="logoDark" class="dropify" data-default-file="{{ isset($companySetting->logoDark) ? asset('storage/'.$companySetting->logoDark) : '' }}" data-height="140" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Logo Light:</label>
                                    <div class="input-group">
                                        <input type="file" name="logoLight" class="dropify" data-default-file="{{ isset($companySetting->logoLight) ? asset('storage/'.$companySetting->logoLight) : '' }}" data-height="140" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Favicon:</label>
                                    <div class="input-group">
                                        <input type="file" name="favicon" class="dropify" data-default-file="{{ isset($companySetting->favicon) ? asset('storage/'.$companySetting->favicon) : '' }}" data-height="140" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" id="save-btn" class="btn btn-primary mt-4 ">Save Changes</button>
                        </div>
                        <span id="error" class="text-danger"></span>
                       </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->


@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('company-form'); 
        var error =  document.getElementById('error'); 

        form.addEventListener('submit', function(event) {
            var startTime = document.getElementById('start_time').value;
            var endTime = document.getElementById('end_time').value;

            if ((startTime && !endTime) || (!startTime && endTime)) {
                event.preventDefault();
                error.innerHTML = "Both start time and end time are required.";
            }
        });
    });
</script>

@endsection