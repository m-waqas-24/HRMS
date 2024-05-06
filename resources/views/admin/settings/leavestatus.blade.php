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
                        @can('create leave-types')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addgiftmodal"><i class="feather feather-plus"></i>  Add Type</a>
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
                        <h4 class="card-title">Leaves Types</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Leaves Type</th>
                                        @if(Gate::check('edit leave-types') || Gate::check('delete leave-types'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leavestatus as $status)
                                        <tr>
                                            <td>{{ $status->name }}</td>
                                            @if(Gate::check('edit leave-types') || Gate::check('delete leave-types'))
                                            <td>
                                                <div class="d-flex">
                                                    @can('edit leave-types')
                                                    <a  href="{{ route('admin.leavestatus.edit', $status) }}" class="action-btns1"><i class="feather feather-edit primary text-primary"></i></a>
                                                    @endcan
                                                    {{-- <a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a> --}}
                                                </div>
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


@can('create leave-types')
		            <!-- ADD DEPARTMENT MODAL -->
					<div class="modal fade"  id="addgiftmodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.leavestatus.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Type</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Leave Type Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Leave Type name" >
									</div>
								</div>
								<div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit"  class="btn btn-primary">Add</button>
								</div>
							</div>
						</form>
						</div>
					</div>
					<!-- END ADD DEPARTMENT MODAL -->

                    @endcan


@endsection