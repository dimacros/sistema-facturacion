@extends('layouts.dashboard', ['icon' => 'cubes'])

@section('title', 'Productos')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Productos</h3>
            <p>
              <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                <i class="fa fa-plus"></i> Crear Producto
              </a>
            </p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($products as $product)
                <tr>
                  <td>{{ $product->code }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->render_price }} </td>
                </tr> 
              @empty
                <tr>
                  <td colspan="3" class="text-center">No hay datos disponibles en la tabla</td>
                </tr>
              @endforelse
              </tbody>
            </table>
        </div><!--/.table-responsive-->
    @endcomponent
@endsection
