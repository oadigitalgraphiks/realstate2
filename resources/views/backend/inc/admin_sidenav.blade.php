<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}">
            @if (get_setting('system_logo_white') != null)
                <img class="h-35px logo" src="{{ uploaded_asset(get_setting('system_logo_white')) }}"
                    class="brand-icon" alt="{{ get_setting('site_name') }}">
            @else
                <img class="mw-100 h-35px logo" src="{{ static_asset('assets/img/logo.png') }}"
                    alt="{{ get_setting('site_name') }}">
            @endif
        </a>

        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="black" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    @php
        $admin = Auth::user()->user_type == 'admin';
        //    $newOrdersCount = \App\Order::where('viewed',0)->get()->count();
        $newOrdersCount = DB::table('orders')
            ->where('viewed', 0)
            ->where('payment_status', 'paid')
            ->select('orders.id')
            ->count();
    @endphp
    <!-- begin: menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">

                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                    </div>
                </div>

                @foreach (admin_menus() as $main_menu)
                    {{-- <div class="menu-item"> --}}
                    @if((Auth::user()->user_type == 'admin' || menu_permissions($main_menu->id)))
                    <div {{ $main_menu->route == null ? 'data-kt-menu-trigger="click"' : '' }}
                        class="menu-item {{ $main_menu->route == null ? 'menu-accordion' : '' }}">
                        <a class="menu-link {{ areActiveRoutes([$main_menu->route]) }}"
                            href="{{ $main_menu->route != null ? route($main_menu->route) : 'javascript:void(0)' }}">
                            <span class="menu-icon">
                                {!! html_entity_decode($main_menu->icon_class) !!}
                            </span>
                            <span class="menu-title">{{ translate($main_menu->name) }}</span>
                            @if ($main_menu->route == null)
                                <span class="menu-arrow"></span>
                            @endif
                        </a>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @foreach ($main_menu->childrens as $sub_menu)
                                @if(Auth::user()->user_type == 'admin' || menu_permissions($sub_menu->id))
                                        @if ($sub_menu->route == 'manage.menus')
                                            @if (addon_is_activated($sub_menu->addon_name))
                                                <div class="menu-item">
                                                    <a class="menu-link" href="{{route($sub_menu->route)}}?id=1">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ translate($sub_menu->name) }}</span>
                                                        @if ($sub_menu->route == null)
                                                            <span class="menu-arrow"></span>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        @elseif ($sub_menu->route == 'website.footer')
                                            <div class="menu-item">
                                                <a class="menu-link" href="{{ route($sub_menu->route, ['lang' => App::getLocale()]) }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ translate($sub_menu->name) }}</span>
                                                    @if ($sub_menu->route == null)
                                                        <span class="menu-arrow"></span>
                                                    @endif
                                                </a>
                                            </div>
                                        @else
                                            @if ($sub_menu->addon_name != null && addon_is_activated($sub_menu->addon_name))
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                        href="{{ $sub_menu->route != null ? route($sub_menu->route) : 'javascript:void(0)' }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ translate($sub_menu->name) }}</span>
                                                        @if ($sub_menu->route == null)
                                                            <span class="menu-arrow"></span>
                                                        @endif
                                                    </a>
                                                </div>
                                            @elseif($sub_menu->addon_name == null)
                                                @if ($sub_menu->childrens->count() == 0)
                                                    <div class="menu-item">
                                                        <a class="menu-link"
                                                            href="{{ $sub_menu->route != null ? route($sub_menu->route) : 'javascript:void(0)' }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">{{ translate($sub_menu->name) }}</span>
                                                            @if ($sub_menu->route == null)
                                                                <span class="menu-arrow"></span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @else
                                                {{-- TEST CODE TO DELETE --}}
                                                    <div class="menu-sub menu-sub-accordion menu-active-bg show" kt-hidden-height="156" style="">
                                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                            <span class="menu-link">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">{{ translate($sub_menu->name) }}</span>
                                                                <span class="menu-arrow"></span>
                                                            </span>
                                                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                                                @foreach ($sub_menu->childrens as $sub_child)
                                                                <div class="menu-item">
                                                                    <a class="menu-link" href="{{ route($sub_child->route) }}">
                                                                        <span class="menu-bullet">
                                                                            <span class="bullet bullet-dot"></span>
                                                                        </span>
                                                                        <span class="menu-title">{{ translate($sub_child->name) }}</span>
                                                                    </a>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- TEST CODE TO DELETE --}}
                                            @endif
                                        @endif
                                {{-- @endif --}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
