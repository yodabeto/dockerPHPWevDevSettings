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

if (($rowUser !=NULL) && ($id == $rowUser['id_cliente'])) {
    if(isset($_POST['filmName'])){
        $filmName = $_POST['filmName'];

        $columnsArray= $database->getColumnsNoBindQuery($dbconn, 'SELECT * FROM tblpelicula');
        $stmtRows = $dbconn->prepare('SELECT * FROM tblpelicula WHERE nombre =:nombre');
        $stmtRows->bindparam(':nombre', $filmName);
        $stmtRows->execute();
        if($stmtRows->rowCount() > 0){
            while($rowsArray= $stmtRows->fetch(PDO::FETCH_BOTH)){
                foreach ($columnsArray as $column){
                    echo '<h4>'.$column.': '.$rowsArray[$column].'</h4>';
                }
                echo '<br>';
            }
        }
    }else{
        echo "<p>HTTP POST request invalido</p>";
    }
    
}else{
    echo "<p>Verifique sus datos de acceso a la plataforma</p>";
}
?>