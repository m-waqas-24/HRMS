@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Income & Expense Categories</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create categories')
                            <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addallowancemodal"><i class="feather feather-plus"></i>  Add New</a>
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
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Category Name</th>
                                        <th class="border-bottom-0 text-uppercase font-weight-bold">Category Type</th>
                                        @if(Gate::check('edit categories')  || Gate::check('delete categories'))
                                            <th class="border-bottom-0 text-uppercase font-weight-bold">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->type->name }}</td>
                                        @if(Gate::check('edit categories')  || Gate::check('delete categories'))
                                        <td>
                                            @can('edit categories')
                                                <a href="#" class="btn btn-primary btn-icon btn-sm edit-category" data-category-id={{ $category->id }}>
                                                    <i class="feather feather-edit" ></i>
                                                </a>
                                            @endcan
                                            @can('delete categories')
                                                <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deleteacccat_{{ $category->id }}');"><i class="feather feather-trash-2"></i></a>
                                                <form id="deleteacccat_{{ $category->id }}" action="{{ route('admin.account.category.destroy', $category->id) }}" method="POST" style="display: none">
                                                    @csrf
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

        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

                @can('create categories')
					<div class="modal fade"  id="addallowancemodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.account.category.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add New Category</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Category Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Category Name" >
									</div>
									<div class="form-group">
                                        <label class="form-label">Category Type</label>
                                        <select name="type"  class="form-control custom-select required-field">
                                            <option value="">Choose Type</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}"> {{ $type->name }} </option>
                                            @endforeach
                                        </select>
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
                @endcan

                @can('edit categories')
                    <div class="modal fade"  id="editCategory">
						<div class="modal-dialog" role="document">
							<form id="editcategoryForm" action="" method="POST">
								@csrf
                                @method('PUT')
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Edit Category</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
                                    <div class="form-group">
										<label class="form-label">Category Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Category Name" >
									</div>
									<div class="form-group">
                                        <label class="form-label">Category Type</label>
                                        <select name="type"  class="form-control custom-select required-field">
                                            <option value="">Choose Type</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}"> {{ $type->name }} </option>
                                            @endforeach
                                        </select>
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
                @endcan


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.edit-category').click(function() {
            var categoryId = $(this).data('category-id');
            console.log(categoryId)

            $.ajax({
                url: "{{ route('admin.account.category.edit') }}",
                type: 'POST', 
                data: {
                    categoryId: categoryId, 
                },
                success: function(response) {

                    $('#editCategory input[name="name"]').val(response.category.name);
                    $('#editCategory select[name="type"]').val(response.category.cat_type_id);

                    var editUserFormAction = "{{ route('admin.account.category.update') }}/" + response.category.id;
                    $('#editcategoryForm').attr('action', editUserFormAction);

                    $('#editCategory').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
    
@endsection