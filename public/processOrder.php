<?php
use App\mail;
use App\shoppingCart;
require '../config/load.php';

$cart = new shoppingCart();
$resul = $cart->processOrder($_SESSION['user']->id);

if($resul === true && !$cart->isEmpty()){
    $correo = $_SESSION['user']->mailAdress;
    $message =  "Comanda realitzada amb èxit. Se enviarà un correu de confirmació a: $correo ";
    $mail = new mail($cart->getOrder(), $resul, $correo);
    $resul = $mail->send();
    if($resul !== TRUE){
        $message =  "Error a l'enviar: $resul <br>";
    };
    $cart->empty();
} else $message = "No s'ha pogut processar la comanda: ".$resul;
$titleView = "Comanda processada";
echo $blade->render('processOrder',compact('message','titleView'));




