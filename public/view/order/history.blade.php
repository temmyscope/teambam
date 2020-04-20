@extends('app')
@section('title', 'Cart')
@section('content')

	<?php use App\Helpers\HTML; ?> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List of Orders</li>
    </ol>

	<?= HTML::Card("<center> <div class='border' style='width: 500px'><h1>List of Order</h1></div></center>"); ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Order ID.#</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($dataSource as $row)
                <tr>
                    <td> {{ $row['id'] }} </td>
                    <td> {{ $row['created_at'] }} </td>
                    <td> {{ $row['delivery_date'] }} </td>
                    <td> {{ $row['total'] }} </td>
                    <td> {{ $row['status'] }} </td>
                    <td>
                        @if($row['status'] == 'confirmed')
                        <center> 
                            <a class="btn btn-info" title="View list Of Ordered" href="{{ route('order').'/'.$row['id'] }}">
                                View detail
                            </a> 
                        </center>
                        @elseif($row['status'] == 'pending')
                        <center> 
                            <a class="btn btn-info" onclick="return confirm('Are you sure you want to cancel this order?')" title="View list Of Ordered" href="{{ route('order/cancel').'/'.$row['id'] }}">
                                Cancel Order
                            </a> 
                        </center>
                        @endif
                    </td>
                </tr> 
            @empty

            @endforelse
            </tbody>
            
        </table>
    </div>
    
    <?= HTML::closeCard(); ?>

@endsection