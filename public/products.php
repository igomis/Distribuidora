<?php
    use App\shoppingCart;
    use App\Category;
    use App\Product;
    require '../config/load.php';
    $cat = new Category($_GET['category']);

    $cart = new shoppingCart();



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['comprar']))
            $cart->add($_POST['cod'],(int)$_POST['unidades']);
        if (isset($_POST['actualizar'])){
            $cart->set($_POST['cod'],(int)$_POST['unidades']);
        }
        if (isset($_POST['eliminar'])){
            $cart->delete($_POST['cod']);
        }
    }

    $titleView = "Productes categoria $cat->name";
    $products = Product::getbyColum('idCategory',$cat->id);
    $productosCar = $cart->loadProducts();
    echo $blade->render('products',compact('products','titleView','productosCar'));






