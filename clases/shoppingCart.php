<?php
/**
 * Created by PhpStorm.
 * User: igomis
 * Date: 2019-07-26
 * Time: 17:43
 */

namespace App;
use App\bd;
use \PDO;


class shoppingCart
{
    private $order;

    public function __construct()
    {
        $this->order = $this->getSession();
    }
    public function getOrder(){
        return $this->order;
    }

    public function add($id,$amount){
        if(isset($this->order[$id])){
            $this->order[$id] += $amount;
        }else{
            $this->order[$id] = $amount;
        }
        $this->setSession();
    }

    public function set($id,$amount){
        if(isset($this->order[$id]))
            $this->order[$id] = $amount;
        $this->setSession();
    }

    public function delete($id){
        if(isset($this->order[$id]))
            unset($this->order[$id]);
        $this->setSession();
    }

    public function loadProducts(){
        $bd = new bd();
        $texto_in = implode(",", array_keys($this->order));
        if (empty($texto_in)) return [];
        $resul = $bd->query( "select * from Products where id in($texto_in)");
        return $resul->fetchAll(PDO::FETCH_OBJ);
    }


    public function processOrder($idShop){
        $bd = new bd();
        $bd->beginTransaction();
        $hora = date("Y-m-d H:i:s", time());

        // insertar el pedido
        try {
            $sql = "insert into Orders(date, send, idShop) values('$hora',0, $idShop)";
            $resul = $bd->exec($sql);
            if (!$resul) throw new Exception("No he pogut inserir la comanda");

            // coger el id del nuevo pedido para las filas detalle
            $pedido = $bd->lastInsertId();

            // insertar las filas en pedidoproductos
            foreach($this->order as $idProd=>$amount) {
                $sql = "insert into OrderLines(idOrder, idProduct, amount) values( $pedido, $idProd, $amount)";
                $resul = $bd->exec($sql);
                if (!$resul) throw new Exception("No he pogut inserir les files de la comanda");
                $sql = "select stock from Products where id = $idProd";
                $resul = $bd->query($sql);
                $stock = $resul->fetch(PDO::FETCH_OBJ)->stock - $amount;
                $sql = "update Products set stock=$stock where id= $idProd";
                $resul = $bd->query($sql);
                if (!$resul) throw new Exception("No s'ha pogut actualitza l'stock");
            }
        }
        catch (Exception $e){
            $bd->rollBack(); 
            return $e->getMessage();
        }
        
        $bd->commit();
        return true;
    }

    public function isEmpty(){
        if (count($this->order)) return false;
        return true;
    }
    public function empty(){
        $this->order = [];
        $this->setSession();
    }

    private function setSession(){
        $_SESSION['order']  = $this->order;
    }

    private function getSession(){
        return isset($_SESSION['order'])?$_SESSION['order']:[];
    }
}