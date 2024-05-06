@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Income History</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addincomemodal"><i class="feather feather-plus"></i>  Add New</a>
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
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Category</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">BANK ACCOUNT</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Amount</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Attachment</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Description</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Date</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomes as $income)
                                    <tr>
                                        <td>{{ $income->type->name }}</td>
                                        <td>{{ $income->bankAccount->bank->name }} - {{ $income->bankAccount->account_no }} </td>
                                        <td>{{ $income->amount }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$income->img) }}" class="btn btn-sm btn-primary" id="downloadLink"><i class="fa fa-arrow-down"></i></a>                                            
                                        </td>
                                        <td>{{ Str::limit($income->note, 30) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($income->date)->format('d-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.income', $income->id) }}" class="btn btn-primary btn-icon btn-sm edit-bankacc" >
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event);"><i class="feather feather-trash-2"></i></a>
                                            <form id="delete" action="{{ route('admin.destroy.income', $income->id) }}" method="POST" style="display: none">
                                                @csrf
                                                <button type="submit">Delete</button>
                                            </form>
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

		            <!-- ADD categories options MODAL -->
					<div class="modal fade"  id="addincomemodal">
						<div class="modal-dialog modal-lg" role="document">
							<form action="{{ route('admin.store.income') }}" method="POST" enctype="multipart/form-data">
								@csrf
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<h5 class="modal-title">Add New Income</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Income Category:</label>
                                                <select name="type_id" class="form-control form-select required-field">
                                                    <option value="">Select Income Category</option>
                                                    @foreach($incomeCategories as $incomeCat)
                                                        <option value="{{ $incomeCat->id }}"> {{ $incomeCat->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Bank Account:</label>
                                                <select name="bank_acc_id"  class="form-control form-select required-field">
                                                    <option value="">Select Bank Account</option>
                                                    @foreach($bankAccounts as $acc)
                                                        <option value="{{ $acc->id }}"> {{ $acc->bank->name }} - {{ $acc->account_no }} - Balance ({{ $acc->balance }})  </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Amount:</label>
                                                <input type="integer" name="amount" class="form-control required-field" placeholder="Enter Amount" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Date:</label>
                                                <input type="date" name="date" class="form-control required-field" placeholder="Note" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Note:</label>
                                                <input type="text" name="note" class="form-control" placeholder="Note" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Attachment:</label>
                                                <input type="file" name="income_img" class="dropify" data-height="180" />
                                            </div>
                                        </div>
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
              
                    


@endsection

@section('scripts')

<script>
    document.getElementById('downloadLink').addEventListener('click', function(e) {
      e.preventDefault();
  
      var downloadUrl = this.getAttribute('href');
  
      this.setAttribute('download', '');
      var clickEvent = new MouseEvent('click', {
        view: window,
        bubbles: false,
        cancelable: true
      });
      this.dispatchEvent(clickEvent);
    });
  </script>
    
@endsection