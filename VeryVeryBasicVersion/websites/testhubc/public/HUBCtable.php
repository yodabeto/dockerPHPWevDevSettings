<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once __DIR__.'/../supportCode/HuBC_conexion.php';

session_start();

$id =  $_COOKIE['auth_id'];
$username = $_COOKIE['auth_username'];
$membership = $_COOKIE['auth_membership'];

$database = new Database();
$dbconn = $database->dbConnection();
$rowUser = NULL;
$rowUser = $database->getIdUser($dbconn, $username, $membership);

if (($rowUser !=NULL) && ($id == $rowUser['id_cliente'])) {
    if(isset($_GET['tableNameUser']) && isset($_SESSION["queryData"])){
        $tableNameUser = $_GET['tableNameUser'];
        $queryData = $_SESSION["queryData"][$tableNameUser];

        if($membership == 'admin'){
            $template = __DIR__ . '/../templates/HUBCtableAdmin.html.php';

            if(isset($_GET['delete_id'])){
                $idData = $_GET['delete_id'];
                try{
                    if($idData != null){
                        $stmt = $dbconn->prepare('DELETE FROM '.$queryData['tableNameDatabase'].' WHERE '.$queryData['idFieldDatabase'].' = :idData');
                        $stmt->bindparam(':idData', $idData);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0){
                            header('Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&deleted');
                            exit;
                        }
                    }else{
                    var_dump($idData);
                    }
                }catch(PDOException $e){
                    header('Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&errorIntegridad');
                }
            }
        }else{
            $template = __DIR__ . '/../templates/HUBCtableUser.html.php';

            if(isset($_GET['watch_id'])){
                $idData = $_GET['watch_id'];
                try{
                    if($idData != null){
                        $insertRows = 'INSERT INTO tblhistorial (id_cliente, id_pelicula, veces, ultima_fecha)
                                        VALUES(:id, :idData, :count, :lastSeen)
                                        ON DUPLICATE KEY UPDATE veces=veces+1, ultima_fecha=VALUES(ultima_fecha)';
                        $stmt = $dbconn->prepare($insertRows);
                        $stmt->bindparam(':id', $id);
                        $stmt->bindparam(':idData', $idData);
                        $stmt->bindvalue(':count', 1, PDO::PARAM_INT);
                        $stmt->bindvalue(':lastSeen', date("Y-m-d"), PDO::PARAM_STR);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0){
                            header('Location: HUBCtable.php?tableNameUser='.$tableNameUser.'&watched');
                            exit;
                        }
                    }else{
                    var_dump($idData);
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        if($queryData['report'] == TRUE){
            $columnsArray = null;
            if($queryData['queryType'] == 'customQuery'){
                $columnsArray = $database->getColumnsNoBindQuery($dbconn, $queryData['customQuery']);
                if(isset($_GET['chain_id'])){
                    $idData = $_GET['chain_id'];
                    $queryLocalData['customQuery'] = $queryData['customQuery'].' WHERE '.$queryData['filterField'].'=:filterValue';
                    $queryLocalData['bindParams'] = [':filterValue' => $idData];
                    $stmtRows = $dbconn->prepare($queryLocalData['customQuery']);
                    $stmtRows->execute($queryLocalData['bindParams']);
                }
            }else{
                $query = 'SELECT * FROM '.$queryData['tableNameDatabase'];
                $columnsArray= $database->getColumnsNoBindQuery($dbconn, $query);
                
                if($queryData['queryType'] == 'customFilter'){
                    $queryLocalData = array();
                    $queryLocalData['customQuery'] = 'SELECT * FROM '.$queryData['tableNameDatabase'].' WHERE '.$queryData['filterField'].'=:filterValue';
                    $queryLocalData['bindParams'] = [':filterValue' => $queryData['filterValue']];
                    $stmtRows = $dbconn->prepare($queryLocalData['customQuery']);
                    $stmtRows->execute($queryLocalData['bindParams']);
                }else{
                    $stmtRows = $dbconn->prepare('SELECT * FROM '.$queryData['tableNameDatabase']);
                    $stmtRows->execute();
                }
            }
            $nextTableNameUser = $queryData['nextTableNameUser'];
        }else{
            $columnsArray = null;
            if($queryData['queryType'] == 'customQuery'){
                $columnsArray = $database->getColumnsBindedQuery($dbconn, $queryData);
                $stmtRows = $dbconn->prepare($queryData['customQuery']);
                $stmtRows->execute($queryData['bindParams']);
            }else{
                $query = 'SELECT * FROM '.$queryData['tableNameDatabase'];
                $columnsArray= $database->getColumnsNoBindQuery($dbconn, $query);
                $stmtRows = $dbconn->prepare('SELECT * FROM '.$queryData['tableNameDatabase']);
                $stmtRows->execute();   
            }
        }
    }else{
        $tableNameUser = 'Peliculas';
        $columnsArray = null;
        $query = 'SELECT * FROM tblpelicula';
        $columnsArray= $database->getColumnsNoBindQuery($dbconn, $query);
        $stmtRows = $dbconn->prepare('SELECT * FROM tblpelicula');
        $stmRows->execute();
    }
    
    include  $template;
}else{
    header('Location: HUBCAuthFailed.html');
    exit;
}