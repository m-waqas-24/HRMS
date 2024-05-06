@extends('admin.layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('richtexteditor/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('richtexteditor/rte.js') }}"></script>
<script>
    RTE_DefaultConfig.url_base = 'richtexteditor'
</script>
<script type="text/javascript" src="{{ asset('richtexteditor/plugins/all_plugins.js') }}"></script>

<div class="app-content main-content">
    <div class="side-app main-container">
       
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block" style="margin: 1rem 0 !important">
            <div class="page-leftheader">
                <div class="page-title">Recruitments</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                        <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                        <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
           
            <div class=" col-md-12 col-lg-12">
                <div class="tab-menu-heading hremp-tabs p-0 ">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            @can('manage jobs')
                            <li class="ms-4"><a href="#tab5" class="active"  data-bs-toggle="tab">Jobs List</a></li>
                            @endcan
                            @can('manage candidates')
                            <li><a href="#tab6"  data-bs-toggle="tab">Candidate</a></li>
                            @endcan
                            @can('manage interviewschedule')
                            <li><a href="#tab8" data-bs-toggle="tab">Interview Schedule</a></li>
                            @endcan
                            @can('create jobs')
                            <li><a href="#tab7" data-bs-toggle="tab"><i class="feather feather-plus"></i> Create Job</a></li>
                            @endcan
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <div class="tab-content">
                        @can('manage jobs')
                        <div class="tab-pane active" id="tab5">
                        	<div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-uppercase">Job ID</th>
                                                <th class="border-bottom-0 text-uppercase">Position</th>
                                                <th class="border-bottom-0 text-uppercase">Company</th>
                                                <th class="border-bottom-0 text-uppercase">Type</th>
                                                <th class="border-bottom-0 text-uppercase">Posted Date</th>
                                                <th class="border-bottom-0 text-uppercase">Last Date to Apply</th>
                                                <th class="border-bottom-0 text-uppercase">Status</th>
                                                @if(Gate::check('edit jobs') || Gate::check('delete jobs'))
                                                <th class="border-bottom-0 text-uppercase">Actions</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jobs as $job)
                                            <tr>
                                                <td><strong>{{ $job->jobID }}</strong></td>
                                                <td>
                                                    <a  href="{{ route('admin.recruitments.show', $job) }}">{{ $job->title }}</a>
                                                </td>
                                                <td>{{ $job->company->name }}</td>
                                                <td>
                                                    @if($job->job_type == 1)
                                                    Full-Time
                                                    @elseif($job->job_type == 2)
                                                    Part-Time
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d F, Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($job->last_date)->format('d F, Y') }}</td>
                                                <td>
                                                    @if($job->status_id == 1)
                                                    <span class="badge badge-success">Active</span>
                                                    @elseif($job->status_id == 0)
                                                    <span class="badge badge-danger">inActive</span>
                                                    @endif
                                                </td>
                                                @if(Gate::check('edit jobs') || Gate::check('delete jobs'))
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.recruitments.show', $job) }}" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="View"><i class="feather feather-eye text-primary"></i></a>
                                                        @can('edit jobs')
                                                        <a  href="{{ route('admin.recruitments.edit', $job) }}" class="action-btns1" >
                                                            <i class="feather feather-edit-2  text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit"></i>
                                                        </a>
                                                        @endcan
                                                        {{-- <a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a> --}}
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
                        @endcan
                        @can('manage candidates')
                        <div class="tab-pane" id="tab6">
                            <div class="card-body">
                                @can('create candidates')
                                <a href="#" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#addcandidatemodal"><i class="feather feather-plus"></i> Add Candidate</a>
                                @endcan
                                <div class="table-responsive">
                                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable2">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-uppercase">Name</th>
                                                <th class="border-bottom-0 text-uppercase">Phone</th>
                                                <th class="border-bottom-0 text-uppercase">Apply for</th>
                                                <th class="border-bottom-0 text-uppercase">Apply At</th>
                                                <th class="border-bottom-0 text-uppercase">Resume\CV</th>
                                                <th class="border-bottom-0 text-uppercase">Status</th>
                                                @if(Gate::check('edit candidates') || Gate::check('delete candidates'))
                                                <th class="border-bottom-0 text-uppercase">Actions</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($candidates as $candid)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-1 fs-14">{{ $candid->name }}</h6>
                                                            <p class="text-muted mb-0 fs-12">{{ $candid->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $candid->phone }}</td>
                                                <td>{{ $candid->job->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($candid->created_at)->format('d F, Y') }}</td>
                                                <td><a href="{{ asset('storage/'.$candid->file) }}" download="{{ asset('storage/'.$candid->file) }}" class="btn btn-danger btn-sm"><i class="feather-download"></i> </a></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            @foreach($candidateStatuses as $status)
                                                                @if($candid->status_id === $status->id)
                                                                    {{ $status->name }}
                                                                @endif
                                                            @endforeach
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @foreach($candidateStatuses as $status)
                                                                <a class="dropdown-item option-item" href="#" data-value="{{ $status->name }}" data-status-id="{{ $status->id }}" data-candidate-id="{{ $candid->id }}">{{ $status->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                                @if(Gate::check('edit candidates') || Gate::check('delete candidates'))
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.candidates.show', $candid) }}" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="View"><i class="feather feather-eye text-primary"></i></a>
                                                        
                                                        @can('edit candidates')
                                                        <a  href="{{ route('admin.candidates.edit', $candid) }}" class="action-btns1">
                                                            <i class="feather feather-edit-2  text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit"></i>
                                                        </a>
                                                        @endcan
                                                        {{-- <a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a> --}}
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
                        @endcan
                        @can('create jobs')
                        <div class="tab-pane" id="tab7">
                            <form action="{{ route('admin.recruitments.store') }}" method="POST">
                                @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Company Name</label>
                                            <select name="company" id="" class="form-control custom-select required-field">
                                                <option value="">Select Company</option>
                                                @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Job Title</label>
                                            <input class="form-control required-field" name="title" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Job Type:</label>
                                            <select name="Job_type"  class="form-control custom-select required-field" data-placeholder="Select Job Type">
                                                <option label="Select Job Type"></option>
                                                <option value="1">Full-Time</option>
                                                <option value="2">Part-Time</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">No.of Vacancy</label>
                                            <input class="form-control required-field" name="vacancy" placeholder="Vacancy">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Last Date To Apply</label>
                                            <div class="input-group">
                                                <input class="form-control required-field" name="last_date" placeholder="DD-MM-YYY" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Enter City:</label>
                                            <input class="form-control" name="city" placeholder="City">
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description:</label>
                                            <textarea name="desc" id="div_editorA" cols="30" class="form-control required-field" placeholder="Enter Job Description" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg" >Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        @endcan
                        @can('manage interviewschedule')
                        <div class="tab-pane" id="tab8">
                        	<div class="card-body">
                                @can('create interviewschedule')
                                <a href="#" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#addinterviewmodal"><i class="feather feather-plus"></i> Schedule Interview</a>
                                @endcan
                                <div class="table-responsive">
                                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable3">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0 text-uppercase">Candidate</th>
                                                <th class="border-bottom-0 text-uppercase">Phone</th>
                                                <th class="border-bottom-0 text-uppercase">Apply for</th>
                                                <th class="border-bottom-0 text-uppercase">Interviewer</th>
                                                <th class="border-bottom-0 text-uppercase">Date-Time</th>
                                                <th class="border-bottom-0 text-uppercase">Status</th>
                                                @if(Gate::check('edit interviewschedule') || Gate::check('delete interviewschedule'))
                                                <th class="border-bottom-0 text-uppercase">Actions</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($interviews as $inter)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-1 fs-14">{{ $inter->candidate->name }}</h6>
                                                            <p class="text-muted mb-0 fs-12">{{ $inter->candidate->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $inter->candidate->phone }}</td>
                                                <td> {{ $inter->candidate->job->title }} </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-1 fs-14">{{ $inter->employe->name }}</h6>
                                                            <p class="text-muted mb-0 fs-12">{{ $inter->employe->companyDetail->designation->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 
                                                    <div class="d-flex">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-1 fs-14">{{ \Carbon\Carbon::parse($inter->date_time)->format('d F, Y') }}</h6>
                                                            <p class="text-muted mb-0 fs-12">{{ \Carbon\Carbon::parse($inter->date_time)->format('H:i:s') }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            @foreach($candidateStatuses as $status)
                                                                @if($inter->candidate->status_id === $status->id)
                                                                    {{ $status->name }}
                                                                @endif
                                                            @endforeach
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @foreach($candidateStatuses as $status)
                                                                <a class="dropdown-item option-item" href="#" data-value="{{ $status->name }}" data-status-id="{{ $status->id }}" data-candidate-id="{{ $inter->candidate->id }}">{{ $status->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                                @if(Gate::check('edit interviewschedule') || Gate::check('delete interviewschedule'))
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="job-view.html" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="View"><i class="feather feather-eye text-primary"></i></a>
                                                        @can('edit interviewschedule')
                                                        <a  href="{{ route('admin.interviews.edit', $inter) }}" class="action-btns1" >
                                                            <i class="feather feather-edit-2  text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit"></i>
                                                        </a>
                                                        @endcan
                                                        @can('delete interviewschedule')
                                                        <a  href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
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
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

                        @can('create candidates')
				            <!-- ADD addcandidatemodal MODAL -->
							<div class="modal fade"  id="addcandidatemodal">
								<div class="modal-dialog modal-lg" role="document">
									<form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Add Candidate</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Applied For</label>
                                                            <select name="job" class="form-control form-select required-field" >
                                                                <option value="">Select Job </option>
                                                                @foreach($jobs as $job)
                                                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Name:</label>
                                                            <input type="text" name="name" class="form-control required-field" placeholder="Enter Candidate Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email:</label>
                                                            <input type="text" name="email" class="form-control required-field" placeholder="Enter Candidate Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone:</label>
                                                            <input class="form-control required-field" name="phone" type="text" placeholder="Enter Candidate Phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Resume\CV:</label>
                                                            <input class="form-control required-field" name="resume" type="file" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Add</button>
                                                </div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- END ADD addcandidatemodal MODAL -->
                        @endcan

                        @can('create interviewschedule')
                        <!-- ADD interview MODAL -->
							<div class="modal fade"  id="addinterviewmodal">
								<div class="modal-dialog " role="document">
									<form action="{{ route('admin.interviews.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Schedule iterview</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="form-group">
                                                    <label class="form-label">Candidate:</label>
                                                    <select name="candidate" class="form-control form-select required-field" >
                                                        <option value="">Select Candidate </option>
                                                        @foreach($candidates as $candid)
                                                        <option value="{{ $candid->id }}">{{ $candid->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Interviewer:</label>
                                                    <select name="interviewer" class="form-control form-select required-field" >
                                                        <option value="">Select Interviewer</option>
                                                        @foreach($employes as $employe)
                                                        <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Interviewer Date and Time:</label>
                                                    <input type="datetime-local" class="form-control required-field" name="datetime">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
											</div>
										</div>
									</form>
								</div>
							</div>
						<!-- END ADD interview MODAL -->
                        @endcan


@endsection



@section('scripts')

<script>
    $(document).ready(function () {
    $(".option-item").click(function () {
        const selectedOption = $(this).data("value");
        const selectedStatusId = $(this).data("status-id");
        const selectedCandidateId = $(this).data("candidate-id"); // Get the candidate ID
        const dropdown = $(this).closest(".dropdown");

        dropdown.find(".dropdown-toggle").text(selectedOption);
        dropdown.find(".selected-option-badge").text(selectedOption);

        $.ajax({
            url: "{{ route('admin.update.candidate-status') }}",
            method: 'GET',
            data: {
                statusId: selectedStatusId,
                candidateId: selectedCandidateId // Send the candidate ID
            },
            success: function (response) {
                let success = response.success;
                
                if(success){
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 5500
                })
                location.reload()
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});

</script>

<script>
    // This line initializes the first editor with ID #div_editor1
    var editor1 = new RichTextEditor("#div_editorA");
</script>
<script src="{{ asset('res/patch.js') }}"></script>


@endsection