<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SUSCRIBER</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/CSS/HuBCcarouselStyles.css">

        <script defer src="assets/JS/HuBCcarousel.js"></script>
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
                <div class="container-fluid row pt-4 text-center">
                <h3>Menu principal del suscriptor</h3>
                    <div class="row bg-secondary rounded align-items-center justify-content-center mx-0" style="min-height: 87vh">
                        <div class="col-md-8 align-self-start">
                            <h1>Estrenos</h1>
                            <div class="thumb-bar">
                                
                            </div>
                            <figure class="full-img">
                                <img class="displayed-img" src="assets/imagenes/pic1.jpg">
                                <figcaption class="caption">The Shining</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-4 align-self-start" id="filmData">
                            <h1>Datos de pelicula</h1>

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