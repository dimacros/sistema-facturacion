<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateTitle">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateTitle">{{ $title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="wrapper-overlay"></div>
            {{ $slot }}
            <div id="wrapper-message"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" id="save-btn" form="add-{{ $model }}">Guardar</button>
        </div>
        <script>
          document.getElementById('add-{{ $model }}').addEventListener('submit', function(e){ 
              
              e.preventDefault();
              var self = this;
              var data = serialize(this, { hash: true });
              document.getElementById('save-btn').disabled = true;
              document.getElementById('wrapper-overlay').innerHTML = `
                <div class="overlay">
                    <div class="m-loader mr-4">
                      <svg class="m-circular" viewBox="25 25 50 50">
                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                      </svg>
                    </div>
                    <h3 class="l-text">Cargando</h3>
                </div>              
              `;
              self.parentElement.appendChild( document.getElementById('wrapper-overlay') );
              axios.post(self.action, data)
              .then(function (response) {
                document.getElementById('save-btn').disabled = false;
                document.getElementById('wrapper-message').innerHTML = `
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>${response.data.success}</strong>
                  </div>
                  <div class="alert alert-warning" role="alert">
                    <strong>No olvide actualizar la página para ver los cambios.</strong>
                  </div>
                `;
                self.reset();
              })
              .catch(function (error) {
                var errors = error.response.data.errors;
                var listErrors = [];
                for (let attribute in errors) {
                    listErrors.push(errors[attribute][0]);
                } 
                document.getElementById('wrapper-message').innerHTML = `
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">
                      ¡Hay ${listErrors.length} ${listErrors.length > 1?'errores':'error'} en el formulario!
                    </h5>
                    <ul>
                      <li>${listErrors.join('</li><li>')}</li>
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                `;
              })
              .then(function () {
                document.getElementById('save-btn').disabled = false;
                document.getElementById('wrapper-overlay').innerHTML = '';
              });

          });
        </script>
      </div>
    </div>
</div>