@extends('app')
@section('title', 'Wallet')
@section('content')

	<?php use App\Helpers\HTML; ?>

	<?= HTML::Card('<center><b>Withdraw From Wallet</b></center>'); ?>
		<form action="{!! route('profile/wallet') !!}" method="POST">
		
            <div class="form-group">
              <div class="form-label-group">
			  <?php $banks = app(__DIR__.'/../config/banks.php')->all(); ?>
			  	<select name="bank_code" class="form-control" placeholder="Available Banks">
				@foreach($banks as $code => $bank)
                  	<option value="{!! $code !!}">{!! $bank !!}</option>
				@endforeach
                </select>
				<?php unset($banks); ?>
              </div>
            </div>
            
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="name" name="account_name" class="form-control" placeholder="{!! $_SESSION['name'] !!}" disabled>
                <label for="name">{!! $_SESSION['name'] !!}</label>
              </div>
            </div>

			<div class='form-group row'>
            	<label for='acc_num' class='col-md-2 col-form-label text-md-right'> Account Number: </label>
				<div class='col-md-10'>
					<input id='acc_num' type='number' class='form-control' name='account_number' placeholder="0176986532" required>                        
            	</div>
            </div>

			<div class='form-group row'>
            	<label for='amount' class='col-md-2 col-form-label text-md-right'> Amount: </label>
				<div class='col-md-10'>
					<input id='amount' type='number' class='form-control' name='amount' placeholder="5000" required>                        
            	</div>
            </div>

            <button type="submit" class="btn btn-block btn-success" name="submit">Withdraw</button>
        </form>

	<br>

	@forelse( $dataSource as $data )

		<?= HTML::Card('Pending Withdrawals'); ?>
			You have a pending withdrawal of {!! $data['amount'] !!} NGN been processed
		<?= HTML::closecard() ?>

	@empty
	@endforelse

@endsection