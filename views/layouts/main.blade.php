<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Tarea 5: Listado de Productos con Plantillas</title>
    <link href="/css/distribuidora.css" rel="stylesheet" type="text/css">
</head>
<body class="pagproductos">
    <div id="contenedor">
        <div id="encabezado">
            <h1>{{ $titleView }}</h1>
        </div>
        @yield('body')
        <br class="divisor" />
        <div id="pie">
            @if ($_SESSION['user']->id == '1')
                <form action='listProducts.php' method='post'>
                    <!-- Botón del mismo tipo que los demás -->
                    <input type='submit' name='llista' class='boton' style='width:100%;' value='Llista Productes'>
                </form>
            @endif
            <form action='categories.php' method='post'>
                <!-- Botón del mismo tipo que los demás -->
                <input type='submit' name='categories' class='boton' style='width:100%;' value='Tornar Categories'>
            </form>
            <form action='logoff.php' method='post'>
                <!-- Botón del mismo tipo que los demás -->
                <input type='submit' name='desconectar' class='boton' style='width:100%;' value='Desconectar usuario {{ $_SESSION['user']->mailAdress }}'/>
            </form>
        </div>
    </div>
</body>
</html>