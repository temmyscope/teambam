@extends('app')
@section('title', 'Products')
@section('content')

	<?php use App\Helpers\HTML; ?> 

	<?= HTML::Card('Products'); ?>
    
    <div class="table-responsive">
        <table class="table " id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
					<th>Product Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
					<th >Measurement</th>
                    <th >Price</th>
					<th >Resellable</th>
                    <th>Status</th>
					<th>Last Updated</th>
					<th></th>
                </tr>
            </thead>

            <tbody style="font-size: 20px">
			@forelse($dataSource as $data)
				<?php $data = (object) $data; ?>
				<tr>
					<td>{{ $data->product_code }}</td>
					<td>{{ $data->product_name }}</td>
					<td>{{ $data->quantity }}</td>
					<td>{{ $data->measurement }}</td>
					<td>{{ $data->price }}</td>
					<td>{{ $data->resellable }}</td>
					<td>{{ $data->status }}</td>
					<td>{{ $data->updated_at }}</td>
					<td>
						<a class="btn btn-success" type="button" href="{{ route('products/edit').'/'.$data->id }}">Edit</a>
					</td>
				</tr>
			@empty

			@endforelse
			
				<tr>
					<center>
						<td>
							<a type="button" class="btn btn-success" href="{{ route('products/add') }}" >Add Product(s)</a>
						</td>
					</center>
				</tr>

            </tbody>

        </table>
    </div>


    
@endsection