<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span>Main</span>
                </li>

                <!-- Dashboard -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            {{__('sidebar.dashboard')}}
                        </span>
                    </a>
                </li>
                    <!-- /Dashboard -->

                <!-- CMS -->
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="file-text"></i>
                        <span class="hide-menu">{{__('sidebar.cms')}} </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        @can('cmscategory-list')
                            <li>
                                <a href="{{ route('cmscategories.index') }}" title="{{__('sidebar.category')}}" class="sidebar-link {{ (request()->is('admin/cmscategories*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.category')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('cms-list')
                            <li>
                                <a href="{{ route('cmspages.index') }}" title="{{__('sidebar.cms-pages')}}" class="sidebar-link {{ (request()->is('admin/cmspage*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.cms-pages')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <!-- /CMS -->

                <!-- Users -->
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="users"></i>
                        <span class="hide-menu">{{__('sidebar.user')}} </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        @can('user-list')
                            <li>
                                <a href="{{ route('users.index') }}" title="{{__('sidebar.user')}}" class="sidebar-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.user')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('role-list')
                            <li>
                                <a href="{{ route('roles.index') }}" title="{{__('sidebar.roles')}}" class="sidebar-link {{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.roles')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('permission-list')
                            <li>
                                <a href="{{ route('permissions.index') }}" title="{{__('sidebar.permissions')}}" class="sidebar-link {{ (request()->is('admin/permissions*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.permission')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('user-activity')
                            <li>
                                <a href="/admin/user-activity" title="{{__('sidebar.user-activity')}}" class="sidebar-link {{ (request()->is('admin/setting/useractivity*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.user-activity')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <!-- /Users -->

                <!-- Settings -->
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="settings"></i>
                        <span class="hide-menu">{{__('sidebar.settings')}} </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        @can('currency-list')
                            <li>
                                <a href="{{ route('currencies.index') }}" title="{{__('sidebar.currencies')}}" class="sidebar-link {{ (request()->is('admin/currencies*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.currency')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('websetting-edit')
                            <li>
                                <a href="{{route('website-setting.edit')}}" title="{{__('sidebar.website-setting')}}" class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.website-setting')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('file-manager')
                            <li>
                                <a href="{{route('filemanager.index')}}" title="{{__('sidebar.file-manager')}}" class="sidebar-link {{ (request()->is('admin/setting/file-manager*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.file-manager')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('log-view')
                            <li>
                                <a href="/admin/log-reader" title="{{__('sidebar.read-logs')}}" class="sidebar-link {{ (request()->is('admin/setting/log*')) ? 'active' : '' }}">
                                    <span class="hide-menu">{{__('sidebar.read-logs')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <!-- /Settings -->

            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
