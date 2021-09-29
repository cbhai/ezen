<nav class="relative z-10 flex flex-wrap items-center justify-between px-6 py-4 bg-white shadow-xl md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden md:w-64">
    <div class="flex flex-wrap items-center justify-between w-full px-0 mx-auto md:flex-col md:items-stretch md:min-h-full md:flex-nowrap">
        <button class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-blueGray-700 whitespace-nowrap" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="absolute top-0 left-0 right-0 z-40 items-center flex-1 hidden h-auto overflow-x-hidden overflow-y-auto rounded shadow md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none" id="example-collapse-sidebar">
            <div class="block pb-4 mb-4 border-b border-solid md:min-w-full md:hidden border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-blueGray-700 whitespace-nowrap" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="flex justify-end w-6/12">
                        <button type="button" class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <form class="mt-6 mb-4 md:hidden">
                <div class="pt-0 mb-3">
                    @livewire('global-search')
                </div>
            </form>

            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("panel/permissions*")||request()->is("panel/roles*")||request()->is("panel/users*")||request()->is("panel/audit-logs*")||request()->is("panel/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="hidden ml-4 subnav">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.audit-logs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                        </i>
                                        {{ trans('cruds.auditLog.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.user-alerts.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-bell">
                                        </i>
                                        {{ trans('cruds.userAlert.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('master_room_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/master-rooms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.master-rooms.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.masterRoom.title') }}
                        </a>
                    </li>
                @endcan
                @can('master_workitem_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/master-workitems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.master-workitems.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.masterWorkitem.title') }}
                        </a>
                    </li>
                @endcan
                @can('my_business_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("panel/business-profiles*")||request()->is("panel/brandings*")||request()->is("panel/terms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-desktop">
                            </i>
                            {{ trans('cruds.myBusiness.title') }}
                        </a>
                        <ul class="hidden ml-4 subnav">
                            @can('business_profile_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/business-profiles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.business-profiles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.businessProfile.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('branding_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/brandings*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.brandings.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-bullhorn">
                                        </i>
                                        {{ trans('cruds.branding.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('term_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("panel/terms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.terms.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon far fa-calendar-check">
                                        </i>
                                        {{ trans('cruds.term.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('customer_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/customers*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.customers.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                            </i>
                            {{ trans('cruds.customer.title') }}
                        </a>
                    </li>
                @endcan
                @can('estimate_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/estimates*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.estimates.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-rupee-sign">
                            </i>
                            {{ trans('cruds.estimate.title') }}
                        </a>
                    </li>
                @endcan
                @can('room_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/rooms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.rooms.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-home">
                            </i>
                            {{ trans('cruds.room.title') }}
                        </a>
                    </li>
                @endcan
                @can('workitem_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/workitems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.workitems.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-list-ul">
                            </i>
                            {{ trans('cruds.workitem.title') }}
                        </a>
                    </li>
                @endcan
                @can('user_access')
                @can('estimate_detail_access')
                    <li class="items-center">
                        <a class="{{ request()->is("panel/estimate-details*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.estimate-details.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.estimateDetail.title') }}
                        </a>
                    </li>
                @endcan
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
