<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-{{ (app()->getLocale() === 'en')? 'us' : 'pk' }}"></i>
                    <span class="selected-language"> {{ strtoupper(app()->getLocale()) }}</span>
                </a>
                @if(count(config('app.languages')) > 1)
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                        @foreach(config('app.languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?lang={{ $langLocale }}"
                               data-language="{{$langLocale}}">
                                <i class="flag-icon flag-icon-{{(($langLocale === 'en') ? 'us' : 'pk')}}"></i> {{ strtoupper($langLocale) }}
                                ({{ $langName }})
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
            <li class="nav-item d-block">
                @if(session('theme') === 'light-layout')
                    <a class="nav-link" href="{{ url()->current() }}?theme=dark-layout">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                @else
                    <a class="nav-link" href="{{ url()->current() }}?theme=light-layout">
                        <i class="ficon" data-feather="sun"></i>
                    </a>
                @endif
            </li>
            {{-- <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i><span
                        class="badge rounded-pill bg-danger badge-up">5</span></a>
            </li> --}}
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="#" data-bs-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{auth()->user()->name}}</span>
                    </div>
                    <span class="avatar">
                        @if( \App\Models\Agency::findOrFail(session('agency_id'))->getFirstMediaUrl('profile')==="media/profile-placeholder.png")
                            <img class="round"
                                 src="{{ asset('media/profile-placeholder.png')}}"
                                 alt="avatar" height="40" width="40">
                        @else
                            <img class="round"
                                 src="{{ \App\Models\Agency::findOrFail(session('agency_id'))->getFirstMediaUrl('profile') }}"
                                 alt="avatar" height="40" width="40">
                        @endif
                            <span class="avatar-status-online"></span>
                        </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="me-50" data-feather="user"></i> {{__('Profile')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item w-100" type="submit">
                            <i class="me-50" data-feather="power"></i> {{ __('Log out') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
