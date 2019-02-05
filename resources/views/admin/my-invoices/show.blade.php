@extends('layouts.dashboard', ['icon' => 'file-text'])

@section('title', 'Crear Factura de Compra')

@section('content')
    @component('tile')
        <section class="invoice">
            <div class="row mb-4">
                <div class="col-6">
                    <h2 class="page-header"><i class="fa fa-globe"></i> Vali Inc</h2>
                </div>
                <div class="col-6">
                    <h5 class="text-right">Fecha: {{ date('d-m-Y') }}</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-4">
                    <address>
                        <h6>Vali Inc.</h6>
                        518 Akshar Avenue<br>
                        Gandhi Marg<br>New Delhi<br>
                        Email: hello@vali.com
                    </address>
                </div>
                <div class="col-4">
                    <address>
                        <h6>John Doe</h6>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                    </address>
                </div>
                <div class="col-4">
                    <h6>Invoice #007612</h6>
                    <strong>Order ID:</strong> 4F3S8J<br>
                    <strong>Payment Due:</strong> 2/22/2014<br>
                    <strong>Account:</strong> 968-34567
                </div>
            </div><!--/.invoice-info-->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Valor Unitario</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <a class="btn btn-primary" href="javascript:window.print();" target="_blank">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    @endcomponent
@endsection
