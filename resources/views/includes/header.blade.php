<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <div class="header-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close">
                            <i class="ik ik-x"></i>
                        </span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div>
                </div>
                <button class="nav-link" title="clear cache">
                    <a href="{{ url('clear-cache') }}">
                        <i class="ik ik-battery-charging"></i>
                    </a>
                </button>
                <button type="button" id="navbar-fullscreen" class="nav-link ml-2"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="header-search"><span>{{ Auth::user()->name }}</span></div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0)" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{ Auth::user()->photo_url ? Storage::url(Auth::user()->photo_url) : asset('img/user.jpg') }}"
                            alt="Logo"></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('profile') }}"><i class="ik ik-user dropdown-icon"></i>
                            {{ __('Profile') }}</a>
                        <a class="dropdown-item" href="{{ url('logout') }}">
                            <i class="ik ik-power dropdown-icon"></i>
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

