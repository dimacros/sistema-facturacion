@extends('layouts.dashboard', ['icon' => 'building'])

@section('title', 'Tiendas')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Tiendas</h3>
            <p>
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                <i class="fa fa-plus"></i> Crear Tienda
              </button>
            </p>
        </div>
        @include('message-alert')
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($stores as $store)
                    <tr>
                      <td>
                        {{ $store->name }}
                        @if ( $store->is_primary )
                           <span class="ml-1 badge badge-primary">Principal</span>
                        @endif
                      </td>
                      <td>{{ $store->address }}</td>
                      <td class="text-right">
                          @unless ( $store->is_primary )
                            @include('btn-delete', ['id' => $store->id, 'routeName' => 'admin.stores.destroy'])
                          @endunless
                          <button class="btn btn-icon btn-icon-warning" data-toggle="modal" 
                            data-target="#modalEdit-{{ $store->id }}">
                              <i class="fa fa-edit"></i>
                          </button>
                          <a href="{{ $store->url() }}" class="btn btn-icon btn-icon-primary" target="_BLANK">
                            <i class="fa fa-external-link"></i>
                          </a>
                      </td>
                    </tr>
                    <!-- Edit Store -->
                    @component('modal-edit', ['id' => $store->id, 'model' => 'store'])

                      @slot('title', 'Editar Tienda - ' . $store->name)
                      
                      <form method="POST" action="{{ route('admin.stores.update', $store->id) }}" 
                        id="update-store-{{ $store->id }}">
                          @csrf @method('put')
                          <div class="form-group">
                            <label for="name">Nombre de la Tienda</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $store->name }}">
                          </div>
                          <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $store->address }}">
                          </div>
                      </form>

                    @endcomponent
                @endforeach
              </tbody>
            </table>
        </div><!--/.table-responsive-->
    @endcomponent
    <!-- Create Store -->
    @component('admin.stores._create', ['model' => 'store'])

        @slot('title', 'Agregar Tienda')

        <form method="POST" id="add-store" action="{{ route('admin.stores.store') }}">
            <div class="form-group">
              <label for="name">Nombre de la Tienda</label>
              <input type="text" class="form-control" name="name" id="name" required/>
            </div>
            <div class="form-group">
              <label for="address">Dirección</label>
              <input type="text" class="form-control" name="address" id="address" required/>
            </div>
        </form>    
    @endcomponent
@endsection
@push('scripts')
<script>
$('.delete-record').click(function(){
    var form_id = 'delete-record-' + this.dataset.id;
    var confirmationText = '¿Está seguro de eliminar esta tienda?';
    if( confirm(confirmationText) ) 
        document.getElementById(form_id).submit();
});
</script>
@endpush
