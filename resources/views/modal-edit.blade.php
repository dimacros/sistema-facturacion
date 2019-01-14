<div class="modal fade" id="modalEdit-{{ $id }}" tabindex="-1" role="dialog" 
    aria-labelledby="modalEditTitle-{{ $id }}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditTitle-{{ $id }}">
            {{ $title }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" form="update-{{ $model }}-{{ $id }}">Guardar</button>
        </div>
      </div>
    </div>
</div>