<?php
use App\mail;
require 'header.php';

$error = '';
$idOrder = addOrder($_SESSION['order'], $_SESSION['user']->id);
if($idOrder === FALSE) $error = "No s'ha pogut realitzar la comanda";
else{

	$mail = new mail($_SESSION['order'], $idOrder, $_SESSION['user']->mailAdress);
	$resul =$mail->send();
	if($resul !==TRUE) $error = "Error al enviar correu a ". $_SESSION['user']->mailAdress;
	$_SESSION['order'] = [];
}
?>
<div id="encabezado">
	<h1>Processant Comanda <?= $_SESSION['user']->id ?></h1>
	<p><?= empty($error)?'Comanda Processada amb èxit':$error; ?></p>
</div>
<?php require 'footer.php';?>
	