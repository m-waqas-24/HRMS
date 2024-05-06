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
                    <div class="btn-list">
                        <a  href="{{ route('admin.create.expense') }}" class="btn btn-primary"><i class="feather feather-plus"></i>  Add New</a>
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
                                    @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->type->name }}</td>
                                        <td>{{ $expense->bankAccount->bank->name }} - {{ $expense->bankAccount->account_no }} </td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$expense->img) }}" class="btn btn-sm btn-primary" id="downloadLink"><i class="fa fa-arrow-down"></i></a>                                            
                                        </td>
                                        <td>{{ Str::limit($expense->note, 30) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-F-Y') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-icon btn-sm edit-expense" data-expense-id="{{ $expense->id }}">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event);"><i class="feather feather-trash-2"></i></a>
                                            <form id="delete" action="{{ route('admin.destroy.expense', $expense->id) }}" method="POST" style="display: none">
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
					<div class="modal fade"  id="editexpensemodal">
						<div class="modal-dialog modal-lg" role="document">
							<form id="editExpenseForm" action="" method="POST" enctype="multipart/form-data">
								@csrf
                                @method('PUT')
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<h5 class="modal-title">Edit Expense</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Expense Category:</label>
                                                <select name="type_id" class="form-control form-select required-field">
                                                    <option value="">Select Category</option>
                                                    @foreach($expenseCategories as $expense)
                                                        <option value="{{ $expense->id }}"> {{ $expense->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Bank Account:</label>
                                                <select name="bank_acc_id"  class="form-control form-select required-field">
                                                    <option value="">Select Account</option>
                                                    @foreach($bankAccounts as $acc)
                                                        <option value="{{ $acc->id }}"> {{ $acc->bank->name }}-{{ $acc->account_no }}-Balance ({{ $acc->balance }})  </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Amount:</label>
                                                <input type="number" name="amount" class="form-control required-field" placeholder="Enter Amount" >
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
                                                <input type="file" name="expense_img" class="dropify" data-height="180" />
                                                
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit"  class="btn btn-primary">Update</button>
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

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.edit-expense').click(function(){
            var expenseId = $(this).data('expense-id');
            console.log(expenseId)

            $.ajax({
                url: "{{ route('admin.edit.expense') }}",
                method: 'POST',
                data: {
                    expenseId: expenseId,
                },
                success: function(response){
                    var expense = response.expense;
                    $('#editexpensemodal select[name="type_id"]').val(expense.type_id);
                    $('#editexpensemodal select[name="bank_acc_id"]').val(expense.bank_acc_id); 
                    $('#editexpensemodal input[name="amount"]').val(expense.amount); 
                    $('#editexpensemodal input[name="date"]').val(expense.date); 
                    $('#editexpensemodal input[name="note"]').val(expense.note); 
                    
                    var editExpenseFormAction = "{{ route('admin.update.expense') }}/" + expense.id;
                    $('#editExpenseForm').attr('action', editExpenseFormAction);

                    $('#editexpensemodal').modal('show');
                },
                error: function(error){
                    console.error(error);
                }
            })

        })

    });
</script>
    


    
@endsection