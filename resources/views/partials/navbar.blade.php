<!-- Navigation Bar-->
        <nav class="navbar">
            <div class="container container-fluid">
              <a class="navbar-brand" href="/" style="color: aliceblue;">Web Monitoring SPPD</a>
              <div class="d-flex">
                @if(Auth::check())
                    <a class="btn btn-primary btn-logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-auto">
                        @csrf
                    </form>
                @else
                    <a class="btn btn-primary btn-logout" href="{{ route('login') }}">{{ __('login') }}</a>
                @endif
                </div>
            </div>
          </nav>