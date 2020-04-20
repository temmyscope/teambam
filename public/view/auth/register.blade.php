@extends('app')
@section('title', 'Register')
@section('content')

	<?php use App\Helpers\HTML; ?>

	<?= HTML::Card('Register'); ?>

	<?= HTML::generateForm('register', [
			'name' => [ 'rule' => 'required', 'type'=>'text', 'placeholder' => 'Jane Doe'],
			'email' => [ 'rule' => 'required', 'type'=>'email', 'placeholder' => 'user@example.com'],
			'password' => ['rule' => 'required', 'type' => 'password', 'placeholder' =>'*********'],
			'verify_password' => ['rule' => 'required', 'type' => 'password', 'placeholder' =>'*********'],
			'Register' => [ 'type' => 'submit']
		]);
	?>

	<div class='col-md-4 col-form-label text-md-left'>
		<span style="color: red;">* Please Enter Your Name in the other: Firstname Lastname</span>
		<br>
		<span> <a href="{{ route('login') }}">Login</a> | <a href="{{ route('forgot_password') }}">Forgot password </a> </span>
	</div>
	
@endsection