<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,PUT,DELETE,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require $_SERVER['DOCUMENT_ROOT'].'/../config/load.php';
use App\Product;


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id']))
            $products = Product::getbyId($_GET['id']);
        else
            $products = Product::getAll();
        if ($products) {
            http_response_code(200);
            echo json_encode($products);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No products found."));
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $product = new Product($data);

        if ($product->save()) {
            http_response_code(200);
            echo json_encode($product->id);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No Inserit"));
        break;
    case 'PUT';
        $data = json_decode(file_get_contents("php://input"), true);
        $product = new Product($_GET['id']);
        foreach ($data as $key => $value) {
            $product->$key = $value;
        }

        if ($product->save()) {
            http_response_code(200);
            echo json_encode($product->id, true);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No Inserit"));
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = Product::deletebyId($_GET['id']);
            if ($result) {
                http_response_code(200);
                echo json_encode(array("message" => "Esborrat satisfactori."));
                exit();
            }
        }
        http_response_code(404);
        echo json_encode(array("message" => "No products found."));
        break;
}