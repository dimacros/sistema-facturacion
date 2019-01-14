@extends('layouts.dashboard', ['icon' => 'user-plus'])

@section('title', 'Crear Usuario')

@section('content')
    @component('tile')
        @include('message-alert')
        <form method="POST" action="{{ route('admin.users.store') }}" id="add-user">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Usuario</legend>
                        <div class="form-group">
                            <label for="first_name">Nombre(s)</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" 
                                value="{{ old('first_name') }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellidos</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" 
                                value="{{ old('last_name') }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required/>
                        </div>
                        <div class="form-group">
                            <div class="toggle">
                                <label>
                                    <input type="checkbox" id="has_password" name="has_password" value="1" 
                                        {{ old('has_password') ? 'checked' : '' }}/>
                                    <span class="button-indecator">¿Deseas crear la contraseña?</span>
                                </label>
                            </div>
                        </div>
                        <div id="password-wrapper" style="display: {{ old('has_password') ? 'block' : 'none' }};">
                          <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label for="password-confirmation">Confirmar Contraseña</label>
                            <input type="password" id="password-confirmation" 
                                name="password_confirmation" class="form-control"/>
                          </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2">
                        <legend class="w-auto">Asignar Tienda(s)</legend>
                        <div class="form-group">
                            <div class="animated-checkbox">
                            @foreach ($stores as $store)
                                <label class="form-check-inline">
                                    <input type="checkbox" name="stores[{{ $store->id }}]" value="{{ $store->id }}" 
                                        {{ old("stores.{$store->id}") ? 'checked' : '' }}/>
                                    <span class="label-text">{{ $store->name }}</span>
                                </label>                             
                            @endforeach
                            </div>
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Detalles de Perfil</legend>
                        
                    </fieldset>
                    <fieldset class="border p-2">
                        <legend class="w-auto">Asignar Rol</legend>
                        <div class="form-group">
                        @foreach ($roles as $role)
                            <div class="animated-radio-button">
                                <label>
                                    <input type="radio" name="role_id" value="{{ $role->id }}" 
                                        {{ ( old('role_id') == $role->id ) ? 'checked' : '' }}/>
                                    <span class="label-text">{{ $role->title }}</span>
                                </label>
                            </div>                         
                        @endforeach
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
            </div><!--/.row-->
        </form>
        <div class="tile-footer">
            <a class="btn btn-primary" href="{{ route('admin.users.index') }}">
                <i class="fa fa-angle-double-left"></i> Regresar
            </a>
            <button class="btn btn-primary" type="submit" form="add-user">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div>
    @endcomponent
@endsection
@push('scripts')
<script>
$('#has_password').change(function(){
    $('#password-wrapper').toggle("slow");
});
</script>
@endpush