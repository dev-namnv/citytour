<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item ">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">Pages</span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="{{route('account')}}" class="menu-link menu-toggle">
                            <span class="menu-text">Users</span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="menu-text">Contact</span>
                        </a>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">

            <!--begin::Search-->
            <div class="dropdown" id="kt_quick_search_toggle">
                <!--begin::Toggle-->
                <div class="topbar-item dropdown-toggle-split" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                            <i class="fas fa-bell text-danger"></i>
                            <sub class="total-notification" style="color: red; font-size: 20px">0</sub>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                        <!--begin::Scroll-->
                        <div class="scroll notification" data-scroll="true" data-height="325"
                             data-mobile-height="200"></div>
                        <!--end::Scroll-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>

            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                     id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{Auth::user()->username}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                    </span>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
