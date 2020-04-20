@extends('app')
@section('title', 'Cart')
@section('content')

	<?php use App\Helpers\HTML; ?>

    <div class="row">
        <div class="col-lg-8">
			<?= HTML::Card('Order Summary'); ?>

				<div class="table-responsive">
					<table class="table " width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Image</th>
								<th>Product</th>
								<th width="300">Quantity</th>
								<th width="300">Price</th>
								<th>Total</th> 
								<th>Option</th>
							</tr>
						</thead>

						<tbody>
							@if( !empty($_SESSION["cart"]) )
								<?php $_SESSION['mm'] = 0; ?>
								@foreach( $_SESSION["cart"] as $keys => $values )
									<tr>
										<td><img src=" {{ app()->get('assets').'/images/images.png' }}" style="width: 100px"></td>
										<td>{{ $values["name"] }} </td>
										<td> {{ $values["quantity"] }}</td>
										<td>&#8369 {{ $values["price"] }}</td>
										<td>&#8369 {{ $values["quantity"] * $values["price"] }} </td>
										<td>
											<a class="btn btn-danger" type="button" onclick="return confirm('Are you sure?')" href="{{ route('order/remove_product').'?id='.$values['ids'] }}">Remove</a>
										</td>
									</tr>
									<?php $name= $values["name"];  $_SESSION['mm'] = $_SESSION['mm'] + ($values["quantity"] * $values["price"]); ?>
								@endforeach
								
							@endif
						</tbody>
					</table>
				</div>
            <?= HTML::closeCard(); ?>
        </div>

        <div class="col-lg-4">
			<div class="container">
				<?= HTML::Card('Checkout'); ?>
					<form role="form" method="POST" action="{{ route('order/checkout') }}" id="paymentForm">
						<h5><i class="fas fa-user-alt"></i> {!! $dataSource->name !!} </h5><br>
						<h5><i class="fas fa-envelope"></i> {!! $dataSource->email !!}</h5><br>
						@if(empty($dataSource->contact))
							<h5><i class="fas fa-phone"></i> <input type="number" maxlength="12" name="phonenumber" placeholder="Your phone number" required></h5><br>
						@else
							<h5><i class="fas fa-phone"></i> {!! $dataSource->contact !!}</h5><br>
							<input type="hidden" maxlength="12" name="phonenumber" value="{!! $dataSource->contact !!}" >
						@endif
						<h2>Order Summary</h2><br>
						<div class="row">
							<div class="col-lg-7" >
							<h5>Cost</h5><br>
							</div>

							<div align="right" class="col-lg-4">
								<h5>&#8369 {!! $_SESSION['mm'] !!}</h5><br>
							</div> 
							


							<div class="col-lg-7">
								<h5>Total</h5><br>
							</div>

							<div align="right" class="col-lg-4">
								<h5>&#8369 {!! $_SESSION['mm'] !!}</h5><br>
							</div>

						</div>

						<?php [$firstname, $lastname] = explode(' ', $dataSource->name); ?>
							<input type="hidden" name="amount" value="{!! $_SESSION['mm']+150 !!}" /> <!-- Replace the value with your transaction amount -->
							<input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
							<input type="hidden" name="description" value="Payment For Products Purchased" /> <!-- Replace the value with your transaction description -->
							<input type="hidden" name="logo" value="{!! app()->get('assets').'/images/images.png' !!}" /> <!-- Replace the value with your logo url -->
							<input type="hidden" name="title" value="Agri-Trading Checkout" /> <!-- Replace the value with your transaction title -->
							<input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
							<input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
							<input type="hidden" name="email" value="{!! $dataSource->email !!}" /> <!-- Replace the value with your customer email -->
							<input type="hidden" name="firstname" value="{!! $firstname !!}" /> <!-- Replace the value with your customer firstname -->
							<input type="hidden" name="lastname"value="{!! $lastname !!}" /> <!-- Replace the value with your customer lastname -->
							 <!-- Replace the value with your customer phonenumber -->
							<input type="hidden" name="pay_button_text" value="Complete Payment" /> <!-- Replace the value with the payment button text you prefer -->
							<input type="hidden" name="ref" value="{!! $dataSource->txref !!}" /> <!-- Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
						
						<center>
							<button type="submit" onclick="return confirm('Do you want to submit order and Checkout?')" class="btn btn-lg btn-success">Submit Order</button>
						</center>						
					</form>

					
				<?= HTML::closeCard(); ?>
            </div>
        </div>
    </div>

@endsection