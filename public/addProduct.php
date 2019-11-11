<?php
use App\Product;
require dirname(__FILE__) . "/../config/load.php";
$product = new Product();
if (isset($_GET['id'])){
    $product->find($_GET['id']);
}
if (isset($_POST['submit']) && $_POST['submit']=='Validar') {
    $product = new Product($_POST);
    $product->save();
    header("Location:listProducts.php");
}
$titleView = "Afegir producte";
echo $blade->render('addProduct',compact('titleView','product'));
