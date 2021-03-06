    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
          </li>
          @if (Auth::user()->role_id == 1)
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crew</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="{{ route('item.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unit.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('rack.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rak Penyimpanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("supplier.index") }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("distributor.index") }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Distributor</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('stockIn.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Barang Masuk
                    {{-- <i class="fas fa-angle-left right"></i> --}}
                  </p>
                </a>
                {{-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('stockIn.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Transaksi Otomatis</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="javascript:void(0)" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Transaksi Manual</p>
                      </a>
                    </li>
                </ul> --}}
              </li>
              <li class="nav-item">
                <a href="{{ route('stockOut.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('stock.racks') }}" class="nav-link">
                <i class="nav-icon fab fa-bitbucket"></i>
                <p>Stock Rak Penyimpanan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('stock.index') }}" class="nav-link">
                <i class="nav-icon fas fa-boxes"></i>
                <p>Stock Barang</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
