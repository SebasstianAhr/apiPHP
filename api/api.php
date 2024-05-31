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
            $data = json_decode(file_get_contents('php://input', true));
            $updateProduct = $productoDAO->updateProduct($data->id, $data->nombre, $data->descripcion);
            echo $updateProduct;
            break;

        case 'DELETE':
            $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
            $buscarId = explode('/', $path);
            $id = $buscarId != '/' ? end($buscarId) : null;

            
            $deleteProduct = $productoDAO->eliminar($id);
            echo $deleteProduct;
            break;
        
        default:
            echo 'Metodo no disponible :(';
            break;

    
}

?>