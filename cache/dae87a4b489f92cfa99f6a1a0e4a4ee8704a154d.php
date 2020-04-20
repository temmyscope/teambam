
<?php $__env->startSection('title', 'Admin'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User ID</th>
                    <th>Transaction ID</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                <?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $data = (object) $data; ?>
				<tr>
					<td> <?php echo $data->customer_id; ?> </td>
                    <td> <?php echo $data->id; ?> </td>
                    <td> <?php echo $data->created_at; ?> </td>
                    <td> <?php echo $data->delivery_date; ?> </td>
					<td>
						<a class="btn btn-success" type="button" href="<?php echo e(route('admin/orders').'/$data->id?type=cancelled&action=cancel'); ?>">Cancel</a>
						<a class="btn btn-success" type="button" href="<?php echo e(route('admin/orders').'/$data->id?type=confirmed&action=confirm'); ?>">Confirm</a>
					</td>
				</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>
            </tbody>

        </table>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/admin/pending_orders.blade.php ENDPATH**/ ?>