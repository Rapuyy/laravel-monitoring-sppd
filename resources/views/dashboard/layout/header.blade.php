<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 text-center" href="/">
      <img src={{ asset("./img/jmtm.png") }} alt="logo-jmtm" class="img-fluid">
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="nav-item navbar-apps" href="#">Website Monitoring SPPD</a>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap me-2">
        @if(Auth::check())
                <a class="btn btn-warning btn-logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><span data-feather="log-out"></span>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-auto">
                    @csrf
                </form>
                
            @else
                <a class="btn btn-warning btn-logout" href="{{ route('login') }}"> <span data-feather="log-in"></span> {{ __('Login') }}</a>
            @endif
      </div>
    </div>
  </header>