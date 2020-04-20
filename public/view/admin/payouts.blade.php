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
					<th>Bank Name</th>
					<th>Account Name</th>
					<th>Account Number</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Withdrawal Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                @foreach( $dataSource as $data)
                <?php $data = (object) $data; ?>
                <tr>
                    <td>{{ $data->user_id }}</td>
                    <td>{{ $data->bank_name }}</td>
                    <td>{{ $data->account_name }}</td>
                    <td>{{ $data->account_no }}</td>
                    <td>{{ $data->amount }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td> <a class="btn btn-success" type="button" href="{{ route('admin/payouts/').$data->id }}">Confirm</a> </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>


    
@endsection