@extends('app')
@section('title', 'Search')
@section('content')

	<?php use app\Helpers\HTML; use app\Providers\Request;  ?>

	<?= HTML::Card('Search Results'); ?>

	You searched for: <?php print_r((Request::post())->search); ?>
	
@endsection