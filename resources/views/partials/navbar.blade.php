<nav class="navbar navbar-dark bg-dark navbar-expand-md">
<div class="container container-fluid">
      <a href="/" class="navbar-brand">Web Monitoring SPPD</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item ms-5"><a href="{{ route('sppd') }}" class="nav-link">SPPD</a></li>
              <li class="nav-item ms-5"><a href="{{ route('ipa') }}" class="nav-link">IPA</a></li>
              <li class="nav-item ms-5"><a href="{{ route('pp') }}" class="nav-link">PP</a></li>
          </ul>
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
                <a class="btn btn-primary btn-logout" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endif
          </div>
      </div>
      </div>
      <script>
      $(function(){
            var current = location.pathname;
            $('#navbar li a').each(function(){
                var $this = $(this);
                // if the current path is like this link, make it active
                if($this.attr('href').indexOf(current) !== -1){
                    $this.addClass('active');
                }
            })
        })</script>
</nav>