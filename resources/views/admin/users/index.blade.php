@extends('layouts.dashboard', ['icon' => 'users'])

@section('title', 'Usuarios')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Usuarios</h3>
            <p>
              <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                <i class="fa fa-plus"></i> Crear Usuario
              </a>
            </p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td></td>
                        <td>
                           {{ $user->fullName() }}
                           @if ( $user->email_verified_at )
                              <span class="ml-1 badge badge-primary">Verificado</span>
                           @endif
                       </td>
                        <td>{{ $user->email }}</td>
                    </tr> 
                @endforeach
              </tbody>
            </table>
        </div><!--/.table-responsive-->
    @endcomponent
@endsection
