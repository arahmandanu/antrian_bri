<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background-image: linear-gradient(to right, rgba(46,85,199,255), rgba(38,37,34,255));">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin_dashboard') }}">
        <div class="sidebar-brand-icon m-4 pt-3">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="{{ asset('images/logo_white.png') }}" class="img-fluid" alt="">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('developer'))
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Ekko::isActive('/admin/dashboard') }}">
            <a class=" nav-link" href="{{ route('admin_dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{ Ekko::isActive('/admin/queue_logs') }}">
            <a class="nav-link {{ Ekko::isActive('/admin/queue_logs', 'collapsed') }}" href="#"
                data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
                aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse {{ Ekko::isActive('/admin/queue_logs', 'show') }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('queue_logs.index') }}">Online Queue</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ Ekko::isActive(['/admin/over_sla', '/admin/reports', '/admin/branch/map']) }}">
            <a class="nav-link {{ Ekko::isActive(['/admin/over_sla', '/admin/reports', '/admin/branch/map'], 'collapsed') }}"
                href="#" data-toggle="collapse" data-target="#collapsereports" aria-expanded="true"
                aria-controls="collapsereports">
                <i class="fas fa-fw fa-bars"></i>
                <span>Laporan</span>
            </a>
            <div id="collapsereports"
                class="collapse {{ Ekko::isActive(['/admin/over_sla', '/admin/reports', '/admin/branch/map'], 'show') }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.over_sla') }}">Chart Over Sla</a>
                    <a class="collapse-item" href="{{ route('admin.reports') }}">Reports</a>
                    <a class="collapse-item" href="{{ route('admin.branchMap') }}">
                        Branch Map</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Ekko::isActive(['/admin/unit_codes', '/admin/user']) }}">
            <a class="nav-link {{ Ekko::isActive(['/admin/unit_codes', '/admin/user', '/admin/transaction_params'], 'collapsed') }}"
                href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Settings</span>
            </a>
            <div id="collapsePages"
                class="collapse {{ Ekko::isActive(['/admin/unit_codes', '/admin/user', '/admin/transaction_params'], 'show') }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">System:</h6>
                    <a class="collapse-item" href="{{ route('unit_codes.index') }}">Unit Codes</a>
                    <a class="collapse-item" href="{{ route('admin.transactionParams.index') }}">Type Transaction</a>
                    <a class="collapse-item" href="{{ route('user.index') }}">User</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Ekko::isActive(['/admin/bank_area', '/admin/bank_branches', '/admin/banks']) }}">
            <a class="nav-link {{ Ekko::isActive(['/admin/bank_area', '/admin/bank_branches', '/admin/banks'], 'collapsed') }}"
                href="#" data-toggle="collapse" data-target="#collapsePagesmaster" aria-expanded="true"
                aria-controls="collapsePagesmaster">
                <i class="fas fa-fw fa-folder"></i>
                <span>Data Master</span>
            </a>
            <div id="collapsePagesmaster"
                class="collapse {{ Ekko::isActive(['/admin/bank_area', '/admin/bank_branches', '/admin/banks'], 'show') }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.bank_area.index') }}">Area</a>
                    <a class="collapse-item" href="{{ route('admin.bank_branches.index') }}">Cabang Induk</a>
                    <a class="collapse-item" href="{{ route('banks.index') }}">KC/KCP/KK/Unit</a>
                </div>
            </div>
        </li>
    @endif

    @if (auth()->user()->hasRole('developer') || auth()->user()->hasRole('operator'))
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Ekko::isActive(['/admin/settings/button', '/admin/settings/button_actor']) }}">
            <a class="nav-link {{ Ekko::isActive(['/admin/settings/button', '/admin/settings/button_actor'], 'collapsed') }}"
                href="#" data-toggle="collapse" data-target="#collapsePagesButton" aria-expanded="true"
                aria-controls="collapsePagesButton">
                <i class="fas fa-fw fa-folder"></i>
                <span>Settings</span>
            </a>

            <div id="collapsePagesButton"
                class="collapse {{ Ekko::isActive(['/admin/settings/button', '/admin/settings/button_actor'], 'show') }}"
                aria-labelledby="headingPages" data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">System:</h6>
                    <a class="collapse-item" href="{{ route('operator.button.index') }}">Tombol</a>
                    <a class="collapse-item" href="{{ route('operator.button_actor.index') }}">Employee</a>
                </div>

            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center bottom-0 start-0">
        <div class="sidebar-brand-text mx-3">{{ auth()->user()->roleName() }} Antrian</div>
    </div>
</ul>
