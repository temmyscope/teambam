
<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('<center><h1> Order </h1></center>'); ?>
        <div class="table-responsive">
            <table class="table " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th width="200">Quantity</th>
                        <th width="200">Price</th>
                        <th width="200">Resellable Price</th>
                        <th>Total</th> 
                        <th>Option</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if( !empty($_SESSION["cart"]) ): ?>
                        <?php $_SESSION['mm'] = 0; $_SESSION['resellable'] = 0; ?>
                        <?php $__currentLoopData = $_SESSION["cart"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img src=" <?php echo e(app()->get('assets').'/images/images.png'); ?>" style="width: 100px"></td>
                                <td><?php echo e($values["name"]); ?> </td>
                                <td> <?php echo e($values["quantity"]); ?></td>
                                <td>&#8369 <?php echo e($values["price"]); ?></td>
                                <td>&#8369 <?php echo e($values["resellable"]); ?></td>
                                <td>&#8369 <?php echo e(($values["quantity"] * $values["price"])); ?> </td>
                                <td>
                                    <a class="btn btn-danger" type="button" onclick="return confirm('Are you sure?')" href="<?php echo e(route('remove_product').'?id='.$values['ids']); ?>">Remove</a>
                                </td>
                            </tr>
                            <?php $name= $values["name"];  $_SESSION['mm'] = $_SESSION['mm'] + ($values["quantity"] * $values["price"]); 
                                $_SESSION['resellable'] = $_SESSION['resellable'] + ($values["resellable"] * $values["quantity"]);
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="4" align="right">Resellable Price: &#8369 <?php echo e($_SESSION['resellable']); ?></td>
                            <td align="right">Total Price: &#8369 <?php echo e($_SESSION['mm']); ?></td>

                            <td><a type="button" class="btn btn-success" href="<?php echo e(route('order/checkout')); ?>" >Proceed and Checkout</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?= HTML::closeCard(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/order/cart.blade.php ENDPATH**/ ?>