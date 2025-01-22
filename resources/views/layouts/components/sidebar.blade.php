<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
      <a href="./index.html" class="brand-link">
        <img
          src="{{ asset('Assets/dist/assets/img/AdminLTELogo.png') }}"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <span class="brand-text fw-light">Product-Management</span>
      </a>
    </div>
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
        <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link">
              <i class="nav-icon bi bi-palette"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route( 'product') }}" class="nav-link">
              <i class="nav-icon bi bi-palette"></i>
              <p>Product</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
