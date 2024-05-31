<?php
include("../db/conexion.php");

class ProductoDAO
{
    public $id;
    public $nombre;
    public $descripcion;

    public function __construct($id=null, $nombre=null, $descripcion=null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getAllProducts(){
        try {

            $instancia = new Connection('localhost', 'root', '', 'api');
            $conexion = $instancia->conectar();
            $query = $conexion->prepare("SELECT * FROM productos");
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_ASSOC);
            
            http_response_code(200);
            return $productos;

            $instancia->desconectar();
            
        } catch (PDOException $e) {
            http_response_code(500);
            echo "Algo ha salido mal: {$e}";
        }
    }

    
}

