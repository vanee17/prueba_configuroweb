<?php

class Crud{
    private $conn;
    private  $dataToSave;
    public function __construct(){
        include('../config/db.php');
        $obj = new db();
        $this->conn = $obj->connection(); 
    }

    public function createUser(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataToSave = $_POST['data'];
            // Itera a través de los datos y realiza la inserción
            foreach ($dataToSave as $row) {
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $edad = (int) $row['edad'];
        
                // Realiza la inserción en la base de datos

                $query = $this->conn->prepare('INSERT INTO prueba.usuarios (us_nombre, us_apellido, edad) VALUES (?, ?, ?)');
                $query->bindParam(1, $nombre);
                $query->bindParam(2, $apellido);
                $query->bindParam(3, $edad);

                if ($query->execute()) {
                    // Operación exitosa
                } else {
                    echo "Error al guardar los datos: " . $query->error;
                }
            }
            print_r($this->getUsers());
        }

    }

    public function getUsers(){
        $query = $this->conn->prepare('SELECT * FROM prueba.usuarios');
        $query->execute();
        $res = $query->fetchAll();
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        foreach($res as $item){
            $data =[];
            $data['us_nombre'] = $item['us_nombre'];
            $data['us_apellido'] = $item['us_apellido'];
            $data['edad'] = $item['edad'];
            $data['edit'] = '<button type="button" name="editar" id="'.$item['id'].'" class="btn btn-warning btn-xs editar"> Editar </button>';
            $data['delete'] = '<button type="button" name="borrar" id="'.$item['id'].'" class="btn btn-danger btn-xs borrar"> Borrar </button>';
            $dataAll[] = $data;
        }

        echo json_encode($dataAll);
    }

    public function getUser(){
        if (isset($_POST["id_usuario"])) {
            $data =  array();
            $query = $this->conn->prepare("SELECT * FROM prueba.usuarios WHERE id = '".$_POST["id_usuario"]."' LIMIT 1");
            $query->execute();
            $res =  $query->fetchAll();
            foreach($res as $item ){
                $data["nombre"] = $item["us_nombre"];
                $data["apellido"] = $item["us_apellido"];
                $data["edad"] = $item["edad"];
            }
    
            echo json_encode($data);
        }
    }

    public function editUser(){
        if (isset($_POST['nombre']) && isset($_POST["apellido"]) && isset($_POST["edad"])) {

            $query = $this->conn->prepare("UPDATE prueba.usuarios SET us_nombre = :nombre, us_apellido = :apellido, edad = :edad WHERE id = :id");
            $res = $query->execute(
                array(
                    ':nombre'   =>$_POST["nombre"],
                    ':apellido'   =>$_POST["apellido"],
                    ':edad'   =>$_POST["edad"],
                    ':id' =>$_POST["id_usuario"]
                )
            );
            
              print_r($this->getUsers());
        }
    }

    public function deleteUser(){
        if (isset($_POST["id_usuario"])) {
            $query = $this->conn->prepare("DELETE FROM prueba.usuarios WHERE id = :id");
            $res = $query->execute(
                array(
                    ':id'   =>$_POST["id_usuario"]
                )
            );
            print_r($this->getUsers());
        }
    }
    
}

$action = !isset($_GET['f']) ? 'none': strtolower($_GET['f']);
$obj = new Crud();
switch ($action) {
    case 'createuser':
        $obj->createUser();
        break;
    case 'getusers':
        $obj->getUsers();
        break;
    
    case 'getuser':
        $obj->getUser();
        break;

    case 'edituser':
        $obj->editUser();
        break;
    case 'deleteuser':
        $obj->deleteUser();
        break;
}