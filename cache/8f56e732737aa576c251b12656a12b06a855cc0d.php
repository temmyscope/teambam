
<?php $__env->startSection('title', 'Forgot Password'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?>

	<?= HTML::Card('Forgot Password'); ?>

	<?= HTML::generateForm('forgot_password', [
				'email' => [ 'rule' => 'required', 'type' => 'email', 'placeholder' => 'user@example.com'],
				'Regenerate Password' => [ 'type' => 'submit']
			]);
	?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/auth/forgot_password.blade.php ENDPATH**/ ?>