@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Settings</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create gifts')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addgiftmodal"><i class="feather feather-plus"></i>  Add Gifts</a>
                        @endcan
                        {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Department" data-bs-toggle="modal" data-bs-target="#adddepartmentmodal"> <i class="feather feather-plus mt-1"></i> Create Departments</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-4 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">

                            @include('admin.settings.setting-links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-lg-12">  
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Gifts</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Gifts Name</th>
                                        @if(Gate::check('edit gifts') || Gate::check('delete gifts'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gifts as $gift)
                                    <tr>
                                        <td>{{ $gift->name }}</td>
                                        @if(Gate::check('edit gifts') || Gate::check('delete gifts'))
                                        <td>
                                            @can('edit gifts')
                                            <a href="{{ route('admin.gifts.edit', $gift) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
                                            @endcan
                                            {{-- <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete"><i class="feather feather-trash-2"></i></a> --}}
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


@can('create gifts')
		            <!-- ADD DEPARTMENT MODAL -->
					<div class="modal fade"  id="addgiftmodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.gifts.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Gifts</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Gifts Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter gifts name" >
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
					<!-- END ADD DEPARTMENT MODAL -->
                    @endcan


@endsection