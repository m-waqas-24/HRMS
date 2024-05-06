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
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbranch"><i class="feather feather-plus"></i>  Create Company</a>
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

                            @include('system-settings.links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-lg-12">  
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Companies</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Company</th>
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
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

		    <!-- ADD companies options MODAL -->
			    <div class="modal fade"  id="addbranch">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.companies.store') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Create Company </h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">Company Name</label>
										<input type="text" name="name" class="form-control required-field" placeholder="Enter Company Name" >
									</div>
								</div>
								<div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						</div>
			    </div>
			<!-- END ADD Allowance type MODAL -->


@endsection