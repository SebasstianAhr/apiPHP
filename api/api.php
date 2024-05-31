<?php
include('../models/productosDAO.php');
$productoDAO = new ProductoDAO();

header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];


switch ($method) {

    //select
    case 'GET':
        $productos =  $productoDAO->getAllProducts();
        echo json_encode($productos);
        
        break;
        case 'POST':
            $data = json_decode(file_get_contents('php://input', true));
            $producto = $productoDAO->insertar($data->nombre, $data->descripcion);
            echo $producto;
            break;

        case 'PUT':
            // obteniendo data
            echo 'edicion de registros PUT';
            break;

        case 'DELETE':
            echo 'borrado de registros DELETE';
            break;
        
        default:
            echo 'Metodo no disponible :(';
            break;

    
}

?>