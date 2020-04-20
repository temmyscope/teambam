@extends('app')
@section('title', 'Admin')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Admin DashBoard'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>User Email</th>
					<th>User Name</th>
					<th>User Privilege/Role</th>
					<th>Options/Change To</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
                @foreach( $dataSource as $data)
                <?php $data = (object) $data; ?>
                <tr>
                    <form action = "{{ route('admin/change_role') }}" method="POST">
					<td>{{ $data->email }}</td>
					<td>{{ $data->name }}</td>
					<td>{{ $data->role }}</td>
                    <input type ='hidden' name='user_id' value="{{ $data->id }}" >
					<td> 
                        <select class="form-control" name='role'> 
                            <option value='admin'>Admin</option>
                            <option value='supplier'>Supplier</option>
                            <option value='cutomer'>Customer</option>
                        </select> 
                    </td>
                    <td> <button value="change" type="submit" class="btn btn-success">Change Role</button> </td>
                    </form>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>


    
@endsection