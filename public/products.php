<?php
    require 'header.php';
    $cat = loadCategory($_GET['category']);
    $products = loadProductsCategory($_GET['category']);

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        if(isset($_SESSION['order'][$id])){
            $_SESSION['order'][$id] += (int)$_POST['amount'];
        }else{
            $_SESSION['order'][$id] = (int)$_POST['amount'];
        }
    }
?>
    <div id="encabezado">
        <h1>Productes categoria <?= $cat->name ?></h1>
    </div>
    <div id="cesta" style="text-align:center">
        <?php require_once "order.php" ?>
    </div>
    <div id="productos">
        <?php foreach($products as $product){ ?>
        <p>
        <form id='<?= $product->id ?>'  method='post'>
            <label><?= $product->name ?> - <?= $product->description  ?>(<?= $product->stock ?>)</label>
            <input name = 'id' type='hidden' value = '<?= $product->id ?>'>
            <input name = 'amount' type='number' min = '1' value = '1'>
            <input type = 'submit' value='Comprar'>
        </form>
        </p>
        <?php }; ?>
    </div>
<?php require 'footer.php'; ?>
