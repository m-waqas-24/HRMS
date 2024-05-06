@extends('admin.layouts.app')

@section('content')


<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Dashboard<span class="font-weight-normal text-muted ms-2"></span></div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="d-flex">
                        <div class="header-datepicker me-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-calendar"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" placeholder="19 Feb 2020" type="text">
                            </div>
                        </div>
                        <div class="header-datepicker me-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-clock"></i>
                                    </div>
                                </div><!-- input-group-prepend -->
                                <input id="tpBasic" type="text" placeholder="09:30am" class="form-control input-small">
                            </div>
                        </div><!-- wd-150 -->
                    </div>
                    <div class="d-lg-flex d-block">
                        <div class="btn-list">
                                {{-- <button type="button"  class="btn btn-primary"  data-bs-toggle="modal"   data-bs-target="#clockinmodal">Clock In</button>
                                <button type="button"  class="btn btn-light"    data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                                <button type="button"  class="btn btn-light"    data-bs-toggle="tooltip" data-bs-placement="top" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                                <button type="button"  class="btn btn-primary"  data-bs-toggle="tooltip" data-bs-placement="top"  title="Info"> <i class="feather feather-info"></i> </button> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!--ROW-->

       

        <div class="row">
          
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total Employees</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $employeCount }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-success my-auto  float-end"> <i class="feather feather-users"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Department</span>
                                            <h3 class="mb-0 mt-1 mb-2">{{ $departmentCount }}</h3>
                                            {{-- <span class="text-muted">
                                                <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-down-left me-1 bg-danger-transparent p-1 brround"></i>13</span>
                                                for last month
                                            </span> --}}
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-primary my-auto  float-end"> <i class="feather feather-box"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Pending Leaves</span>
                                        <h3 class="mb-0 mt-1  mb-2">{{ $pendingLeaves  }}</h3> </div>
                                        {{-- <span class="text-muted">
                                            <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>21.1% </span>
                                            for last month
                                        </span> --}}
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-danger brround my-auto  float-end"> <i class="fa fa-wpforms"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Trainings</span>
                                        <h3 class="mb-0 mt-1  mb-2">{{ $trainingInProgress }}</h3> </div>
                                        {{-- <span class="text-muted">
                                            <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>21.1% </span>
                                            for last month
                                        </span> --}}
                                    </div>
                                    <div class="col-4">
                                        <div class="icon1 bg-secondary brround my-auto  float-end"> <i class="feather feather-dollar-sign"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">Today's Not Clock In</h4>
                    </div>
                    <div class="card-body">
                        <div class="avatar-list d-flex" style="overflow-x: auto; white-space: nowrap;">

                            @foreach($employeesWithoutClockIn as $emp)
                                <div class="me-5 ms-5">
                                    <span class="avatar bradius mb-4" 
                                    @if(@$emp->user->avatar)
                                    style="background-image: url({{ asset('storage/'.$emp->user->avatar) }}); width:100px;  height:100px"
                                    @else
                                    style="background-image: url({{ asset('assets/images/users/user.jpg') }}); width:100px;  height:100px"
                                    @endif
                                    >
                                        <span class="avatar-status bg-red"></span>
                                    </span>
                                    <h6>{{ $emp->name }}</h6>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title">Recent Activity</h4>
                        <div class="card-options">
                            {{-- <div class="dropdown"> <a  href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false"> View All <i class="feather feather-chevron-down"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                    <li><a  href="javascript:void(0);">Monthly</a></li>
                                    <li><a  href="javascript:void(0);">Yearly</a></li>
                                    <li><a  href="javascript:void(0);">Weekly</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="timeline">
                            @php
                            $classes = ['pink', 'success', 'primary'];
                            $classCount = count($classes);
                        @endphp
                        
                        @foreach($activities as $key => $activity)
                            @php
                                $classIndex = $key % $classCount;
                                $class = $classes[$classIndex];
                            @endphp
                        
                            <li class="{{ $class }}">
                                <a href="javascript:void(0);" class="font-weight-semibold fs-15 ms-3">{{ $activity->log_name }}</a>
                                <a href="javascript:void(0);" class="text-muted float-end fs-13 me-3">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</a>
                                <p class="mb-0 pb-0 text-muted pt-1 fs-11 ms-3">{{ $activity->description }}</p>
                                {{-- <span class="text-muted  ms-3 fs-11"> On Monday 12 Jan 2020.</span> --}}
                            </li>
                        @endforeach
                            {{-- <li class="primary">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Wok Update</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">10 min ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From "Robert Marshall" Developer</p>
                                <span class="text-muted ms-3 fs-11">Task Completed.</span>
                            </li>
                            <li class="pink">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Received Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">15 min ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">Emergency Sick Leave from "jacob Berry"</p>
                                <span class="text-muted ms-3 fs-11">Ui Designer, Designer Team.</span>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li>
                            <li class="success mb-0 pb-0">
                                <a target="_blank"  href="javascript:void(0);" class="font-weight-semibold fs-15 mb-2 ms-3">Job Application Mail</a>
                                <a  href="javascript:void(0);" class="text-muted float-end fs-13">1 Hour ago</a>
                                <p class="mb-0 pb-0 text-muted fs-11 pt-1 ms-3">From jobmail@gmail.com laravel developer.</p>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title">Notice Board</h4>
                    </div>
                    <div class="pt-2">
                        <div class="list-group" style="    overflow-y: auto;
                        height: 420px;">

                  
                            @php
                            $colorClasses = ['bg-pink-transparent', 'bg-secondary-transparent', 'bg-danger-transparent', 'bg-orange-transparent', 'bg-success-transparent', 'bg-primary-transparent'];
                            @endphp

                            @foreach($notices as $notice)
                            @php
                                $randomColorClass = $colorClasses[array_rand($colorClasses)];
                            @endphp
                            <div class="list-group-item d-flex pt-3 pb-3 border-0 noticeBoard" data-bs-toggle="modal" data-bs-target="#myModal" data-notice-id="{{ $notice->id }}">
                                <div class="me-3 me-xs-0">
                                    <div class="calendar-icon icons">
                                        <div class="date_time {{ $randomColorClass }}">
                                            <span class="date">{{ \Carbon\Carbon::parse($notice->created_at)->format('d') }}</span>
                                            <span class="month">{{ \Carbon\Carbon::parse($notice->created_at)->format('M') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-1">
                                    <div class="h5 fs-14 mb-1">{{ Str::limit($notice->title, 40) }}</div>
                                    <small class="text-muted">{{ Str::limit($notice->desc, 60) }}</small>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">

                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Today's Clock-In</h3>
                    </div>
                    <div style="height: 500px !important" class="table-responsive attendance_table mt-4">
                        	<div class="table-responsive jobdatatable">
							<table class="table table-vcenter text-nowrap mb-0" id="job-table">
								<thead>
									<tr>
										<th class="wd-10p border-bottom-0 font-weight-bold">#EmpID</th>
										<th class="wd-15p border-bottom-0 font-weight-bold">Name</th>
										<th class="w-15p border-bottom-0 font-weight-bold">Status</th>
										<th class="wd-20p border-bottom-0 font-weight-bold">CheckIn</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($employeesWithAttendance as $emp)
                                    <tr class="border-bottom">
                                        <td class="">{{ $emp->empID }}</td>
                                        <td class="font-weight-semibold fs-14">{{ Str::limit($emp->name, 40) }}</td>
                                        <td class="">
                                            @php
                                                $attend = $emp->attendance->first(); // Assuming you want to get the first attendance record
                                            @endphp
                                            @if($attend)
                                                @if($attend->is_late)
                                                    <span class="badge badge-warning">Late</span>
                                                @else
                                                    <span class="badge badge-success">Present</span>
                                                @endif
                                            @else
                                                <span class="badge badge-danger">Absent</span>
                                            @endif
                                        </td>
                                        <td class="">{{ $attend ? \Carbon\Carbon::parse($attend->check_in)->format('h:i A') : '' }}</td>
                                        {{-- <td class="text-center">
                                            <a href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                            <a href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Chat"><i class="feather-message-circle text-success"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach
								</tbody>
							</table>
						</div>
                    </div>
                </div>
            </div>  
            <div class="col-md-5">
                <div class="mb-4">
                    <div class="card-header border-bottom-0 pt-2 ps-0">
                        <h4 class="card-title">Upcoming Events</h4>
                    </div>
                    <ul class="vertical-scroll">

                    @foreach($events as $event)
                    @php
                        $randomColorClass = $colorClasses[array_rand($colorClasses)];
                    @endphp
                        <li class="item">
                            <div class="card p-4 ">
                                <div class="d-flex comming_events calendar-icon icons">
                                    <span class="date_time {{ $randomColorClass }} bradius me-3"><span class="date fs-18">{{ \Carbon\Carbon::parse($event->created_at)->format('d') }}</span>
                                        <span class="month fs-10">{{ \Carbon\Carbon::parse($event->created_at)->format('M') }}</span>
                                    </span>
                                    <div class="me-3 mt-0 mt-sm-1 d-block">
                                        <h6 class="mb-1">{{ Str::limit($event->title, 20) }}</h6>
                                        <span class="clearfix"></span>
                                        <small>{{ Str::limit($event->desc, 30) }}</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                    </ul>
                </div>
            </div>
            {{-- <div class="col-xl-4 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title">Project Overview</h4>
                        <div class="card-options">
                            <div class="dropdown"> <a  href="javascript:void(0);" class="btn btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false"> Week <i class="feather feather-chevron-down"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                    <li><a  href="javascript:void(0);">Monthly</a></li>
                                    <li><a  href="javascript:void(0);">Yearly</a></li>
                                    <li><a  href="javascript:void(0);">Weekly</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-5">
                            <canvas id="sales-summary" class=""></canvas>
                        </div>
                        <div class="sales-chart mt-4 row text-center">
                            <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-primary me-2 my-auto"></span>On progress</div>
                            <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-secondary me-2 my-auto"></span>Pending</div>
                            <div class="d-flex my-auto col-sm-4 mx-auto text-center justify-content-center"><span class="dot-label bg-light4  me-2 my-auto"></span>Completed</div>
                        </div>
                    </div>
                </div>
            </div> --}}
           
        </div>
        <!-- END ROW -->

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">Jobs</h3>
                        <div class="card-options">
                            <div class="dropdown"> <a  href="javascript:void(0);" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> See All <i class="feather feather-chevron-down"></i> </a>
                                {{-- <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                    <li><a  href="javascript:void(0);">Monthly</a></li>
                                    <li><a  href="javascript:void(0);">Yearly</a></li>
                                    <li><a  href="javascript:void(0);">Weekly</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-menu-heading table_tabs mt-2 p-0 ">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="ms-sm-4"><a href="#tab5"  data-bs-toggle="tab">Job Applications</a></li>
                                <li><a href="#tab6" class="active" data-bs-toggle="tab">Job Opening</a></li>
                                <li><a href="#tab7" data-bs-toggle="tab">Hired Candidates</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body table_tabs1 p-0 border-0">
                        <div class="tab-content">
                            <div class="tab-pane" id="tab5">
                                <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                                    <table class="table mb-0 text-nowrap" >
                                        <tbody>
                                            @foreach($hiredCandid as $hired)
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/users/16.jpg') }}" alt="img" class="avatar avatar-md brround me-3">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-0">{{ $hired->name }}</h6>
                                                            <div class="clearfix"></div>
                                                            <small class="text-muted">{{ $hired->email  }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">{{ $hired->phone }}</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane active" id="tab6">
                                <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                                    <table class="table mb-0 text-nowrap" >
                                        <tbody>
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="table_img brround bg-light me-3">
                                                            <span class="bg-light brround fs-12">UI/UX</span>
                                                        </div>
                                                        <div class="me-3 mt-3 d-block">
                                                            <h6 class="mb-0 fs-13 font-weight-semibold">UI UX Designers</h6>
                                                            <div class="clearfix"></div>
                                                            <small class="text-muted">12 Dec 2020</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">4 vacancies</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="table_img brround bg-light me-3">
                                                            <img src="{{ asset('assets/images/photos/html.png') }}" alt="img" class=" bg-light brround">
                                                        </div>
                                                        <div class="me-3 mt-3 d-block">
                                                            <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Html Developer</h6>
                                                            <div class="clearfix"></div>
                                                            <small class="text-muted">28 Nov 2020</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">2 vacancies</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="table_img brround bg-light me-3">
                                                            <img src="{{ asset('assets/images/photos/jquery.png') }}" alt="img" class=" bg-light brround">
                                                        </div>
                                                        <div class="me-3 mt-3 d-block">
                                                            <h6 class="mb-0 fs-13 font-weight-semibold">Experienced Jquery Developer</h6>
                                                            <div class="clearfix"></div>
                                                            <small>12 Nov 2020</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">1 vacancies</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                                </td>
                                            </tr>
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="table_img brround bg-light me-3">
                                                            <img src="{{ asset('assets/images/photos/vue.png') }}" alt="img" class=" bg-light brround">
                                                        </div>
                                                        <div class="me-3 mt-3 d-block">
                                                            <h6 class="mb-0 fs-13 font-weight-semibold">Vue js Developer</h6>
                                                            <div class="clearfix"></div>
                                                            <small>24 Oct 2020</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">6 vacancies</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="table_img brround bg-light me-3">
                                                            <img src="{{ asset('assets/images/photos/html.png') }}" alt="img" class=" bg-light brround">
                                                        </div>
                                                        <div class="me-3 mt-3 d-block">
                                                            <h6 class="mb-0 fs-13 font-weight-semibold">Kimberly Berry</h6>
                                                            <div class="clearfix"></div>
                                                            <small>14 Oct 2020</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">4 vacancies</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-check text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-help-circle  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns"><i class="feather feather-x text-danger"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane " id="tab7">
                                <div class="table-responsive recent_jobs pt-2 pb-2 ps-2 pe-2 card-body">
                                    <table class="table mb-0 text-nowrap" id="responsive-datatable">
                                        <tbody>
                                            @foreach($hiredCandid as $hired)
                                            <tr class="border-bottom">
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/users/16.jpg') }}" alt="img" class="avatar avatar-md brround me-3">
                                                        <div class="me-3 mt-0 mt-sm-1 d-block">
                                                            <h6 class="mb-0">{{ $hired->name }}</h6>
                                                            <div class="clearfix"></div>
                                                            <small class="text-muted">{{ $hired->email  }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start fs-13">{{ $hired->phone }}</td>
                                                <td class="text-start fs-13"><i class="feather feather-map-pin text-muted me-2"></i>USA</td>
                                                <td class="text-end">
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Contact"><i class="feather feather-phone-call text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Mail"><i class="feather feather-mail  text-primary"></i></a>
                                                    <a  href="javascript:void(0);" class="action-btns" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="feather feather-trash-2 text-danger"></i></a>
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
            </div>
            <div class="col-md-4">
                <div class="card chart-donut1">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Gender by Employees</h4>
                    </div>
                    <div class="card-body">
                        <div id="employees" class="mx-auto apex-dount"></div>
                        <div class="sales-chart pt-5 pb-3 d-flex mx-auto text-center justify-content-center ">
                            <div class="d-flex me-5"><span class="dot-label bg-primary me-2 my-auto"></span>Male</div>
                            <div class="d-flex"><span class="dot-label bg-secondary me-2 my-auto"></span>Female</div>

                            <span id="maleCount" style="display: none">{{ $maleCount }}</span>
                            <span id="femaleCount" style="display: none">{{ $femaleCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Your modal content goes here -->
                  <p>This is the content of your modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
          

    </div>
</div><!-- end app-content-->

@endsection