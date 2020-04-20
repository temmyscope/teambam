
<?php $__env->startSection('title', 'Search'); ?>
<?php $__env->startSection('content'); ?>

	<?php use app\Helpers\HTML; use app\Providers\Request;  ?>

	<?= HTML::Card('Search Results'); ?>

	You searched for: <?php print_r((Request::post())->search); ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\altvel\public\view/search/index.blade.php ENDPATH**/ ?>