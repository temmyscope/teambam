@extends('app')
@section('title', 'Products')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Products'); ?>
	
    <?= HTML::generateForm('product/add', [
        'product_name' => [ 'type' => 'text', 'rule' => 'required' ],
        'img' => [ 'type' => 'file', 'rule' => 'required', 'label' => 'Product Image' ],
        'qty' => [ 'type' => 'number', 'label' => 'Quantity Available', 'rule' => 'required' ],
        'measurement' => [ 'type' => 'text', 'rule' => 'required' ],
        'price' => [ 'type' => 'number', 'rule' => 'required' ],
        'resellable_price' => [ 'type' => 'number', 'rule' => 'required' ],
        'category' => [ 'type' => 'text', 'rule' => 'required'],
        'update' => [ 'type' => 'submit' ]
    ]); ?>


@endsection