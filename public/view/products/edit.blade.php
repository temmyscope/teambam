@extends('app')
@section('title', 'Products')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Edit Product'); ?>
	
    <?= HTML::generateForm('product/edit/'.$dataSource->id, [
        'product_name' => [ 'type' => 'text', 'rule' => 'required', 'value' => $dataSource->product_name ],
        'qty' => [ 'type' => 'text', 'label' => 'Quantity Available', 'value' => $dataSource->quantity ],
        'measurement' => [ 'type' => 'text', 'placeholder' => 'e.g. Bag', 'value' => $dataSource->measurement ],
        'price' => [ 'type' => 'number', 'rule' => 'required', 'value' => $dataSource->price ],
        'resellable_price' => [ 'type' => 'number', 'rule' => 'required', 'value' => $dataSource->resellable ],
        'category' => [ 'type' => 'text', 'rule' => 'required', 'value' => $dataSource->category ],
        'status' => [ 'type' => 'select', 'value' => [ 'Available' => 'available', 'UnAvailable' => 'unavailable' ] ],
        'update' => [ 'type' => 'submit' ]
    ]); ?>

@endsection