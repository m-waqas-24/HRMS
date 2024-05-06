		
@php
$symbol = getSystemCurrency();
$symbolPosition = getSystemCurrencyPosition();
@endphp

@extends('admin.layouts.app')
@section('styles')

<style>
    .table thead th{
        border: none !important;
        padding-top: 20px;
    }
</style>

@endsection

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">

      
        <div class="card mg-b-20 my-5" id="breadcrumb2" style="background-color: none ">
            <div class="card-header border-bottom-0">
                
                    <h5>Employe Set Salary</h5>
                    
            </div>
            <div class="card-body pt-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style2 mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a  href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a  href="{{ route('admin.index.setsalary') }}">Payroll</a>
                        </li>
                        <li class="breadcrumb-item active">Set Salary {{ $employe->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- END ROW -->

        <div class="row">
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Employe Salary</h5>
                        @can('create salary')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addbascisalary">
                            <i class="feather feather-plus"></i>  
                        </button>
                        @endcan
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Payslip Type</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salary as $sal)
                                    <tr>
                                        <td>{{ $sal->employe->name }}</td>
                                        <td>{{ $sal->paymentslipOption->name ?? "" }}</td>
                                        <td>{{ ($symbolPosition == 1) ? $symbol . " " . $sal->salary : $sal->salary . " " . $symbol ?? 0 }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Allowance</h5>
                        @can('create allowance ')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addallowance">
                            <i class="feather feather-plus"></i>  
                        </button>
                        @endcan
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>TYPE</th>
                                        <th>AMOUNT</th> 
                                        @if(Gate::check('edit allowance ') || Gate::check('delete allowance '))
                                        <th>Action</th>     
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allowances as $allowance)
                                    <tr>
                                        <td>{{ $allowance->employe->name }}</td>
                                        <td>{{ $allowance->allowanceOption->name }}</td>
                                        <td>{{ ($symbolPosition == 1) ? $symbol . " " . $allowance->amount : $allowance->amount . " " . $symbol ?? 0 }}</td>
                                        @if(Gate::check('edit allowance ') || Gate::check('delete allowance '))
                                        <td>
                                            @can('edit allowance ')
                                            <a class="text-primary me-3 edit-allowance" data-allowance-id="{{ $allowance->id }}" href="#">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete allowance ')
                                            <a class="text-danger" href="#" title="Delete" onclick="confirmDelete(event, 'deleteallowance_{{ $allowance->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deleteallowance_{{ $allowance->id }}" action="{{ route('admin.allowances.destroy', $allowance) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Commission</h5>
                        @can('create commission')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addcommission">
                            <i class="feather feather-plus"></i>  
                        </button>
                        @endcan
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive"  style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>TITLE</th>
                                        <th>AMOUNT</th> 
                                        @if(Gate::check('edit commission') || Gate::check('delete commission'))
                                        <th>Action</th> 
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commissions as $com)
                                    <tr>
                                        <td>{{ $com->employe->name }}</td>
                                        <td>{{ $com->title }}</td>
                                        <td> {{ ($symbolPosition == 1) ? $symbol . " " . $com->amount : $com->amount . " " . $symbol ?? 0 }}</td>
                                        @if(Gate::check('edit commission') || Gate::check('delete commission'))
                                        <td>
                                            @can('edit commission')
                                            <a class="text-primary me-3 edit-commission" data-commission-id="{{ $com->id }}" href="#">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan
                                            
                                            @can('delete commission')
                                            <a class="text-danger" href="#" title="Delete" onclick="confirmDelete(event, 'deletecom_{{ $com->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletecom_{{ $com->id }}" action="{{ route('admin.commissions.destroy', $com) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Loan</h5>
                        @can('create loan ')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addloan">
                            <i class="feather feather-plus"></i>  
                        </button>
                        @endcan
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>LOAN TYPE</th>
                                        <th>AMOUNT</th>
                                        <th>REASON</th>
                                        @if(Gate::check('edit loan ') || Gate::check('delete loan '))
                                        <th>ACTIONS</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loans as $loan)
                                    <tr>
                                        <td>{{ $loan->employe->name }}</td>
                                        <td>{{ $loan->loanOption->name }}</td>
                                        <td> {{ ($symbolPosition == 1) ? $symbol . " " . $loan->amount : $loan->amount . " " . $symbol ?? 0 }}</td>
                                        <td>{{ $loan->reason }}</td>
                                        @if(Gate::check('edit loan ') || Gate::check('delete loan '))
                                        <td>
                                            @can('edit loan ')
                                            <a class="text-primary me-3 edit-loan" data-loan-id="{{ $loan->id }}" href="#">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan

                                            @can('delete loan ')
                                            <a class="text-danger" href="#" title="Delete" onclick="confirmDelete(event, 'deleteloan_{{ $loan->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="'deleteloan_{{ $loan->id }}" action="{{ route('admin.loans.destroy', $loan) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Saturation Deduction
                        </h5>
                        @can('create deduction ')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adddeduction">
                            <i class="feather feather-plus"></i>  
                        </button>
                        @endcan
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>DEDUCTION TYPE</th>
                                        <th> AMOUNT</th>
                                        @if(Gate::check('edit deduction ') || Gate::check('delete deduction '))
                                        <th>ACTIONS</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deductions as $deduct)
                                    <tr>
                                        <td>{{ $deduct->employe->name }}</td>
                                        <td>{{ $deduct->deductionOption->name }}</td>
                                        <td>{{ ($symbolPosition == 1) ? $symbol . " " . $deduct->amount : $deduct->amount . " " . $symbol ?? 0 }}</td>
                                        @if(Gate::check('edit deduction ') || Gate::check('delete deduction '))
                                        <td>
                                            @can('edit deduction ')
                                            <a class="text-primary me-3 edit-deduction" data-deduction-id="{{ $deduct->id }}" href="#">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan

                                            @can('delete deduction ')
                                            <a class="text-danger" href="#" title="Delete" onclick="confirmDelete(event, 'deletededuct_{{ $deduct->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletededuct_{{ $deduct->id }}" action="{{ route('admin.deductions.destroy', $deduct) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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
            <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Other Payments</h5>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addop">
                            <i class="feather feather-plus"></i>  
                        </button>
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        @if(Gate::check('edit otherpayments') || Gate::check('delete otherpayments'))
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($otherpayments as $op)
                                    <tr>
                                        <td>{{ $op->title }}</td>
                                        <td> {{ ($symbolPosition == 1) ? $symbol . " " . $op->amount : $op->amount . " " . $symbol ?? 0 }}</td>
                                        @if(Gate::check('edit otherpayments') || Gate::check('delete otherpayments'))
                                        <td>
                                            @can('edit otherpayments')
                                            <a class="text-primary me-3 edit-op" data-op-id="{{ $op->id }}" href="#">
                                                <i class="feather feather-edit"></i>
                                            </a>
                                            @endcan

                                            @can('delete otherpayments')
                                            <a class="text-danger" href="#" title="Delete" onclick="confirmDelete(event, 'deleteop_{{ $op->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deleteop_{{ $op->id }}" action="{{ route('admin.otherpayments.destroy', $op) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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
            {{-- <div class="col-md-6">
                <div class="card" style="height: 300px">
                    <div class="card-header border-bottom-0 d-flex align-items-center justify-content-between">
                        <h5 class="">Other Payment</h5>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addovertime">
                            <i class="feather feather-plus"></i>  
                        </button>
                    </div>
                    <div class="card-body p-0 border-top">
                        <div class="table-responsive" style="overflow-y: auto; max-height: 220px;">
                            <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Payslip Type</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>


    </div>
</div><!-- end app-content-->

		            <!-- Add basic salary MODAL -->
					<div class="modal fade"  id="addbascisalary">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.setEmpSalary', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Set Basic Salary</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Payslip Type</label>
                                            <select name="payslip_option" class="form-control form-select  required-field" id="">
                                                <option value="">Select Payslip Type</option>
                                                @foreach($payslipOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter basic salary" type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END basic salary  MODAL -->

                    <!-- Add allowance MODAL -->
					<div class="modal fade"  id="addallowance">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.allowances.storeWithId', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Allowance</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Allowance Options</label>
                                            <select name="allowance_option" class="form-control form-select required-field" id="">
                                                <option value="">Select Allowance Type</option>
                                                @foreach($allowanceOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter allowance amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END allowance  MODAL -->

                    <!-- Edit allowance MODAL -->
					<div class="modal fade"  id="editallowance">
						<div class="modal-dialog" role="document">	
							<form  method="POST">
								@csrf
                                @method('PUT')
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Allowance</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Allowance Options</label>
                                            <select id="allowance_type" name="allowance_option" class="form-control form-select allowance_type required-field" id="">
                                                <option value="">Select Allowance Type</option>
                                                @foreach($allowanceOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control allowance-amount required-field" placeholder="Enter allowance amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- Edit allowance  MODAL -->

                    <!-- Add commission MODAL -->
					<div class="modal fade"  id="addcommission">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.commissions.storeWithId', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Commission</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Title</label>
											<div class="input-group">
                                            <input name="title" class="form-control required-field" placeholder="Enter commission title" type="text">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter commission amount" type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END commission  MODAL -->
                  
                    <!-- Edit commission MODAL -->
					<div class="modal fade"  id="editcommission">
						<div class="modal-dialog" role="document">	
							<form method="POST">
								@csrf
                                @method('PUT')
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Commission</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Title</label>
											<div class="input-group">
                                            <input name="title" class="form-control edit-commission-title required-field" placeholder="Enter commission title" type="text">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control edit-commission-amount required-field" placeholder="Enter commission amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- Edit commission  MODAL -->

                    <!-- Add loan MODAL -->
					<div class="modal fade"  id="addloan">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.loans.storeWithId', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Loan</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
                                        <div class="form-group">
											<label class="form-label">Loan Options</label>
                                            <select name="loan_option" class="form-control form-select required-field" id="">
                                                <option value="">Select Loan Option</option>
                                                @foreach($loanOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter loan amount " type="number">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Reason</label>
											<div class="input-group">
                                            <textarea name="reason" class="form-control required-field" placeholder="Enter loan reason"></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button  class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END loan  MODAL -->

                     <!-- Edit loan MODAL -->
					<div class="modal fade"  id="editloan">
						<div class="modal-dialog" role="document">	
							<form  method="POST">
								@csrf
                                @method('PUT')
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Loan</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
                                        <div class="form-group">
											<label class="form-label">Loan Options</label>
                                            <select name="loan_option" class="form-control form-select loan_option required-field" id="">
                                                <option  value="">Select Loan Option</option>
                                                @foreach($loanOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control loan-amount required-field" placeholder="Enter loan amount" type="number">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Reason</label>
											<div class="input-group">
                                            <textarea name="reason" class="form-control loan-reason required-field" placeholder="Enter loan reason"></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="sumit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END Edit loan  MODAL -->

                    <!-- Add deduction MODAL -->
					<div class="modal fade"  id="adddeduction">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.deductions.storeWithId', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Deduction</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
                                        <div class="form-group">
											<label class="form-label">Deduction Options</label>
                                            <select name="deduction_option" class="form-control form-select required-field" id="">
                                                <option value="">Select Deduction Option</option>
                                                @foreach($deductionOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter Deduction amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END deduction  MODAL -->

                    <!-- Edit deduction MODAL -->
					<div class="modal fade"  id="editdeduction">
						<div class="modal-dialog" role="document">	
							<form method="POST">
								@csrf
                                @method('PUT')
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Deduction</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
                                        <div class="form-group">
											<label class="form-label">Deduction Options</label>
                                            <select name="deduction_option" class="form-control form-select deduction_option required-field" id="">
                                                <option value="">Select Deduction Option</option>
                                                @foreach($deductionOptions as $options)
                                                <option value="{{ $options->id }}">{{ $options->name }}</option>
                                                @endforeach
                                            </select>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control deduction-amount required-field" placeholder="Enter Deduction amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END Edit deduction  MODAL -->

                    <!-- Add other payment MODAL -->
					<div class="modal fade"  id="addop">
						<div class="modal-dialog" role="document">	
							<form action="{{ route('admin.otherpayments.storeWithId', $employe->id) }}" method="POST">
								@csrf
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Create Other Payment</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Title</label>
											<div class="input-group">
                                            <input name="title" class="form-control required-field" placeholder="Enter Other Payment title" type="text">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control required-field" placeholder="Enter Other Payment amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END other payment  MODAL -->

                     <!-- Edit other payment MODAL -->
					<div class="modal fade"  id="editop">
						<div class="modal-dialog" role="document">	
							<form method="POST">
								@csrf
                                @method('PUT')
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Other Payment</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="form-label">Title</label>
											<div class="input-group">
                                            <input name="title" class="form-control edit-op-title required-field" placeholder="Enter Other Payment title" type="text">
											</div>
										</div>
										<div class="form-group">
											<label class="form-label">Amount</label>
											<div class="input-group">
                                            <input name="amount" class="form-control edit-op-amount required-field" placeholder="Enter Other Payment amount " type="number">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END Edit other payment  MODAL -->

@endsection

@section('scripts')


<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); 

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        //edit allowance modal
        $('.edit-allowance').click(function(e) {
            e.preventDefault();
            var allowanceId = $(this).data('allowance-id');

            $.ajax({
                url: "{{ route('admin.allowance-edit') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    allowanceId: allowanceId,
                },
                success: function(response){
                    var allowance = response.allowance;
                    $('.allowance_type').val(allowance.allowance_option);
                    $('.allowance-amount').val(allowance.amount);
                    $('#editallowance form').attr('action', `/admin/allowances/${allowance.id}/update`);
                    $("#editallowance").modal('show');
                },
                error: function(error){
                    console.log(error);
                }
            })
        });

        //edit commission modal
        $('.edit-commission').click(function(e) {
            e.preventDefault();
            var commissionId = $(this).data('commission-id');
            $.ajax({
                url: "{{ route('admin.commission-edit') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    commissionId: commissionId,
                },
                success: function(response){
                    var commission = response.commission;
                    $('.edit-commission-amount').val(commission.amount);
                    $('.edit-commission-title').val(commission.title);
                    $('#editcommission form').attr('action', `/admin/commissions/${commission.id}/update`);
                    $("#editcommission").modal('show');
                },
                error: function(error){
                    console.log(error);
                }
            })
        });


        //edit loan modal
        $('.edit-loan').click(function(e) {
        e.preventDefault();
        var loanId = $(this).data('loan-id');
        $.ajax({
            url: "{{ route('admin.edit-loan') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                loanId: loanId,
            },
            success: function(response){
                var loan = response.loan;
                $('.loan_option').val(loan.loan_option);
                $('.loan-amount').val(loan.amount);
                $('.loan-reason').val(loan.reason);
                $('#editloan form').attr('action', `/admin/loans/${loan.id}/update`);
                $("#editloan").modal('show');
            },
            error: function(error){
                console.log(error);
            }
        })
    });


    //edit deduction modal
    $('.edit-deduction').click(function(e) {
        e.preventDefault();
        var deductionId = $(this).data('deduction-id');
        $.ajax({
            url: "{{ route('admin.edit-deduction') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                deductionId: deductionId,
            },
            success: function(response){
                var deduction = response.deduction;
                $('.deduction_option').val(deduction.deduction_option);
                $('.deduction-amount').val(deduction.amount);
                $('#editdeduction form').attr('action', `/admin/deductions/${deduction.id}/update`);
                $("#editdeduction").modal('show');
            },
            error: function(error){
                console.log(error);
            }
        })
    });

        //edit op modal
        $('.edit-op').click(function(e) {
        e.preventDefault();
        var opId = $(this).data('op-id');
        console.log(opId) 
        $.ajax({
            url: "{{ route('admin.edit-otherpayment') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                opId: opId,
            },
            success: function(response){
                var op = response.op;
                $('.edit-op-title').val(op.title);
                $('.edit-op-amount').val(op.amount);
                $('#editop form').attr('action', `/admin/otherpayments/${op.id}/update`);
                $("#editop").modal('show');
            },
            error: function(error){
                console.log(error);
            }
        })
    });
        
    });
</script>


@endsection