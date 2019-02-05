@extends('layouts.dashboard', ['icon' => 'id-card'])

@section('title', 'Crear Cliente')

@section('content')
    @component('tile')
        @include('message-alert')
        <form method="POST" action="{{ route('admin.customers.store') }}" id="add-customer">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Datos del Cliente</legend>
                        <div class="form-group">
                            <label for="document_type">Tipo de Documento</label>
                            <select class="form-control" name="document_type" id="document_type" required>
                                <option value="">Seleccione una opción</option>
                                <option value="6">RUC</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="document_value">Número del Documento</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="document_value" name="document_value" 
                                    value="{{ old('document_value') }}" placeholder="Búsqueda por RUC" required/>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-outline-secondary" id="search_ruc">
                                    <i class="fa fa-search mr-0"></i>
                                  </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Razón Social</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" 
                                value="{{ old('company_name') }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                value="{{ old('address') }}" required/>
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Tipo de Cliente</legend>
                        <div class="form-group">
                            <div class="animated-radio-button">
                                <label class="custom-control-inline">
                                  <input type="radio" name="type" value="Consumidor"/>
                                  <span class="label-text">Consumidor</span>
                                </label>
                                <label class="custom-control-inline">
                                    <input type="radio" name="type" value="Proveedor"/>
                                    <span class="label-text">Proveedor</span>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2">
                        <legend class="w-auto">Contacto</legend>
                        <div class="form-group mb-2">
                            <label for="contact_name">Nombre</label>
                            <input type="text" class="form-control" id="contact_name" name="contact[name]" 
                                value="{{ old('contact.name') }}"/>
                        </div>
                        <div class="form-group mb-2">
                            <label for="contact_phone">Teléfono</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact[phone]" 
                                value="{{ old('contact.phone') }}"/>
                        </div>
                        <div class="form-group mb-2">
                            <label for="contact_email">Correo Electrónico</label>
                            <input type="text" class="form-control" id="contact_email" name="contact[email]" 
                                value="{{ old('contact.email') }}"/>
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
            </div><!--/.row-->
        </form>
        <div class="tile-footer">
            <a class="btn btn-primary" href="{{ route('admin.customers.index') }}">
                <i class="fa fa-angle-double-left"></i> Regresar
            </a>
            <button class="btn btn-primary" type="submit" form="add-customer">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div>
    @endcomponent
@endsection
@push('scripts')
<script>
document.getElementById('search_ruc').addEventListener('click', function(){

    var self = this;
    var ruc = document.getElementById('document_value').value;
    
    if( ruc === '' || ruc.length !== 11) return;

    self.disabled = true;
    axios.get('/ruc/' + ruc).then(function (response) {
        document.getElementById('company_name').value = response.data.razonSocial;
        document.getElementById('address').value = response.data.direccion;
    })
    .then(function(){
        self.disabled = false;
    });

});
</script>
@endpush