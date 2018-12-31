<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" 
    src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
      <p class="app-sidebar__user-designation">Administrador</p>
    </div>
  </div>
  <ul class="app-menu">
    <li>
      <a class="app-menu__item {{ active('home') }}" href="{{ route('home') }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Escritorio</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('tiendas.index') }}" href="{{ route('tiendas.index') }}">
        <i class="app-menu__icon fa fa-building"></i>
        <span class="app-menu__label">Tiendas</span>
      </a>
    </li>
    <li>
      <a class="app-menu__item {{ active('usuarios.index') }}" href="{{ route('usuarios.index') }}">
        <i class="app-menu__icon fa fa-users"></i>
        <span class="app-menu__label">Usuarios</span>
      </a>
    </li>
    @if ($stores->isNotEmpty())
    <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-external-link"></i>
          <span class="app-menu__label">Mis Tiendas</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          @foreach ($stores as $store)
            <li>
              <a class="treeview-item" href="{{ url($store->slug) }}">
                <i class="icon fa fa-circle-o"></i> {{ $store->name }}
              </a>
            </li>
          @endforeach
        </ul>
    </li>        
    @endif
  </ul>
</aside>