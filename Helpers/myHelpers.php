<?php


use App\bd;




function addOrder($order, $idShop){
    $bd = new bd();
	$bd->beginTransaction();	

	$sth = $bd->prepare("insert into Orders(date, send, idShop) values (:hora,:send,:idShop)");
	$resul = $sth->execute(['hora'=>date("Y-m-d H:i:s", time()),'send'=>0,'idShop'=>$idShop]);

    if (!$resul) return FALSE;

	// coger el id del nuevo pedido para las filas detalle
	$idOrder = $bd->lastInsertId();
	// insertar las filas en pedidoproductos

    foreach($order as $id=>$amount){
		$sth =  $bd->prepare("insert into OrderLines(idOrder, idProduct, amount) values( :idOrder, :idProduct, :amount)");
        $resul = $sth->execute(['idOrder'=>$idOrder,'idProduct'=>$id,'amount'=>$amount]);
		if (!$resul) {
			$bd->rollback();
			return FALSE;
		}
	}
	$bd->commit();
	return $idOrder;
}

function checkSession(){
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php?redirigido=true");
        exit();
    }

}

function response($method,$class){
    switch ($method) {
        case 'GET':
            if (isset($_GET['id']))
                $elements = $class::getbyId($_GET['id']);
            else
                $elements = $class::getAll();
            if ($elements) {
                http_response_code(200);
                echo json_encode($elements);
                exit();
            }
            http_response_code(404);
            return json_encode(array("message" => "No products found."));
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $element = new $class($data);

            if ($element->save()) {
                http_response_code(200);
                echo json_encode($element->id);
                exit();
            }
            http_response_code(404);
            return json_encode(array("message" => "No Inserit"));
            break;
        case 'PUT';
            $data = json_decode(file_get_contents("php://input"), true);
            $element = new $class($_GET['id']);
            foreach ($data as $key => $value) {
                $element->$key = $value;
            }

            if ($element->save()) {
                http_response_code(200);
                echo json_encode($element->id, true);
                exit();
            }
            http_response_code(404);
            return json_encode(array("message" => "No Inserit"));
            break;
        case 'DELETE':
            if (isset($_GET['id'])) {
                $result = $class::deletebyId($_GET['id']);
                if ($result) {
                    http_response_code(200);
                    echo json_encode(array("message" => "Esborrat satisfactori."));
                    exit();
                }
            }
            http_response_code(404);
            return json_encode(array("message" => "No products found."));
            break;
    }
}

function dd($var){
    var_dump($var);
    exit();
}

