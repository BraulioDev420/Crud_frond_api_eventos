<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"> </script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.7/quartz/bootstrap.rtl.min.css" integrity="sha384-..." crossorigin="anonymous">

  <title>مرحبًا بالعالم!</title>

</head>

<body>
  <section>
    <!-- NAVBAR-->

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand ">CLIENTES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">OPCIONES</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Datos</a>
            <a class="dropdown-item" href="clientes_pdf.php" target="_blank">Generar Reporte PDF</a>
            <!--<a class="dropdown-item" href="#">Something else here</a> -->
            <div class="dropdown-divider"></div>
            <!-- <a class="dropdown-item" href="#">Separated link</a> -->
          </div>
        </li>
        <!--
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Home
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
              </div>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-sm-2" type="search" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
        -->
      </div>
    </nav>
  </section>
  <div class="container text-center">
    <h1>Listado de Clientes</h1>
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#nuevoClienteModal">
      NUEVO CLIENTE
    </button>



    <style>
      .modal-header {
        justify-content: space-between;
        /* Asegura título a la izquierda y X a la derecha */
      }

      .modal-header .btn-close {
        margin-left: 0;
        /* Quita margen que empuja hacia adentro */
        margin-right: 0;
        /* Elimina espacio extra */
      }
    </style>
    <!-- Modal nuevo cliente -->
    <div class="modal fade" id="nuevoClienteModal" tabindex="-1" aria-labelledby="nuevoClienteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formNuevoCliente">
            <div class="modal-header">
              <h5 class="modal-title" id="nuevoClienteLabel">Nuevo Cliente</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="inputNombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="inputNombres" name="nombres" required>
              </div>
              <div class="mb-3">
                <label for="inputApellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="inputApellidos" name="apellidos" required>
              </div>
              <div class="mb-3">
                <label for="inputDireccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="inputDireccion" name="direccion" required>
              </div>
              <div class="mb-3">
                <label for="inputTelefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="inputTelefono" name="telefono" required>
              </div>
              <div class="mb-3">
                <label for="inputCorreo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="inputCorreo" name="correo" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    include('listado.php');
    ?>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>


</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  //GUARDAR NUEVO CLIENTE

  document.getElementById('formNuevoCliente').addEventListener('submit', function(e) {
    e.preventDefault();


    //metodo normal

    //const datos = {
    //  nombres: this.nombres.value.trim(),
    // apellidos: this.apellidos.value.trim(),
    //  direccion: this.direccion.value.trim(),
    //  telefono: this.telefono.value.trim(),
    // correo: this.correo.value.trim()
    //};

    //serialize
    const formElement = document.getElementById('formNuevoCliente');
    const formData = new FormData(formElement);

    const datos = {};
    formData.forEach((value, key) => {
      datos[key] = value.trim();
    });



    fetch('http://localhost/Apieventos/save.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          title: data.mensaje,
          icon: data.codigo === '1' ? 'success' : 'error',
          draggable: true
        }).then(() => {
          if (data.codigo === '1') {
            const modal = bootstrap.Modal.getInstance(document.getElementById('nuevoClienteModal'));
            modal.hide();
            location.reload();
          }
        });
      })
      .catch(error => {
        Swal.fire({
          title: 'Error al guardar el cliente.',
          icon: 'error',
          draggable: true
        });
        console.error(error);
      });
  });
</script>