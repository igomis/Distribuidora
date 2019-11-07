<h3><img src='img/cesta.png' alt='Cesta' width='24' height='21'>Comanda</h3>
<hr />
<?php if(!empty($productosCar)): ?>
    <?php $__currentLoopData = $productosCar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productoCar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form  method = 'POST'>
            <input type="text" style="width: 5em" disabled  value="<?php echo e($productoCar->name); ?>" />
            <input name = 'cod' type='hidden'  value = '<?php echo e($productoCar->id); ?>'>
            <input name = 'unidades' type='number' min = '1' value = "<?php echo e($_SESSION['order'][$productoCar->id]); ?>" style="width: 3em">
            <input type = 'submit' style="width: 2em" name='actualizar' value='OK'>
            <input type = 'submit' style="width: 2em"  name='eliminar' value='X'>
        </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <form id='vaciar' action='deleteOrder.php' method='post'>
        <input type='submit' name='empty' class='boton' value='Buidar'  />
    </form>
    <form id='comprar' action='processOrder.php' method='post'>
        <input type='submit' name='buy' class='boton' value='Processar'  />
    </form>
<?php else: ?>
    <p>Buida</p>
<?php endif; ?>
<?php /**PATH /home/vagrant/Code/Distribuidora/views/order.blade.php ENDPATH**/ ?>