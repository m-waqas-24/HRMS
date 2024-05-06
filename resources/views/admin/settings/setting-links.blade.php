<div class="list-group ">
    {{-- @can('manage company-settings')
    <a  href="{{ route('admin.company-setting.index') }}" class="list-group-item {{ request()->routeIs('admin.company-setting.index') ? 'active' : '' }}"><i class="fe fe-cpu me-2 text-warning"></i> Company Setting <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan

    @can('manage system-settings')
    <a  href="{{ route('admin.system-setting.index') }}" class="list-group-item {{ request()->routeIs('admin.system-setting.index') ? 'active' : '' }}"><i class="fa fa-first-order me-2 text-warning"></i> System Setting <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan --}}

    @can('manage attendance-timeslots')
    <a  href="{{ route('admin.index.time-slots') }}" class="list-group-item {{ request()->routeIs('admin.index.time-slots') ? 'active' : '' }}"><i class="fa fa-first-order me-2 text-warning"></i> Attendance Time Slots <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan

    @can('manage ip-restriction')
    <a  href="{{ route('admin.index.ip') }}" class="list-group-item {{ request()->routeIs('admin.index.ip') ? 'active' : '' }}"><i class="fa fa-first-order me-2 text-warning"></i> IP Restriction <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan

    {{-- @can('manage companies')
    <a  href="{{ route('admin.companies.index') }}" class="list-group-item {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}"><i class="fa fa-server me-2 text-warning"></i> Companies <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan

    @can('manage branches')
    <a  href="{{ route('admin.branches.index') }}" class="list-group-item {{ request()->routeIs('admin.branches.index') ? 'active' : '' }}"><i class="fa fa-cubes me-2 text-dark"></i> Branches <i class="fa fa-chevron-right float-end mt-1"></i> </a>
     @endcan --}}

    @can('manage departments')
    <a  href="{{ route('admin.departments.index') }}" class="list-group-item {{ request()->routeIs('admin.departments.index') ? 'active' : '' }}"><i class="fa fa-tasks me-2 text-secondary"></i> Departments <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage designations')
    <a  href="{{ route('admin.designations.index') }}" class="list-group-item {{ request()->routeIs('admin.designations.index') ? 'active' : '' }}"><i class="fa fa-object-group text-warning me-2"></i> Designations <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage leave-types')
    <a  href="{{ route('admin.leavestatus.index') }}" class="list-group-item {{ request()->routeIs('admin.leavestatus.index') ? 'active' : '' }}"><i class="fa fa-wpforms text-danger me-2"></i> Leave Types <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

     @can('manage training-type')
    <a href="{{ route('admin.trainingtypes.index') }}" class="list-group-item {{ request()->routeIs('admin.trainingtypes.index') ? 'active' : '' }}"><i class="fa fa-bookmark text-danger me-2"></i> Training Types <i class="fa fa-chevron-right float-end mt-1"></i></a>
    @endcan

    @can('manage assets ')
    <a  href="{{ route('admin.assets.index') }}" class="list-group-item {{ request()->routeIs('admin.assets.index') ? 'active' : '' }}"><i class="fa fa-bookmark text-danger me-2"></i> Assets <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage contract-types')
    <a  href="{{ route('admin.contracts.index') }}" class="list-group-item {{ request()->routeIs('admin.contracts.index') ? 'active' : '' }}"><i class="fa fa-handshake-o text-danger me-2"></i> Contract Types <i class="fa fa-chevron-right float-end mt-1"></i></a>
    @endcan

    @can('manage gifts')
    <a  href="{{ route('admin.gifts.index') }}" class="list-group-item {{ request()->routeIs('admin.gifts.index') ? 'active' : '' }}"><i class="fa fa-gift text-secondary me-2"></i> Gifts <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage award-type')
    <a  href="{{ route('admin.awardtypes.index') }}" class="list-group-item {{ request()->routeIs('admin.awardtypes.index') ? 'active' : '' }}"><i class="fa fa-graduation-cap text-success me-2"></i> Award Type <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage payslip-options')
    <a  href="{{ route('admin.paysliptypes.index') }}" class="list-group-item {{ request()->routeIs('admin.paysliptypes.index') ? 'active' : '' }}"><i class="fa fa-money me-2"></i> Payslip Options <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage allowance-options')
    <a  href="{{ route('admin.allowancetypes.index') }}" class="list-group-item {{ request()->routeIs('admin.allowancetypes.index') ? 'active' : '' }}"><i class="fa fa-id-card text-danger me-2"></i> Allowance Options <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage loan-options')
    <a  href="{{ route('admin.loantypes.index') }}" class="list-group-item {{ request()->routeIs('admin.loantypes.index') ? 'active' : '' }}"><i class="fa fa-fax text-primary me-2"></i> Loan Options <i class="fa fa-chevron-right float-end mt-1"></i></a>
     @endcan

    @can('manage deduction-options')
    <a  href="{{ route('admin.deductiontypes.index') }}" class="list-group-item {{ request()->routeIs('admin.deductiontypes.index') ? 'active' : '' }}"><i class="fa fa-arrow-circle-o-down text-warning me-2"></i> Deduction Options <i class="fa fa-chevron-right float-end mt-1"></i></a>
    @endcan
</div>

