@extends('layouts.dashboard', ['icon' => 'cubes'])

@section('title', 'Compras')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Compras</h3>
            <p>
              <a class="btn btn-primary" href="{{ route('admin.purchases.create') }}">
                <i class="fa fa-plus"></i> Crear Factura
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
              </tbody>
            </table>
        </div><!--/.table-responsive-->
    @endcomponent
@endsection
