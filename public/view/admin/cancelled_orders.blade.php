@extends('app')
@section('title', 'Admin')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Cancelled Orders'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User ID</th>
                    <th>Transaction ID</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                @forelse($dataSource as $data)
                <?php $data = (object) $data; ?>
				<tr>
					<td> {!! $data->customer_id !!} </td>
                    <td> {!! $data->id !!} </td>
                    <td> {!! $data->created_at !!} </td>
                    <td> {!! $data->delivery_date !!} </td>
				</tr>
                @empty

                @endforelse
            </tbody>

        </table>
    </div>
    
@endsection