<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="media user-profile mt-2 mb-2">
    <object
                data="{{Cookie::get('image')}}"
                type="image/jpg"
                class="avatar-sm rounded-circle mr-2"
              >
        <img src="/backend/assets/images/users/default.png" class="avatar-sm rounded-circle mr-2" alt="Shreyu"/>
        </object>
        <div class="media-body">
            <h6 class="pro-user-name mt-0 mb-0">{{Cookie::get('first_name')}} {{Cookie::get('last_name')}}</h6>
            <span class="pro-user-desc">@if ( \Cookie::get('user_role') == "store_admin")
                    STORE ADMIN
                    @elseif ( \Cookie::get('user_role') == "super_admin")
                    SUPER ADMIN
                    @elseif ( \Cookie::get('user_role') == "store_assistant")
                    STORE ASSISTANT
            @endif</span>
        </div>
        <div class="dropdown align-self-center profile-dropdown-menu">
            <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
               aria-expanded="false">
                <span data-feather="chevron-down"></span>
            </a>
            <div class="dropdown-menu profile-dropdown">
                <a href="{{ route('setting') }}" class="dropdown-item notify-item">
                    <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                    <span>My Account</span>
                </a>

                {{-- <a href="{{ route('settings') }}" class="dropdown-item notify-item">
                    <i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
                    <span>Settings</span>
                </a> --}}

                {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i data-feather="help-circle" class="icon-dual icon-xs mr-2"></i>
                    <span>Support</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i data-feather="lock" class="icon-dual icon-xs mr-2"></i>
                    <span>Lock Screen</span>
                </a> --}}

                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                    <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                    <span>Logout</span>
                </a>

            </div>
        </div>
    </div>
    <div class="sidebar-content">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="slimscroll-menu">
            <ul class="metismenu" id="menu-bar">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                {{-- @if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'store_admin') --}}
                    {{--super admin protected routes here--}}
                    @include('partials.menus_items.store_admin')
                {{-- @endif --}}

                {{-- @if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'super_admin') --}}
                    {{-- super admin protected routes here --}}
                    {{-- @include('partials.menus_items.super_admin') --}}
                {{-- @endif --}}

                {{-- @if(\Illuminate\Support\Facades\Cookie::get('user_role') == 'super_assistant') --}}
                    {{-- super admin protected routes here --}}
                    {{-- @include('partials.menus_items.store_assistant') --}}
                {{-- @endif --}}
                <li>
                <a href="{{ route('change_password') }}">
                     <i class="uil  uil-cog"></i>
                        <span> Change Password </span>
                 </a>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
