@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Edit Income</div>
                @include('admin.breadcrumbs')
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
                    <form action="{{ route('admin.update.income', $income->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Income Category:</label>
                                        <select name="type_id" class="form-control custom-select required-field">
                                            <option value="">Select Income Category</option>
                                            @foreach($incomeCategories as $incomeCat)
                                            <option value="{{ $incomeCat->id }}" {{ $income->type_id == $incomeCat->id ? 'selected' : '' }}> {{ $incomeCat->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Select Bank Account:</label>
                                        <select name="bank_acc_id"  class="form-control custom-select required-field">
                                            <option value="">Select Bank Account</option>
                                            @foreach($bankAccounts as $acc)
                                                <option value="{{ $acc->id }}" {{ $income->bank_acc_id == $acc->id ? 'selected' : '' }}> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Amount:</label>
                                        <input type="integer" name="amount" class="form-control required-field" value="{{ $income->amount }}" placeholder="Enter Amount" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Reference:</label>
                                        <input type="text" name="reference" class="form-control" value="{{ $income->reference }}" placeholder="Reference" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Date:</label>
                                        <input type="date" name="date" class="form-control required-field" value="{{ $income->date }}" placeholder="Note" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Note:</label>
                                        <input type="text" name="note" class="form-control" value={{ $income->note }} placeholder="Note" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Attachment:</label>
                                        <input type="file" name="income_img" class="dropify" data-height="180" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->
