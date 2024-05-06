<div class="list-group ">
        <a  href="{{ route('admin.company-setting.index') }}" class="list-group-item {{ request()->routeIs('admin.company-setting.index') ? 'active' : '' }}"><i class="fe fe-cpu me-2 text-warning"></i> Company Setting <i class="fa fa-chevron-right float-end mt-1"></i> </a>
        <a  href="{{ route('admin.system-setting.index') }}" class="list-group-item {{ request()->routeIs('admin.system-setting.index') ? 'active' : '' }}"><i class="fa fa-first-order me-2 text-warning"></i> System Setting <i class="fa fa-chevron-right float-end mt-1"></i> </a>

        <a  href="{{ route('admin.companies.index') }}" class="list-group-item {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}"><i class="fa fa-server me-2 text-warning"></i> Companies <i class="fa fa-chevron-right float-end mt-1"></i> </a>

        <a  href="{{ route('admin.branches.index') }}" class="list-group-item {{ request()->routeIs('admin.branches.index') ? 'active' : '' }}"><i class="fa fa-cubes me-2 text-dark"></i> Branches <i class="fa fa-chevron-right float-end mt-1"></i> </a>
</div>

