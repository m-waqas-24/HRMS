
		
@php
$symbol = getSystemCurrency();
$symbolPosition = getSystemCurrencyPosition();
@endphp

@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employee Salary</div>
				@include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list mt-3 mt-lg-0">
                        {{-- <a href="hr-addpayroll.html" class="btn btn-primary me-3">Add New Payroll</a> --}}
                        {{-- <button  class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#excelmodal">
                            <i class="las la-file-excel"></i>  Download Monthly Excel Report
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="file-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase w-5">#Emp ID</th>
                                        <th class="border-bottom-0 text-uppercase">Name</th>
                                        <th class="border-bottom-0 text-uppercase">Payroll type</th>
                                        <th class="border-bottom-0 text-uppercase">Basic Salary</th>
                                        <th class="border-bottom-0 text-uppercase">Net Salary</th>
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($employes as $employe)
                                    <tr>
                                        <td><a href="{{ route('admin.employee.show', $employe) }}" class="btn btn-outline-success">{{ $employe->empID }}</a></td>
                                        <td>
                                            <div class="d-flex">
                                                <span class="avatar avatar-md brround me-3" style="background-image: url({{asset('storage/'. $employe->user->avatar)}})"></span>
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $employe->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $employe->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $employe->salary->paymentslipOption->name ?? "" }}</td>
                                        <td class="font-weight-semibold"> {{ ($symbolPosition == 1) ? $symbol . " " . $employe->salary->salary : $employe->salary->salary . " " . $symbol ?? 0 }}</td>
                                        <td> {{ ($symbolPosition == 1) ? $symbol . " " . $employe->NetSalary() : $employe->NetSalary() . " " . $symbol ?? 0 }}</td>
                                        <td class="text-start">
                                            <a  href="{{ route('admin.edit.setsalary', $employe->slug) }}" title="Set Salary" class="action-btns" >
                                                <i class="feather feather-eye text-primary" title="View"></i>
                                            </a>
                                            {{-- <a  href="{{ route('admin.payslip') }}" class="action-btns" data-bs-toggle="modal" data-bs-target="#viewsalarymodal">
                                                <i class="feather feather-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i>
                                            </a> --}}
                                            <a  href="{{ route('admin.payslip-receipt', $employe->id) }}" class="action-btns">
                                                <i class="feather feather-printer text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate Payslip"></i>
                                            </a>
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


                    <!-- ADD PAYSLIP MODAL -->
					{{-- <div class="modal fade"  id="generateplayslip">
						<div class="modal-dialog" role="document">
							<form  method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Generate Pay Slip</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Select Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}">
									</div>
								</div>
								<div class="modal-footer">
									<a  href="javascript:void(0);" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a>
									<button type="submit"  class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						</div>
					</div> --}}
					<!-- END ADD PAYSLIP MODAL -->


            <!--ADD EXPENSE MODAL -->
			{{-- <div class="modal fade"  id="viewsalarymodal">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">PaySlip</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-header">
							<div>
								<img src="assets/images/brand/logo.png" class="header-brand-img" alt="Dayonelogo">
							</div>
							<div class="ms-auto">
								<div class="font-weight-bold text-md-right mt-3">Date: 01-02-2021</div>
							</div>
						</div>
						<div class="modal-body pt-1">
							<div class="table-responsive mt-3 mb-3">
								<table class="table mb-0 modal-paytable">
									<tbody>
										<tr>
											<td>
												<strong>Emp ID:</strong>
												<span>2987</span>
											</td>
											<td class="text-end">
												<strong>Emp Name:</strong>
												<span>Faith Harris</span>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Location:</strong>
												<span>USA</span>
											</td>
											<td class="text-end">
												<strong>Pay Period:</strong>
												<span>January-2021</span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="table-responsive mt-4">
								<table class="table text-nowrap mb-0 border">
									<tbody>
										<tr>
											<td class="p-0">
												<table class="table text-nowrap mb-0">
													<thead>
														<tr>
															<th class="fs-18" rowspan="1" colspan="2">Earnings</th>
														</tr>
														<tr>
															<th>Pay Type</th>
															<th class="border-start">Amount</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Basic</td>
															<td class="border-start">$32,000</td>
														</tr>
														<tr>
															<td>HRA</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr>
															<td>Medical Allowance</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr>
															<td>Bonus Allowance</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr class="border-top">
															<td class="font-weight-semibold">Total Earnings</td>
															<td class="font-weight-semibold border-start">$32,000</td>
														</tr>
													</tbody>
												</table>
											</td>
											<td class="p-0">
												<table class="table text-nowrap mb-0 border-start">
													<thead>
														<tr>
															<th class="fs-18" rowspan="1" colspan="2">Deduction</th>
														</tr>
														<tr>
															<th>Pay Type</th>
															<th class="border-start">Amount</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>PF</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr>
															<td>Professional Tax</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr>
															<td>TDS</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr>
															<td>Loans & Others</td>
															<td class="border-start">0.00</td>
														</tr>
														<tr class="border-top">
															<td class="font-weight-semibold">Total Deduction</td>
															<td class="font-weight-semibold border-start">0.00</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="mt-4 mb-3">
								<table class="table mb-0">
									<tbody>
										<tr>
											<td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
											<td class="pb-0 pt-0">
												<h4 class="font-weight-semibold mb-0 fs-24">$32,000</h4>
											</td>
										</tr>
										<tr>
											<td class="font-weight-semibold w-20 pb-0 pt-1 text-muted">InWords</td>
											<td class="pb-0 pt-1">
												<h5 class="mb-0  text-muted">Thirty-Two Thousand only</h5>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="p-5 border-top text-center">
							<div class="text-center">
								<h6 class="mb-2">Spruko Technologies Pvt Ltd.</h6>
								<p class="mb-1 fs-12">Near Tulasi Hospital ECIL, ushaiguda, Hyderabad, Telangana 500062</p>
								<div>
									<small>Tel No: 99488 67536,</small>
									<small>Email: info@spruko.com</small>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="ms-auto">
								<a  href="javascript:void(0);" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print</a>
								<a  href="javascript:void(0);" class="btn btn-success"><i class="feather feather-download"></i> Download</a>
								<a  href="javascript:void(0);" class="btn btn-primary"><i class="si si-paper-plane"></i> Send</a>
								<a  href="javascript:void(0);" class="btn btn-danger" data-bs-dismiss="modal"><i class="feather feather-x"></i> Close</a>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
			<!-- END ADDEXPENSE MODAL -->


@endsection

{{-- @section('scripts')

<script>
    $(document).ready(function() {
        $('.generate-slip-btn').click(function() {
            var employeeId = $(this).data('employee-id'); // Get the employee ID from the clicked button

            // Set the form action attribute with the employee ID
            $('#generateplayslip form').attr('action', "{{ route('admin.payslips.storeWithId', '') }}/" + employeeId);
        });
    });
</script>


@endsection --}}


