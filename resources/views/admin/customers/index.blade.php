@extends('layouts.dashboard', ['icon' => 'id-card'])

@section('title', 'Clientes')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Clientes</h3>
            <p>
                <a class="btn btn-primary" href="{{ route('admin.customers.create') }}">
                    <i class="fa fa-plus"></i> Crear Cliente
                </a>                
            </p>
        </div>
        <table id="customers"></table>
    @endcomponent
@endsection
@push('scripts')
<script>
$('#customers').bootstrapTable({
    ajax: function(request){
        axios({
            method: request.type,
            params: request.data,
            url: "{{ route('admin.customers.data') }}",
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
        { field: 'company_name', title: 'Razón Social', sortable: true },
        { field: 'type', title: 'Tipo', sortable: true },
        { field: 'address', title: 'Dirección' }, 
    ],
    detailView: true,
    detailFormatter: function(index, row) {
        var contact = JSON.parse(row.contact);
        
        return `
            <h6>Datos de Contacto</h6>
            <ul>
                <li>Correo: ${contact.name || '-'} </li>
                <li>Nombre: ${contact.email || '-'} </li>
                <li>Teléfono: ${contact.phone || '-'} </li>
            </ul>
        `;
    },
    pagination: true,
    search: true,
    searchOnEnterKey: true,
    sidePagination: 'server'
});
</script>    
@endpush
