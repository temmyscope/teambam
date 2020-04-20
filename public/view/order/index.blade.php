@extends('app')
@section('title', 'Cart')
@section('content')

	<?php use App\Helpers\HTML; ?> 

    <span id="divToPrint">

		<?= HTML::Card("<center> <h2>Agri-Trading</h2> </center>"); ?>

			<div style="margin-bottom: 30px">
				<center>
					<p style="font-size: 20px">Brgy. Enclaro Binalbagan City <br> Negros Occidental</p>
				</center>
			</div>

			<ul>
				<div  style="margin-bottom: 30px">
				<h5>Order .# : {{ $dataSource['order_code'] }}</h5>
				<h5>Name : {{ $_SESSION['name'] }}</h5>
				<h5>Contact : {{ '09098765322' }}</h5>
				<h5>Address : {{ 'my address' }}</h5>
				<h5>Delivery Date : {{ $dataSource['delivery_date'] }}</h5>
			</ul>

			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Product</th>
							<th>Order Date</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					@forelse($dataSource['summary'] as $row)
						<?php $total = 0; ?>
						<tr>
							<td> {{ $row->product_name }} </td>
							<td> {{ $dataSource['created_at'] }} </td>
							<td> {{ $row->quantity }} </td>
							<td> {{ $row->price }} </td>
							<td> {{ $row->price * $row->quantity }} </td>
						</tr>
						
						<?php $total += $row->price * $row->quantity; ?>
					@empty
						
					@endforelse
						
					</tbody><br>
					<tr>
						<td colspan="4" align="right"><br><h5> Cost :</h5></td>
						<td ><br><h5> &#8369 {{ $total }}</h5></td>
					</tr>
					<tr>
						<td colspan="4" align="right"><h5> Delivery Fee :</h5></td>
						<td ><h5> &#8369 150</h5></td>
						
					</tr>
						<tr>
						<td colspan="4" align="right"><h5> Total :</h5></td>
						<td ><h5> &#8369 {{ $total + 150 }}</h5></td>
					</tr>
				</table>

				<div class='container' align = "center">
					<h5>Please print this as a proof of purchased</h5>
					<p> We hope you enjoy your purchased products. Have a nice day!</p>
				</div>
			</div>


			<script type="text/javascript">     
				function PrintDiv() {    
					var divToPrint = document.getElementById('divToPrint');
					var popupWin = window.open('', '_blank', 'width=800,height=800');
					popupWin.document.open();
					popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
					popupWin.document.close();
				}
			</script>

			<a href="{{ route('order/history') }}" class="btn btn-xs btn-info fas fa-arrow-left" ">Back</a>
			@if( true )
				<a href="#" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">Print</a>
			@endif

		<?= HTML::closeCard() ?>

	</span>

@endsection