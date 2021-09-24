<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <form class="mt-6 mb-4 md:hidden">
                <div class="mb-3 pt-0">
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

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/permissions*")||request()->is("admin/roles*")||request()->is("admin/users*")||request()->is("admin/audit-logs*")||request()->is("admin/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/audit-logs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.audit-logs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file-alt">
                                        </i>
                                        {{ trans('cruds.auditLog.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/user-alerts*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.user-alerts.index") }}">
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
                        <a class="{{ request()->is("admin/master-rooms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.master-rooms.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.masterRoom.title') }}
                        </a>
                    </li>
                @endcan
                @can('master_workitem_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/master-workitems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.master-workitems.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.masterWorkitem.title') }}
                        </a>
                    </li>
                @endcan
                @can('my_business_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/business-profiles*")||request()->is("admin/brandings*")||request()->is("admin/terms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-desktop">
                            </i>
                            {{ trans('cruds.myBusiness.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('business_profile_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/business-profiles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.business-profiles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.businessProfile.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('branding_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/brandings*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.brandings.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-bullhorn">
                                        </i>
                                        {{ trans('cruds.branding.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('term_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/terms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.terms.index") }}">
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
                        <a class="{{ request()->is("admin/customers*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.customers.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-users">
                            </i>
                            {{ trans('cruds.customer.title') }}
                        </a>
                    </li>
                @endcan
                @can('estimate_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/estimates*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.estimates.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-rupee-sign">
                            </i>
                            {{ trans('cruds.estimate.title') }}
                        </a>
                    </li>
                @endcan
                @can('room_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/rooms*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.rooms.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-home">
                            </i>
                            {{ trans('cruds.room.title') }}
                        </a>
                    </li>
                @endcan
                @can('workitem_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/workitems*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.workitems.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-list-ul">
                            </i>
                            {{ trans('cruds.workitem.title') }}
                        </a>
                    </li>
                @endcan
                @can('estimate_detail_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/estimate-details*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.estimate-details.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.estimateDetail.title') }}
                        </a>
                    </li>
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