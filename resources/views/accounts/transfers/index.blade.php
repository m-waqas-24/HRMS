@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Transfers Histories</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create balance-transfers')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtransfermodal"><i class="feather feather-plus"></i>  Make a Transfer</a>
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
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">From ACCOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">To ACCOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Transfer Amount</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Transfer Date</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transfers as $transfer)
                                    <tr>
                                        <td>{{ $transfer->fromBank->bank->name }} - {{ $transfer->fromBank->account_no }}</td>
                                        <td>{{ $transfer->fromBank->bank->name }} - {{ $transfer->toBank->account_no }}</td>
                                        <td>{{ $transfer->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transfer->date)->format('d-F-Y') }}</td>
                                        <td>{{ Str::limit($transfer->note, 20) }}</td>
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

                    @can('create balance-transfers')
                        <!-- ADD categories options MODAL -->
                        <div class="modal fade"  id="addtransfermodal">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.balance-transfers.store') }}" method="POST">
                                    @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> Balance Transfer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label">From Account</label>
                                            <select name="from"  class="form-control form-select required-field">
                                                <option value="">Select Bank Account</option>
                                                @foreach($bankAccounts as $acc)
                                                    <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - Balance - ({{ $acc->balance }})  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">To Account </label>
                                            <select name="to"  class="form-control form-select required-field">
                                                <option value="">Select Bank Account</option>
                                                @foreach($bankAccounts as $acc)
                                                    <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - Balance - ({{ $acc->balance }})  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Amount</label>
                                            <input type="number" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Transfer Date</label>
                                            <input type="date" name="date" class="form-control required-field" placeholder="Transfer Date" >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <input type="text" name="note" class="form-control" placeholder="Note..." >
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
                    


@endsection


@section('scripts')



<script>
    $(document).ready(function () {
        $('select[name="from"]').change(function () {
            var selectedValue = $(this).val();
            $('select[name="to"] option[value="' + selectedValue + '"]').prop('disabled', true);
        });

        $('select[name="to"]').change(function () {
            var selectedValue = $(this).val();
            $('select[name="from"] option[value="' + selectedValue + '"]').prop('disabled', true);
        });
    });
</script>


    
@endsection