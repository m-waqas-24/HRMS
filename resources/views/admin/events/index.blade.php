@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Events</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create events')
                        <a  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#eventmodal" class="btn btn-primary me-3"><i class="feather feather-plus"></i> Add New Events</a>
                        @endcan
                        {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                        <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                        <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h4 class="card-title">Upcoming Events</h4>
                    </div>
                    <div class="card-body mt-2">
                        @if(count($events) == 0)
                        <p class="text-danger">No event planned yet!</p>
                        @endif

                        @foreach($events as $event)
                        <div class="mb-5">
                            <div class="d-flex comming_holidays calendar-icon icons">
                                <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                    <span class="month fs-13">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                </span>
                                <div class="me-3 mt-0 mt-sm-2 d-block">
                                    <h6 class="mb-1 font-weight-semibold">{{ $event->title }}</h6>
                                    <span class="clearfix"></span>
                                    <small>{{ $event->desc }}</small>
                                </div>
                            </div>
                            @can('delete events')
                                <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deleteevent_{{ $event->id }}');"><i class="feather feather-trash-2"></i></a>
                                <form id="deleteevent_{{ $event->id }}" action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endcan
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

    @can('create events')
    <!-- ADD NEW EVENT MODAL -->
    <div class="modal fade"  id="eventmodal">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control  required-field" placeholder="Enter Event title" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Event Date:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="feather feather-calendar"></i>
                                    </div>
                                </div><input class="form-control  required-field" name="date" type="date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Event Description</label>
                            <textarea class="form-control  required-field" rows="1" name="description" placeholder="Description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END ADD NEW EVENT MODAL -->
    @endcan

@endsection