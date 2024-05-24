<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('website.home') }}">
                    <i class="ri-honour-line"></i> <span data-key="t-widgets">Website</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.page.index') }}">
                    <i class="ri-pages-line"></i> <span data-key="t-pages">Trang nội dung</span>
                </a>
            </li>
            {{-- layout website --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Giao diện</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarLayouts">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.menu.index') }}" class="nav-link" data-key="t-calendar">Menu
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- News --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarAuth">
                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Tin tức</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarAuth">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.category_new.index') }}" class="nav-link">Chủ đề </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.news.index') }}" class="nav-link">Bài viết
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Products --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarForms">
                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Sản phẩm</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarForms">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.category_product.index') }}" class="nav-link">Chủ đề </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link">Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order.index') }}" class="nav-link">Đơn hàng
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarContact" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarContact">
                    <i class="ri-pages-line"></i> <span data-key="t-dashboards">Liên hệ</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarContact">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.index') }}" class="nav-link" data-key="t-calendar">Yêu cầu
                                liên hệ
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.subscribe.index') }}" class="nav-link" data-key="t-calendar">Đăng
                                ký
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            {{-- Slider --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.slider.index') }}">
                    <i class="ri-pages-line"></i> <span data-key="t-pages">Slider</span>
                </a>
            </li>
            {{-- Ads --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.ads.index') }}">
                    <i class="ri-pages-line"></i> <span data-key="t-pages">Ads</span>
                </a>
            </li>
            {{-- Contact --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.chart.index') }}">
                    <i class="ri-pages-line"></i> <span data-key="t-pages">Biểu đồ</span>
                </a>
            </li>
            {{-- system --}}
            @if (Auth::user()->level == 1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Hệ thống</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.system.index') }}" class="nav-link"
                                    data-key="t-calendar">Quản
                                    lý hệ thống
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="{{ route('admin.hotline.index') }}" class="nav-link" data-key="t-calendar">SĐT/Zalo
                            </a>
                        </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link"
                                    data-key="t-calendar">Quản
                                    trị viên
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.brand.index') }}">
                    <i class="ri-honour-line"></i> <span data-key="t-widgets">Đối tác</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('admin.ads.index') }}">
                    <i class="ri-honour-line"></i> <span data-key="t-widgets">Quảng cáo</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('logout') }}">
                    <i class="ri-honour-line"></i> <span data-key="t-widgets">Logout</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- Sidebar -->
</div>
