<?php
require dirname(__FILE__) . "/../config/load.php";


/*formulario de login habitual
si va bien abre sesión, guarda el nombre de usuario y redirige a principal.php 
si va mal, mensaje de error */

if(isset($_GET["redirigido"])) $error = 'Haga login para continuar';
else $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
	
	$usu = checkLogin($_POST['usuario'], $_POST['clave']);

	if($usu===false){
        $error = 'Revise usuario y contraseña';
		$usuario = $_POST['usuario'];
	}else{
		session_start();
		// $usu tiene campos correo y codRes, correo 
		$_SESSION['user'] = $usu;
		$_SESSION['order'] = [];
		header("Location: categories.php");
		return;
	}	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de login</title>
		<meta charset = "UTF-8">
        <link href="/css/distribuidora.css" rel="stylesheet">
	</head>
	<body>
    <div id='login'>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
            <fieldset>
                <legend>Login</legend>
                <div>
                    <span class='error'><?= $error ?></span>
                </div>
                <div class='campo'>
                    <label for = "usuario">Usuari</label>
                    <input value = "<?php if(isset($usuario))echo $usuario;?>" id = "usuario" name = "usuario" type = "text" maxlength="50" />
                </div>
                <div class='campo'>
                    <label for = "clave">Clau</label>
                    <input id = "clave" name = "clave" type = "password"  maxlength="50" />
                </div>
                <div class='campo' style='text-align: center'>
                    <input type = "submit" class="boton" name="enviar" value="enviar">
                </div>
            </fieldset>
		</form>
    </div>
	</body>
</html>
<body>
