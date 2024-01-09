<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once __DIR__.'/../supportCode/HuBC_conexion.php';

$loginFeedbackResult = '';
$loginFeedbackMessage = '';

$suscriptorFormData = array();
$suscriptorFormData = [
    'usuarioFeedbackResult'   => '',   'usuarioFeedbackMessage' => '',
    'contrasenaFeedbackResult'=> '','contrasenaFeedbackMessage' => '',
    'nombreFeedbackResult'    => '',    'nombreFeedbackMessage' => '',
    'apellidoPFeedbackResult' => '', 'apellidoPFeedbackMessage' => '',
    'apellidoMFeedbackResult' => '', 'apellidoMFeedbackMessage' => '',
    'tarjetaFeedbackResult'   => '',   'tarjetaFeedbackMessage' => '',
    'cargoFeedbackResult'     => '',     'cargoFeedbackMessage' => '',
    'fechaNFeedbackResult'    => '',    'fechaNFeedbackMessage' => '',
    'sexoFeedbackResult'      => '',      'sexoFeedbackMessage' => '',
    'estadoNFeedbackResult'   => '',   'estadoNFeedbackMessage' => '',
    'membresiaFeedbackResult' => '', 'membresiaFeedbackMessage' => '',
    'tarjetaFeedbackResult'   => '',   'tarjetaFeedbackMessage' => '',
    'cargoFeedbackResult'     => '',     'cargoFeedbackMessage' => ''
];

session_start();
$_SESSION['suscriptorFormData'] = $suscriptorFormData;

if (!isset($_POST['submit'])) {
    $username ='';
    include  __DIR__ . '/../templates/HUBCsignin.html.php';
} else {
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
	
    $database = new Database();
    $dbconn = $database->dbConnection();
    $rowUser = NULL;
    $rowUser= $database->getFullLoginInfo($dbconn, $username, $pass);
    
    if ($rowUser == NULL){
        $loginFeedbackResult = 'invalid';
        $loginFeedbackMessage = 'El usuario o contraseña no son correctos';
        include  __DIR__ . '/../templates/HUBCsignin.html.php';
    } else{   
        $id = $rowUser['id_cliente'];
        $membership = $rowUser['tipo_membresia'];

        setcookie('auth_id',$id);
        setcookie('auth_username',$username);
        setcookie('auth_membership',$membership);

        header('Location:HUBCmain.php');
        exit;
    }
}