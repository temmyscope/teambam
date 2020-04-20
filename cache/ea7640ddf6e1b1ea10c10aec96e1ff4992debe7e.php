
<?php $__env->startSection('title', 'Error'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?>

	<?= HTML::Card('Error'); ?>

	An Error Occurred. That content does not exist.
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/errors/index.blade.php ENDPATH**/ ?>