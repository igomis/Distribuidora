<?php
    use App\shoppingCart;
    require '../config/load.php';
    $categorias = loadCategories();
    $titleView = "Llistat de categories";
    echo $blade->render('categories',compact('categorias','titleView'));
