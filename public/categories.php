<?php require 'header.php';?>
<div id="encabezado">
    <h1>Llistat de categories</h1>
</div>
<?php
    $categorias = loadCategories();
    foreach($categorias as $cat){
?>
     <p><a href='products.php?category=<?= $cat->id ?>'><?= $cat->name ?></a></p>
<?php };
    require 'footer.php'; ?>
