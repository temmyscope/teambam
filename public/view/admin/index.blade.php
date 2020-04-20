@extends('app')
@section('title', 'Admin')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>Action</th>
					<th>Options</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
				<tr>
					<td> Orders </td>
					<td>
						<a class="btn btn-success" type="button" href="{{ route('admin/orders').'?type=cancelled' }}">Cancelled</a>
						<a class="btn btn-success" type="button" href="{{ route('admin/orders').'?type=confirmed' }}">Confirmed</a>
						<a class="btn btn-success" type="button" href="{{ route('admin/orders').'?type=pending' }}">Pending</a>
					</td>
				</tr>

				<tr>
					<td> Users </td>
					<td>
						<a class="btn btn-success" type="button" href="{{ route('admin/change_role') }}">Change Role/Privilege</a>
					</td>
				</tr>

				<tr>
					<td> Activity Chart </td>
					<td>
						<a class="btn btn-success" type="button" href="{{ route('admin/charts') }}">View Chart</a>
					</td>
				</tr>

				<tr>
					<td> Withdrawal Requests </td>
					<td>
						<a class="btn btn-success" type="button" href="{{ route('admin/payouts') }}">Process</a>
					</td>
				</tr>

            </tbody>

        </table>
    </div>


    
@endsection