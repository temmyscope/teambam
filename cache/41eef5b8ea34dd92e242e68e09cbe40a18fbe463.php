<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Products'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>Product Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
					<th >Measurement</th>
                    <th >Price</th>
					<th >Resellable</th>
                    <th>Status</th>
					<th>Last Updated</th>
					<th></th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
			<?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<?php $data = (object) $data; ?>
				<tr>
					<td><?php echo e($data->product_code); ?></td>
					<td><?php echo e($data->product_name); ?></td>
					<td><?php echo e($data->quantity); ?></td>
					<td><?php echo e($data->measurement); ?></td>
					<td><?php echo e($data->price); ?></td>
					<td><?php echo e($data->resellable); ?></td>
					<td><?php echo e($data->status); ?></td>
					<td><?php echo e($data->updated_at); ?></td>
					<td>
						<a class="btn btn-success" type="button" href="<?php echo e(route('products/edit').'/'.$data->id); ?>">Edit</a>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

			<?php endif; ?>
			
				<tr>
					<center>
						<td>
							<a type="button" class="btn btn-success" href="<?php echo e(route('products/add')); ?>" >Add Product(s)</a>
						</td>
					</center>
				</tr>

            </tbody>

        </table>
    </div>


    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/products/index.blade.php ENDPATH**/ ?>