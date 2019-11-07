<!DOCTYPE html>
<html>
<head>
    <title>Formulario de login</title>
    <meta charset = "UTF-8">
    <link href="/css/distribuidora.css" rel="stylesheet">
</head>
<body>
<div id='login'>
    <form action = "{{ htmlspecialchars($_SERVER["PHP_SELF"]) }}" method = "POST">
        <fieldset>
            <legend>Login</legend>
            <div>
                <span class='error'>{{ $error }}</span>
            </div>
            <div class='campo'>
                <label for = "usuario">Usuari</label>
                <input value = "{{ $usuario }}" id = "usuario" name = "usuario" type = "text" maxlength="50" />
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