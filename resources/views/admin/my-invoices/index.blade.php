@extends('layouts.dashboard', ['icon' => 'credit-card'])

@section('title', 'Mis Facturas')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Facturas</h3>
            <p>
              <a class="btn btn-primary" href="{{ route('admin.my-invoices.create') }}">
                <i class="fa fa-plus"></i> Crear Factura
              </a>
            </p>
        </div>
        <div class="table-responsive">
            <table id="my-invoices"></table>
        </div><!--/.table-responsive-->
    @endcomponent
@endsection
@push('scripts')
<script>
$('#my-invoices').bootstrapTable({
    ajax: function(request){
        axios({
            method: request.type,
            params: request.data,
            url: "{{ route('admin.my-invoices.data') }}",
            responseType: request.dataType
        })
        .then(function (response) {
            request.success(response.data);
        })
        .catch(function (error) {
            request.error(error);
        });
    },
    columns: [
        { field: 'serie', title: 'Serie' },
        { field: 'correlative', title: 'N°' },
        { field: 'creation_date', title: 'Fecha de emisión' },
        { field: 'status', title: 'Estado' },
        { field: 'subtotal', title: 'Subtotal' },
        { field: 'tax', title: 'Impuesto' },
        { field: 'total', title: 'Total' },
    ],
    pagination: true,
    sidePagination: 'server'
});
</script>    
@endpush