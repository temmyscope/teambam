
<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List of Orders</li>
    </ol>

	<?= HTML::Card("<center> <div class='border' style='width: 500px'><h1>List of Order</h1></div></center>"); ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Order ID.#</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td> <?php echo e($row['id']); ?> </td>
                    <td> <?php echo e($row['created_at']); ?> </td>
                    <td> <?php echo e($row['delivery_date']); ?> </td>
                    <td> <?php echo e($row['total']); ?> </td>
                    <td> <?php echo e($row['status']); ?> </td>
                    <td>
                        <?php if($row['status'] == 'confirmed'): ?>
                        <center> 
                            <a class="btn btn-info" title="View list Of Ordered" href="<?php echo e(route('order').'/'.$row['id']); ?>">
                                View detail
                            </a> 
                        </center>
                        <?php elseif($row['status'] == 'pending'): ?>
                        <center> 
                            <a class="btn btn-info" onclick="return confirm('Are you sure you want to cancel this order?')" title="View list Of Ordered" href="<?php echo e(route('order/cancel').'/'.$row['id']); ?>">
                                Cancel Order
                            </a> 
                        </center>
                        <?php endif; ?>
                    </td>
                </tr> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <?php endif; ?>
            </tbody>
            
        </table>
    </div>
    
    <?= HTML::closeCard(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/order/history.blade.php ENDPATH**/ ?>