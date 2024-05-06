@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Debts/Loans</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create debts-loans')
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddebtmodal"><i class="feather feather-plus"></i>  Add New</a>
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
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Person</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">AMOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">TYPE</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">ACCOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">DATE</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">NOTE</th>
                                        @if(Gate::check('delete debts-loans') || Gate::check('create borrow-more') || Gate::check('create repay') || Gate::check('create lend-more')  || Gate::check('create debt-collection'))
                                            <th class="border-bottom-0 text-uppercase font-weight-bold">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($debts as $debt)
                                    <tr>
                                        <td>{{ $debt->person }}</td>
                                        <td>{{ $debt->amount }}</td>
                                        <td>{{ $debt->type->name }}</td>
                                        <td>{{ $debt->bankAccount->bank->name }} - {{ $debt->bankAccount->account_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($debt->date)->format('d-F-Y') }}</td>
                                        <td>{{ Str::limit($debt->note, 30) }}</td>
                                        @if(Gate::check('delete debts-loans') || Gate::check('create borrow-more') || Gate::check('create repay') || Gate::check('create lend-more')  || Gate::check('create debt-collection'))
                                            <td>
                                                @if(Gate::check('create borrow-more') || Gate::check('create repay') || Gate::check('create lend-more')  || Gate::check('create debt-collection'))
                                                    <a href="{{ route('admin.manage-borrow.index', $debt->id ) }}" class="btn btn-primary btn-icon btn-sm">
                                                        <i class="feather feather-edit ms-1" ></i>Manage
                                                    </a>
                                                @endif
                                                {{-- @can('delete debts-loans')
                                                    <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event);"><i class="feather feather-trash-2 ms-1"></i>Delete</a>
                                                    <form id="delete" action="" method="POST" style="display: none">
                                                        @csrf
                                                        <button type="submit">Delete</button>
                                                    </form>
                                                @endcan --}}
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

                @can('create debts-loans')
		            <!-- ADD adddebtmodal options MODAL -->
					<div class="modal fade" id="adddebtmodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.debts.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Debt</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Person</label>
										<input type="text" name="person" class="form-control required-field" placeholder="Enter Person Name" >
									</div>
                                    <div class="form-group">
										<label class="form-label">Amount :</label>
										<input type="text" name="amount" class="form-control required-field" placeholder="Enter Amount" >
									</div>
                                    <div class="form-group">
                                        <label class="form-label">Bank Account</label>
                                        <select name="bank_acc"  class="form-control form-select required-field">
                                            <option value="">Select Bank Account</option>
                                            @foreach($bankAccounts as $acc)
                                                <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Select Type :</label>
                                        <select name="type" class="form-control form-select required-field">
                                            <option value="">Select Type</option>
                                                <option value="1"> Lend </option>
                                                <option value="2"> Borrow </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
										<label class="form-label">Date</label>
										<input type="date" name="date" class="form-control required-field" placeholder="Enter Account Balance" >
									</div>
                                    <div class="form-group">
										<label class="form-label">Note</label>
										<input type="text" name="note" class="form-control" placeholder="Enter Note" >
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						</div>
					</div>
					<!-- END ADD adddebtmodal type MODAL -->
                @endcan

@endsection
