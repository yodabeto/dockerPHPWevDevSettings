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
    </head>

    <body>
        <div class="container-fluid position-relative d-flex p-0">
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
            <!-- Sidebar End -->

            <div class="container-fluid">
            <?php if(isset($_GET['updated'])): ?>
                <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                Actualizado correctamente!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  </button>
                </div>
            <?php elseif(isset($_GET['deleted'])): ?>
                    <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                    Eliminado correctamente!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </button>
                    </div>
            <?php elseif(isset($_GET['inserted'])): ?>
                    <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                    Insertado correctamente!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </button>
                    </div>
            <?php elseif(isset($_GET['errorIntegridad'])): ?>
                    <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                    No se puede eliminar, ya esta siendo usado en otro elemento!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </button>
                    </div>
            <?php elseif(isset($_GET['error'])): ?>
                    <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                    Error en DB! Algo salio mal al ejecutar la operación, intentalo denuevo!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                      </button>
                    </div>
            <?php endif; ?>
                <div class="container-fluid pt-4">
                    <div class="row bg-secondary rounded justify-content-center mx-0" style="min-height: 87vh">
                        <div class="col-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4"><?php echo $tableNameUser;?></h6>
                          <?php if(($membership == 'admin') && ($queryData['report'] == FALSE)): ?>
                                    <a href="HUBCform.php?tableNameUser=<?php echo $tableNameUser; ?>" class="btn btn-outline-warning">Añadir nuevo</a><br><br>
                          <?php endif; ?>        
                                <div class="table">
                                    <table class="table table-hover">   
                                        <thead>
                                            <tr>
                                            <?php if($columnsArray != null):   
                                                    foreach ($columnsArray as $column):
                                            ?>        
                                                        <th><?php echo $column; ?></th>
                                            <?php   endforeach;
                                                  endif;
                                            ?>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                        <?php
                                            if($stmtRows->rowCount() > 0):
                                                while($rowsArray= $stmtRows->fetch(PDO::FETCH_BOTH)):
                                        ?>
                                                    <tr>
                                                    <?php foreach ($columnsArray as $column): ?>
                                                              <td><?php echo $rowsArray[$column]; ?></td>
                                                    <?php endforeach; 
                                                          if(($membership == 'admin') && ($queryData['report'] == FALSE)): 
                                                    ?>
                                                              <td>
                                                                  <a class="btn btn-danger btn-sm" href="HUBCform.php?tableNameUser=<?php echo $tableNameUser; ?>&amp;edit_id=<?php echo $rowsArray[0]; ?>">Editar</a>
                                                              </td>
                                                              <td>
                                                                  <a class="btn btn-danger btn-sm" href="HUBCtable.php?tableNameUser=<?php echo $tableNameUser; ?>&amp;delete_id=<?php echo $rowsArray[0]; ?>">Eliminar</a>
                                                              </td>
                                                    <?php elseif(($queryData['report'] == TRUE) & ($nextTableNameUser == 'Peliculas')): ?>
                                                              <td>
                                                                  <a class="btn btn-danger btn-sm" href="HUBCform.php?tableNameUser=<?php echo $nextTableNameUser; ?>&amp;edit_id=<?php echo $rowsArray[0]; ?>">Ver detalle</a>
                                                              </td>         
                                                    <?php elseif($queryData['report'] == TRUE): ?>
                                                              <td>
                                                                  <a class="btn btn-danger btn-sm" href="HUBCtable.php?tableNameUser=<?php echo $nextTableNameUser; ?>&amp;chain_id=<?php echo $rowsArray[0]; ?>">Ver detalle</a>
                                                              </td>
                                                    <?php endif; ?>
                                                    </tr>
                                        <?php
                                                endwhile; 
                                            endif;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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