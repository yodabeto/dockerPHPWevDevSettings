<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once __DIR__.'/../supportCode/HuBC_conexion.php';

$id =  $_COOKIE['auth_id'];
$username = $_COOKIE['auth_username'];
$membership = $_COOKIE['auth_membership'];

$database = new Database();
$dbconn = $database->dbConnection();
$rowUser = NULL;
$rowUser = $database->getIdUser($dbconn, $username, $membership);

if (($rowUser !=NULL) && ($id == $rowUser['id_cliente'])){
    if(!isset($_GET['initialized'])){
        if($membership == 'admin'){
            $queryData = array();
            $queryData['Categorias']           = ['queryType' => 'idFilter',     'report' => FALSE, 'tableNameDatabase' => 'tblcategoria', 'idFieldDatabase' => 'id_categoria'];
            $queryData['Directores']           = ['queryType' => 'idFilter',     'report' => FALSE, 'tableNameDatabase' => 'tbldirector',  'idFieldDatabase' => 'id_director'];
            $queryData['Actores']              = ['queryType' => 'idFilter',     'report' => FALSE, 'tableNameDatabase' => 'tblactor',     'idFieldDatabase' => 'id_actor'];
            $queryData['Peliculas']            = ['queryType' => 'idFilter',     'report' => FALSE, 'tableNameDatabase' => 'tblpelicula',  'idFieldDatabase' => 'id_pelicula'];
            $queryData['Reporte Suscriptores'] = ['queryType' => 'customFilter', 'report' => TRUE, 'tableNameDatabase' => 'tblcliente', 'filterField' => 'tipo_membresia', 'filterValue' => 'suscriptor', 'nextTableNameUser' => 'Reporte Historial'];
            $queryData['Reporte Historial'] = [
                'queryType'         => 'customQuery',
                'report'            => TRUE,
                'customQuery'       => 'SELECT id_pelicula, nombre, clasificacion, veces, ultima_fecha 
                                        FROM tblhistorial 
                                        JOIN tblpelicula USING(id_pelicula)',
                'filterField'       => 'id_cliente',
                'nextTableNameUser' => 'Peliculas'];
            
            $formData = array();
            $formData['Categorias'] = ['categoriaFeedbackResult' => '', 'categoriaFeedbackMessage' => ''];
            $formData['Directores'] = [
                'nombreFeedbackResult'       => '',       'nombreFeedbackMessage' => '',
                'apellidoPFeedbackResult'    => '',    'apellidoPFeedbackMessage' => '',
                'apellidoMFeedbackResult'    => '',    'apellidoMFeedbackMessage' => '',
                'nacionalidadFeedbackResult' => '', 'nacionalidadFeedbackMessage' => '',
                'fechaNFeedbackResult'       => '',       'fechaNFeedbackMessage' => ''
            ];
            $formData['Actores'] = [
                'nombreFeedbackResult'       => '',       'nombreFeedbackMessage' => '',
                'apellidoPFeedbackResult'    => '',    'apellidoPFeedbackMessage' => '',
                'apellidoMFeedbackResult'    => '',    'apellidoMFeedbackMessage' => '',
                'nacionalidadFeedbackResult' => '', 'nacionalidadFeedbackMessage' => '',
                'fechaNFeedbackResult'       => '',       'fechaNFeedbackMessage' => ''
            ];
            $formData['Peliculas'] = [
                'idCategoriaFeedbackResult'   => '',    'idCategoriaFeedbackMessage' => '',
                'idDirectorFeedbackResult'    => '',     'idDirectorFeedbackMessage' => '',
                'idActor1FeedbackResult'      => '',       'idActor1FeedbackMessage' => '',
                'idActor2FeedbackResult'      => '',       'idActor2FeedbackMessage' => '',
                'nombreFeedbackResult'        => '',         'nombreFeedbackMessage' => '',
                'paisFeedbackResult'          => '',           'paisFeedbackMessage' => '',
                'sinopsisFeedbackResult'      => '',       'sinopsisFeedbackMessage' => '',
                'anoLanzamientoFeedbackResult'=> '', 'anoLanzamientoFeedbackMessage' => '',
                'clasificacionFeedbackResult' => '',  'clasificacionFeedbackMessage' => ''
            ];

        }else{
            $queryData = array();
            $queryData['Peliculas']           = ['queryType' => 'idFilter', 'report' => FALSE, 'tableNameDatabase' => 'tblpelicula', 'idFieldDatabase' => 'id_pelicula'];
            $queryData['Visto recientemente'] = [
                'queryType'   => 'customQuery',
                'report'      => FALSE,
                'customQuery' => 'SELECT nombre, clasificacion, veces, ultima_fecha
                                  FROM tblhistorial
                                  JOIN tblpelicula USING(id_pelicula) 
                                  WHERE id_cliente =:id',
                'bindParams'  => ['id' => $id]                
            ];

            $formData = array();
        }
        session_start();
        $_SESSION['queryData'] = $queryData;
        $_SESSION['formData'] = $formData;
    }

    if($membership == 'admin'){
        $template = __DIR__ . '/../templates/HUBCmainAdmin.html.php';
    }else{
        $template = __DIR__ . '/../templates/HUBCmainUser.html.php';
    }
    include  $template;

}else{
    header('Location:HUBCAuthFailed.html');
    exit;
}
