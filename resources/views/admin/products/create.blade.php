@extends('layouts.dashboard', ['icon' => 'cube'])

@section('title', 'Crear Producto')

@section('content')
    @component('tile')
        @include('message-alert')
        <form method="POST" action="{{ route('admin.products.store') }}" 
            id="add-product" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Producto</legend>
                        <div class="form-group">
                            <label for="code">Código</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">P</span>
                                </div>
                                <input type="text" class="form-control" name="code" id="code"
                                    value="{{ old('code') }}" placeholder="001" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" name="description" id="description"
                                value="{{ old('description') }}" required/>
                        </div>
                        <div class="form-group">
                            <label>Imágenes del Producto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" id="images"
                                    lang="es" multiple/>
                                <label class="custom-file-label" for="images">Seleccionar Imágenes</label>
                            </div>
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
                <div class="col-lg-6">
                    <fieldset class="border p-2">
                        <legend class="w-auto">Detalles de Producto</legend>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select class="form-control" name="type" id="type"> 
                                <option value="">Seleccione una opción</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unidad de Medida</label>
                            <select class="form-control" name="unit_code" id="unit" required> 
                                <option value="">Seleccione una opción</option>
                                <option value="NIU">Unidades</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">PEN</span>
                              </div>
                              <input type="hidden" name="currency_code" value="PEN">
                              <input type="number" class="form-control" name="price" id="price" step="0.01" 
                                value="{{ old('price') }}" required/>
                            </div>
                        </div>
                    </fieldset>
                </div><!--/.col-lg-6-->
            </div><!--/.row-->
        </form>
        <div class="tile-footer">
            <a class="btn btn-primary" href="{{ route('admin.products.index') }}">
                <i class="fa fa-angle-double-left"></i> Regresar
            </a>
            <button class="btn btn-primary" type="submit" form="add-product">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div>
    @endcomponent
@endsection