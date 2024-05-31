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

    public function insertar(string $nombre, string $descripcion){
        try {
    
            $instancia = new Connection('localhost', 'root', '', 'api');
            $conexion = $instancia->conectar();
            $query = $conexion->prepare("INSERT INTO productos(nombre, descripcion) VALUES ('$nombre', '$descripcion')");
            $query->execute();
    
            http_response_code(200);
            return "Producto agregado con exito!";
            $instancia->desconectar();
    
        } catch (PDOException $e) {
            echo "Error al agregar producto: {$e->getMessage()}";
        }
    }

    public function eliminar(int $id){
        try {

            $instancia = new Connection('localhost','root', '', 'api');
            $conexion = $instancia->conectar();
            $query = $conexion->prepare("DELETE FROM productos WHERE id = $id");
            $query->execute();

            if ($query->rowCount() > 0) {
                http_response_code(200);
                return "Producto eliminado exitosamente!";
            } else {
                http_response_code(400);
                return "Ningun campo se ha sido eliminado.";
            }

            $instancia->desconectar();

        } catch(PDOException $e){
            http_response_code(500);
            echo "Error al eliminar producto: {$e->getMessage()}";
        }
    }

    
}

