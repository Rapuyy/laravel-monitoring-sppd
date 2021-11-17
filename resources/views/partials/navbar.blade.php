<!-- Navigation Bar-->
        <nav class="navbar">
            <div class="container container-fluid">
              <a class="navbar-brand" href="/" style="color: aliceblue;">Web Monitoring SPPD</a>
              <form class="d-flex">
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-auto">
                        @csrf
                    </form>
                </form>
            </div>
          </nav>