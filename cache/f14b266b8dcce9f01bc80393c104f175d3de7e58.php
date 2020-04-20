
<?php $__env->startSection('title', 'Admin'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User Email</th>
					<th>User Name</th>
					<th>User Privilege/Role</th>
					<th>Options/Change To</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                <?php $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $data = (object) $data; ?>
                <tr>
                    <form action = "<?php echo e(route('admin/change_role')); ?>" method="POST">
					<td><?php echo e($data->email); ?></td>
					<td><?php echo e($data->name); ?></td>
					<td><?php echo e($data->role); ?></td>
                    <input type ='hidden' name='user_id' value="<?php echo e($data->id); ?>" >
					<td> 
                        <select class="form-control" name='role'> 
                            <option value='admin'>Admin</option>
                            <option value='supplier'>Supplier</option>
                            <option value='cutomer'>Customer</option>
                        </select> 
                    </td>
                    <td> <button value="change" type="submit" class="btn btn-success">Change Role</button> </td>
                    </form>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>


    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/admin/change_role.blade.php ENDPATH**/ ?>