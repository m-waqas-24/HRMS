@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Notice Board</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create notice-board')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnoticemodal"><i class="feather feather-plus"></i> Add New Notice</a>
                        @endcan
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Notice Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Title</th>
                                        <th class="border-bottom-0 text-uppercase">Description</th>
                                        <th class="border-bottom-0 text-uppercase">Created at</th>
                                        @if(Gate::check('edit notice-board') || Gate::check('delete notice-board'))
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($notices as $notice)
                                    <tr>
                                        <td>{{ $notice->title }}</td>
                                        <td>{{ Str::limit($notice->desc, 60) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($notice->created_at)->format('d F, Y') }}</td>
                                        @if(Gate::check('edit notice-board') || Gate::check('delete notice-board'))
                                        <td>
                                        <div class="d-flex">
                                            @can('edit notice-board')
                                            <a  href="{{ route('admin.noticeboard.edit', $notice) }}" class="action-btns1"><i class="feather feather-edit primary text-primary"></i></a>
                                            @endcan
                                            @can('delete notice-board')
                                            <a class="btn btn-danger btn-icon btn-sm" href="#" onclick="confirmDelete(event, 'deletenotice_{{ $notice->id }}');"><i class="feather feather-trash-2"></i></a>
                                            <form id="deletenotice_{{ $notice->id }}" action="{{ route('admin.noticeboard.destroy', $notice) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $notices->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

<!-- ADD notice MODAL -->
<div class="modal fade"  id="addnoticemodal">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.noticeboard.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input class="form-control required-field" name="title" placeholder="Text">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description:</label>
                        <div class="form-group">
                            <label class="form-label"></label>
                            <textarea name="desc" class="form-control  required-field" cols="10" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Attachment:</label>
                        <div class="form-group">
                        <label class="form-label"></label>
                            <input class="form-control" name="img" type="file" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" id="img" width="100" height="100" alt=" ">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END ADD notice MODAL -->

@endsection
