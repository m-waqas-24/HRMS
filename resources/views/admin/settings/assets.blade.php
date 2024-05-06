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
                        @can('create assets ')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addassets"><i class="feather feather-plus"></i>  Add</a>
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
                        <h4 class="card-title">Assets</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Name</th>
                                        <th class="border-bottom-0 text-uppercase">Total</th>
                                        <th class="border-bottom-0 text-uppercase">Info</th>
                                        @if(Gate::check('edit assets ') || Gate::check('delete assets '))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assets as $asset)
                                        <tr>
                                            <td>{{ $asset->name }}</td>
                                            <td>{{ $asset->total_asset }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                                        <h6 class="mb-1 fs-14">Assigned: {{ $asset->assigned }}</h6>
                                                        <p class="text-muted mb-0 fs-12">Free: {{ $asset->free }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            @if(Gate::check('edit assets ') || Gate::check('delete assets '))
                                            <td>
                                                <div class="d-flex">
                                                    @can('edit assets ')
                                                    <a  href="{{ route('admin.assets.edit', $asset) }}" class="action-btns1"><i class="feather feather-edit primary text-primary"></i></a>
                                                    @endcan
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

                @can('create assets ')
		            <!-- ADD DEPARTMENT MODAL -->
					<div class="modal fade"  id="addassets">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.assets.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Add Assets</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Assets Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Assets name" >
									</div>
									<div class="form-group">
										<label class="form-label">Total Assets</label>
										<input type="text" name="total_asset" class="form-control  required-field" placeholder="Enter Total Assets" >
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