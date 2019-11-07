<!DOCTYPE html>
<html>
<head>
    <title>Formulario de login</title>
    <meta charset = "UTF-8">
    <link href="/css/distribuidora.css" rel="stylesheet">
</head>
<body>
<div id='login'>
    <form action = "<?php echo e(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method = "POST">
        <fieldset>
            <legend>Login</legend>
            <div>
                <span class='error'><?php echo e($error); ?></span>
            </div>
            <div class='campo'>
                <label for = "usuario">Usuari</label>
                <input value = "<?php echo e($usuario); ?>" id = "usuario" name = "usuario" type = "text" maxlength="50" />
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
<body><?php /**PATH /home/vagrant/Code/Distribuidora/views/login.blade.php ENDPATH**/ ?>