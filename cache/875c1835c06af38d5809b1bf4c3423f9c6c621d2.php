;
<?php $__env->startSection('body'); ?>
    <div id="cesta" style="text-align:center">
        <?php echo $__env->make('order', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div id="productos">
        <table class="table table-striped table-hover">
            <tr><th>Nombre</th><th>Descripción</th><th>Stock</th><th>Comprar</th></tr>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($product->name); ?> </td>
                <td><?php echo e($product->description); ?></td>
                <td><?php echo e($product->stock); ?></td>
                <td>
                    <form method = 'POST'>
                        <input type="hidden" name="cod" value="<?php echo e($product->id); ?>" />
                        <input name = 'unidades' type='number' min = '1' value = '1' />
                        <input type = 'submit' name='comprar' value='Comprar'>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/Distribuidora/views/products.blade.php ENDPATH**/ ?>