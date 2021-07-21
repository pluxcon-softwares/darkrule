<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <img src="{{ asset('images/darkrule_site_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link"><i class="nav-icon fas fa-home"></i> {{__('Home')}}</a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="nav-icon fas fa-shopping-cart"></i>
                {{__('Buy')}}
            </a>
            <ul class="dropdown-menu border-0 shadow">
                @if (isset($mainCategories))
                    @foreach ($mainCategories as $category)
                    <li class="">
                        <a href="{{route('products', ['id' => $category->id])}}" class="dropdown-item">
                            {{$category->category_name}}
                        </a>
                    </li>
                    @endforeach
                @endif
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('purchases') }}" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i> {{__('Purchases')}}
            </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('add.money') }}" class="nav-link">
                    <i class="nav-icon fas fa-piggy-bank"></i> {{__('Fund')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('tickets') }}" class="nav-link">
                    <i class="nav-icon fas fa-ticket-alt"></i> {{__('Contact')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('rules') }}" class="nav-link">
                    <i class="nav-icon fas fa-flag"></i> {{__('Rules')}}
                </a>
            </li>

        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link info-number" href="{{ route('tickets') }}">
              <i class="fas fa-comments"></i>
              <span class="badge badge-danger navbar-badge">{{$ticketReplies}}</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('cart') }}">
              <i class="fas fa-shopping-cart" id="countOrderItems"></i>
              <span class="badge badge-danger navbar-badge">0</span>
            </a>
          </li>

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" style="color: red">
              <i class="fas fa-piggy-bank"></i>
              {{__('Wallet')}} ${{ Auth::user()->wallet ? Auth::user()->wallet : '0.00' }}
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
              {{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i>
                    {{__('Profile')}}
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i>
                    {{__('Logout')}}
                </a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-globe"></i>
              Lang
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a class="nav-link" href="{{ url()->current() }}?lang=en">
                    <img src="{{ asset('images/united-states.png') }}" style="width: 18px;">
                    EN
                  </a>

                  <a class="nav-link" href="{{ url()->current() }}?lang=ru">
                    <img src="{{ asset('images/russia.png') }}" style="width: 18px;">
                    RU
                  </a>
            </div>
          </li>

      </ul>
    </div>
  </nav>
