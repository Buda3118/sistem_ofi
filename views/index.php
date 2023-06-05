<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']['status']) {
  header("Location:../");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenidos a mi Supermercado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Datatable-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css" rel="stylesheet" />

</head>

<style>
  body {
    height: 100vh;
    background: url(../img/ofi.jpg);
  }
</style>

<body>
  <div class="container vh-100">
    <h1 class="text-center">Productos de Supermercado</h1>
    <div class="text-center">
      <a class="btn btn-danger btn-sm my-4" href="../controllers/trabajador.controller.php?operacion=destroy">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Cerrar sesión
      </a>
    </div>

    <div class="row">
      <div class="col-md-5">
        <form action="" id="formulario-productos" autocomplete="off">
          <div class="card">
            <div class="card-header">
              <h4>Registrar Producto</h4>
            </div>

            <div class="card-body">
              <div class="mb-3">
                <label for="clasificaciones" class="form-label">Clasificaciones:</label>
                <select name="clasificaciones" id="clasificaciones" class="form-select" autofocus>
                  <option value="" selected hidden>Seleccione</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="marcas" class="form-label">Marcas:</label>
                <select name="marcas" id="marcas" class="form-select">
                  <option value="" selected hidden>Seleccione</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion">
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="numeroserie" class="form-label">Número de serie:</label>
                  <input type="text" class="form-control" id="numeroserie" placeholder="Campo opcional">
                </div>

                <div class="col-md-6">
                  <label for="cantidad" class="form-label">Cantidad:</label>
                  <input type="number" class="form-control" id="cantidad">
                </div>
              </div>
              <!-- Fin del formulario -->
            </div>
            <div class="card-footer text-body-secondary text-end">
              <button class="btn btn-secondary btn-sm" type="reset">Reiniciar</button>
              <button class="btn btn-success btn-sm" type="button" id="guardar">Guardar</button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-7">
        <table class="table table-sm table-striped responsive" id="tabla-productos" width="100%">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Clasificación</th>
              <th>Marca</th>
              <th>Descripcion</th>
              <th>Serie</th>
              <th>Cantidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

    <!-- Button trigger modal -->
    <!-- <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar-producto">
      Editar
    </a> -->

    <!-- Modal -->
    <div class="modal fade" id="modal-productos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="clasificaciones">Clasificaciones:</label>
                <select name="clasificaciones" id="md-clasificacion" class="form-control form-control-sm" autofocus>
                  <!-- <option value="">Seleccione</option> -->
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="marcas">Marcas:</label>
                <select name="marcas" id="md-marca" class="form-control form-control-sm">
                  <!-- <option value="">Seleccione</option> -->
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="descripcion">Descripcion:</label>
              <input type="text" class="form-control form-control-sm" id="md-descripcion">
            </div>

            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="numeroserie">Número de serie:</label>
                <input type="text" class="form-control form-control-sm" id="md-numeroserie"
                  placeholder="Campo opcional">
              </div>
              <div class="mb-3 col-md-6">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control form-control-sm" id="md-cantidad">
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="actualizar">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

  </div>



  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- Opcional -->
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
  <!-- Datatable -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
  <!-- botones -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
  <!-- fin botones -->

  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/7ac08d8e48.js" crossorigin="anonymous"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      let idproducto = ``;
      const tabla = document.querySelector("#tabla-productos");
      const cuerpoTabla = tabla.querySelector("tbody");
      const btnGuardar = document.querySelector("#guardar");
      const clasificaciones = document.querySelector("#clasificaciones");
      const marca = document.querySelector("#marcas");
      const descripcion = document.querySelector("#descripcion");
      const numeroserie = document.querySelector("#numeroserie");
      const cantidad = document.querySelector("#cantidad");
      const btnActualizar = document.querySelector("#actualizar");
      const modal = new bootstrap.Modal(document.querySelector("#modal-productos"))

      function listarProductos() {
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarProductos")
        fetch(`../controllers/producto.controller.php`, {
          method: 'POST',
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            cuerpoTabla.innerHTML = ``;
            datos.forEach(registro => {
              const fila = `
                <tr>
                  <td>${registro.idproducto}</td>
                  <td>${registro.clasificacion}</td>
                  <td>${registro.marca}</td>
                  <td>${registro.descripcion}</td>
                  <td>${registro.numeroserie}</td>
                  <td>${registro.cantidad}</td>
                  <td>
                    <a href='#' class='btn btn-danger btn-sm eliminar' data-idproducto ='${registro.idproducto}'>
                      <i class='fa-solid fa-trash'></i>
                    </a>
                    <a href='#' class='btn btn-primary btn-sm editar' data-idproducto ='${registro.idproducto}'>
                      <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                  </td>
                </tr>
              `;
              cuerpoTabla.innerHTML += fila;
            });
            $('#tabla-productos').DataTable({
              dom: 'Bfrtip',
              responsive: true,
              buttons: [
                {
                  "extend": "pdf",
                  "text": "Generar Reporte <i class='fa-solid fa-file-pdf'></i>",
                  exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                  "className": "btn btn-danger"
                }
              ],
            });
          })
          .catch(error => {
            console.log(error);
          });
      }

      function listarClasificaciones() {
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarClasificaciones")
        fetch(`../controllers/clasificacion.controller.php`, {
          method: 'POST',
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            //clasificaciones.innerHTML = ``;
            datos.forEach(registro => {
              const fila = `
              <option value="${registro.idclasificacion}">${registro.clasificacion}</option>
              `;
              clasificaciones.innerHTML += fila;
            });
          })
          .catch(error => {
            console.log(error);
          });
      }

      function listarMarcas() {
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarMarcas")
        fetch(`../controllers/marca.controller.php`, {
          method: 'POST',
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            //clasificaciones.innerHTML = ``;
            datos.forEach(registro => {
              const fila = `
              <option value="${registro.idmarca}">${registro.marca}</option>
              `;
              marca.innerHTML += fila;
            });
          })
          .catch(error => {
            console.log(error);
          });
      }

      function registrarProductos() {
        if (confirm("¿Está seguro de registrar?")) {

          const parametros = new URLSearchParams();
          parametros.append("operacion", "registrarProductos");
          parametros.append("idclasificacion", clasificaciones.value);
          parametros.append("idmarca", marca.value);
          parametros.append("descripcion", descripcion.value);
          parametros.append("numeroserie", numeroserie.value);
          parametros.append("cantidad", cantidad.value);

          fetch(`../controllers/producto.controller.php`, {
            method: 'POST',
            body: parametros
          })
            .then(respuesta => respuesta.json())
            .then(datos => {
              console.log(datos);
              if (datos.status) {
                listarProductos();
                formproducto.reset();
                clasificaciones.focus();
              } else {
                alert(datos.message);
              }
            })
            .catch(error => {
              console.log(error);
            });

        }
      }

      cuerpoTabla.addEventListener("click", (event) => {
        if (event.target.classList[0] === 'eliminar') {
          if (confirm("¿Está seguro de eliminar?")) {
            idproducto = parseInt(event.target.dataset.idproducto);

            console.log(idproducto);

            const parametros = new URLSearchParams();
            parametros.append("operacion", "eliminarProducto");
            parametros.append("idproducto", idproducto);

            fetch("../controllers/producto.controller.php", {
              method: 'POST',
              body: parametros
            })

              .then(response => response.json())
              .then(datos => {
                console.log(datos);
                if (datos.status) {
                  listarProductos();
                } else {
                  alert(datos.message);
                }
              })
          }
        }
      });

      cuerpoTabla.addEventListener("click", (event) => {
        if (event.target.classList[0] === 'editar') {
          idproducto = parseInt(event.target.dataset.idproducto);

          const parametros = new URLSearchParams();
          parametros.append("operacion", "obtenerProducto");
          parametros.append("idproducto", idproducto);
          fetch("../controllers/producto.controller.php", {
            method: 'POST',
            body: parametros
          })
            .then(response => response.json())
            .then(datos => {
              document.querySelector("#md-clasificacion").value = datos.idclasificacion;
              document.querySelector("#md-marca").value = datos.idmarca;
              document.querySelector("#md-descripcion").value = datos.descripcion;
              document.querySelector("#md-numeroserie").value = datos.numeroserie;
              document.querySelector("#md-cantidad").value = datos.cantidad;

              console.log(idclasificacion);

              modal.toggle();
            });
        }
      })

      btnGuardar.addEventListener("click", registrarProductos);


      listarProductos();
      listarClasificaciones();
      listarMarcas();

    });
  </script>

</body>

</html>