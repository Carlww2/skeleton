@extends('layouts.main')
@section('pageTitle', 'Noticias')
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert alert-success">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1>
			@lang('panel.list', ['item' => "<span class='semi-bold'>".__('panel.news')."</span>"])
		</h1>
	</div>
	<div class="row-fluid text-left buttons-container">
		<a href="{{route('News.form')}}" class="btn btn-success add"><i class="glyphicon glyphicon-plus"></i> @lang('panel.new-button', ['item' => __('panel.new')])</a>
		<a href="{{route('News.multipleDestroys')}}" class="btn btn-danger multiple-delete-btn disabled" disabled><i class="glyphicon glyphicon-trash"></i> @lang('panel.multiple-delete')</a>
	</div>
	<div class="row-fluid">
		<div id="body-content">
			@include('news.table')
		</div>
	</div>
</div>
@endsection
