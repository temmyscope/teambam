
<?php $__env->startSection('title', 'Products'); ?>
<?php $__env->startSection('content'); ?>

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Edit Product'); ?>
	
    <?= HTML::generateForm('product/edit/'.$dataSource->id, [
        'product_name' => [ 'type' => 'text', 'rule' => 'required', 'value' => $dataSource->product_name ],
        'qty' => [ 'type' => 'text', 'label' => 'Quantity Available', 'value' => $dataSource->quantity ],
        'measurement' => [ 'type' => 'text', 'placeholder' => 'e.g. Bag', 'value' => $dataSource->measurement ],
        'price' => [ 'type' => 'number', 'rule' => 'required', 'value' => $dataSource->price ],
        'category' => [ 'type' => 'text', 'rule' => 'required', 'value' => $dataSource->category ],
        'status' => [ 'type' => 'select', 'value' => [ 'Available' => 'available', 'UnAvailable' => 'unavailable' ] ],
        'update' => [ 'type' => 'submit' ]
    ]); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bam\public\view/products/edit.blade.php ENDPATH**/ ?>