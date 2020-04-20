
<?php $__env->startSection('title', 'Admin'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>User ID</th>
					<th>Bank Name</th>
					<th>Account Name</th>
					<th>Account Number</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Withdrawal Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                <?php $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $data = (object) $data; ?>
                <tr>
                    <td><?php echo e($data->user_id); ?></td>
                    <td><?php echo e($data->bank_name); ?></td>
                    <td><?php echo e($data->account_name); ?></td>
                    <td><?php echo e($data->account_no); ?></td>
                    <td><?php echo e($data->amount); ?></td>
                    <td><?php echo e($data->status); ?></td>
                    <td><?php echo e($data->created_at); ?></td>
                    <td> <a class="btn btn-success" type="button" href="<?php echo e(route('admin/payouts/').$data->id); ?>">Confirm</a> </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>


    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/admin/payouts.blade.php ENDPATH**/ ?>