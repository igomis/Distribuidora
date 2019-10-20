<?php
/**
 * Created by PhpStorm.
 * User: igomis
 * Date: 2019-07-17
 * Time: 18:50
 */
namespace App;

use PHPMailer\PHPMailer\PHPMailer;

class mail
{
    private $order;
    private $id;
    private $email;

    /**
     * mail constructor.
     * @param $order
     * @param $idShop
     * @param $email
     */
    public function __construct($order, $id, $email)
    {
        $this->order = $order;
        $this->id = $id;
        $this->email = $email;
    }


    public function send(){
        return $this->sendMails("$this->email, igomis@cipfpbatoi.es", "Pedido $this->id confirmado");
    }

    private function doMsgHTML(){
        $products = loadProducts(array_keys($this->order));
        $text = "<h1>Pedido nº $this->id </h1><h2>Restaurante: $this->email </h2>";
        $text .= "Detalle del pedido:";
        $text .= "<table>"; //abrir la tabla
        $text .= "<tr><th>Id</th><th>Nom</th><th>Descripció</th><th>Unitats</th></tr>";

        foreach($products as $product)
            $text .= "<tr><td>$product->id</td><td>$product->name</td><td>$product->description</td><td>".$this->order[$product->id]."</td><td></tr>";

        $text .= "</table>";
        return $text;
    }

    private function sendMails($emailsList,  $subject = ""){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;  // cambiar a 1 o 2 para ver errores
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 587;
        $mail->Username   = "cipfpbatoi2daw@gmail.com";  //usuario de gmail
        $mail->Password   = "2dawDWES"; //contraseña de gmail
        $mail->SetFrom('noreply@empresafalsa.com', 'Sistema de pedidos');
        $mail->Subject    = $subject;
        $mail->MsgHTML($this->doMsgHTML());

        foreach(explode(",", $emailsList) as $email){
            $mail->AddAddress($email, $email);
        }
        if(!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return TRUE;
        }
    }
}