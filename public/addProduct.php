<?php
require dirname(__FILE__) . "/../config/load.php";
if (isset($_POST['submit']) && $_POST['submit']=='Afegir') {
    addProduct($_POST['category'],$_POST['name'],$_POST['description'],$_POST['stock'],$_POST['price']);
}
$titleView = "Afegir producte";
echo $blade->render('addProduct',compact('titleView'));
