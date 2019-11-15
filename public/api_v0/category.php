<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,PUT,DELETE,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require $_SERVER['DOCUMENT_ROOT'].'/../config/load.php';
use App\Category;


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id']))
            $categories = Category::getbyId($_GET['id']);
        else
            $categories = Category::getAll();
        if ($categories) {
            http_response_code(200);
            echo json_encode($categories);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No products found."));
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $category = new Category($data);

        if ($category->save()) {
            http_response_code(200);
            echo json_encode($category->id);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No Inserit"));
        break;
    case 'PUT';
        $data = json_decode(file_get_contents("php://input"), true);
        $category = new Category($_GET['id']);
        foreach ($data as $key => $value) {
            $category->$key = $value;
        }

        if ($category->save()) {
            http_response_code(200);
            echo json_encode($category->id, true);
            exit();
        }
        http_response_code(404);
        echo json_encode(array("message" => "No Inserit"));
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = Category::deletebyId($_GET['id']);
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