<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $tableNameUser;?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">

        <script defer src="assets/JS/HuBCsuscriptorValidation.js"></script>
    </head>

    <body>
        <div class="container-fluid position-relative d-flex p-0">
        <?php if($tableNameUser != 'Suscriptores'): ?>
            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="position-relative navbar-nav w-100">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $username;?></h6>
                        <span>Admin</span><br>
                        <a href="HUBClogoff.php">Cerrar Sesion</a>
                    </div>
                </div>
                <nav class="navbar bg-secondary navbar-dark">
                    <a href="HUBCmain.php?initialized">
                        <h3 class="text-primary">Main</h3>
                    </a>
                    <div class="navbar-nav w-100">
                        <a href="HUBCtable.php?tableNameUser=Categorias" class="nav-item nav-link">Categorias</a>
                        <a href="HUBCtable.php?tableNameUser=Directores" class="nav-item nav-link">Directores</a>
                        <a href="HUBCtable.php?tableNameUser=Actores" class="nav-item nav-link">Actores</a>
                        <a href="HUBCtable.php?tableNameUser=Peliculas" class="nav-item nav-link">Peliculas</a>
                        <a href="HUBCtable.php?tableNameUser=Reporte Suscriptores" class="nav-item nav-link">Reportes</a>
                    </div>
                </nav>
            </div>
        <?php endif; ?>
            <!-- Sidebar End -->

            <div class="container-fluid">
                <div class="container-fluid pt-4" style="min-height: 89vh">
                    <form class="bg-secondary rounded h-100 p-4" action ="" method="post" id="myForm">
              <?php if($idData != null): ?>
                        <h6 class="mb-4"><?php echo 'Editar '.$tableNameUser;?></h6>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control is-<?php echo $idDataFeedbackResult ?>" id="idData" name="idData" value="<?php echo $rowData[0];?>" readonly>
                            <label for="floatingInputNumber">ID del elemento</label>
                            <div class="<?php echo $idDataFeedbackResult ?>-feedback"><?php echo $idDataFeedbackMessage ?></div>
                        </div>
              <?php else: ?>
                        <h6 class="mb-4"><?php echo 'Agregar '.$tableNameUser;?></h6>
              <?php endif; ?>
                <?php
                    switch ($tableNameUser):
                        case 'Categorias':
                ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['categoriaFeedbackResult'] ?>" id="categoria" name="categoria" value="<?php echo $rowData[1];?>" required>
                                <label for="floatingInputText">Nombre de categoria</label>
                                <div class="<?php echo $formData['categoriaFeedbackResult'] ?>-feedback"><?php echo $formData['categoriaFeedbackMessage'] ?></div>
                            </div>             
                <?php   break;?>
                <?php   case 'Directores':
                        case 'Actores':
                ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['nombreFeedbackResult'] ?>" id="nombre" name="nombre" value="<?php echo $rowData[1];?>" required>
                                <label for="floatingInputText">Nombre</label>
                                <div class="<?php echo $formData['nombreFeedbackResult'] ?>-feedback"><?php echo $formData['nombreFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['apellidoPFeedbackResult'] ?>" id="apellidoP" name="apellidoP" value="<?php echo $rowData[2];?>" required>
                                <label for="floatingInputText">Apellido paterno</label>
                                <div class="<?php echo $formData['apellidoPFeedbackResult'] ?>-feedback"><?php echo $formData['apellidoPFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['apellidoMFeedbackResult'] ?>" id="apellidoM" name="apellidoM" value="<?php echo $rowData[3];?>" required>
                                <label for="floatingInputText">Apellido materno</label>
                                <div class="<?php echo $formData['apellidoMFeedbackResult'] ?>-feedback"><?php echo $formData['apellidoMFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['nacionalidadFeedbackResult'] ?>" id="nacionalidad" name="nacionalidad" value="<?php echo $rowData[4];?>" required>
                                <label for="floatingInputText">Nacionalidad</label>
                                <div class="<?php echo $formData['nacionalidadFeedbackResult'] ?>-feedback"><?php echo $formData['nacionalidadFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control is-<?php echo $formData['fechaNFeedbackResult'] ?>" id="fechaN" name="fechaN" value="<?php echo $rowData[5];?>" required>
                                <label for="floatingInputText">Fecha de nacimiento</label>
                                <div class="<?php echo $formData['fechaNFeedbackResult'] ?>-feedback"><?php echo $formData['fechaNFeedbackMessage'] ?></div>
                            </div>
                <?php   break;?>
                <?php   case 'Peliculas': ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['idCategoriaFeedbackResult'] ?>" id="idCategoria" name="idCategoria" value="<?php echo $rowData[1];?>" required>
                                <label for="floatingInputText">ID de la categoria de la pelicula</label>
                                <div class="<?php echo $formData['idCategoriaFeedbackResult'] ?>-feedback"><?php echo $formData['idCategoriaFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['idDirectorFeedbackResult'] ?>" id="idDirector" name="idDirector" value="<?php echo $rowData[2];?>" required>
                                <label for="floatingInputText">ID del director de la pelicula</label>
                                <div class="<?php echo $formData['idDirectorFeedbackResult'] ?>-feedback"><?php echo $formData['idDirectorFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['idActor1FeedbackResult'] ?>" id="idActor1" name="idActor1" value="<?php echo $rowData[3];?>" required>
                                <label for="floatingInputText">ID del actor 1</label>
                                <div class="<?php echo $formData['idActor1FeedbackResult'] ?>-feedback"><?php echo $formData['idActor1FeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['idActor2FeedbackResult'] ?>" id="idActor2" name="idActor2" value="<?php echo $rowData[4];?>" required>
                                <label for="floatingInputText">ID del actor 2</label>
                                <div class="<?php echo $formData['idActor2FeedbackResult'] ?>-feedback"><?php echo $formData['idActor2FeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['nombreFeedbackResult'] ?>" id="nombre" name="nombre" value="<?php echo $rowData[5];?>" required>
                                <label for="floatingInputText">Nombre de la pelicula</label>
                                <div class="<?php echo $formData['nombreFeedbackResult'] ?>-feedback"><?php echo $formData['nombreFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['paisFeedbackResult'] ?>" id="pais" name="pais" value="<?php echo $rowData[6];?>" required>
                                <label for="floatingInputText">Pais de la pelicula</label>
                                <div class="<?php echo $formData['paisFeedbackResult'] ?>-feedback"><?php echo $formData['paisFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control is-<?php echo $formData['sinopsisFeedbackResult'] ?>" id="sinopsis" name="sinopsis" style="height: 150px;" required><?php echo $rowData[7];?></textarea>
                                <label for="floatingTextarea">Sinopsis de la pelicula</label>
                                <div class="<?php echo $formData['sinopsisFeedbackResult'] ?>-feedback"><?php echo $formData['sinopsisFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['anoLanzamientoFeedbackResult'] ?>" id="anoLanzamiento" name="anoLanzamiento" value="<?php echo $rowData[8];?>" required>
                                <label for="floatingInputText">Año de lanzamiento de la pelicula</label>
                                <div class="<?php echo $formData['anoLanzamientoFeedbackResult'] ?>-feedback"><?php echo $formData['anoLanzamientoFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $formData['clasificacionFeedbackResult'] ?>" id="clasificacion" name="clasificacion" value="<?php echo $rowData[9];?>" required>
                                <label for="floatingInputText">Clasificación de la pelicula</label>
                                <div class="<?php echo $formData['clasificacionFeedbackResult'] ?>-feedback"><?php echo $formData['clasificacionFeedbackMessage'] ?></div>
                            </div>
                <?php   break;?>
                <?php   case 'Suscriptores': ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['usuarioFeedbackResult'] ?>" id="usuario" name="usuario" value="<?php echo $rowData[1];?>" required maxlength="30">
                                <label for="floatingInputText">Nombre de usuario</label>
                                <div class="<?php echo $suscriptorFormData['usuarioFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['usuarioFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control is-<?php echo $suscriptorFormData['contrasenaFeedbackResult'] ?>" id="contrasena" name="contrasena" value="<?php echo $rowData[2];?>" required maxlength="16">
                                <label for="floatingInputText">Contraseña</label>
                                <div class="<?php echo $suscriptorFormData['contrasenaFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['contrasenaFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['nombreFeedbackResult'] ?>" id="nombre" name="nombre" value="<?php echo $rowData[3];?>" required maxlength="50">
                                <label for="floatingInputText">Nombre</label>
                                <div class="<?php echo $suscriptorFormData['nombreFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['nombreFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['apellidoPFeedbackResult'] ?>" id="apellidoP" name="apellidoP" value="<?php echo $rowData[4];?>" required maxlength="50">
                                <label for="floatingInputText">Apellido Paterno</label>
                                <div class="<?php echo $suscriptorFormData['apellidoPFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['apellidoPFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['apellidoMFeedbackResult'] ?>" id="apellidoM" name="apellidoM" value="<?php echo $rowData[5];?>" required maxlength="50">
                                <label for="floatingInputText">Apellido Materno</label>
                                <div class="<?php echo $suscriptorFormData['apellidoMFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['apellidoMFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control is-<?php echo $suscriptorFormData['fechaNFeedbackResult'] ?>" id="fechaN" name="fechaN" value="<?php echo $rowData[6];?>" required>
                                <label for="floatingInputText">Fecha de Nacimiento</label>
                                <div class="<?php echo $suscriptorFormData['fechaNFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['fechaNFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['sexoFeedbackResult'] ?>" id="sexo" name="sexo" value="<?php echo $rowData[7];?>" required maxlength="1">
                                <label for="floatingInputText">Sexo</label>
                                <div class="<?php echo $suscriptorFormData['sexoFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['sexoFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['estadoNFeedbackResult'] ?>" id="estadoN" name="estadoN" value="<?php echo $rowData[8];?>" required maxlength="50">
                                <label for="floatingInputText">Estado de nacimiento</label>
                                <div class="<?php echo $suscriptorFormData['estadoNFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['estadoNFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['membresiaFeedbackResult'] ?>" id="membresia" name="membresia" value="<?php echo $rowData[9];?>" required>
                                <label for="floatingInputText">TIpo de Membresia</label>
                                <div class="<?php echo $suscriptorFormData['membresiaFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['membresiaFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['tarjetaFeedbackResult'] ?>" id="tarjeta" name="tarjeta" value="<?php echo $rowData[10];?>" required maxlength="16">
                                <label for="floatingInputText">Numero de tarjeta</label>
                                <div class="<?php echo $suscriptorFormData['tarjetaFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['tarjetaFeedbackMessage'] ?></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control is-<?php echo $suscriptorFormData['cargoFeedbackResult'] ?>" id="cargo" name="cargo" value="<?php echo $rowData[11];?>" required>
                                <label for="floatingInputText">Cargo autorizado a la tarjeta</label>
                                <div class="<?php echo $suscriptorFormData['cargoFeedbackResult'] ?>-feedback"><?php echo $suscriptorFormData['cargoFeedbackMessage'] ?></div>
                            </div>
                <?php     
                        break;
                    endswitch;
                ?>
                         <div class="text-end">
                            <input type='hidden' class="form-control is-<?php echo $generalFeedbackResult ?>" id="tableNameUser" name='tableNameUser' value="<?php echo $tableNameUser; ?>"/>
                            <div class="<?php echo $generalFeedbackResult ?>-feedback"><?php echo $generalFeedbackMessage ?></div><br>
                            <button type="submit" class="btn btn-outline-warning" name="submit" value="sent">Guardar</button>
                        </div>
                    </form>
                </div>

                <!-- Footer Start -->
                <div class="container-fluid pt-4">
                    <div class="bg-secondary rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">HuBC-PW1-Noviembre-2023</a>, All Rights Reserved.  
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                Usando:<a href="#">HTML HUBC Template</a>
                                <br>Prueba de:<a href="#" target="_blank">Prototipo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content End -->
        </div>
        <!-- Template Javascript -->
        <script src="bootstrap/bootstrap.bundle.min.js"></script>
    </body>
</html>