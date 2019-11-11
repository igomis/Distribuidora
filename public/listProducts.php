<?php
    use App\Product;
    require '../config/load.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete']))
            Product::deletebyId($_POST['id']);
        if (isset($_POST['update'])){
            header("Location: addProduct.php?id=".$_POST['id']);
        }
    }

    $titleView = "Manteniment de Productes ";
    $products = Product::getAll();
    echo $blade->render('listProducts',compact('products','titleView'));






