<?php
//OBTENER CLIENTES
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/Apieventos/getclientes.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',

));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo 'cURL Error #:' . $err;
  exit(1);
} else {
  $objeto = json_decode($response);
}





?>
<table class='table table-bordered table-striped table-hover' id="tblcliente">
  <thead class='table-light'>
    <th> ID </th>
    <th> NOMBRES </th>
    <th>TELEFONO</th>
    <th>CORREO</th>
    <th>ACCIONES</th>

  </thead>

  <tbody>

    <?php

    foreach ($objeto as $reg) {
    ?>

      <tr>
        <td><?= $reg->id ?> </td>
        <td><?= $reg->nombres . ' ' . $reg->apellidos   ?> </td>
        <td><?= $reg->telefono ?> </td>
        <td><?= $reg->correo ?></td>
        <td>
          <button class="btn btn-danger btnEliminar"
            data-id="<?= $reg->id ?>"
            data-bs-toggle="modal"
            data-bs-target="#confirmDeleteModal">
            ELIMINAR
          </button>
          <button type="button"
            class="btn btn-warning btnEditar"
            data-bs-toggle="modal"
            data-bs-target="#editarClienteModal"
            data-id="<?= $reg->id ?>"
            data-nombres="<?= htmlspecialchars($reg->nombres) ?>"
            data-apellidos="<?= htmlspecialchars($reg->apellidos) ?>"
            data-direccion="<?= htmlspecialchars($reg->direccion) ?>"
            data-telefono="<?= htmlspecialchars($reg->telefono) ?>"
            data-correo="<?= htmlspecialchars($reg->correo) ?>">
            EDITAR
          </button>
        </td>
        <!-- MODAL ELIMINAR -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header alert-danger">
                <h5 class="modal-title" id="confirmDeleteLabel">¡Atención!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <strong>Seguro que desea eliminar este cliente?</strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal editar cliente -->
        <div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="editarClienteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form id="formEditarCliente">
                <div class="modal-header">
                  <h5 class="modal-title" id="editarClienteLabel">Editar Cliente</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="editClienteId" name="id">
                  <div class="mb-3">
                    <label for="editNombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="editNombres" name="nombres" required>
                  </div>
                  <div class="mb-3">
                    <label for="editApellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="editApellidos" name="apellidos" required>
                  </div>
                  <div class="mb-3">
                    <label for="editTelefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="editTelefono" name="telefono" required>
                  </div>
                  <div class="mb-3">
                    <label for="editDireccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="editDireccion" name="direccion" required>
                  </div>
                  <div class="mb-3">
                    <label for="editCorreo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="editCorreo" name="correo" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>


      </tr>
    <?php

    }
    ?>

  </tbody>
  <tfoot>

    <th> ID </th>
    <th> NOMBRES </th>
    <th>TELEFONO</th>
    <th>CORREO</th>
    <th>ACCIONES</th>


  </tfoot>

</table>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  new DataTable('#tblcliente');
  //MODAL

  //MODAL ELIMINAR

  let clienteIdAEliminar = null;

  // Cuando se abre el modal, capturamos el ID del botón que lo abrió
  const modalDelete = document.getElementById('confirmDeleteModal');
  modalDelete.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget; // Botón que abrió el modal
    clienteIdAEliminar = button.getAttribute('data-id');
  });

  // Cuando clickeamos el botón "Eliminar" en el modal
  document.getElementById('btnConfirmarEliminar').addEventListener('click', () => {
    if (!clienteIdAEliminar) return;

    fetch('http://localhost/Apieventos/delete.php', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id: clienteIdAEliminar
        })
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          title: data.mensaje,
          icon: data.codigo === '1' ? 'success' : 'error',
          draggable: true,
          timer: 2000,
          timerProgressBar: true,
          willClose: () => {
            if (data.codigo === '1') {
              const modal = bootstrap.Modal.getInstance(modalDelete);
              modal.hide();
              location.reload();
            }
          }
        });
      })
      .catch(error => {
        Swal.fire({
          title: 'Error al eliminar el cliente.',
          icon: 'error',
          draggable: true
        });
        console.error(error);
      });
  });

  //MODAL EDITAR 
  // Al abrir el modal, llenar los inputs con los datos del botón
  const editarModal = document.getElementById('editarClienteModal');
  editarModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const nombres = button.getAttribute('data-nombres');
    const apellidos = button.getAttribute('data-apellidos');
    const direccion = button.getAttribute('data-direccion');
    const telefono = button.getAttribute('data-telefono');
    const correo = button.getAttribute('data-correo');

    document.getElementById('editClienteId').value = id;
    document.getElementById('editNombres').value = nombres;
    document.getElementById('editApellidos').value = apellidos;
    document.getElementById('editDireccion').value = direccion;
    document.getElementById('editTelefono').value = telefono;
    document.getElementById('editCorreo').value = correo;
  });

  // Manejar envío del formulario de editar
  document.getElementById('formEditarCliente').addEventListener('submit', function(e) {
    e.preventDefault();

    const datos = {
      id: this.id.value,
      nombres: this.nombres.value.trim(),
      apellidos: this.apellidos.value.trim(),
      direccion: this.direccion.value.trim(),
      telefono: this.telefono.value.trim(),
      correo: this.correo.value.trim()
    };

    fetch('http://localhost/Apieventos/update.php', { // Cambia la URL a tu endpoint
        method: 'PUT', // o 'POST' si tu API no soporta PUT
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
      })
      .then(res => res.json())
      .then(data => {
        Swal.fire({
          title: data.mensaje,
          icon: data.codigo === '1' ? 'success' : 'error',
          draggable: true
        }).then(() => {
          if (data.codigo === '1') {
            const modal = bootstrap.Modal.getInstance(editarModal);
            modal.hide();
            location.reload(); // Recarga para ver cambios
          }
        });
      })
      .catch(error => {
        Swal.fire({
          title: 'Error al actualizar cliente.',
          icon: 'error',
          draggable: true
        });
        console.error(error);
      });
  });
</script>