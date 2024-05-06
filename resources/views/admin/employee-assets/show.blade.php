@extends('admin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">{{ $employeName }} Assets</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                    <div class="btn-list">
                        <a href="{{ route('admin.employee-assets.index') }}" class="btn btn-primary me-3" ><i class="feather feather-arrow-left"></i> Back</a>
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
                        <h4 class="card-title"> Assets</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">Assets</th>
                                        <th class="border-bottom-0 text-uppercase">Status</th>
                                        @if(Gate::check('edit employee-assets') || Gate::check('delete employee-assets'))
                                        <th class="border-bottom-0 text-uppercase">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($empasset as $asset)
                                    <tr>
                                        <td><strong>{{ $asset->assetName->name }}</strong></td>
                                        <td>
                                            <span class="badge @if($asset->AssetStatus->id == 1) badge-success @elseif($asset->AssetStatus->id == 2) badge-primary @elseif($asset->AssetStatus->id == 3) badge-info @elseif($asset->AssetStatus->id == 4) badge-danger  @elseif($asset->AssetStatus->id == 5) badge-warning  @endif mt-2"> {{ $asset->AssetStatus->name }}</span>
                                        </td>
                                        @if(Gate::check('edit employee-assets') || Gate::check('delete employee-assets'))
                                        <td>
                                            <div class="d-flex">
                                                @can('edit employee-assets')
                                                <button data-bs-toggle="modal" data-bs-target="#editasset" class="action-btns1 edit-btn" data-asset-id="{{ $asset->id }}">
                                                    <i class="feather feather-edit-2  text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit"></i>
                                                </button>
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
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

                    <!-- ADD Training MODAL -->
                    <div class="modal fade" id="editasset">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('admin.employe-asset-update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Asset Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" id="assetid">
                                                        <label class="form-label">Status:</label>
                                                        <select required id="employe" name="status"  class="form-control" data-placeholder="Choose Status" >
                                                            @foreach($assetStatus as $asset)
                                                            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Update</button>
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

    $('document').ready(function(){
        $('.edit-btn').click(function(){
            var assetId = $(this).data('asset-id');
            console.log(assetId);

            $.ajax({
                url: "{{ route('admin.employe-asset-edit') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    assetId : assetId,
                },
                success: function(response){
                    var empAsset = response.emp_asset;

                    console.log(empAsset.asset);

                    $('#assetid').val(empAsset.id);
                    $('#employe').val(empAsset.status);
                    
                    $('#editasset').modal('show');
                },
                error: function(error){
                    console.log(error);
                }
            });

        });
    });

</script>

@endsection