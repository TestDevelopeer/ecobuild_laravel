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
            @foreach ($sidebar as $side)
                <li class="menu-label">{{ $side['title'] }}</li>
                @foreach ($side['menu'] as $menu)
                    <li>
                        <a @class([
                            'feedback-modal' =>
                                isset($menu['type']) && $menu['type'] == 'feedback-modal',
                        ])
                            href="{{ isset($menu['link']) ? $menu['link'] : 'javascript:;' }}">
                            <div class="parent-icon">
                                <i class="{{ $menu['icon'] }}"></i>
                            </div>
                            <div class="menu-title">{{ $menu['title'] }}</div>
                        </a>
                        @if (isset($menu['submenu']))
                            <ul>
                                @foreach ($menu['submenu'] as $sub)
                                    <li>
                                        <a href="{{ $sub['link'] }}">
                                            <i class="{{ $sub['icon'] }}"></i>
                                            {{ $sub['title'] }}"
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endforeach
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
