@extends('app')
@section('title', 'Home')
@section('content')

	<?php use App\Helpers\HTML;  ?>

	<?= HTML::Card('Home'); ?>
		
	<div class="row">
		@forelse($dataSource as $row)
		<?php $row = (object) $row; ?>
		<div class="col-lg-3">
			<div class="card mb-3">
				<div class="card-body">
				<form method="post" action="{!! route('add_product') !!}">
					<center>
						<img src="{!! empty($row->img) ? app()->get('assets').'/images/images.png' : $row->img !!}" style="width: 100px">
						<h4 class="text-info">{!! $row->product_name !!}</h4>
						<h5 class="text-info">Available Qty:({!! $row->quantity !!})</h5>
						<h4 class="text-danger">&#8369 {!! $row->price !!}.00</h4>
						<input type='hidden', name='product_code', value="{!! $row->product_code !!}">
						<input class="form-control" type="number" min="0" placeholder="Quantity" name="quantity" value="1">
						<input class="form-control" type="hidden" name="av" value="{!! $row->quantity !!}">
						<input class="form-control" type="hidden" name="hiddenname" value="{!! $row->product_name !!}">
						<input class="form-control" type="hidden" name="hiddenprice" value="{!! $row->price !!}">
						<input class="form-control" type="hidden" name="resellable" value="{!! $row->resellable !!}">
						<input class="btn btn-success" type="submit" name="add_to_cart" value="Add to Cart" style="margin-top: 10px">
					</center>
				</form>
				</div>
			</div>
		</div>
		@empty
			There are no available products at this time
		@endforelse
	</div>


@endsection