;
<?php $__env->startSection('body'); ?>
    <div>
        <table>
            <form action = '' method = 'POST'>
                <tr><td>Categoria:</td><td>
                        <select name="category">
                            <?php $__currentLoopData = loadCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($cat->id); ?>'><?php echo e($cat->name); ?></option>";
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td></tr>
                <tr><td>Nom:</td><td><input name = 'name' type='text' ></td></tr>
                <tr><td>Descripció:</td><td><input name = 'description' type='text' ></td></tr>
                <tr><td>Stock:</td><td><input name = 'stock' type='text' ></td></tr>
                <tr><td>Preu:</td><td><input name = 'price' type='text' ></td></tr>
                <tr><td><input name='submit' type = 'submit' value='Afegir'></td></tr>
            </form>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/Distribuidora/views/addProduct.blade.php ENDPATH**/ ?>