@extends('admin.layouts.app')

@section('content')


<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Attendance
                </div>
               @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        {{-- <a href="hr-attmark.html" class="btn btn-primary me-3">Mark Attendance</a> --}}
                        {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                        <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                        <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->


        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.search.attendance') }}" method="GET"> 
                        @csrf
                        <div class="card-body">
                            <div class="row mt-5">
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Employee Name:</label>
                                        <select class="form-control select2 custom-select" name="employee" >
                                            <option value="">Select Employee</option>
                                        @foreach($employes as $emp)
                                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Month:</label>
                                        <select required class="form-control custom-select select2 required-field" name="month">
                                            <option value="">Select Month</option>
                                            @foreach ($months as $month )
                                                <option value="{{ $month->id }}" {{ $smonth == $month->id ? 'selected' : '' }}> {{ $month->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label">Year:</label>
                                        <select required class="form-control custom-select select2" name="year" >
                                            <option value="">Select Year</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" {{ $syear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="d-flex mb-6 mt-5">
                            <div class="me-3">
                                <label class="form-label">Note:</label>
                            </div>
                            <div>
                                <span class="badge badge-success-light me-2"><i class="feather feather-check-circle text-success"></i> ---> Present</span>
                                <span class="badge badge-danger-light me-2"><i class="feather feather-x-circle text-danger"></i> ---> Absent</span>
                                <span class="badge badge-warning-light me-2"><i class="fa fa-star text-warning"></i> ---> Holiday</span>
                                <span class="badge badge-success-light me-2"><i class="fa fa-adjust text-success"></i>  ---> Half Day</span>
                                <span class="badge badge-orange-light me-2"><i class="fa fa-user text-danger"></i>  ---> Leave</span>
                                <span class="badge badge-secondary-light me-2"><i class="fa fa-circle text-secondary"></i>  ---> Sunday</span>
                            </div>
                        </div>
                        <div class="table-responsive hr-attlist">
                            <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-attendance">
                                <thead>
                                    @php
                                        if (!empty($totalDaysInSearchMonth)) {
                                            $totaldays = $totalDaysInSearchMonth;
                                        } else {
                                            $totaldays = now()->daysInMonth;
                                        }
                                    @endphp
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Employee Name</th>
                                        @for ($i = 1; $i <= $totaldays; $i++)
                                            <th class="border-bottom-0 w-5">{{ $i }}</th>
                                        @endfor
                                        <th class="border-bottom-0">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employes as $employee)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.attendance-by-user', $employee->id) }}">
                                                <span class="avatar avatar brround me-3"
                                                    style="background-image: url({{ asset('storage/'.$employee->user->avatar) }})"></span></a>
                                                <div class="me-3 mt-0 mt-sm-2 d-block">
                                                    <h6 class="mb-1 fs-14"> <a href="{{ route('admin.attendance-by-user', $employee->id) }}">{{ $employee->name }}</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        @for($day = 1; $day <= $totaldays ; $day++)
                                        @php
                                        if(!empty($smonth) && !empty($syear)){
                                            //check for search month and year
                                            $dateToCheck = $syear . '-' . $smonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                        }else{
                                            //check for current month and year
                                            $dateToCheck = now()->year . '-' . now()->month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                        }
                                        $attendanceExist = $employee->attendance()
                                        ->whereDate('created_at', $dateToCheck)
                                        ->exists();
                                        $halfDayExist = $employee->attendance()
                                        ->whereDate('created_at', $dateToCheck)
                                        ->where('total_hours', '<', 4)
                                        ->exists();

                                        $getAttendance = $employee->attendance()
                                            ->whereDate('created_at', $dateToCheck)
                                            ->first();

                                        if ($getAttendance) {
                                            $getAttendanceId = $getAttendance->id;
                                        } else {
                                            $getAttendanceId = null;
                                        }

                                        $isSunday = isSunday($dateToCheck);
                                        $isHoliday = isHolidayy($dateToCheck);
                                        $isLeave = $employee->isLeave($dateToCheck);
                                    @endphp
                
                                        <td>
                                            <div class="hr-listd">
                                                 
                                                <a href="#" data-attendance-id="{{ $getAttendanceId ?? '' }}" @if(@$getAttendanceId) data-bs-toggle="modal" data-bs-target="#presentmodal" @endif
                                                    class="hr-listmodal get-attendance"
                                                    data-bs-placement="top" data-bs-toggle="tooltip" title="" 
                                                    data-bs-original-title="@if($attendanceExist && $halfDayExist) Half Day @elseif($attendanceExist && !$halfDayExist) Present
                                                    @elseif($isHoliday) Holiday  @elseif($isLeave) Leave  @elseif($attendanceExist && $isSunday) Present
                                                    @elseif(!$attendanceExist && $isSunday) Sunday @else Absent @endif"></a>

                                                    
                                                @if($day > now()->day && empty($smonth) && empty($syear) )
                                                    <span>--</span>
                                                @else  

                                                    @if($attendanceExist && !$halfDayExist)
                                                        <span class="feather feather-check-circle text-success"></span>
                                                    @elseif($attendanceExist && $halfDayExist)
                                                        <span class="fa fa-adjust text-success"></span>
                                                    @elseif($isHoliday)
                                                        <span class="fa fa-star text-warning" ></span>
                                                    @elseif($isLeave)
                                                        <span class="fa fa-user text-danger" ></span>
                                                    @elseif($attendanceExist && $isSunday)
                                                        <span class="feather feather-check-circle text-success"></span>
                                                    @elseif(!$attendanceExist && $isSunday)
                                                        <span class="fa fa-circle text-secondary" ></span>
                                                    @else
                                                    <span class="feather feather-x-circle text-danger" ></span>
                                                    @endif
                                                @endif
                                                </div>
                                            </td>
                                            @endfor
                                        <td>
                                            <h6 class="mb-0">
                                                @if(!empty($smonth) && !empty($syear))
                                                    <span class="text-primary">{{ $employee->getPresentDaysCountForMonth($syear, $smonth) }}</span>
                                                    <span class="my-auto fs-8 font-weight-normal text-muted">/</span>
                                                    <span class="">{{  $totalwork }}</span>
                                                @else
                                                    <span class="text-primary">{{ $employee->getPresentDaysCountForMonth(now()->year, now()->month) }}</span>
                                                    <span class="my-auto fs-8 font-weight-normal text-muted">/</span>
                                                    <span class="">{{ now()->day }}</span>
                                                @endif
                                                
                                            </h6>
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


<div class="modal fade"  id="presentmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-5 mt-4">
                    <div class="col-md-4">
                        <div class="pt-5 text-center">
                            <h6 class="mb-1 fs-16 font-weight-semibold cin-time">09:30 AM</h6>
                            <small class="text-muted fs-14">Clock In</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-circle chart-circle-md" data-value="100" data-thickness="6" data-color="#0dcd94">
                            <div class="chart-circle-value text-muted total-time">09:00 hrs</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pt-5 text-center">
                            <h6 class="mb-1 fs-16 font-weight-semibold cout-time"> 06:30 PM</h6>
                            <small class="text-muted fs-14">Clock Out</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        $('.get-attendance').click(function(e) {
        e.preventDefault();
        var attendanceId = $(this).data('attendance-id');

        $.ajax({
                url: "{{ route('admin.get-attendance') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    attendanceId: attendanceId,
                },
                success: function(response){
                    var attendance = response.attendance;
                    var checkInTime = attendance.check_in ? new Date(attendance.check_in) : 'N\A';
                    var checkInTime = checkInTime.toLocaleString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
                    var checkOutTime =  attendance.check_out ? new Date(attendance.check_out) : 'N\A';
                    var checkOutTime = checkOutTime.toLocaleString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });


                    $('#presentmodal .cin-time').html(checkInTime ? checkInTime : 'N\A' );
                    $('#presentmodal .cout-time').html(checkOutTime ? checkOutTime : 'N\A');
                   
                    var totalHours = attendance.total_hours || 0;
                    var totalMinutes = attendance.total_minutes || 0;
                    var formattedTotalTime = '';

                    if (totalHours > 0) {
                        formattedTotalTime = `${totalHours}h${totalMinutes > 0 ? ` ${totalMinutes} min` : ''}`;
                    } else if (totalHours <= 0 && totalMinutes > 0) {
                        formattedTotalTime = `${totalMinutes} min`;
                    } else {
                        formattedTotalTime = 'N/A';
                    }

                    $('#presentmodal .total-time').html(formattedTotalTime);

                },
                error: function(error){
                    console.log(error);
                }
            })

    });
    });
</script>
    
@endsection

