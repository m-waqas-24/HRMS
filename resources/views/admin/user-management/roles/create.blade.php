@extends('admin.layouts.app')

@section('content')

<div class="app-content main-content">
    <div class="side-app main-container">
        
        <!--PAGE HEADER-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <div class="page-title">Roles</div>
                @include('admin.breadcrumbs')
            </div>
            <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                    <div class="btn-list">
                    </div>
                </div>
            </div>
        </div>
        <!--END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header  border-0">
                        <h4 class="card-title">Edit Role</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('admin.store.role') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label mb-0 mt-2">Role Name</label>
                                    <input type="text" name="name" class="form-control required-field" placeholder="Enter Name"  id="">
                                </div>

									<div class="card-body" style="padding: .8rem !important">
										<div class="panel panel-primary tabs-style-3">
											<div class="tab-menu-heading">
												<div class="tabs-menu ">
													<!-- Tabs -->
													<ul class="nav panel-tabs">
                                                        @if(getCompanyPlan()->hrm)
														    <li class=""><a href="#tab11" class="active" data-bs-toggle="tab"> HRM</a></li>
                                                        @endif
                                                        @if(getCompanyPlan()->accounts)
														    <li class=""><a href="#tab12" class=" @if(getCompanyPlan()->accounts && !getCompanyPlan()->hrm) active @endif  " data-bs-toggle="tab"> Accounts</a></li>
                                                        @endif
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body">
												<div class="tab-content">
                                                    @if(getCompanyPlan()->hrm)
													<div class="tab-pane active" id="tab11">
                                                                @php
                                                                    $modules = ['employee ', 'salary', 'allowance ', 'commission', 'loan ', 'deduction ', 'otherpayments', 'leaves', 'trainer', 'traininglist', 'training-type', 'hradminsetup', 'transfer', 'promotions',
                                                                     'awards', 'resignation', 'termination', 'complaints', 'holidays', 'recruitments', 'jobs', 'candidates', 'interviewschedule', 'employee-assets', 'notice-board', 'events', 
                                                                     'departments', 'designations', 'leave-types', 'assets ', 'contract-types', 'gifts', 'award-type', 'payslip-options', 'allowance-options', 'loan-options', 'deduction-options',
                                                                     'attendance-overview', 'attendance-timeslots', 'ip-restriction', 'user-management', 'role'];
                                                                     
                                                                @endphp
                                                        <table class="m-4 w-100">
                                                            <thead>
                                                                <tr class='bg-primary p-4'>
                                                                    <th>
                                                                        <input type="checkbox" name="" id="">
                                                                    </th>
                                                                    <th class="fw-bold text-uppercase">Module</th>
                                                                    <th class="fw-bold text-uppercase">Permissions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($modules as $index => $module)
                                                                <tr style="border-bottom: 1px solid #eee; {{ $index % 2 == 0 ? 'background: #eee;' : '' }}">
                                                                    <td>
                                                                        <input type="checkbox" value="{{ $module }}" class="module-checkbox">
                                                                    </td>
                                                                    <td class="fw-bold" style="font-weight: 700 !important">{{ ucfirst($module) }}</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            @foreach($permissions as $permission)
                                                                                @if(str_contains($permission->name, $module))
                                                                                    <div class="col-md-2">
                                                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $module.$permission->id }}" class="permission-checkbox" data-module="{{ $module }}" >
                                                                                        @php
                                                                                            $namePer = ucfirst(str_replace($module . ' ', '', $permission->name));
                                                                                            $permissionParts = explode(' ', $namePer);
                                                                                        @endphp
                                                                                        {{ $permissionParts[0] }}
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            
                                                            </tbody>
                                                        </table>
													</div>
                                                    @endif
                                                    @if(getCompanyPlan()->accounts)
                                                    <div class="tab-pane  @if(getCompanyPlan()->accounts && !getCompanyPlan()->hrm) active @endif  " id="tab12">
                                                        @php
                                                            $accmodules = ['categories', 'banks', 'bank-accounts', 'balance-transfers', 'debts-loans', 'borrow-more', 'repay', 'lend-more', 'debt-collection', 'incomes', 'expenses'];
                                                             
                                                        @endphp
                                                        <table class="m-4 w-100">
                                                            <thead>
                                                                <tr class='bg-primary p-4'>
                                                                    <th>
                                                                        <input type="checkbox" name="" id="">
                                                                    </th>
                                                                    <th class="fw-bold text-uppercase">Module</th>
                                                                    <th class="fw-bold text-uppercase">Permissions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($accmodules as $index => $module)
                                                                <tr style="border-bottom: 1px solid #eee; {{ $index % 2 == 0 ? 'background: #eee;' : '' }}">
                                                                    <td>
                                                                        <input type="checkbox" value="{{ $module }}" class="module-checkbox">
                                                                    </td>
                                                                    <td class="fw-bold" style="font-weight: 700 !important">{{ ucfirst($module) }}</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            @foreach($accpermissions as $permission)
                                                                                @if(str_contains($permission->name, $module))
                                                                                    <div class="col-md-2">
                                                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $module.$permission->id }}" class="permission-checkbox" data-module="{{ $module }}" >
                                                                                        @php
                                                                                            $namePer = ucfirst(str_replace($module . ' ', '', $permission->name));
                                                                                            $permissionParts = explode(' ', $namePer);
                                                                                        @endphp
                                                                                        {{ $permissionParts[0] }}
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
												</div>
											</div>
										</div>
									</div>
                                    
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4 ">Update</button>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

    </div>
</div><!-- end app-content-->

@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let moduleCheckboxes = document.querySelectorAll('.module-checkbox');
        let permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        moduleCheckboxes.forEach(function (moduleCheckbox) {
            moduleCheckbox.addEventListener('change', function () {
                let moduleName = this.value;
                let relatedPermissionCheckboxes = document.querySelectorAll('.permission-checkbox[data-module="' + moduleName + '"]');

                relatedPermissionCheckboxes.forEach(function (permissionCheckbox) {
                    permissionCheckbox.checked = moduleCheckbox.checked;
                });
            });
        });
    });
</script>

@endsection