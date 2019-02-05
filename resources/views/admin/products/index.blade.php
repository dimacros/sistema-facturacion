@extends('layouts.dashboard', ['icon' => 'cubes'])

@section('title', 'Productos')

@section('content')
    @component('tile')
        <div class="tile-title-w-btn">
            <h3 class="title">Listar Productos</h3>
            <p>
                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                    <i class="fa fa-plus"></i> Crear Producto
                </a>                
            </p>
        </div>
        <table id="products"></table>
    @endcomponent
@endsection

@push('scripts')
<script>
$('#products').bootstrapTable({
    ajax: function(request){
        axios({
            method: request.type,
            params: request.data,
            url: "{{ route('admin.products.data') }}",
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
        { field: 'code', title: '#', sortable: true },
        { field: 'description', title: 'Descripción', sortable: true },
        { field: 'price', title: 'Precio', sortable: true }, 
    ],
    pagination: true,
    search: true,
    searchOnEnterKey: true,
    sidePagination: 'server'
});
</script>
@endpush