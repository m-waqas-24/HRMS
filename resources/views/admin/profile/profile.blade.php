@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Profile</div>
            </div>
            <div class="page-rightheader ms-xl-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                        <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                        <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        @include('admin.errors')

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="text-center my-5">
                        <form id="imageForm" action="{{ route('admin.update.photo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" id="fileInput" name="avatar" style="display: none;">
                            <img id="imgLabel" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Click to Change Profile" class="userr-img" height="150" class="img-fluid" alt="{{ auth()->user()->name }}" 
                                @if(isset(auth()->user()->avatar)) 
                                    src="{{ asset('storage/'.auth()->user()->avatar)}}" 
                                @else 
                                    src="{{ asset('assets/images/users/7.jpg')}}" 
                                @endif
                            >                        
                            <input type="submit" class="d-none" value="Submit">
                        </form>

                    </div>
                    <div class="nav flex-column admisetting-tabs" id="settings-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" data-bs-toggle="pill" href="#tab-1" role="tab">
                             Personal Info
                        </a>
                        <a class="nav-link"  data-bs-toggle="pill" href="#tab-2" role="tab">
                           Change Password
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="tab-content adminsetting-content" id="setting-tabContent">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                        <form action="{{ route('admin.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header  border-0">
                                    <h4 class="card-title">Personal Info</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label mb-0 mt-2">Name:</label>
                                            <input name="name" type="text" value="{{ auth()->user()->name }}" class="form-control"  placeholder="Enter Username">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0 mt-2">Email:</label>
                                            <input  name="email" type="text" value="{{ auth()->user()->email }}" class="form-control"  placeholder="Enter Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel">
                       <form action="{{ route('admin.update.password') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header  border-0">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Current Password</label>
                                                <div class="input-group mb-4">
                                                    <div class="input-group" id="Password-toggle">
                                                        <a href="#" class="input-group-text">
                                                            <i class="fe fe-eye-off" aria-hidden="true"></i>
                                                        </a>
                                                        <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Current Password" required autocomplete="current-password">
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">New Password</label>
                                                <div class="input-group mb-4">
                                                    <div class="input-group" id="Password-toggle">
                                                        <a href="#" class="input-group-text">
                                                            <i class="fe fe-eye-off" aria-hidden="true"></i>
                                                        </a>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" required autocomplete="current-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirmed Password</label>
                                                <div class="input-group mb-4">
                                                    <div class="input-group" id="Password-toggle">
                                                        <a href="#" class="input-group-text">
                                                            <i class="fe fe-eye-off" aria-hidden="true"></i>
                                                        </a>
                                                        <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmed Password" required autocomplete="current-password">
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                            </div>
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

@section('scripts')

<script>
    $(document).ready(function() {
        $("#imgLabel").click(function() {
            $("#fileInput").click();
        });

        // Update the image source when a file is selected
        $("#fileInput").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgLabel').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Automatically submit the form after selecting an image
        $("#fileInput").change(function() {
            $("#imageForm").submit();
        });
    });
</script>
    
@endsection