
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML;  ?>

	<?= HTML::Card('Home'); ?>
		
	<div class="row">
		<?php $__empty_1 = true; $__currentLoopData = $dataSource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		<?php $row = (object) $row; ?>
		<div class="col-lg-3">
			<div class="card mb-3">
				<div class="card-body">
				<form method="post" action="<?php echo route('add_product'); ?>">
					<center>
						<img src="<?php echo empty($row->img) ? app()->get('assets').'/images/images.png' : $row->img; ?>" style="width: 100px">
						<h4 class="text-info"><?php echo $row->product_name; ?></h4>
						<h5 class="text-info">Available Qty:(<?php echo $row->quantity; ?>)</h5>
						<h4 class="text-danger">&#8369 <?php echo $row->price; ?>.00</h4>
						<input type='hidden', name='product_code', value="<?php echo $row->product_code; ?>">
						<input class="form-control" type="number" min="0" placeholder="Quantity" name="quantity" value="1">
						<input class="form-control" type="hidden" name="av" value="<?php echo $row->quantity; ?>">
						<input class="form-control" type="hidden" name="hiddenname" value="<?php echo $row->product_name; ?>">
						<input class="form-control" type="hidden" name="hiddenprice" value="<?php echo $row->price; ?>">
						<input class="form-control" type="hidden" name="resellable" value="<?php echo $row->resellable; ?>">
						<input class="btn btn-success" type="submit" name="add_to_cart" value="Add to Cart" style="margin-top: 10px">
					</center>
				</form>
				</div>
			</div>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			There are no available products at this time
		<?php endif; ?>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/home/index.blade.php ENDPATH**/ ?>