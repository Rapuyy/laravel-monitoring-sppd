<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse mt-2">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        {{--  <li class="nav-item namaapps" >
            Web Monitoring SPPD
        </li>  --}}
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/">
            <span data-feather="bar-chart"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sppd">
            <span data-feather="file-text"></span>
            SPMPD
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ipa">
            <span data-feather="credit-card"></span>
            IPA
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pp">
            <span data-feather="check-square"></span>
            PP
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <script>
    $(function(){
          var current = location.pathname;
          $('#sidebarMenu li a').each(function(){
              var $this = $(this);
              // if the current path is like this link, make it active
              if($this.attr('href').indexOf(current) !== -1){
                  $this.addClass('active');
              }
          })
      })</script>