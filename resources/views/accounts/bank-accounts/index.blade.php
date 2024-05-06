@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Bank Accounts</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create bank-accounts')
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbankaccountmodal"><i class="feather feather-plus"></i>  Add New</a>
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
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">ACCOUNT HOLDER Name</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">BANK NAme</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">ACCOUNT NUMBER</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">AVAILABLE BALANCE</th>
                                        @if(Gate::check('edit bank-accounts')  || Gate::check('delete bank-accounts'))
                                            <th class="border-bottom-0 text-uppercase font-weight-bold">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bankaccounts as $acc)
                                    <tr>
                                        <td>{{ $acc->account_holder }}</td>
                                        <td>{{ $acc->bank->name }}</td>
                                        <td>{{ $acc->account_no }}</td>
                                        <td>{{ $acc->balance }}</td>
                                        @if(Gate::check('edit bank-accounts')  || Gate::check('delete bank-accounts'))
                                            <td>
                                                @can('edit bank-accounts')
                                                    <a href="#" class="btn btn-primary btn-icon btn-sm edit-bankacc" data-bankacc-id={{ $acc->id }}>
                                                        <i class="feather feather-edit" ></i>
                                                    </a>
                                                @endcan
                                                @can('delete bank-accounts')
                                                    <a class="btn btn-danger btn-icon btn-sm" href="#"  onclick="confirmDelete(event, 'deleteacc_{{ $acc->id }}')"><i class="feather feather-trash-2"></i></a>
                                                    <form id="deleteacc_{{ $acc->id }}" action="{{ route('admin.bank-acc.destroy', $acc->id) }}" method="POST" style="display: none">
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

                @can('create bank-accounts')
					<div class="modal fade"  id="addbankaccountmodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.bank-acc.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add New Bank-Account</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Account Holder Name</label>
										<input type="text" name="account_holder" class="form-control required-field" placeholder="Enter Account Holder Name" >
									</div>
                                    <div class="form-group">
                                        <label class="form-label">Bank Name</label>
                                        <select name="bank"  class="form-control custom-select required-field">
                                            <option value="">Choose Bank</option>
                                            @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
										<label class="form-label">Account Number</label>
										<input type="text" name="account_no" class="form-control required-field" placeholder="Enter Account Number" >
									</div>
                                    <div class="form-group">
										<label class="form-label">Available Balance</label>
										<input type="number" name="balance" class="form-control required-field" placeholder="Enter Account Balance" >
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
                @endcan

                @can('edit bank-accounts')
                    <div class="modal fade"  id="editbankaccountmodal">
						<div class="modal-dialog" role="document">
							<form id="editaccountForm" action="" method="POST">
								@csrf
                                @method('PUT')
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Bank-Account</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Account Holder Name</label>
										<input type="text" name="account_holder" class="form-control required-field" placeholder="Enter Account Holder Name" >
									</div>
                                    <div class="form-group">
                                        <label class="form-label">Bank Name</label>
                                        <select name="bank"  class="form-control custom-select required-field">
                                            <option value="">Choose Bank</option>
                                            @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}"> {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
										<label class="form-label">Account Number</label>
										<input type="integer" name="account_no" class="form-control required-field" placeholder="Enter Account Number" >
									</div>
                                    <div class="form-group">
										<label class="form-label">Available Balance</label>
										<input type="text" name="balance" class="form-control required-field" placeholder="Enter Account Balance" >
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

        $('.edit-bankacc').click(function() {
            var bankId = $(this).data('bankacc-id');
            console.log(bankId)

            $.ajax({
                url: "{{ route('admin.bank-acc.edit') }}",
                type: 'POST', 
                data: {
                    bankId: bankId, 
                },
                success: function(response) {
                    console.log(response.bankacc)

                    $('#editbankaccountmodal input[name="account_holder"]').val(response.bankacc.account_holder);
                    $('#editbankaccountmodal input[name="account_no"]').val(response.bankacc.account_no);
                    $('#editbankaccountmodal input[name="balance"]').val(response.bankacc.balance);
                    $('#editbankaccountmodal select[name="bank"]').val(response.bankacc.bank_id);

                    var editUserFormAction = "{{ route('admin.bank-acc.update') }}/" + response.bankacc.id;
                    $('#editaccountForm').attr('action', editUserFormAction);

                    $('#editbankaccountmodal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
    
@endsection