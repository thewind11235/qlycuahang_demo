<div class="sidebar" data-color="black">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-normal">
            {{ __('Menu') }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if ($activePage == 'home') active @endif">
                <a href="{{ route('home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @admin
            <li>
                <a data-toggle="collapse" href="#admin_func">
                    <i class="now-ui-icons design_app"></i>
                    <p>
                        {{ __('Chức năng admin') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="admin_func">
                    <ul class="nav">
                        <li class="@if ($activePage == 'users') active @endif">
                            <a href="{{ route('user.index') }}">
                                <i class="now-ui-icons users_circle-08"></i>
                                <p> {{ __('Quản lý users') }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'storage') active @endif">
                            <a href="#">
                                <i class="fas fa-code-branch"></i>
                                <p> {{ __('Quản lý kho') }} </p>
                            </a>
                        </li>
                        {{-- <li class="@if ($activePage == 'levels') active @endif">
                            <a href="{{ route('levels.index') }}">
                                <i class="fas fa-layer-group"></i>
                                <p> {{ __('Quản lý cấp bậc') }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'xuat_tuyen') active @endif">
                            <a href="{{ route('xuat_tuyen.index') }}">
                                <i class="fas fa-code-branch"></i>
                                <p> {{ __('Quản lý xuất tuyến') }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'maps') active @endif">
                            <a href="{{ route('maps.index') }}">
                                <i class="now-ui-icons location_map-big"></i>
                                <p>{{ __('Track map') }}</p>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            @end
            @cashier
            <li class="@if ($activePage == 'bills') active @endif">
                <a href="{{ route('bill.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <p> {{ __('Quản lý hoá đơn') }} </p>
                </a>
            </li>
            @end
            @staff
            <li class="@if ($activePage == 'bills.create.index') active @endif">
                <a href="{{ route('bill.create.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <p> {{ __('Tạo lý hoá đơn') }} </p>
                </a>
            </li>
            <li class="@if ($activePage == 'bills.history') active @endif">
                <a href="{{ route('bill.history') }}">
                    <i class="fas fa-code-branch"></i>
                    <p> {{ __('Lịch sử hoá đơn') }} </p>
                </a>
            </li>
            @end
            {{-- <li class="@if ($activePage == 'hanh_lang') active @endif">
                <a href="{{ route('hanhlang.index') }}">
                    <i class="now-ui-icons education_atom"></i>
                    <p>{{ __('Hành lang') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'khiem_khuyet') active @endif">
                <a href="{{ route('khiemkhuyet.index') }}">
                    <i class="now-ui-icons education_atom"></i>
                    <p>{{ __('Khiếm khuyết') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'tram_bien_ap') active @endif">
                <a href="{{ route('trambienap.index') }}">
                    <i class="now-ui-icons education_atom"></i>
                    <p>{{ __('Trạm biến áp') }}</p>
                </a>
            </li>
            <li class="@if ($activePage == 'download_app') active @endif">
                <a href="{{ route('download_app.index') }}">
                    <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                    <p>{{ __('Tải xuống app mobile') }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
