<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="/assets/images/logo-icon.png" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Абитуриент</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            @foreach ($sidebarComposer as $sidebar)
                @if (!isset($sidebar['role']) || $sidebar['role'] == Auth::user()->role)
                    <li class="menu-label">{{ $sidebar['title'] }}</li>
                    @foreach ($sidebar['menu'] as $menu)
                        <li>
                            <a @class([$menu['modal'] ?? '', 'has-arrow' => isset($menu['submenu'])])
                                href="{{ isset($menu['link']) ? $menu['link'] : 'javascript:;' }}">
                                <div class="parent-icon">
                                    <i class="{{ $menu['icon'] }}"></i>
                                </div>
                                <div @class([
                                    'menu-title',
                                    'd-flex justify-content-between align-items-center w-100' => isset(
                                        $menu['cnt']),
                                ])>
                                    {{ $menu['title'] }}
                                    @if (isset($menu['cnt']))
                                        <span class="badge rounded-pill bg-grd-royal">{{ $menu['cnt'] }}</span>
                                    @endif
                                </div>
                            </a>
                            @if (isset($menu['submenu']))
                                <ul>
                                    @foreach ($menu['submenu'] as $sub)
                                        <li>
                                            <a href="{{ $sub['link'] }}" style="justify-content: space-between">
                                                @if (isset($sub['is_completed']) && $sub['is_completed'])
                                                    <span class="badge rounded-pill bg-success"><i
                                                            class="fa-solid fa-check me-0"></i></span>
                                                @else
                                                    <i class="fa-solid fa-caret-right"></i>
                                                @endif

                                                {{ $sub['title'] }}

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
