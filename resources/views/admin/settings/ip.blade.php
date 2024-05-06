@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER -->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">All IP's</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                        @can('create ip-restriction')
                        <a  href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addip"><i class="feather feather-plus"></i>  Create IP</a>
                        @endcan
                        
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-4 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">

                            @include('admin.settings.setting-links')

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-md-12 col-lg-12">  
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title me-4">IP Restrict <span id="switch">@if(IpRestrict() == 1) ON @else OFF @endif</span></h4>
                        <label class="custom-switch">
                            <input type="checkbox" @if(IpRestrict() == 1) checked @endif  name="custom-switch-checkbox2" class="custom-switch-input" id="ipRestrictSwitch">
                            <span class="custom-switch-indicator custom-switch-indicator-lg custom-square"></span>
                        </label>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 text-uppercase">IP</th>
                                        @if(Gate::check('edit ip-restriction') )
                                        <th class="border-bottom-0 text-uppercase">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>    
                                <tbody>
                                    @foreach($ips as $ip)
                                    <tr>
                                        <td>{{ $ip->ip }}</td>
                                        @if(Gate::check('edit ip-restriction') )
                                        <td>
                                            @can('edit ip-restriction')
                                            <a href="{{ route('admin.edit.ip', $ip->id) }}" class="btn btn-primary btn-icon btn-sm">
                                                <i class="feather feather-edit" ></i>
                                            </a>
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

                    @can('create ip-restriction')
		            <!-- ADD companies options MODAL -->
					<div class="modal fade"  id="addip">
						<div class="modal-dialog" role="document">
							<form action="{{ route('admin.store.ip') }}" method="POST">
								@csrf
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Create IP </h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="form-label">IP</label>
										<input type="text" name="ip" class="form-control required-field" placeholder="Static IP address! e.g: 111.111.11.111" >
									</div>
								</div>
								<div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						</div>
					</div>
					<!-- END ADD Allowance type MODAL -->
                    @endcan


@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var switchSpan = $("#switch");
        var ipRestrictSwitch = $("#ipRestrictSwitch");

        ipRestrictSwitch.on("change", function() {

            
 // Create a modal overlay element
 var overlay = $('<div id="overlay"></div>');
    overlay.css({
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'width': '100%',
        'height': '100%',
        'background': 'rgba(0, 0, 0, 0.5)', // Semi-transparent black background
        'z-index': '9999' // Ensure the overlay appears on top of other elements
    });

    // Append the overlay to the body
    $('body').append(overlay);

    // Add a text element to the overlay
    overlay.html('<p>Loading...</p>');

    // Optionally, you can customize the appearance of the text
    overlay.find('p').css({
        'position': 'absolute',
        'top': '50%',
        'left': '50%',
        'transform': 'translate(-50%, -50%)',
        'color': 'white',
        'font-size': '24px'
    });

            var isChecked = $(this).prop("checked");
            switchSpan.text(isChecked ? "ON" : "OFF");

            var ipRestrictValue = isChecked ? 1 : 0;

            $.ajax({
                url: "{{route('admin.update.ip-restrict')}}",
                method: 'POST',
                data: {
                    ipRestrictValue: ipRestrictValue,
                },
                success: function(response){
                    if(response.success){
                        $('#overlay').remove();
                    }
                },
                error: function(error){
                    console.log(error)
                },
            });
        });
    });
</script>

                 
    
@endsection
