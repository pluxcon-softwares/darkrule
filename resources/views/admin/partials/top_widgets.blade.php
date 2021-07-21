<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $countUsers ? $countUsers : 0 }}</h3>

          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $countProducts ? $countProducts : 0 }}</h3>

          <p>Total Products</p>
        </div>
        <div class="icon">
          <i class="fa fa-gear"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $countTickets ? $countTickets : 0 }}</h3>

          <p>Support/Ticket</p>
        </div>
        <div class="icon">
          <i class="fa fa-mortar-board"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $totalWallets ? sprintf('%.2f', $totalWallets) : sprintf('%.2f', 0) }}</h3>

          <p>Wallet</p>
        </div>
        <div class="icon">
          <i class="fas fa-bank"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
