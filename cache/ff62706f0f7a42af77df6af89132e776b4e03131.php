
<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Products'); ?>
	
    <?= HTML::generateForm('product/add', [
        'product_name' => [ 'type' => 'text', 'rule' => 'required' ],
        'qty' => [ 'type' => 'number', 'label' => 'Quantity Available' ],
        'measurement' => [ 'type' => 'text', 'rule' => 'required' ],
        'price' => [ 'type' => 'number', 'rule' => 'required' ],
        'category' => [ 'type' => 'text', 'rule' => 'required'],
        'update' => [ 'type' => 'submit' ]
    ]); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/products/add.blade.php ENDPATH**/ ?>