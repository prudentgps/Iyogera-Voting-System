<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-light">

        <div class="slimscroll-menu">

            <!-- LOGO -->
            <a href="index.html" class="logo text-center">
                <span class="logo-lg">
                <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="16">
                </span>
                <span class="logo-sm">
                <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="16">
                </span>
            </a>
            <!--- Sidemenu -->
            <ul class="metismenu side-nav side-nav-light">
                <li class="side-nav-title side-nav-item">Navigation</li>
                <li class="side-nav-item">
                    <a href="{{ route('dashboard') }}" class="side-nav-link">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @foreach (\App\Menu::where('parent', 0)->where('status', 1)->get() as $menu)
                <li class="side-nav-item">
                    <a href="javascript: void(0);" class="side-nav-link">
                        <i class="{{ $menu->icon }}"></i>
                        <span> {{ ucfirst(str_replace('_', ' ', $menu->displayed_name)) }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        @foreach (\App\Menu::where('parent', $menu->id)->where('status', 1)->orderBy('sort_order', 'ASC')->get() as $sub_menu)

                        @if (count(\App\Menu::where('parent', $sub_menu->id)->where('status', 1)->get()) > 0 )
                            <li class="side-nav-item">
                                <a href="javascript: void(0);" aria-expanded="false">{{ ucfirst(str_replace('_', ' ', $sub_menu->displayed_name)) }}
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="side-nav-third-level" aria-expanded="false">
                                    @foreach (\App\Menu::where('parent', $sub_menu->id)->where('status', 1)->orderBy('sort_order', 'ASC')->get() as $sub_sub_menu)
                                        <li>
                                            <a href="{{ $sub_sub_menu->route_name == '' ? route('dashboard') : route($sub_sub_menu->route_name)  }}">{{ ucfirst(str_replace('_', ' ', $sub_sub_menu->displayed_name)) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ $sub_menu->route_name == '' ? route('dashboard') : route($sub_menu->route_name)  }}">{{ ucfirst(str_replace('_', ' ', $sub_menu->displayed_name)) }}</a>
                            </li>
                        @endif

                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->
