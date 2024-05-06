@extends('superadmin.layouts.app')
@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Pricing</div>
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    <a  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addplanmodal" class="btn btn-primary me-3"><i class="feather feather-plus"></i> Add Plan</a>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">

            @foreach($plans as $plan)
            <div class="col-md-4 mt-2">
                <div class="panel price  panel-color">
                    <div class=" bg-white text-center price-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#6FD943" fill-opacity="1" d="M0,96L48,133.3C96,171,192,245,288,266.7C384,288,480,256,576,240C672,224,768,224,864,192C960,160,1056,96,1152,106.7C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                        </svg>
                        <div class="price-title">{{ $plan->name }}</div>
                    </div>
                    <div class="panel-body text-center pt-0">
                        <p class=" fs-24 font-weight-semibold"><strong>Rs.{{ $plan->price }} / </strong>{{ $plan->duration }} </p>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                        {{-- <li class="list-group-item"><strong> 1 </strong> Databases</li> --}}
                        <li class="list-group-item"><strong> 24/7</strong> support</li>
                        @if($plan->hrm)
                        <li class="list-group-item"><strong> Enable HRM </strong> </li>
                        @endif
                        @if($plan->accounts)
                        <li class="list-group-item"><strong> Enable Accounts </strong> </li>
                        @endif
                    </ul>
                    <div class="panel-footer text-center border-end-0 border-start-0">
                        <a class="btn btn-lg btn-primary edit-plan"  data-plan-id="{{ $plan->id }}" href="javascript:void(0);"><i class="feather feather-edit"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

<!-- ADD Plan MODAL -->
<div class="modal fade"  id="addplanmodal">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('superadmin.store-plan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Plan Name</label>
                                <input required class="form-control" type="text" name="name" placeholder="Enter Plan Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input required  class="form-control" type="number" name="price" placeholder="Enter Plan Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Duration</label>
                                <select name="duration" class="form-control form-select" id="">
                                    <option value="">Select Duration</option>
                                    <option value="Lifetime">Lifetime</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" id=""  cols="30" rows="1" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="hrm" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description me-2 text-dark">Enable HRM</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="accounts" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description me-2 text-dark">Enable Accounts</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END ADD Plan MODAL -->

<!-- ADD Plan MODAL -->
<div class="modal fade"  id="editplanmodal">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="editplanForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Plan Name</label>
                                <input required class="form-control" type="text" name="name" placeholder="Enter Plan Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input required  class="form-control" type="number" name="price" placeholder="Enter Plan Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Duration</label>
                                <select name="duration" class="form-control form-select" id="">
                                    <option value="">Select Duration</option>
                                    <option value="Lifetime">Lifetime</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" id=""  cols="30" rows="1" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="hrm" class="custom-switch-input hrm">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description me-2 text-dark">Enable HRM</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="accounts" class="custom-switch-input accounts">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description me-2 text-dark">Enable Accounts</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END ADD Plan MODAL -->


@endsection

@section('scripts')

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.edit-plan').click(function(){
            var planId = $(this).data('plan-id');
            console.log(planId)

            $.ajax({
                url: "{{ route('superadmin.edit.plan') }}",
                method: 'POST',
                data: {
                    planId: planId,
                },
                success: function(response){
                    var plan = response.plan;
                    
                    var planPriceWithoutCommas = plan.price.replace(/,/g, '');

                    var editUserFormAction = "{{ route('superadmin.update.plan') }}/" + plan.id;
                    $('#editplanForm').attr('action', editUserFormAction);

                    $('#editplanmodal input[name="name"]').val(plan.name); 
                    $('#editplanmodal input[name="price"]').val(planPriceWithoutCommas); 
                    $('#editplanmodal select[name="duration"]').val(plan.duration);
                    $('#editplanmodal textarea[name="description"]').val(plan.description);

                    if (plan.hrm == 1) {
                        $('.hrm').prop('checked', true);
                    }else{
                        $('.hrm').prop('checked', false);
                    }
                    
                    if (plan.accounts == 1) {
                        $('.accounts').prop('checked', true);
                    }else{
                        $('.accounts').prop('checked', false);
                    }

                    $('#editplanmodal').modal('show');
                },
                error: function(error){
                    console.error(error);
                }
            })

        })

    });
</script>
    
@endsection