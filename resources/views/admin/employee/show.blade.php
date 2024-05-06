@extends('admin.layouts.app')

@section('styles')
<style>
    .table td{
        width: 30% !important;
    }
</style>
@endsection

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">

        <!-- ROW -->
        <div class="main-proifle mt-4">
            <div class="row">
                <div class="col-xl-7">
                    <div class="box-widget widget-user">
                        <div class="widget-user-image d-sm-flex">
                            @if(isset($employee->user->avatar))
                                <span class="avatar" style="background-image: url({{ asset('storage/'.$employee->user->avatar) }}); border:none !important;">
                            @else
                                <span class="avatar" style="background-image: url({{ asset('assets/user.jpg') }}); border:none !important;">
                            @endif

                                <span class="avatar-status bg-green"></span>
                            </span>
                            <div class="ms-sm-4 mt-4">
                                <h4 class="pro-user-username mb-3 font-weight-semibold">{{ $employee->name }}<i class="ri-checkbox-circle-line text-success ms-1 fs-14"></i></h4>
                                <div class="d-flex mb-2">
                                    <span class="ri-mail-line icons"></span>
                                    <div class="h6 mb-0 ms-3 mt-1">{{ $employee->user->email }}</div>
                                </div>
                                <div class="d-flex">
                                    <span class="ri-phone-line icons"></span>
                                    <div class="h6 mb-0 ms-3 mt-1">{{ $employee->number }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-7">
                    <div class="text-xl-end mt-4 mt-xl-0">
                        {{-- <a  href="javascript:void(0);" class="btn btn-white">Message</a> --}}
                        @can('edit employee ')
                            <a href="{{ route('admin.employee.edit', $employee) }}" class="btn btn-primary">Edit Profile</a>
                        @endcan
                    </div>
                    <div class="mt-5">
                        {{-- <div class="main-profile-contact-list row">
                            <div class="media col-sm-4 p-0">
                                <div class="media-icon bg-primary  me-3 mt-1">
                                    <i class="las la-edit fs-20 text-white"></i>
                                </div>
                                <div class="media-body">
                                    <span class="text-muted">Posts</span>
                                    <div class="font-weight-semibold fs-25">
                                        328
                                    </div>
                                </div>
                            </div>
                            <div class="media col-sm-4 p-0">
                                <div class="media-icon bg-success me-3 mt-1">
                                    <i class="las la-users fs-20 text-white"></i>
                                </div>
                                <div class="media-body">
                                    <span class="text-muted">Followers</span>
                                    <div class="font-weight-semibold fs-25">
                                        937k
                                    </div>
                                </div>
                            </div>
                            <div class="media col-sm-4 p-0">
                                <div class="media-icon bg-orange me-3 mt-1">
                                    <i class="las la-wifi fs-20 text-white"></i>
                                </div>
                                <div class="media-body">
                                    <span class="text-muted">Following</span>
                                    <div class="font-weight-semibold fs-25">
                                        2,876
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="profile-cover">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading p-0">
                        <div class="tabs-menu1 px-3">
                            <ul class="nav">
                                <li><a href="#tab-7" class="active" data-bs-toggle="tab">Profile</a></li>
                                {{-- <li><a href="#tab-8" data-bs-toggle="tab" class="">Company Details</a></li>
                                <li><a href="#tab-9" data-bs-toggle="tab" class="">Bank Details</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.profile-cover -->
        </div>
        <!-- END ROW -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="border-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card" style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Personal Details</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">#EmployeeId: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->empID }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Address: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Marital Status: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                @if($employee->marital == 1)
                                                                Single
                                                                @elseif($employee->marital == 2)
                                                                Married
                                                                @elseif($employee->marital == 3)
                                                                Divorced
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Blood Group </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->blood }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Date-of-Birth: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ \Carbon\Carbon::parse($employee->d_o_b)->format('d F, Y') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card"  style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Company Details</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Company: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->companyDetail->company->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Branch: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->companyDetail->branch->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Department: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->companyDetail->designation->department->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Designation: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->companyDetail->designation->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Date-of-Joining: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                {{ \Carbon\Carbon::parse($employee->companyDetail->d_o_join)->format('d F, Y') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Attendance Slot: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                {{ $employee->companyDetail->timeSlot->name ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card" style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Contact</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Employe Contact: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Emergency Contact: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->eme_no_1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Relationship to Employee: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->relation }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card"  style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Bank Account Details</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Account Name: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->bankDetail->acc_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Account Number: </span>
                                                            </td>
                                                            <td class="py-2 px-0">{{ $employee->bankDetail->acc_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Bank Name: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                {{ $employee->bankDetail->bank_name  }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Bank Location: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                {{ $employee->bankDetail->bank_location  }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Bank Code: </span>
                                                            </td>
                                                            <td class="py-2 px-0">
                                                                {{ $employee->bankDetail->bank_code  }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card"  style="height: 320px">
                                        <div class="card-body">
                                            <h6 class="card-title">Documents Details</h6>
                                            <div class="table-responsive border-top">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Resume: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a href="{{ asset('storage/'.$employee->document->resume) }}" class="btn btn-primary btn-sm" download="{{ asset('storage/'.$employee->document->resume) }}">Download</a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">CNIC: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$employee->document->cnic) }}" download="{{ asset('storage/'.$employee->document->cnic) }}">Download</a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Offer-Letter: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$employee->document->offer_letter) }}" download="{{ asset('storage/'.$employee->document->offer_letter) }}">Download</a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Joining-Letter: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$employee->document->joining_letter) }}" download="{{ asset('storage/'.$employee->document->joining_letter) }}">Download</a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Agreement-Letter: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$employee->document->agreement_letter) }}" download="{{ asset('storage/'.$employee->document->agreement_letter) }}">Download</a> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-0">
                                                                <span class="font-weight-bold ">Experience-Letter: </span>
                                                            </td>
                                                            <td class="py-2 px-0"> <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$employee->document->experience_letter) }}" download="{{ asset('storage/'.$employee->document->experience_letter) }}">Download</a> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-8">
                            <div class="card p-5">
                                <h5 class="font-weight-semibold">Company Details</h5>
                                <div class="main-profile-contact-list d-lg-flex">
                                    <div class="media me-4">
                                        <div class="media-icon bg-primary text-white me-3 mt-1">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="text-muted">Date of Birth</small>
                                            <div class="font-weight-semibold">
                                                {{ \Carbon\Carbon::parse($employee->d_o_b)->format('d F, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media me-4">
                                        <div class="media-icon bg-warning text-white me-3 mt-1">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="text-muted">Blood Group</small>
                                            <div class="font-weight-semibold">
                                                {{ $employee->blood }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-icon bg-info text-white me-3 mt-1">
                                            <i class="fa fa-map"></i>
                                        </div>
                                        <div class="media-body">
                                            <small class="text-muted">Current Address</small>
                                            <div class="font-weight-semibold">
                                                {{ $employee->address }}
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- main-profile-contact-list -->
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-9">
                            <ul class="timelinestart pb-5">
                                <li class="timestart-label"><span class="bg-danger">10 May. 2020</span></li>
                                <li>
                                    <i class="fa fa-envelope bg-primary"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 12:05</span>
                                        <h3 class="timelinestart-header"><a  href="javascript:void(0);">Support Team</a> <span>sent you an email</span></h3>
                                        <div class="timelinestart-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timelinestart-footer">
                                            <a class="btn btn-primary text-white btn-sm">Read more</a>
                                            <a class="btn btn-secondary text-white btn-sm ">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-user bg-secondary"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 5 mins ago</span>
                                        <h3 class="timelinestart-header no-border"><a  href="javascript:void(0);">Sarah Young</a> accepted your friend request</h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-comments bg-warning"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 27 mins ago</span>
                                        <h3 class="timelinestart-header"><a  href="javascript:void(0);">Jay White</a> commented on your post</h3>
                                        <div class="timelinestart-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timelinestart-footer">
                                            <a class="btn btn-info text-white btn-flat btn-sm">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-video-camera bg-pink"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 1 hour ago</span>
                                        <h3 class="timelinestart-header"><a  href="javascript:void(0);">Mr. John</a> shared a video</h3>
                                        <div class="timelinestart-body">
                                            <div class="embed-responsive embed-responsive-16by9 w-75" >
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                 allowfullscreen></iframe>
                                            </div>
                                            <div class="timelinestart-body mt-3">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus.Lorem ipsum dolor sit amet
                                            </div>
                                        </div>
                                        <div class="timelinestart-footer">
                                            <a  href="javascript:void(0);" class="btn btn-sm bg-warning text-white">See comments</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="timestart-label">
                                    <span class="bg-success"> 3 Jan. 2014</span>
                                </li>
                                <li>
                                    <i class="fa fa-camera bg-orange"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 2 days ago</span>
                                        <h3 class="timelinestart-header"><a  href="javascript:void(0);">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timelinestart-body">
                                            <img src="assets/images/photos/1.jpg" alt="..." class="margin mt-2 mb-2">
                                            <img src="assets/images/photos/2.jpg" alt="..." class="margin mt-2 mb-2 ">
                                            <img src="assets/images/photos/3.jpg" alt="..." class="margin mt-2 mb-2 ">
                                            <img src="assets/images/photos/4.jpg" alt="..." class="margin mt-2 mb-2">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-video-camera bg-pink"></i>
                                    <div class="timelinestart-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i> 5 days ago</span>
                                        <h3 class="timelinestart-header"><a  href="javascript:void(0);">Mr. Doe</a> shared a video</h3>
                                        <div class="timelinestart-body">
                                            <div class="embed-responsive embed-responsive-16by9 w-75" >
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                 allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <div class="timelinestart-footer">
                                            <a  href="javascript:void(0);" class="btn btn-sm bg-warning text-white">See comments</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o bg-success pb-3"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection