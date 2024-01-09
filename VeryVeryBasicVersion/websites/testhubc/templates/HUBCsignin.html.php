<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Control de acceso</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    </head>

    <body>
        <div class="container-fluid position-relative d-flex p-0">
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center text-center" style="min-height: 93.5vh">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-7">
                        <div class="bg-secondary rounded p-4 p-sm-5">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3 class="text-primary">Plataforma de streaming</h3>
                                <h3>Datos de acceso</h3>
                            </div>
                            <form class="form-floating mb-4" action ="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>" placeholder="TuNombreDeUsuario" required>
                                    <label for="floatingInput">Nombre de usuario</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="TuContraseña" required>
                                    <label for="floatingPassword">Contraseña</label>
                                    <input type='hidden' class="form-control is-<?php echo $loginFeedbackResult ?>"/>
                                    <div class="<?php echo $loginFeedbackResult ?>-feedback text-start"><?php echo $loginFeedbackMessage ?></div>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit" value="sent">Iniciar sesión</button>
                                <a class="btn btn-warning w-30 text-center" href="HUBCform.php?tableNameUser=Suscriptores">Suscribirse</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-secondary text-white text-center">
            <div class="container-fluid pt-4">
                <div class="bg-secondary rounded-top">
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
        </footer>
        <!-- Template Javascript -->
        <script src="bootstrap/bootstrap.bundle.min.js"></script>
    </body>
</html>