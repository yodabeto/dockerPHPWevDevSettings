<?php
class Database {
    private $host = "mysql";
    private $dbName = "streamingHuBC";
    private $username = "root";
    private $password = "localhubc";

    public $conn;

    public function dbConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getFullLoginInfo($dbconn, $username, $pass) {
        $rowUser = NULL;
        try{
            $stmt = $dbconn->prepare('SELECT id_cliente, tipo_membresia FROM tblcliente WHERE nombre_usuario=:nombre_usuario AND contrasena=:contrasena');
            $stmt->bindparam(':nombre_usuario', $username);
            $stmt->bindparam(':contrasena', $pass);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $rowUser;
    }

    public function getIdUser($dbconn, $username, $membership) {
        $rowUser = NULL;
        try{
            $stmt = $dbconn->prepare('SELECT id_cliente FROM tblcliente WHERE nombre_usuario=:nombre_usuario AND tipo_membresia=:membresia');
            $stmt->bindparam(':nombre_usuario', $username);
            $stmt->bindparam(':membresia', $membership);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $rowUser;
    }

    public function getColumnsNoBindQuery($dbconn, $query) {
        $columnsArray = NULL;
        $stmt = $dbconn->prepare($query.' LIMIT 1');
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $columnsArray= array_keys($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $columnsArray;
    }

    public function getColumnsBindedQuery($dbconn, array $queryData) {
        $columnsArray = NULL;
        $stmt = $dbconn->prepare($queryData['customQuery'].' LIMIT 1');
        $stmt->execute($queryData['bindParams']);
        if($stmt->rowCount() > 0){
            $columnsArray= array_keys($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $columnsArray;
    }
}

?>
