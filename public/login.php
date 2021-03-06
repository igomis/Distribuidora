<?php
use App\Shop;
require dirname(__FILE__) . "/../config/load.php";


/*formulario de login habitual
si va bien abre sesión, guarda el nombre de usuario y redirige a principal.php 
si va mal, mensaje de error */

if(isset($_GET["redirigido"])) $error = 'Haga login para continuar';
else $error = '';
$usuario = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
	
	$shop = Shop::checkLogin($_POST['usuario'], $_POST['clave']);

	if($shop===false){
        $error = 'Revise usuario y contraseña';
		$usuario = $_POST['usuario'];
	}else{
		session_start();
		// $usu tiene campos correo y codRes, correo 
		$_SESSION['user'] = $shop;
		$_SESSION['order'] = [];
		header("Location: categories.php");
		return;
	}	
}
echo $blade->render('login',compact('usuario','error'));



