<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('images/crowshop_cc_logo.png') }}" alt="Darkrule Logo" class="brand-image img-circle elevation-3" style="">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/profile_pic.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::guard('admin')->user()->username }}</a>
        </div>

      </div>

      <div class="user-panel">
        <div class="image">&nbsp;</div>
        <div class="info">
            <a href="{{route('admin.logout')}}"><span class="fas fa-power-off"></span> Logout</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            </li>

            <li class="nav-header">PRODUCTS</li>

            @if(isset($mainCategories))
                @foreach($mainCategories as $category)
                <li class="nav-item">
                    <a href="{{route('admin.products', ['id'=>$category->id])}}" class="nav-link"><i class="far fa-dot-circle nav-icon"></i>
                    <p>{{$category->category_name}}</p>
                    </a>
                </li>
                @endforeach
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Categories
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('admin.categories')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Main Category</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.subcategories')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!--<div class="nav-header"></div>-->

              <li class="nav-item"><a href="{{route('admin.orders')}}" class="nav-link"><i class="fas fa-truck-moving"></i> <p>Orders</p></a></li>
              <li class="nav-item"><a href="{{route('admin.purchases')}}" class="nav-link"><i class="fas fa-shopping-cart"></i> <p>Purchases</p></a></li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('admin.admin-account')}}"" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Admins</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.user-account')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Users</p>
                    </a>
                  </li>
                </ul>
              </li>

            <li class="nav-item"><a href="{{ route('admin.tickets') }}" class="nav-link"><i class="fas fa-ticket-alt"></i> <p>Support</p></a></li>
            <li class="nav-item"><a href="{{route('admin.message-board')}}" class="nav-link"><i class="fa fa-comments"></i> <p>Message Board</p></a></li>

            <li class="nav-item"><a href="{{ route('admin.rules') }}" class="nav-link"><i class="fa fa-flag"></i> <p>Rules</p></a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
