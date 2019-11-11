<?php
    use App\shoppingCart;

    require '../config/load.php';

    $titleView = "Llistat de categories";
    echo $blade->render('categories',compact('titleView'));
