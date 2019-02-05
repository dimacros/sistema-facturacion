<ul class="app-menu">
    <li>
      <a class="app-menu__item {{ active('admin.home') }}" href="{{ route('admin.home') }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Escritorio</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('admin.stores.index') }}" href="{{ route('admin.stores.index') }}">
        <i class="app-menu__icon fa fa-building"></i>
        <span class="app-menu__label">Tiendas</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('admin.products.index') }}" href="{{ route('admin.products.index') }}">
        <i class="app-menu__icon fa fa-cubes"></i>
        <span class="app-menu__label">Productos</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('admin.customers.index') }}" href="{{ route('admin.customers.index') }}">
        <i class="app-menu__icon fa fa-id-card"></i>
        <span class="app-menu__label">Clientes</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('admin.my-invoices.index') }}" href="{{ route('admin.my-invoices.index') }}">
        <i class="app-menu__icon fa fa-credit-card"></i>
        <span class="app-menu__label">Mis Facturas</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item" href="">
        <i class="app-menu__icon fa fa-truck"></i>
        <span class="app-menu__label">Transferencias</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('admin.users.index') }}" href="{{ route('admin.users.index') }}">
        <i class="app-menu__icon fa fa-users"></i>
        <span class="app-menu__label">Usuarios</span>
      </a>
    </li>
</ul>