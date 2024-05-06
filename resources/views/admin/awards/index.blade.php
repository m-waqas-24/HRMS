@extends('admin.layouts.app')

@section('content')
<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Awards</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create awards')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addawardmodal"><i class="feather feather-plus"></i> Add New Award</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{ $error }}
                @endforeach
        </div>
    @endif

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Emp Name</th>
                                        <th class="border-bottom-0 text-uppercase">Designation</th>
                                        <th class="border-bottom-0 text-uppercase text-center">Attendance</th>
                                        <th class="border-bottom-0 text-uppercase">Award Type</th>
                                        <th class="border-bottom-0 text-uppercase">Gift Type</th>
                                        <th class="border-bottom-0 text-uppercase">Date</th>
                                        <th class="border-bottom-0 text-uppercase">Award Information</th>
                                        @if(Gate::check('edit awards') || Gate::check('delete awards'))
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($awards as $award)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                    <h6 class="mb-1 fs-14">{{ $award->employe->user->name }}</h6>
                                                    <p class="text-muted mb-0 fs-12">{{ $award->employe->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $award->employe->companyDetail->designation->name }}</td>
                                        <td>
                                            <div class="chart-circle chart-circle-xs" data-value="0.85" data-thickness="3" data-color="#0dcd94">
                                                <div class="chart-circle-value text-success fs-12">85%</div>
                                            </div>
                                        </td>
                                        <td class="font-weight-semibold">{{ $award->type->name }}</td>
                                        @php
                                            $classes = ['badge-primary-light', 'badge-danger-light', 'badge-warning-light', 'badge-success-light', 'badge-info-light'];
                                            $randomIndex = array_rand($classes);
                                            $randomClass = $classes[$randomIndex];
                                        @endphp
                                        <td><span class="badge {{ $randomClass }}">{{ $award->gift->name }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($award->date)->format('d F, Y') }}</td>
                                        <td>{{ Str::limit($award->desc, 20) }}</td>
                                        @if(Gate::check('edit awards') || Gate::check('delete awards'))
                                        <td>
                                            @can('edit awards')
                                            <a class="btn btn-primary btn-icon btn-sm"  href="{{ route('admin.awards.edit', $award) }}">
                                                <i class="feather feather-edit" title="View/Edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete awards')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deleteaward_{{ $award->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deleteaward_{{ $award->id }}" action="{{ route('admin.awards.destroy', $award) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
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


        @can('create awards')
			<!-- ADDAWARD MODAL -->
			<div class="modal fade"  id="addawardmodal">
				<div class="modal-dialog modal-lg" role="document">
					<form action="{{ route('admin.awards.store') }}" method="POST">
					@csrf
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Award Details</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="form-label">Employee Name</label>
											<select name="employee" class="form-control form-select required-field" >
                                                @if(Auth::user()->type == 'employee')
                                                <option value="{{ Auth::user()->employe->id }}">{{ Auth::user()->employe->name }}</option>
                                                @else
												<option value="">Select Employee</option>
												@foreach($employees as $employe)
												<option value="{{ $employe->id }}">{{ $employe->name }}</option>
												@endforeach
                                                @endif
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Award Types</label>
											<select name="award_type"  class="form-control custom-select required-field">
												<option value="">Choose Award Type</option>
                                                @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="form-label">Gift Types</label>
											<select name="gift"  class="form-control custom-select required-field">
												<option value="">Choose Gift</option>
                                                @foreach($gifts as $gift)
                                                <option value="{{ $gift->id }}"> {{ $gift->name }} </option>
                                                @endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="form-label">Date:</label>
									<div class="input-group">
										<input type="date" name="date"  class="form-control required-field" placeholder="select dates"/>
									</div>
								</div>
								<div class="form-group">
									<label class="form-label">Award Description:</label>
									<textarea class="form-control" rows="3" name="description" placeholder="Description...."></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<div class="ms-auto">
									<a  href="javascript:void(0);" class="btn btn-outline-primary" data-bs-dismiss="modal">close</a>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END ADDAWARD MODAL -->
        @endcan

@endsection