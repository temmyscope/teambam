@extends('app')
@section('title', 'Admin')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User ID</th>
                    <th>Transaction ID</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Action</th>
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
					<td>
						<a class="btn btn-success" type="button" href="{{ route('admin/orders').'/$data->id?type=cancelled&action=cancel' }}">Cancel</a>
						<a class="btn btn-success" type="button" href="{{ route('admin/orders').'/$data->id?type=confirmed&action=confirm' }}">Confirm</a>
					</td>
				</tr>
                @empty

                @endforelse
            </tbody>

        </table>
    </div>
    
@endsection