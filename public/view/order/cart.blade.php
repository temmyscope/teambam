@extends('app')
@section('title', 'Cart')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('<center><h1> Order </h1></center>'); ?>
        <div class="table-responsive">
            <table class="table " width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th width="200">Quantity</th>
                        <th width="200">Price</th>
                        <th width="200">Resellable Price</th>
                        <th>Total</th> 
                        <th>Option</th>
                    </tr>
                </thead>

                <tbody>
                    @if( !empty($_SESSION["cart"]) )
                        <?php $_SESSION['mm'] = 0; $_SESSION['resellable'] = 0; ?>
                        @foreach( $_SESSION["cart"] as $keys => $values )
                            <tr>
                                <td><img src=" {{ app()->get('assets').'/images/images.png' }}" style="width: 100px"></td>
                                <td>{{ $values["name"] }} </td>
                                <td> {{ $values["quantity"] }}</td>
                                <td>&#8369 {{ $values["price"] }}</td>
                                <td>&#8369 {{ $values["resellable"] }}</td>
                                <td>&#8369 {{ ($values["quantity"] * $values["price"]) }} </td>
                                <td>
                                    <a class="btn btn-danger" type="button" onclick="return confirm('Are you sure?')" href="{{ route('remove_product').'?id='.$values['ids'] }}">Remove</a>
                                </td>
                            </tr>
                            <?php $name= $values["name"];  $_SESSION['mm'] = $_SESSION['mm'] + ($values["quantity"] * $values["price"]); 
                                $_SESSION['resellable'] = $_SESSION['resellable'] + ($values["resellable"] * $values["quantity"]);
                            ?>
                        @endforeach
                        <tr>
                            <td colspan="4" align="right">Resellable Price: &#8369 {{ $_SESSION['resellable'] }}</td>
                            <td align="right">Total Price: &#8369 {{ $_SESSION['mm'] }}</td>

                            <td><a type="button" class="btn btn-success" href="{{ route('order/checkout') }}" >Proceed and Checkout</a></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    <?= HTML::closeCard(); ?>

@endsection