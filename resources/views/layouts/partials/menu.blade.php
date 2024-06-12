<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                @include('layouts.partials.logo')
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Wams</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <li
            class="menu-item {{
                request()->is('master-data/customers*') ||
                request()->is('master-data/principals') ||
                request()->is('master-data/personel-teams')
                ? 'open'
                : ''
            }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-database"></i>
                <div data-i18n="Master Data">Master Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('master-data/customers*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}" class="menu-link">
                        <div data-i18n="Customers">Customers</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Principal">Principal</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('master-data/personel-teams*') ? 'active' : '' }} ">
                    <a href="{{ route('personel-teams.index') }}" class="menu-link">
                        <div data-i18n="Personal Teams">Personal Teams</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps &amp; Pages</span>
        </li>
        <li class="menu-item {{
            request()->is('opty*') ||
            request()->is('project*')
            ? 'open'
            : ''
        }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-files"></i>
                <div data-i18n="ACDC">ACDC</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Project">Project</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('opty*') ? 'active' : '' }}">
                    <a href="/opty" class="menu-link">
                        <div data-i18n="Opty">Opty</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div data-i18n="Reimbursement">Reimbursement</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('reimbursement/personal-teams*') ? 'active' : '' }} ">
                    <a href="" class="menu-link">
                        <div data-i18n="Reimbursement">Reimbursement</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-access-roles.html" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-access-permission.html" class="menu-link">
                        <div data-i18n="Permission">Permission</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-user-list.html" class="menu-link">
                        <div data-i18n="Manage Users">Manage Users</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
