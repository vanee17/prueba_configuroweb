<?php
    class Query{
        private $conn;
        public function __construct(){
            include('../config/db.php');
            $obj = new db();
            $this->conn = $obj->connection(); 
        }

        public function getNames(){
            $query = $this->conn->prepare('SELECT nombre FROM prueba.nombres');
            $query->execute();
            $res = $query->fetchAll();
            $data =[];
            foreach($res as $item){
                $data[] = $item['nombre'];
            }
            return $data;
        }
    
        public function getLastNames(){
            $query = $this->conn->prepare('SELECT apellido FROM prueba.apellidos');
            $query->execute();
            $res = $query->fetchAll();
            $data = [];
            foreach ($res as $item) {
                $data[] = $item['apellido'];
            }
            return $data;
        }
    }
