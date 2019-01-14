<button type="button" class="btn btn-icon btn-icon-danger delete-record" data-id="{{ $id }}">
    <i class="fa fa-times"></i>
</button>
<form method="POST" action="{{ route($routeName, $id) }}" class="d-none" id="delete-record-{{ $id }}">
    @csrf
    @method('delete')
</form>