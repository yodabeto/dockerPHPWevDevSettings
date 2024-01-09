<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once __DIR__.'/../supportCode/HuBC_conexion.php';
require_once __DIR__.'/../supportCode/fieldValidation.php';

session_start();

$id =  $_COOKIE['auth_id'];
$username = $_COOKIE['auth_username'];
$membership = $_COOKIE['auth_membership'];

$database = new Database();
$dbconn = $database->dbConnection();

$idDataFeedbackResult ='';
$idDataFeedbackMessage='';
$generalFeedbackResult ='';
$generalFeedbackMessage='';
$idData = null;

if (!isset($_POST['submit'])) {
    if(isset($_GET['tableNameUser'])){
        $tableNameUser = $_GET['tableNameUser'];
        if(($tableNameUser!='Suscriptores') && isset($_SESSION["queryData"]) && isset($_SESSION["formData"])){  
            $queryData = $_SESSION["queryData"][$tableNameUser];
            $formData = $_SESSION["formData"][$tableNameUser];
            
            if(isset($_GET['edit_id'])){
                $idData = $_GET['edit_id'];
                $queryLocalData = array();
                $queryLocalData['customQuery'] = 'SELECT * FROM '.$queryData['tableNameDatabase'].' WHERE '.$queryData['idFieldDatabase'].'=:idData';
                $queryLocalData['bindParams'] = [':idData' => $idData];
                $stmt = $dbconn->prepare($queryLocalData['customQuery']);
                $stmt->execute($queryLocalData['bindParams']);
                if($stmt->rowCount() > 0){
                    $rowData= $stmt->fetch(PDO::FETCH_NUM);
                }
            }else{
                $queryColumns = 'DESCRIBE '.$queryData['tableNameDatabase'];
                $stmt = $dbconn->prepare($queryColumns);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    $columnsArray= array_keys($stmt->fetchall(PDO::FETCH_COLUMN));
                }
                foreach ($columnsArray as $column){
                   $rowData[$column] = '';
                }
            }
            include  __DIR__ . '/../templates/HUBCform.html.php';
    
        }elseif(isset($_SESSION["suscriptorFormData"])) {
            $tableNameUser = $_GET['tableNameUser'];
            if($tableNameUser == 'Suscriptores'){
                $suscriptorFormData = $_SESSION["suscriptorFormData"];
                $rowData =['','','','','','','','','','','',''];
        
                include  __DIR__ . '/../templates/HUBCform.html.php';
    
            }else{
                header('Location:HUBCAuthFailed.html');
                exit;
            }
        }else{
            header('Location:HUBCAuthFailed.html');
            exit;
        }
    }else{
        header('Location:HUBCAuthFailed.html');
        exit;
    }
} else {
    if(isset($_POST['tableNameUser'])){
        $tableNameUser = $_POST['tableNameUser'];
        if(($tableNameUser != 'Suscriptores') && isset($_SESSION["queryData"]) && isset($_SESSION["formData"])){
            $rowUser = NULL;
            $rowUser = $database->getIdUser($dbconn, $username, $membership);
            
            if (($rowUser !=NULL) && ($id == $rowUser['id_cliente']) && ($membership == 'admin')) {
                $tableNameUser = $_POST['tableNameUser'];
                $queryData = $_SESSION["queryData"][$tableNameUser];
                $formData = $_SESSION["formData"][$tableNameUser];
                $validationFailed = FALSE;
    
                if(isset($_POST['idData'])){
                    $rowData[0] = $idData = htmlspecialchars($_POST['idData']);
                    $validationFailed = isInvalidNumeric($idData, $validationFailed, $idDataFeedbackResult, $idDataFeedbackMessage);
                }
                
                switch ($tableNameUser) {
                    case 'Categorias':
                        $rowData[1] = $categoria = htmlspecialchars($_POST['categoria']);
                        isInvalidStr($categoria, 50, $validationFailed, $formData['categoriaFeedbackResult'], $formData['categoriaFeedbackMessage']);
                        break;
                    case 'Directores':
                    case 'Actores':
                        $rowData[1] = $nombre = htmlspecialchars($_POST['nombre']);
                        isInvalidStrWord($nombre, 50, $validationFailed, $formData['nombreFeedbackResult'], $formData['nombreFeedbackMessage']);
                        $rowData[2] = $apellidoP = htmlspecialchars($_POST['apellidoP']);
                        isInvalidStrWord($apellidoP, 50, $validationFailed, $formData['apellidoPFeedbackResult'], $formData['apellidoPFeedbackMessage']);
                        $rowData[3] = $apellidoM = htmlspecialchars($_POST['apellidoM']);
                        isInvalidStrWord($apellidoM, 50, $validationFailed, $formData['apellidoMFeedbackResult'], $formData['apellidoMFeedbackMessage']);
                        $rowData[4] = $nacionalidad = htmlspecialchars($_POST['nacionalidad']);
                        isInvalidStr($nacionalidad, 50, $validationFailed, $formData['nacionalidadFeedbackResult'], $formData['nacionalidadFeedbackMessage']);
                        $rowData[5] = $fechaN = htmlspecialchars($_POST['fechaN']);
                        $formData['nacionalidadFeedbackResult'] = 'valid';
                        $formData['nacionalidadFeedbackResult'] = '';
                        break;
                    case 'Peliculas':
                        $rowData[1] = $idCategoria = htmlspecialchars($_POST['idCategoria']);
                        isInvalidNumeric($idCategoria, $validationFailed, $formData['idCategoriaFeedbackResult'], $formData['idCategoriaFeedbackMessage']);
                        $rowData[2] = $idDirector = htmlspecialchars($_POST['idDirector']);
                        isInvalidNumeric($idDirector, $validationFailed, $formData['idDirectorFeedbackResult'], $formData['idDirectorFeedbackMessage']);
                        $rowData[3] = $idActor1 = htmlspecialchars($_POST['idActor1']);
                        isInvalidNumeric($idActor1, $validationFailed, $formData['idActor1FeedbackResult'], $formData['idActor1FeedbackMessage']);
                        $rowData[4] = $idActor2 = htmlspecialchars($_POST['idActor2']);
                        isInvalidNumeric($idActor2, $validationFailed, $formData['idActor2FeedbackResult'], $formData['idActor2FeedbackMessage']);
                        $rowData[5] = $nombre = htmlspecialchars($_POST['nombre']);
                        isInvalidStr($nombre, 50, $validationFailed, $formData['nombreFeedbackResult'], $formData['nombreFeedbackMessage']);
                        $rowData[6] = $pais = htmlspecialchars($_POST['pais']);
                        isInvalidStr($pais, 50, $validationFailed, $formData['paisFeedbackResult'], $formData['paisFeedbackMessage']);
                        $rowData[7] = $sinopsis = htmlspecialchars($_POST['sinopsis']);
                        isInvalidStr($sinopsis, 200, $validationFailed, $formData['sinopsisFeedbackResult'], $formData['sinopsisFeedbackMessage']);
                        $rowData[8] = $anoLanzamiento = htmlspecialchars($_POST['anoLanzamiento']);
                        isInvalidYear($anoLanzamiento, $validationFailed, $formData['anoLanzamientoFeedbackResult'], $formData['anoLanzamientoFeedbackMessage']);
                        $rowData[9] = $clasificacion = htmlspecialchars($_POST['clasificacion']);
                        isInvalidStr($clasificacion, 50, $validationFailed, $formData['clasificacionFeedbackResult'], $formData['clasificacionFeedbackMessage']);
                        break;
                }
                if($validationFailed){
                    include  __DIR__ . '/../templates/HUBCform.html.php';
                }else{
                    try{
                        $queryLocalData = array();
                        if($idData != null){
                            switch ($tableNameUser) {
                                case 'Categorias':
                                    $queryLocalData['customQuery'] = 'UPDATE '.$queryData['tableNameDatabase'].' SET categoria = :categoria WHERE id_categoria = :idData';
                                    $queryLocalData['bindParams'] = ['categoria' => $categoria, 'idData' => $idData];
                                    break;
                                case 'Directores':
                                    $queryLocalData['customQuery'] = 'UPDATE '.$queryData['tableNameDatabase'].' SET nombre = :nombre, ap_paterno = :apellidoP, ap_materno = :apellidoM, nacionalidad = :nacionalidad, fecha_nacimiento = :fechaN WHERE id_director = :idData';
                                    $queryLocalData['bindParams'] = ['nombre' => $nombre, 'apellidoP' => $apellidoP, 'apellidoM' => $apellidoM, 'nacionalidad' => $nacionalidad, 'fechaN' => $fechaN, 'idData' => $idData];
                                case 'Actores':
                                    $queryLocalData['customQuery'] = 'UPDATE '.$queryData['tableNameDatabase'].' SET nombre = :nombre, ap_paterno = :apellidoP, ap_materno = :apellidoM, nacionalidad = :nacionalidad, fecha_nacimiento = :fechaN WHERE id_actor = :idData';
                                    $queryLocalData['bindParams'] = ['nombre' => $nombre, 'apellidoP' => $apellidoP, 'apellidoM' => $apellidoM, 'nacionalidad' => $nacionalidad, 'fechaN' => $fechaN, 'idData' => $idData];
                                    break;
                                case 'Peliculas':
                                    $queryLocalData['customQuery'] = 'UPDATE '.$queryData['tableNameDatabase'].' SET id_categoria = :idCategoria, id_director = :idDirector, id_actor1 = :idActor1, id_actor2 = :idActor2, nombre = :nombre, pais = :pais, sinopsis = :sinopsis, ano_lanzamiento = :anoLanzamiento, clasificacion = :clasificacion WHERE id_pelicula = :idData';
                                    $queryLocalData['bindParams'] = ['idCategoria' => $idCategoria, 'idDirector' => $idDirector, 'idActor1' => $idActor1, 'idActor2' => $idActor2, 'nombre' => $nombre, 'pais' => $pais, 'sinopsis' => $sinopsis, 'anoLanzamiento' => $anoLanzamiento, 'clasificacion' => $clasificacion, 'idData' => $idData];
                                    break;
                            }
                            $redirectLocation = 'Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&updated';
                        }else{
                            switch ($tableNameUser) {
                                case 'Categorias':
                                    $queryLocalData['customQuery'] = 'INSERT INTO '.$queryData['tableNameDatabase'].' (categoria) VALUES(:categoria)';
                                    $queryLocalData['bindParams'] = ['categoria' => $categoria];
                                    break;
                                case 'Directores':
                                case 'Actores':
                                    $queryLocalData['customQuery'] = 'INSERT INTO '.$queryData['tableNameDatabase'].' (nombre, ap_paterno, ap_materno, nacionalidad, fecha_nacimiento) VALUES(:nombre, :apellidoP, :apellidoM, :nacionalidad, :fechaN)';
                                    $queryLocalData['bindParams'] = ['nombre' => $nombre, 'apellidoP' => $apellidoP, 'apellidoM' => $apellidoM, 'nacionalidad' => $nacionalidad, 'fechaN' => $fechaN];
                                    break;
                                case 'Peliculas':
                                    $queryLocalData['customQuery'] = 'INSERT INTO '.$queryData['tableNameDatabase'].' (id_categoria, id_director, id_actor1, id_actor2, nombre, pais, sinopsis, ano_lanzamiento, clasificacion) VALUES(:idCategoria, :idDirector, :idActor1, :idActor2, :nombre, :pais, :sinopsis, :anoLanzamiento, :clasificacion)';
                                    $queryLocalData['bindParams'] = ['idCategoria' => $idCategoria, 'idDirector' => $idDirector, 'idActor1' => $idActor1, 'idActor2' => $idActor2, 'nombre' => $nombre, 'pais' => $pais, 'sinopsis' => $sinopsis, 'anoLanzamiento' => $anoLanzamiento, 'clasificacion' => $clasificacion];
                                    break;
                            }
                            $redirectLocation = 'Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&inserted';
                        }
                        $stmt = $dbconn->prepare($queryLocalData['customQuery']);
                        $stmt->execute($queryLocalData['bindParams']);
                        if($stmt->rowCount() > 0){
                            header($redirectLocation);
                            exit;
                        }else{
                            header('Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&error');
                            exit;
                        }
                    }catch(PDOException $e){
                        $formData = $_SESSION["formData"][$tableNameUser];
                        $generalFeedbackResult ='invalid';
                        $generalFeedbackMessage='Los datos violan la integridad de la base de datos. Verifiquelos';
                        include  __DIR__ . '/../templates/HUBCform.html.php';
                    }
                }
            }else{
                header('Location:HUBCAuthFailed.html');
                exit;
            }
        }elseif(isset($_SESSION["suscriptorFormData"])){
            $tableNameUser = $_GET['tableNameUser'];
            if($tableNameUser == 'Suscriptores'){
                $suscriptorFormData = $_SESSION["suscriptorFormData"];
                $rowData[1] = $usuario = htmlspecialchars($_POST['usuario']);
                $rowData[2] = $contrasena = htmlspecialchars($_POST['contrasena']);
                $rowData[3] = $nombre = htmlspecialchars($_POST['nombre']);
                $rowData[4] = $apellidoP = htmlspecialchars($_POST['apellidoP']);
                $rowData[5] = $apellidoM = htmlspecialchars($_POST['apellidoM']);
                $rowData[6] = $fechaN = htmlspecialchars($_POST['fechaN']);
                $rowData[7] = $sexo = htmlspecialchars($_POST['sexo']);
                $rowData[8] = $estadoN = htmlspecialchars($_POST['estadoN']);
                $rowData[9] = $membresia = htmlspecialchars($_POST['membresia']);
                $rowData[10] = $tarjeta = htmlspecialchars($_POST['tarjeta']);
                $rowData[11] = $cargo = htmlspecialchars($_POST['cargo']);
                $RFC = htmlspecialchars($_POST['CURP']);
                $CURP = htmlspecialchars($_POST['CURP']);
                $fechaI = htmlspecialchars($_POST['fechaI']);
                $fechaT = htmlspecialchars($_POST['fechaT']);

                $queryLocalData = array();
                $queryLocalData['customQuery'] = 'INSERT INTO tblcliente (nombre_usuario, contrasena, nombre, ap_paterno, ap_materno, RFC, CURP, tipo_membresia, fecha_inicio, fecha_termino, tarjeta) VALUES(:usuario, :contrasena, :nombre, :apellidoP, :apellidoM, :RFC, :CURP, :membresia, :fechaI, :fechaT, :tarjeta)';
                $queryLocalData['bindParams'] = ['usuario' => $usuario, 'contrasena' => $contrasena, 'nombre' => $nombre, 'apellidoP' => $apellidoP, 'apellidoM' => $apellidoM, 'RFC' => $RFC, 'CURP' => $CURP, 'membresia' => 'suscriptor', 'fechaI' => $fechaI, 'fechaT' => $fechaT, 'tarjeta' => $tarjeta];
                try{
                    $stmt = $dbconn->prepare($queryLocalData['customQuery']);
                    $stmt->execute($queryLocalData['bindParams']);
                    if($stmt->rowCount() > 0){
                        header('Location: index.php');
                        exit;
                    }else{
                        $suscriptorFormData = $_SESSION["suscriptorFormData"];
                        $generalFeedbackResult ='invalid';
                        $generalFeedbackMessage='No fue posible crear el nuevo usuario';
                    }
                }catch(PDOException $e){
                    $suscriptorFormData = $_SESSION["suscriptorFormData"];
                    $generalFeedbackResult ='invalid';
                    $generalFeedbackMessage='Los datos violan la integridad de la base de datos. Verifiquelos';
                    include  __DIR__ . '/../templates/HUBCform.html.php';
                }
            }else{
                header('Location:HUBCAuthFailed.html');
                exit;
            }
    
        }else{
            header('Location:HUBCAuthFailed.html');
            exit;
        }
    }else{
        header('Location:HUBCAuthFailed.html');
        exit;
    }
}
