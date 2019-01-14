@extends('layouts.dashboard', ['icon' => 'cubes'])

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
        <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Razón Social</th>
                  <th>Datos de Contacto</th>
                  <th>Tipo</th>
                  <th>Dirección</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($customers as $customer)
                <tr>
                  <td>{{ $customer->company_name }}</td>
                  <td> 
                    <button class="btn btn-primary" data-toggle="modal" data-target="#viewContact"
                      data-contact="{{ $customer->contact }}"> 
                      Ver Contacto
                    </button>
                  </td>
                  <td>{{ $customer->type }}</td>
                  <td>{{ $customer->address }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center">No hay datos disponibles en la tabla</td>
                </tr> 
              @endforelse
              </tbody>
            </table>
        </div><!--/.table-responsive-->
        <div id="viewContact" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="viewContactTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul id="contactInformation"></ul>
              </div>
            </div>
          </div>
        </div>
    @endcomponent
@endsection
@push('scripts')
<script>
$('#viewContact').on('show.bs.modal', function (e) {

  var btn = e.relatedTarget;
  var list = document.getElementById('contactInformation');
  var titleElement = document.getElementById('viewContactTitle');
  var contact = JSON.parse(btn.dataset.contact);
  list.innerHTML = '';
  titleElement.innerText = 'Datos de Contacto';

  for (attr in contact) {

    if (contact[attr] === null) continue;
    const item = document.createElement('li');
    item.innerText = attr + ': ' + contact[attr];
    list.appendChild(item);
  }

});
</script>    
@endpush
