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


function dd($var){
    var_dump($var);
    exit();
}

