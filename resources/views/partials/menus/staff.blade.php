<ul class="app-menu">
    <li>
      <a class="app-menu__item {{ active('staff.home') }}" href="{{ route('staff.home', request('slug')) }}">
        <i class="app-menu__icon fa fa-dashboard"></i>
        <span class="app-menu__label">Escritorio</span>
      </a>
    </li>
    @if ( auth()->user()->canManageStores() )
    <li>
      <a class="app-menu__item" href="{{ route('admin.home') }}">
        <i class="app-menu__icon fa fa-angle-double-left"></i>
        <span class="app-menu__label">Regresar</span>
      </a>
    </li>    
    @endif
</ul>