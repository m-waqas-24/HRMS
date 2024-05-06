@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Employe Assets</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        @can('create employee-assets')
                        <a  href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addasset"><i class="feather feather-plus"></i> </a>
                        @endcan
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
                        <h4 class="card-title">Employe Assets</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">EMP NAME</th>
                                        <th class="border-bottom-0 text-uppercase">Assets</th>
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employeAssets as $empAsset)
                                    <tr>
                                        <td><strong>{{ $empAsset->name }}</strong></td>
                                        <td>
                                        @foreach($empAsset->assets as $index => $asset)
                                            @if($index < 9)
                                                <span class="badge bg-primary">{{ isset($asset->assetName->name) ? $asset->assetName->name : "" }}</span>
                                            @else
                                                @php $remainingCount = count($empAsset->assets) - $index; @endphp
                                                @if($remainingCount > 0)
                                                    ... {{ $remainingCount }} more ...
                                                    @break
                                                @endif
                                            @endif
                                        @endforeach	
                                        </td>
                                        <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.employee-assets.show', $empAsset->id) }}" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="View"><i class="feather feather-eye text-primary"></i></a>
                                        </div>
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

                    <!-- ADD Training MODAL -->
                    <div class="modal fade" id="addasset">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.employee-assets.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Employee Assets</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-label">Employe:</label>
                                                        <select id="employe" name="employee" class="form-control form-select required-field" >
                                                            @if(Auth::user()->type == 'employee')
                                                            <option value="{{ Auth::user()->employe->id }}">{{ Auth::user()->employe->name }}</option>
                                                            @else
                                                            <option value="">Select Employe </option>
                                                            @foreach($employes as $employe)
                                                            <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Assets:</label>
                                                        <select required id="employe" name="asset[]"  class="form-control select2 required-field" data-placeholder="Choose Assets" multiple >
                                                            @foreach($assets as $asset)
                                                            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                                            @endforeach
                                                        </select>
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
                <!-- END ADD trainer MODAL -->

@endsection

@section('scripts')


<script>
    function confirmDelete(event) {
        event.preventDefault(); // Prevent the default link behavior
        
        Swal.fire({
            title: 'Do you want to delete this?',
            showDenyButton: true,
            showCancelButton: false, // Set this to false to hide the "Cancel" button
            confirmButtonText: 'Delete',
            denyButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the form
                document.getElementById('deletenotice').submit();
            } else {
                // If the user denies, do nothing
            }
        });
    }
</script>

@endsection