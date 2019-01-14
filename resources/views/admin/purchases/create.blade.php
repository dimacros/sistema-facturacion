@extends('layouts.dashboard', ['icon' => 'filte-text'])

@section('title', 'Crear Cliente')

@section('content')
    @component('tile')
        @include('message-alert')
        <form method="POST" action="{{ route('admin.purchases.store') }}" id="add-purchase">
            @csrf
            <fieldset class="border p-2">
                <legend class="w-auto">Datos de Factura</legend>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" name="serie" class="form-control" placeholder="F0001"/>
                            </div>
                            <div class="col form-group">
                                <input type="number" name="correlative" class="form-control" placeholder="001"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col form-group">
                                <label for="creation_date">Fecha de emisión</label>
                                <input type="date" class="form-control" name="creation_date" id="creation_date">
                            </div>
                            <div class="col form-group">
                                <label for="expiration_date">Fecha de vencimiento</label>
                                <input type="date" class="form-control" name="expiration_date" id="expiration_date">
                            </div>
                        </div>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Tipo de Moneda</legend>
                            <div class="form-group">
                                <div class="animated-radio-button">
                                    <label class="custom-control-inline">
                                      <input type="radio" name="currency_code" value="PEN"/>
                                      <span class="label-text">PEN</span>
                                    </label>
                                    <label class="custom-control-inline">
                                        <input type="radio" name="currency_code" value="USD"/>
                                        <span class="label-text">USD</span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div><!--/.col-lg-6-->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_id">Búsqueda por RUC o Razón Social</label>
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">Seleccione una opción</option>
                            </select>
                        </div>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Estado de Factura</legend>
                            <div class="form-group">
                                <div class="animated-radio-button">
                                    <label class="custom-control-inline">
                                      <input type="radio" name="status" value="PENDIENTE"/>
                                      <span class="label-text">PENDIENTE</span>
                                    </label>
                                    <label class="custom-control-inline">
                                        <input type="radio" name="status" value="PAGADO"/>
                                        <span class="label-text">PAGADO</span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div><!--/.col-lg-6-->
                </div><!--/.row-->
            </fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Detalles de Factura</legend>
            </fieldset>
        </form>
        <div class="tile-footer">
            <a class="btn btn-primary" href="{{ route('admin.purchases.index') }}">
                <i class="fa fa-angle-double-left"></i> Regresar
            </a>
            <button class="btn btn-primary" type="submit" form="add-purchase">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div>
    @endcomponent
@endsection