@extends('layouts.dashboard', ['icon' => 'file-text'])

@section('title', 'Crear Factura')

@section('content')
    @component('tile')
        @include('message-alert')
        <form method="POST" action="{{ route('admin.my-invoices.store') }}" id="add-invoice">
            <fieldset id="invoice-items"></fieldset>
            <fieldset class="border p-2">
                <legend class="w-auto">Datos de Factura</legend>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col form-group">
                                <input type="text" class="form-control" name="serie" placeholder="F001"
                                    />
                            </div>
                            <div class="col form-group">
                                <input type="number" class="form-control" name="correlative" placeholder="001" 
                                    />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col form-group">
                                <label for="creation_date">Fecha de emisión</label>
                                <input type="date" class="form-control" name="creation_date" id="creation_date" 
                                    />
                            </div>
                            <div class="col form-group">
                                <label for="expiration_date">Fecha de vencimiento</label>
                                <input type="date" class="form-control" name="expiration_date" id="expiration_date"/>
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
                            <select name="customer_id" id="customer_id" style="display:none;" 
                                data-url="{{ route('admin.customers.data') }}">
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
        </form>
        @include('admin.my-invoices._details')
        <div class="tile-footer">
            <a class="btn btn-primary" href="{{ route('admin.my-invoices.index') }}">
                <i class="fa fa-angle-double-left"></i> Regresar
            </a>
            <button class="btn btn-primary" id="btn-add-invoice" type="submit" form="add-invoice">
                <i class="fa fa-check-circle"></i> Enviar
            </button>
        </div>
    @endcomponent
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" 
integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/pages/create-invoice.js') }}"></script>
@endpush