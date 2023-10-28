<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <title>Prueba</title>
    </head>
    <body>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Generar Usuarios</button>
                <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Detalles de Usuarios</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="container">
                    <h1 class="text-center">Generador de Usuarios</h1>

                    <div class="row">
                        <div class="col-2 offset-10">
                            <div class="text-center">
                                <button type="button" class="btn btn-primary w-100" id="botonGenerar">
                                <i class="bi bi-person-add"></i> Generar
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="datos-aleatorios" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apelido</th>
                                    <th>Edad</th>
                                </tr>
                            </thead>
                        </table>
                        <button type="submit" class="btn btn-primary w-100"  data-target="#modalUsuario" id="botonGuardar">Guardar</button>
                    </div>
                </div>
            </div>
         <!-- tabla incio -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="container">
                    <h1 class="text-center">Detalles de Usuarios</h1>
                        <br>
                        <br>
                    <div class="table-responsive">
                        <table id="datos-usuarios" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Edad</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!----modal----->

    <div class="modal fade" id="modalUsuario"  aria-labelledby="modalUsuario" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formulario" encyype="multipart/form-data">
                    <div class="modal-body">
                        <div class="modal-content border-0">
                            <label for="nombre">Ingrese el nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                            <label for="apellido">Ingrese el apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                            <label for="edad">Ingrese la edad</label>
                            <input type="text" name="edad" id="edad" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_usuario"  id="id_usuario">
                            <button type="submit" name="action" id="action" class="btn btn-success" > Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./front/script.js"></script>
</body>
</html>