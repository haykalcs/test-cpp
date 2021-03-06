<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-white navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img class="brand-logo" alt="modern admin logo" src="{{ asset('assets/images/logo/smekda.png') }}">
                        <h3 class="brand-text font-weight-bold">SMEKDA</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse justify-content-end" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700 dark">{{ auth()->user()->username ?? '' }}</span>
                            <span class="avatar avatar-online">
                                <img src="{{ auth()->user()->avatar ? asset('storage/images/' . auth()->user()->avatar) : asset('assets/images/portrait/small/avatar-s-23.png') }}" alt="avatar">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="ft-user"></i> Ubah Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ft-power"></i> Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>