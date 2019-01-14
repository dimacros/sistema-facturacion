@if ( session('success') )
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <h5 class="alert-heading">
      ¡Hay {{ ($errors->count() > 1) ? $errors->count() . ' errores' : '1 error'  }}  en el formulario!
    </h5>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif