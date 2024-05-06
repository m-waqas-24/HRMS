@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Users</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                    <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                    <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row flex-lg-nowrap">
            <div class="col-12">
                <div class="row flex-lg-nowrap">
                    <div class="col-12 mb-3">
                        <div class="e-panel card">
                            <div class="card-body pb-2">    
                                <div class="row">

                                    @foreach($users as $user)
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card border p-0 shadow-none" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important; ">
                                            <div class="d-flex align-items-center p-4">
                                                <span class="badge badge-primary text-white">{{ $user->getRoleName() }}</span>
                                                <div class="float-end ms-auto">
                                                    <div class="btn-group ms-3 mb-0">
                                                        <a  href="javascript:void(0);" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-start">
                                                            <a class="dropdown-item edit-user"  href="#" data-user-id="{{ $user->id }}"><i class="fe fe-edit me-2"></i> Edit</a>
                                                            <a class="dropdown-item delete-user"  href="#" data-duser-id="{{ $user->id }}"><i class="fe fe-trash me-2"></i> Delete</a>
                                                            <a class="dropdown-item update-password"  href="#" data-puser-id="{{ $user->id }}"><i class="fa fa-gears me-2"></i> Reset Password</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center pt-0" style="height: 220px !important">
                                                @if(@$user->employe && @$user->avatar)
                                                <img src="{{ asset('storage/'.$user->avatar) }}" class="userr-img" height="100" width="100" alt="">
                                                @else
                                                <img src="{{ asset('assets/images/users/user.jpg') }}" class="userr-img" height="100" width="100" alt="">
                                                @endif
                                                <div class="mb-3">
                                                    <div class="h4 mt-4 text-primary fw-bold" style="font-weight: 700 !important">{{ $user->name }}</div>
                                                </div>
                                                <div class="">
                                                    <div class="h6 mt-4 text-primary">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <p data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Last Login">2023-07-28 17:05:47</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class='d-flex'>
                                    {!! $users->links() !!}
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

<!-- edit user MODAL -->
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
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control form-select" id="">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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
<!-- END edit user MODAL -->

<!-- edit password MODAL -->
<div class="modal fade"  id="editpassword">
    <div class="modal-dialog" role="document">
        <form id="editPasswordForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input required class="form-control required" type="text" name="password" placeholder="Enter New Password">
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
<!-- END edit password MODAL -->


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
            console.log(userId)

            $.ajax({
                url: "{{ route('admin.edit.user.list') }}",
                type: 'POST', 
                data: {
                    userId: userId,
                },
                success: function(response) {
                    var roleId = response.roleId;

                    $('#editusermodal input[name="name"]').val(response.user.name);
                    $('#editusermodal input[name="email"]').val(response.user.email);
                    $('#editusermodal select[name="role"]').val(roleId);

                    var updateUserFormAction = "{{ route('admin.update.user.list') }}/" + response.user.id;
                    $('#editUserForm').attr('action', updateUserFormAction);

                    $('#editusermodal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('.update-password').click(function() {
            var passworduserId = $(this).data('puser-id');


            var formaCtion = "{{ route('admin.update.password.list') }}/" + passworduserId;
            $('#editPasswordForm').attr('action', formaCtion);
            $('#editpassword').modal('show');
        });

        $('.delete-user').click(function(){
            var delUserId = $(this).data('duser-id');
            console.log(delUserId);

        Swal.fire({
        title: 'Do you want to delete this?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Delete',
        denyButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                deleteItem(delUserId);
            } else {
            
            }
        });
    });

    function deleteItem(delUserId){
        $.ajax({
                url: "{{ route('admin.delete.user.list') }}/" + delUserId ,
                type: 'POST',
                success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'User Deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                title: 'my-custom-font-size'
                            },
                            didDestroy: function() {
                                // This function will be called after the Swal modal is destroyed
                                location.reload();
                            }
                        });
                    },
                error: function(error) {
                    console.error(error);
                }
            });
    }

    });
</script>

@endsection