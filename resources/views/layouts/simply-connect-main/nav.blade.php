<div class="nav-tabs-navigation nav-tabs">
  <div class="nav-tabs-wrapper">
    <ul class="navbar-nav align-middle">
      @if(Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.dashboard.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            @lang('common.dashboard')
          </a>
        </li>
      @endif

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-building"></i> Company
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/"><i class="fas fa-home"></i> Home</a>
          <a class="dropdown-item" href="/about"><i class="fas fa-question"></i> About Us</a>
          <a class="dropdown-item" href="/docs/rules"><i class="fas fa-balance-scale"></i> Pilot Rules</a>
          <a class="dropdown-item" href="/pilots"><i class="fas fa-balance-scale"></i> Pilots</a>
          <a class="dropdown-item" href="/contact"><i class="fas fa-envelope"></i> Contact Us</a>
          <a class="dropdown-item" href="/donations"><i class="fas fa-hand-holding-usd"></i> Donations</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('frontend.livemap.index') }}">
          <i class="fas fa-globe"></i>
          @lang('common.livemap')
        </a>
      </li>

      {{-- Show the module links that don't require being logged in --}}
      @foreach($moduleSvc->getFrontendLinks($logged_in=false) as &$link)
        <li class="nav-item">
          <a class="nav-link" href="{{ url($link['url']) }}">
            <i class="{{ $link['icon'] }}"></i>
            {{ ($link['title']) }}
          </a>
        </li>
      @endforeach

      @foreach($page_links as $page)
        <li class="nav-item">
          <a class="nav-link" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank':'_self' }}">
            <i class="{{ $page['icon'] }}"></i>
            {{ $page['name'] }}
          </a>
        </li>
      @endforeach

      @if(!Auth::check())
         <li class="nav-item">
          <a class="nav-link" href="{{ url('/docs/preregister') }}">
            <i class="far fa-id-card"></i>
            @lang('common.register')
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/login') }}">
            <i class="fas fa-sign-in-alt"></i>
            @lang('common.login')
          </a>
        </li>
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pilot Docs</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/docs/rules">Rules and Support</a>
          <a class="dropdown-item" href="/ranks">Ranks and Aircrafts</a>
          <a class="dropdown-item" href="/docs/searching">Finding Flights</a>
          <a class="dropdown-item" href="/docs/acars">Setting Up ACARS</a>
          <a class="dropdown-item" href="/docs/photo-competition">Screenshot Competition</a>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.flights.index') }}">
            <i class="fab fa-avianex"></i>
            {{ trans_choice('common.flight', 2) }}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.pireps.index') }}">
            <i class="fas fa-cloud-upload-alt"></i>
            My Flight Reports
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/stats">
            Simply Connect Stats
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.downloads.index') }}">
            <i class="fas fa-download"></i>
            {{ trans_choice('common.download', 2) }}
          </a>
        </li>

        {{-- Show the module links for being logged in --}}
        @foreach($moduleSvc->getFrontendLinks($logged_in=true) as &$link)
          <li class="nav-item">
            <a class="nav-link" href="{{ url($link['url']) }}">
              <i class="{{ $link['icon'] }}"></i>
              {{ ($link['title']) }}
            </a>
          </li>
        @endforeach

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" role="button"
             data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
            @if (Auth::user()->avatar == null)
              <img src="\assets\frontend\img\sc_link_icon.png" style="height: 38px; width: 38px;">
            @else
              <img src="{{ Auth::user()->avatar->url }}" style="height: 38px; width: 38px;">
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right">

            <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">
              <i class="far fa-user"></i>&nbsp;&nbsp;@lang('common.profile')
            </a>

            @ability('admin', 'admin-access')
            <a class="dropdown-item" href="{{ url('/admin') }}">
              <i class="fas fa-circle-notch"></i>&nbsp;&nbsp;@lang('common.administration')
            </a>
            @endability
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('/logout') }}">
              <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;@lang('common.logout')
            </a>
          </div>
        </li>
      @endif

    </ul>
  </div>
</div>
