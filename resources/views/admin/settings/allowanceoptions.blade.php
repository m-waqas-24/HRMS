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
                        @can('create allowance-options')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addallowancemodal"><i class="feather feather-plus"></i>  Create Allowance Options</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">

                            @include('admin.settings.setting-links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 ">  
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Allowance</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Allowance Type</th>
                                        @if(Gate::check('edit allowance-options') || Gate::check('delete allowance-options'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allowanceTypes as $allowanceType)
                                    <tr>
                                        <td>{{ $allowanceType->name }}</td>
                                        @if(Gate::check('edit allowance-options') || Gate::check('delete allowance-options'))
                                        <td>
                                            @can('edit allowance-options')
                                            <a href="{{ route('admin.allowancetypes.edit', $allowanceType) }}" class="btn btn-primary btn-icon btn-sm">
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

                    @can('create allowance-options')
		            <!-- ADD Allowance options MODAL -->
					<div class="modal fade"  id="addallowancemodal">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.allowancetypes.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Create Allowance Type</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Allowance Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Allowance Type Name" >
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
					<!-- END ADD Allowance type MODAL -->
                    @endcan


@endsection