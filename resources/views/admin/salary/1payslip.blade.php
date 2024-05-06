@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        <div class="mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center lh-1 bg-dark text-white p-2 mb-2">
                        <h6 class="fw-bold">Payslip</h6> 
                    </div>
                    <div class="d-flex justify-content-end"> <span>Working Branch:ROHINI</span> </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">#EMP-ID:</span> <small class="ms-3">{{ $employe->empID }}</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">EMP Name:</span> <small class="ms-3">{{ $employe->name }}</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">EMP NUMBER:</span> <small class="ms-3">{{ $employe->number }}</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">SALARY TYPE: </span> <small class="ms-3">{{ $employe->salary->paymentslipOption->name ?? '' }}</small> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Designation:</span> <small class="ms-3">{{ $employe->companyDetail->designation->name ?? '' }}</small> </div>
                                </div>
                                <div class="col-md-6">
                                    <div> <span class="fw-bolder">Date:</span> <small class="ms-3">date</small> </div>
                                </div>
                            </div>
                        </div>
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col" class="text-white">Earnings</th>
                                    <th scope="col" class="text-white">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Basic</th>
                                    <td>{{ $employe->salary->salary ?? 0 }}</td>
                                </tr>

                                @foreach($employe->allowance as $allowanc)
                                <tr>
                                    <th scope="row">{{ $allowanc->allowanceOption->name }}</th>
                                    <td>{{ $allowanc->amount }}</td>
                                </tr>
                                @endforeach

                                @foreach($employe->commission as $commi)
                                <tr>
                                    <th scope="row">{{ $commi->title }}</th>
                                    <td>{{ $commi->amount }} </td>
                                </tr>
                                @endforeach

                                @foreach($employe->loan as $loa)
                                <tr>
                                    <th scope="row">{{ $loa->loanOption->name }}</th>
                                    <td>{{ $loa->amount }} </td>
                                </tr>
                                @endforeach

                                @foreach($employe->otherPayment as $op)
                                <tr>
                                    <th scope="row">{{ $op->title }}</th>
                                    <td>{{ $op->amount }} </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col" class="text-white">Deductions</th>
                                    <th scope="col" class="text-white">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employe->deduction as $deduct)
                                <tr>
                                    <th scope="row">{{ $deduct->deductionOption->name }}</th>
                                    <td>{{ $deduct->amount }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end"> 
                            <h5>Net Salary : {{ $employe->NetSalary() }}</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection