@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Expense History</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    {{-- <div class="btn-list">
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addincomemodal"><i class="feather feather-plus"></i>  Add New</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="card">
            <form action="{{ route('admin.store.expense') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Expense Category:</label>
                                <select name="type_id[]" class="form-control form-select required-field">
                                    <option value="">Select Category</option>
                                    @foreach($expenseCategories as $expense)
                                        <option value="{{ $expense->id }}"> {{ $expense->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Select Bank Account:</label>
                                <select name="bank_acc_id[]"  class="form-control form-select required-field">
                                    <option value="">Select Account</option>
                                    @foreach($bankAccounts as $acc)
                                        <option value="{{ $acc->id }}"> {{ $acc->bank->name }}-{{ $acc->account_no }}-Balance ({{ $acc->balance }})  </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Amount:</label>
                                <input type="number" name="amount[]" class="form-control required-field" placeholder="Enter Amount" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Date:</label>
                                <input type="date" name="date[]" class="form-control required-field" placeholder="Note" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Note:</label>
                                <input type="text" name="note[]" class="form-control" placeholder="Note" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Attachment:</label>
                                <input type="file" name="expense_img[]" class="dropify" data-height="180" />
                            </div>
                        </div>
                    </div> 
                    <hr>
                    <div id="dynamicFormContainer">
                            
                    </div>
                    <div class="text-end">
                        <button id="addMore" type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Add More</button>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"> Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->    


@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        var formCounter = 0;
        function appendForm() {
            formCounter++;
            var newForm = `
                <div class="row" id="formRow${formCounter}">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Expense Category:</label>
                            <select name="type_id[]" class="form-control form-select required-field">
                                <option value="">Select Category</option>
                                @foreach($expenseCategories as $expense)
                                    <option value="{{ $expense->id }}"> {{ $expense->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Bank Account:</label>
                            <select name="bank_acc_id[]"  class="form-control form-select required-field">
                                <option value="">Select Account</option>
                                @foreach($bankAccounts as $acc)
                                    <option value="{{ $acc->id }}"> {{ $acc->bank->name }}-{{ $acc->account_no }}-Balance ({{ $acc->balance }})  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Amount:</label>
                            <input type="number" name="amount[]" class="form-control required-field" placeholder="Enter Amount" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Date:</label>
                            <input type="date" name="date[]" class="form-control required-field" placeholder="Note" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Note:</label>
                            <input type="text" name="note[]" class="form-control" placeholder="Note" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Attachment:</label>
                            <input type="file" name="expense_img[]" class="dropify" data-height="180" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger deleteForm" data-rowid="formRow${formCounter}"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                </div>
                
            `;

            $('#dynamicFormContainer').append(newForm);
            $('.dropify').dropify();
        }
        $('#addMore').on('click', function () {
            appendForm();
        });
        $('#dynamicFormContainer').on('click', '.deleteForm', function () {
            var rowId = $(this).data('rowid');
            $('#' + rowId).remove();
        });
    });
</script>
    
@endsection