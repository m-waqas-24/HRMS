@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!-- PAGE HEADER -->
        <div class="page-header d-lg-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Create Employee</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class=" btn-list">
                    {{-- <button  class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
                    <button  class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
                    <button  class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button> --}}
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $index => $error)
                @if($index == 0)
                <button  class="btn-close" style="color: #FFF !important" data-bs-dismiss="alert" aria-hidden="true">×</button>
                @endif
                    {{ $error }} <br>
                @endforeach
        </div>
    @endif

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <!-- div -->
                <div class="card" id="tabs-style4">
                    <div class="card-header border-bottom-0">
                        <div class="card-title">
                            Employee Details
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="border border-end-0 br-ts-7 br-bs-7">
                                <div class="panel panel-primary tabs-style-4">
                                    <div class="tab-menu-heading border-0">
                                        <div class="tabs-menu">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs">
                                                <li class="mb-4"><a href="#tab21" class="active" data-bs-toggle="tab"><i class="ri-group-line me-2"></i> Personal Details</a></li>
                                                <li class="mb-4"><a href="#tab22" data-bs-toggle="tab"><i class="fa fa-cogs me-2"></i> Company Details</a></li>
                                                <li class="mb-4"><a href="#tab23" data-bs-toggle="tab"><i class="fa fa-cube me-2"></i> Bank Details</a></li>
                                                <li class="mb-4"><a href="#tab24" data-bs-toggle="tab"><i class="fa fa-tasks me-2"></i> Documents</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabs-style-4">
                                <div class="panel-body tabs-menu-body br-te-7 br-bs-0 mt-2">
                                    <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab21">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="">
                                                            {{-- <div class="row">
                                                                <div class="col-md-3 mx-auto">
                                                                    <div class="form-label mb-2 mt-0 text-center">Profile Image</div>
                                                                    <input type="file" name="img" class="dropify" data-height="140" />
                                                                </div>
                                                            </div> --}}
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-label mb-2 mt-0 text-center">Profile Image</div>
                                                                <input type="file" name="img" class="dropify" data-height="240" />
                                                            </div>
                                                                    <div class="col-md-9 ">
                                                                        <div class="row">
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Employee Name</label>
                                                                                <input type="text" name="name" class="form-control mb-md-0 mb-5 required-field"  placeholder="Enter Full Name">
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Email</label>
                                                                                <input name="email" type="text" class="form-control required-field"  placeholder="Employee email">
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Phone</label>
                                                                                <input type="number" name="number" class="form-control required-field"  placeholder="Phone Number">
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">CNIC</label>
                                                                                <input type="text" name="cnic" class="form-control required-field"  placeholder="Enter CNIC">
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Date Of Birth</label>
                                                                                <input type="date" name="d_o_b" class="form-control required-field"  placeholder="DD-MM-YYY">
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Gender</label>
                                                                                <select name="gender" class="form-control form-select required-field" data-placeholder="Select">
                                                                                    <option value="">Select Gender</option>
                                                                                    <option value="1">Male</option>
                                                                                    <option value="2">Female</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 ">
                                                                                <label class="form-label mb-0 mt-2">Address</label>
                                                                                <textarea rows="1" name="address1" class="form-control required-field" placeholder="Address1"></textarea>
                                                                            </div>
                                                                            <div class="col-md-4 mb-4">
                                                                                <label class="form-label mb-0 mt-2">Marital Status</label>
                                                                                <select name="marital" class="form-control form-select required-field" data-placeholder="Select">
                                                                                    <option value="">Select Status</option>
                                                                                    <option value="1">Single</option>
                                                                                    <option value="2">Married</option>
                                                                                    <option value="3">Divorced</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-4">
                                                                                <label class="form-label mb-0 mt-2">Blood Group</label>
                                                                                <select name="blood"  class="form-control form-select" data-placeholder="Select Group">
                                                                                    <option value="">Select Group</option>
                                                                                    <option value="A+">A+</option>
                                                                                    <option value="B+">B+</option>
                                                                                    <option value="O+">O+</option>
                                                                                    <option value="AB+">AB+</option>
                                                                                    <option value="A-">A-</option>
                                                                                    <option value="B-">B-</option>
                                                                                    <option value="O-">O-</option>
                                                                                    <option value="AB-">AB-</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4 mb-4">
                                                                                <label class="form-label mb-0 mt-2">Emergency Contact</label>
                                                                                <input type="number" name="eme_no_1" class="form-control required-field"  placeholder="Contact Number">
                                                                            </div>
                                                                            <div class="col-md-4 mb-4">
                                                                                <label class="form-label mb-0 mt-2">Relationship to Employee</label>
                                                                                <input type="text" name="father_name" class="form-control required-field"  placeholder="e,g Father, Brother or Mother">
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                            
                                                                                                                                
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab22">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Company</label>
                                                                    <select name="company" id="" class="form-control custom-select required-field">
                                                                        <option value="">Select Company</option>
                                                                        @foreach($companies as $company)
                                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Branch</label>
                                                                    <select name="branch" id="" class="form-control custom-select required-field">
                                                                        <option value="">Select Branch</option>
                                                                        @foreach($branches as $branch)
                                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Designation</label>
                                                                    <select name="designation" id="" class="form-control custom-select required-field">
                                                                        <option value="">Select Designation</option>
                                                                        @foreach($designations as $designa)
                                                                        <option value="{{ $designa->id }}">{{ $designa->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Attendance Time Slots</label>
                                                                    <select name="timeslot" class="form-control custom-select required-field">
                                                                        <option value="">Select Time Slot</option>
                                                                        @foreach($timeSlots as $timeSlot)
                                                                        <option value="{{ $timeSlot->id }}">{{ $timeSlot->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Date Of Joining</label>
                                                                    <input type="date" name="d_o_join" class="form-control required-field"  placeholder="DD-MM-YYYY">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Contract Type</label>
                                                                    <select name="contract" class="form-control custom-select required-field" data-placeholder="Select Type">
                                                                        <option value="">Select Type</option>
                                                                        @foreach($contracts as $contra)
                                                                        <option value="{{ $contra->id }}">{{ $contra->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                {{-- <div class="col-md-4">
                                                                    <label class="form-label mb-0 mt-2">Salary</label>
                                                                    <input name="salary" type="number" class="form-control"  placeholder="Enter salary">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Status:</label>
                                                                    <label class="custom-switch">
                                                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                        <span class="custom-switch-indicator"></span>
                                                                        <span class="custom-switch-description">Active/Inactive</span>
                                                                    </label>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab23">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Account Holder</label>
                                                                        <input name="acc_name" type="text" class="form-control"  placeholder="Account Holder Name">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Account Number</label>
                                                                        <input  name="acc_no"  type="text" class="form-control"  placeholder="Number">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Bank Name</label>
                                                                        <input  name="bank_name"  type="text" class="form-control"  placeholder="Name">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Branch Location</label>
                                                                        <input name="bank_location" type="text" class="form-control"  placeholder="Location">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Bank Code (IFSC)
                                                                            <span class="form-help" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Identify Number in your Country">?</span>
                                                                            <input name="bank_code" type="text" class="form-control"  placeholder="Code">
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label mb-0 mt-2">Tax Payer ID (PAN)
                                                                            <span class="form-help" data-bs-toggle="tooltip" data-bs-placement="top" title="Taxpayer Identification Number Used in your Country">?</span>
                                                                            <input name type="text" class="form-control"  placeholder="ID No">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="tab-pane" id="tab24">
                                               <div class="row">
                                                    <div class="col-12">
                                                        <div class="">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0">Resume:</div>
                                                                        <input type="file" name="resume" class="dropify" data-height="180" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0">CNIC:</div>
                                                                        <input type="file" name="cnic" class="dropify" data-height="180" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0 ">Offer Letter:</div>
                                                                        <input type="file" name="offer_letter" class="dropify" data-height="180" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0">Joining Letter:</div>
                                                                        <input type="file" name="joining_letter" class="dropify" data-height="180" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0">Agreement Letter:</div>
                                                                        <input type="file" name="agreement_letter" class="dropify" data-height="180" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-label mb-2 mt-0">Experience Letter:</div>
                                                                        <input type="file" name="experience_letter" class="dropify" data-height="180" />
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                               </div>
                                               <button class="btn btn-outline-primary mt-4 float-end" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /div -->
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->


@endsection