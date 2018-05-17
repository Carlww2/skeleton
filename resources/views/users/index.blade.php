@extends('layouts.main')
@section('pageTitle', __('panel.users'))
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert {{session('class')}}">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1>
			@lang('panel.list', ['item' => "<span class='semi-bold'>".__('panel.users')."</span>"])
		</h1>
	</div>
	<div class="row-fluid text-left buttons-container">
		<a href="{{route('User.form')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> @lang('panel.new-button', ['item' => __('panel.user')])</a>
	</div>
	<div class="row-fluid">
		<div id="body-content">
			@include('users.table')
		</div>
	</div>
</div>
@endsection
