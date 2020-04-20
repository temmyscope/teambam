
<?php $__env->startSection('title', 'Admin'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Cancelled Orders'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User ID</th>
                    <th>Transaction ID</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                <?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $data = (object) $data; ?>
				<tr>
					<td> <?php echo $data->customer_id; ?> </td>
                    <td> <?php echo $data->id; ?> </td>
				</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>
            </tbody>

        </table>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/admin/cancelled_orders.blade.php ENDPATH**/ ?>