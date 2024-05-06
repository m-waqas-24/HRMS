@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Manage {{ $type }}</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
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
                            <table class="table table-striped table-vcenter text-nowrap table-bordered border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold font-weight text-center">AMOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold text-center">Person</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold text-center">DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">@if($debt->amount > 0 && $type == 'Borrow') - @endif {{ $debt->amount }}</td>
                                        <td class="text-center">{{ $debt->person }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($debt->date)->format('d-F-Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END ROW -->

        @if($type == 'Borrow')
            <div class="page-header d-xl-flex d-block" style="margin: 0 !important">
                <div class="page-leftheader">
                    @can('create borrow-more')
                        <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrowmore"><i class="feather feather-plus"></i> Borrow More</a>
                    @endcan
                </div>
                <div class="page-rightheader ms-md-auto">
                    <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                        <div class="btn-list">
                            @can('create repay')
                                <a href="javascript:void(0);" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#repay"><i class="feather feather-minus"></i>  Repay</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($type == 'Lend')
            <div class="page-header d-xl-flex d-block" style="margin: 0 !important">
                <div class="page-leftheader">
                    @can('create lend-more')
                        <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#lendmore"><i class="feather feather-plus"></i> Lend More</a>
                    @endcan
                </div>
                <div class="page-rightheader ms-md-auto">
                    <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                        <div class="btn-list">
                            @can('create debt-collection')
                                <a href="javascript:void(0);" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#debtcollection"><i class="feather feather-plus"></i>  Debt Collection</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif

         <!-- ROW -->
         <div class="row">

            <div class="col-md-12 mt-4">  
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter text-nowrap table-bordered border-bottom" >
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">AMOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Bank Account</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Account Holder</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Date</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($debt->installments()->orderBy('id', 'desc')->get() as $installment)
                                    <tr>
                                        <td>{{ $installment->amount }}</td>
                                        <td>{{ $installment->bankAccount->bank->name }} - {{ $installment->bankAccount->account_no }}</td>
                                        <td> {{ $installment->bankAccount->account_holder }}</td>
                                        <td>{{ \Carbon\Carbon::parse($installment->date)->format('d-F-Y') }}</td>
                                        <td>{{ $installment->type->name }}</td>
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

@if($type == 'Borrow')
<div class="modal fade" id="borrowmore">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.borrowMore.store', $debt->id) }}" method="POST">
            @csrf
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Borrow More</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Amount :</label>
                    <input type="text" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                </div>
                <div class="form-group">
                    <label class="form-label">Select Bank Account</label>
                    <select name="bank_acc"  class="form-control form-select required-field">
                        <option value="">Select Bank Account</option>
                        @foreach($bankAccounts as $acc)
                            <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control required-field" placeholder="Enter Account Balance" >
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

<div class="modal fade" id="repay">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.repayBorrow.store', $debt->id) }}" method="POST">
            @csrf
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Repay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Amount :</label>
                    <input type="text" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                </div>
                <div class="form-group">
                    <label class="form-label">Select Bank Account</label>
                    <select name="bank_acc"  class="form-control form-select required-field">
                        <option value="">Select Bank Account</option>
                        @foreach($bankAccounts as $acc)
                            <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control required-field" placeholder="Enter Account Balance" >
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
@endif

@if($type == 'Lend')
    <div class="modal fade" id="lendmore">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.lendMore.store', $debt->id) }}" method="POST">
                @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Lend More</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Amount :</label>
                        <input type="text" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Bank Account</label>
                        <select name="bank_acc" class="form-control form-select required-field">
                            <option value="">Select Bank Account</option>
                            @foreach($bankAccounts as $acc)
                                <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control required-field" placeholder="Enter Account Balance" >
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

    <div class="modal fade" id="debtcollection">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.debtcollection.store', $debt->id) }}" method="POST">
                @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Debt Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Amount :</label>
                        <input type="text" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Bank Account</label>
                        <select name="bank_acc" class="form-control form-select required-field">
                            <option value="">Select Bank Account</option>
                            @foreach($bankAccounts as $acc)
                                <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control required-field" placeholder="Enter Account Balance" >
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

@endif

@endsection


