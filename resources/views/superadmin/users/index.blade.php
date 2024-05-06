@extends('superadmin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">User</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    <a  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addusermodal" class="btn btn-primary me-3"><i class="feather feather-plus"></i> Add User</a>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $index => $error)
                    @if($index == 0)
                    <button type="button" class="btn-close" style="color: #FFF !important" data-bs-dismiss="alert" aria-hidden="true">×</button>
                    @endif
                        {{ $error }} <br>
                    @endforeach
            </div>
	    @endif

        

        <!-- ROW -->
        <div class="row flex-lg-nowrap">
            <div class="col-12">
                <div class="row flex-lg-nowrap">
                    <div class="col-12 mb-3">
                        <div class="e-panel card">
                            <div class="card-body pb-2">
                                
                                <div class="row">

                                    @if(count($users) <= 0)
                                    <p class="text-danger">Company Not Exist!</p>                                    
                                    @endif

                                    @foreach($users as $user)
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card border p-0 shadow-no" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                            <div class="d-flex align-items-center p-4">
                                                <div class="avatar avatar-lg brround d-block cover-image" data-bs-image-src="{{asset('assets/images/users/1.jpg') }}" >
                                                </div>
                                                <div class="wrapper ms-3">
                                                    <p class="mb-0 mt-1 text-dark font-weight-semibold ls-2"><strong>{{ $user->name }}</strong></p>
                                                    <small class="text-muted">{{ $user->type }}</small>
                                                </div>
                                                <div class="float-end ms-auto">
                                                    <div class="btn-group ms-3 mb-0">
                                                        <a  href="javascript:void(0);" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-start">
                                                            <button class="dropdown-item edit-user" data-user-id="{{ $user->id }}" type="button"><i class="fe fe-edit me-2"></i> Edit</button>
                                                            {{-- <a class="dropdown-item edit-user" data-user-id="{{ $user->id }}"  href="javascript:void(0);"><i class="fe fe-edit me-2"></i> Edit</a> --}}
                                                            <a class="dropdown-item" href="javascript:void(0);" data-user-id="123"><i class="fe fe-trash me-2"></i> Delete</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top">
                                                {{-- <p class="text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p> --}}
                                                <div class="d-flex mb-3">
                                                    <span class="icon-style-circle1 ri-mail-send-fill fs-18"></span>
                                                    <div class="h6 mb-0 ms-3 mt-1 text-break">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row ">
                                                    <div class="col-6 mb-4">
                                                        <span class="fw-bold fs-16 ls-1">{{ \App\Models\Plan::find($user->plan)->name  }}</span>
                                                    </div>
                                                    <div class="col-6 mb-4 ">
                                                        <a href="" class="btn btn-outline-success btn-sm">Upgrade Plan</a>
                                                    </div>
                                                    <div class="col-12" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                                        <p class="mt-3">Plan Expired On :  <strong> {{ $user->subscription_end_date ? \Carbon\Carbon::parse($user->subscription_end_date)->format('d F, Y') : "Lifetime" }} </strong> </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="#"><i class="feather feather-user me-2"></i> 
                                                        @php
                                                             $employeCount =  \App\Models\Employe::where('created_by', $user->creatorId())->count();
                                                        @endphp 
                                                        {{ $employeCount }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

<!-- ADD user MODAL -->
<div class="modal fade"  id="addusermodal">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('superadmin.store-users') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input required class="form-control" type="text" name="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input required  class="form-control" type="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group" id="Password-toggle">
                                            <a href="#" class="input-group-text">
                                                <i class="fe fe-eye-off" aria-hidden="true"></i>
                                            </a>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
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
                                <label class="form-label">Plans</label>
                                <select name="plan" class="form-control form-select" id="">
                                    <option value="">Select Plan</option>
                                    @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END ADD user MODAL -->


<!-- ADD user MODAL -->
<div class="modal fade"  id="editusermodal">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editUserForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input required class="form-control" type="text" name="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input required  class="form-control" type="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Plans</label>
                                <select name="plan" class="form-control form-select" id="">
                                    <option value="">Select Plan</option>
                                    @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Plan Expired On</label>
                                <input required  class="form-control" type="date" name="expired" placeholder="Enter date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END ADD user MODAL -->


@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.edit-user').click(function() {
            var userId = $(this).data('user-id');

            $.ajax({
                url: "{{ route('superadmin.edit-user') }}",
                type: 'POST', 
                data: {
                    userId: userId, 
                },
                success: function(response) {
                    console.log(response.user)

                    $('#editusermodal input[name="name"]').val(response.user.name);
                    $('#editusermodal input[name="email"]').val(response.user.email);
                    $('#editusermodal select[name="plan"]').val(response.user.plan);

                    var subscriptionEndDate = response.user.subscription_end_date;
                    if(subscriptionEndDate){
                        var datePart = subscriptionEndDate.split(' ')[0];
                        $('#editusermodal input[name="expired"]').val(datePart);
                    }

                    var editUserFormAction = "{{ route('superadmin.update-user') }}/" + response.user.id;
                    $('#editUserForm').attr('action', editUserFormAction);

                    $('#editusermodal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    document.querySelector('.dropdown-item').addEventListener('click', function() {
    const userId = this.getAttribute('data-user-id');
    console.log(userId)

    Swal.fire({
        title: 'Do you want to delete this?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Delete',
        denyButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Pass the user ID to the delete function or API endpoint
            deleteItem(userId);
        } else {
            // If the user denies, do nothing
        }
    });
});

function deleteItem(userId) {
    // Perform the delete operation using the userId, e.g., send an API request to delete the item
    // Example:
    // fetch(`/api/delete/${userId}`, {
    //     method: 'DELETE',
    //     // other necessary headers and credentials
    // })
    // .then(response => {
    //     // handle the response
    // })
    // .catch(error => {
    //     // handle errors
    // });
}

</script>


@endsection