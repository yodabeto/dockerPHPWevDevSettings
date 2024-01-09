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
                        <span>Suscriptor</span><br>
                        <a href="HUBClogoff.php">Cerrar Sesion</a>
                    </div>
                </div>
                <nav class="navbar bg-secondary navbar-dark">
                    <a href="HUBCmain.php?initialized">
                        <h3 class="text-primary">Main</h3>
                    </a>
                    <div class="navbar-nav w-100">
                        <a href="HUBCtable.php?tableNameUser=Peliculas" class="nav-item nav-link">Peliculas</a>
                        <a href="HUBCtable.php?tableNameUser=Visto recientemente" class="nav-item nav-link">Visto recientemente</a>
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->

            <div class="container-fluid">
            <?php if(isset($_GET['watched'])): ?>
                <div class="alert alert-warning alert-dismissable sticky-top fade show" role="alert">
                Pelicula vista y agregada al historial!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  </button>
                </div>
            <?php endif; ?>
                <div class="container-fluid pt-4">
                    <div class="row bg-secondary rounded justify-content-center mx-0" style="min-height: 87vh">
                        <div class="col-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4"><?php echo $tableNameUser;?></h6>     
                                <div class="table">
                                    <table class="table table-hover">   
                                        <thead>
                                            <tr>
                                            <?php if($columnsArray != null): ?>
                                            <?php   foreach ($columnsArray as $column): ?>        
                                                        <th><?php echo $column; ?></th>
                                            <?php   endforeach;
                                                  endif;
                                            ?>
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
                                                    <?php endforeach; ?>
                                                    <?php if($tableNameUser == 'Peliculas'): ?>
                                                            <td>
                                                                <a class="btn btn-danger btn-sm" href="HUBCtable.php?tableNameUser=Peliculas&amp;watch_id=<?php echo $rowsArray[0]; ?>">Ver</a>
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