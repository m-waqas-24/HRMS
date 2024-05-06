@extends('admin.layouts.app')

@section('content')

	<div class="app-content main-content">
					<div class="side-app main-container">
						
                        <!-- PAGE HEADER -->
                        <div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<div class="page-title">Employees  </div>
								@include('admin.breadcrumbs')	
							</div>
							<div class="page-rightheader ms-md-auto">
								<div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										<button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Grid View"><a href="{{ route('admin.employee.index') }}"><i class="feather feather-grid"></i></a></button>
										@can('create employee ')
										<a href="{{ route('admin.employee.create') }}" class="btn btn-primary me-3"><i class="feather feather-plus"></i> Add New Employee</a>
										@endcan
										{{-- <a href="#" class="action-btns1" title="Delete" onclick="confirmDelete(event);">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </a>
                                            <form id="deletenotice" action="{{ route('admin.noticeboard.destroy', $notice) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form> --}}
									</div>
								</div>
							</div>
						</div>
						<!-- END PAGE HEADER -->

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
						<!-- ROW -->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								<div class="card">
									
								<form action="{{ route('admin.search.employe') }}" method="GET">
									@csrf
									<div class="card-body">
										<div class="row">
													<div class="col-md-2">
														<div class="form-group">
															<label class="form-label">Employee ID</label>
															<div class="input-group">
																<input name="empID" value="{{ $empID ?? '' }}" class="form-control" placeholder="Enter Employe ID" type="text">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">Name</label>
															<div class="input-group">
																<input name="name" class="form-control" value="{{ $name ?? '' }}" placeholder="Enter Employe Name" type="text">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="form-label">Email</label>
															<div class="input-group">
																<input type="email" class="form-control" name="email" value="{{ $email ?? '' }}" placeholder="Enter Employe Email" >
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<label class="form-label">Company</label>
														<select name="company" class="form-control form-select">
															<option value="">Select Company</option>
															@foreach($companies as $company)
															<option value="{{ $company->id }}" {{ @$companyid  == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
															@endforeach
														</select>
													</div>
													<div class="col-md-1">
														<div class="form-group mt-5">
															<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
														</div>
													</div>											
										</div>
									</div>
								</form>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="emp-attendance">
												<thead>
													<tr>
														<th class="border-bottom-0 text-uppercase">#empid</th>
														<th class="border-bottom-0 text-uppercase">name</th>
														<th class="border-bottom-0 text-uppercase">Designation</th>
														<th class="border-bottom-0 text-uppercase">Phone</th>
														{{-- <th class="border-bottom-0">Progress</th> --}}
														@if(Gate::check('edit employee ') || Gate::check('delete employee '))
														<th class="border-bottom-0 text-uppercase">Actions</th>
														@endcan
													</tr>
												</thead>
												<tbody>
													@foreach($employes as $employe)
													<tr>
														<td><span class="badge badge-success fs-14"><a href="{{ route('admin.employee.show', $employe) }}" class="text-white">{{ $employe->empID }}</a></span></td>
														<td>
															<div class="d-flex">
																<div class="me-3 mt-0 mt-sm-1 d-block">
																	<h6 class="mb-1 fs-14"><a href="{{ route('admin.employee.show', $employe) }}"> {{ $employe->name }} </a></h6>
																	<p class="text-muted mb-0 fs-12"> {{ $employe->user->email }} </p>
																</div>
															</div>
														</td>
														<td>
															<div class="d-flex">
																<div class="me-3 mt-0 mt-sm-1 d-block">
																	<h6 class="mb-1 fs-14"> {{ $employe->companyDetail->designation->name }} </h6>
																	<p class="text-muted mb-0 fs-12"> {{ $employe->companyDetail->designation->department->name }} </p>
																</div>
															</div>
														</td>
														<td>
															<h6 class="mb-1 fs-14"> {{ $employe->number }} </h6>
														</td>
                                                        <td>
                                                            @can('edit employee ')
                                                            <a class="btn btn-primary btn-icon btn-sm" href="{{ route('admin.employee.edit', $employe) }}">
                                                                <i class="feather feather-edit"></i>
                                                            </a>
                                                            @endcan
                                                            @can('delete employee ')
                                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'delete_{{ $employe->id }}');"><i class="feather feather-trash-2"></i></a>
                                                            <form id="delete_{{ $employe->id }}" action="{{ route('admin.employee.destroy', $employe) }}" method="POST" style="display: none">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit">Delete</button>
                                                            </form>
                                                            @endcan
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

@endsection
