@extends('layouts.dashboard', 
    ['title' => 'Tiendas']
)

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Tiendas</h3>
            <p>
              <button class="btn btn-primary icon-btn" data-toggle="modal" data-target="#createStore">
                <i class="fa fa-plus"></i> Nueva tienda
              </button>
            </p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Dirección</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($stores as $store)
                   <tr>
                     <td></td>
                     <td>
                        {{ $store->name }}
                        @if ( $store->is_primary)
                           <span class="ml-1 badge badge-primary">Principal</span>
                        @endif
                    </td>
                     <td>{{ $store->address }}</td>
                   </tr> 
                @empty
                    <tr>
                      <td colspan="3" class="text-center">
                        No existe ninguna tienda registrada.
                      </td>
                    </tr>
                @endforelse
              </tbody>
            </table>
        </div>
    @endcomponent
    <!-- New Store -->
    @component('modal-create', [
        'modal_id' => 'createStore', 
        'modal_title' => 'Agregar Tienda', 
        'form_id' => 'store-form'
    ])
        <form id="store-form" action="{{ route('tiendas.store') }}" method="POST">
            <div class="form-group">
              <label for="name">Nombre de la Tienda</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="address">Dirección</label>
              <input type="text" class="form-control" name="address" id="address">
            </div>
            <div class="form-group pl-1">
                <div class="animated-checkbox">
                    <label>
                        <input type="checkbox" name="is_primary" value="1" {{ old('is_primary') ? 'checked' : '' }}>
                        <span class="label-text">Tienda Principal</span>
                    </label>
                </div>
            </div>
        </form>        
    @endcomponent
@endsection
