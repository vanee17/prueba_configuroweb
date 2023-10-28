<?php

class Api{
    private $names;
    private $lastNames;
    public function __construct(){
        include('query.php');
        $obj =  new Query();
        $this->names = $obj->getNames();
        $this->lastNames = $obj->getLastNames();
    }
    public function getRandomRecords() {
        $name = $this->names[array_rand($this->names)];
        $lastName = $this->lastNames[array_rand($this->lastNames)
    ];
        $age = rand(18, 65);
        return [
            'nombre' => $name,
            'apellido' => $lastName,
            'edad' => $age
        ];
    }
}

$obj = new Api();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $data = [];
    for ($i = 0; $i < 10; $i++) {
        $data[] = $obj->getRandomRecords();
    }
    echo json_encode($data);
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método no permitido"]);
}

