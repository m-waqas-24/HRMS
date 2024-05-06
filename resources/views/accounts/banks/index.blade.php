@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Banks</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create banks')
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbankmodal"><i class="feather feather-plus"></i>  Add New</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">

            <div class="col-md-12">  
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Bank Name</th>
                                        @if(Gate::check('edit banks')  || Gate::check('delete banks'))
                                            <th class="border-bottom-0 text-uppercase font-weight-bold">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banks as $bank)
                                    <tr>
                                        <td>{{ $bank->name }}</td>
                                        @if(Gate::check('edit banks')  || Gate::check('delete banks'))
                                        <td>
                                            @can('edit banks')
                                                <a href="#" class="btn btn-primary btn-icon btn-sm edit-bank" data-bank-id={{ $bank->id }}>
                                                    <i class="feather feather-edit" ></i>
                                                </a>
                                            @endcan
                                            @can('delete banks')
                                                <a class="btn btn-danger btn-icon btn-sm" href="#"  onclick="confirmDelete(event, 'deletebanks_{{ $bank->id }}');"><i class="feather feather-trash-2"></i></a>
                                                <form id="deletebanks_{{ $bank->id }}" action="{{ route('admin.banks.destroy', $bank->id) }}" method="POST" style="display: none">
                                                    @csrf
                                                    <button type="submit">Delete</button>
                                                </form>
                                            @endcan                                           
                                        </td>
                                        @endif
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

                    @can('create banks')
                        <!-- ADD categories options MODAL -->
                        <div class="modal fade"  id="addbankmodal">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.banks.store') }}" method="POST">
                                    @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Bank</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <input type="text" name="name" class="form-control required-field" placeholder="Enter Bank Name" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit"  class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <!-- END ADD categories type MODAL -->
                    @endcan

                    @can('edit banks')
                        <div class="modal fade"  id="editbankmodal">
                            <div class="modal-dialog" role="document">
                                <form id="editbankForm" action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Bank</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="form-label">Bank Name</label>
                                                <input type="text" name="name" class="form-control required-field" placeholder="Enter Bank Name" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit"  class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>
                    @endcan

                    


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.edit-bank').click(function() {
            var bankId = $(this).data('bank-id');
            console.log(bankId)

            $.ajax({
                url: "{{ route('admin.banks.edit') }}",
                type: 'POST', 
                data: {
                    bankId: bankId, 
                },
                success: function(response) {
                    console.log(response.bank)

                    $('#editbankmodal input[name="name"]').val(response.bank.name);

                    var editUserFormAction = "{{ route('admin.banks.update') }}/" + response.bank.id;
                    $('#editbankForm').attr('action', editUserFormAction);

                    $('#editbankmodal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
    
@endsection