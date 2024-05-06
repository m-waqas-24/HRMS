		
@php
$symbol = getSystemCurrency();
$symbolPosition = getSystemCurrencyPosition();
@endphp


@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content" >
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Invoice</div>
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
        <div class="row" >
            <div class="col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body" id="captureDiv">
                        <h2 class="font-weight-bold text-center" style="text-decoration: underline">{{ $employe->companyDetail->company->name }}</h2>
                        <div class="card-body ps-0 pe-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Employee Name:</span>
                                    <strong>{{ $employe->name }}</strong><br>
                                    <span>Phone:</span>
                                    <strong>{{ $employe->number }}</strong><br>
                                    <span>Company:</span>
                                    <strong>{{ $employe->companyDetail->company->name }}</strong><br>
                                    <span>Designation:</span>
                                    <strong>{{ $employe->companyDetail->designation->name }}</strong><br>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <span>Payment No:</span>
                                    <strong>INV23456-234</strong><br>
                                     <span>Payment Type:</span>
                                    <strong>{{ $employe->salary->paymentslipOption->name ?? "" }}</strong><br>
                                    <span>Date:</span>
                                    <strong>{{ \Carbon\Carbon::now()->format('d-F-Y') }} </strong><br>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive push">
                            <table class="table table-bordered table-hover text-nowrap">
                               
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">Employee Salary</p>
                                        <div class="text-muted">Basic</div>
                                    </td>
                                    <td class="text-end"> {{ ($symbolPosition == 1) ? $symbol . " " . $employe->salary->salary : $employe->salary->salary . " " . $symbol ?? 0 }}</td>
                                </tr>

                                @foreach($employe->allowance as $allowanc)
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">{{ $allowanc->allowanceOption->name }}</p>
                                        <div class="text-muted">Allowance</div>
                                    </td>
                                    <td class="text-end"> {{ ($symbolPosition == 1) ? $symbol . " " . $allowanc->amount : $allowanc->amount . " " . $symbol ?? 0 }}</td>
                                </tr>
                                @endforeach 

                               @foreach($employe->commission as $commi)
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">{{ $commi->title }}</p>
                                        <div class="text-muted">Commission</div>
                                    </td>
                                    <td class="text-end"> {{ ($symbolPosition == 1) ? $symbol . " " . $commi->amount : $commi->amount . " " . $symbol ?? 0 }}</td>
                                </tr>
                                @endforeach 

                              @foreach($employe->loan as $loa)
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">{{ $loa->loanOption->name }}</p>
                                        <div class="text-muted">Loan</div>
                                    </td>
                                    <td class="text-end"> {{ ($symbolPosition == 1) ? $symbol . " " .  $loa->amount :  $loa->amount . " " . $symbol ?? 0 }}</td>
                                </tr>
                                @endforeach 

                              @foreach($employe->otherPayment as $op)
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">{{ $op->title }}</p>
                                        <div class="text-muted">Other Payment</div>
                                    </td>
                                    <td class="text-end"> {{ ($symbolPosition == 1) ? $symbol . " " . $op->amount : $op->amount . " " . $symbol ?? 0 }}</td>
                                </tr>
                                @endforeach 

                              @foreach($employe->deduction as $deduct)
                                <tr>
                                    <td>
                                        <p class="font-weight-semibold mb-1">{{ $deduct->deductionOption->name }}</p>
                                        <div class="text-muted">Deduction</div>
                                    </td>
                                    <td class="text-end"> -  {{ ($symbolPosition == 1) ? $symbol . " " . $deduct->amount : $deduct->amount . " " . $symbol ?? 0 }}</td>
                                </tr>
                                @endforeach 

                               
                                <tr>
                                    <td  class="font-weight-bold text-uppercase text-end h4 mb-0">Net Salary:</td>
                                    <td class="font-weight-bold text-end h4 mb-0"> {{ ($symbolPosition == 1) ? $symbol . " " . $employe->NetSalary() : $employe->NetSalary() . " " . $symbol ?? 0 }}</td>
                                </tr>
                               
                            </table>
                        </div>
                        <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addresignations" onclick="captureScreenshot()"><i class="si si-wallet"></i> Pay Invoice</button>
                        <!-- Add an image element to display the screenshot -->
                        <img id="screenshotImage" style="display: none;" />
                        <button  class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

<div class="modal fade"  id="addresignations">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.store.pay-slips', $employe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Employe Payslip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Select Month:</label>
                                    <select name="month" class="form-control form-select required-field" >
                                        <option value="">Choose...</option>
                                        <?php
                                        $currentMonthNumber = now()->format('n') - 1;
                                        ?>
                                        @foreach($months as $month)
                                            <option value="{{ $month->id }}" {{ $month->id == $currentMonthNumber ? 'selected' : '' }}>{{ $month->name }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection