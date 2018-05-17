@extends('layouts.main')
@section('pageTitle', __('panel.news'))
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert alert-danger">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1>{{$new->id ?  __('panel.update') : __('panel.create')}} <span class="semi-bold">@lang('panel.new')</span></h1>
	</div>
	<div class="row-fluid">
	{{ Form::model($new, ['route' => !$new->id?'News.store':['News.update', $new->id], 'class' => 'form valid', 'id' => 'newsForm' ,'autocomplete' => 'off', 'files' => true]) }}
			@if($new->id)
			{{ method_field('PUT') }}
			@endif
			<div class="row">
				<div class="form-group col-md-12 {{$errors->new->first('title')?'has-error':''}}">
					{{Form::label('title', __('panel.news.title'), ['class' => 'control-label  required'])}}
					{{Form::text('title', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.news.title')])}}
					{{@$errors->new->first('title')}}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12 {{$errors->new->first('content')?'has-error':''}}">
					{{Form::label('content', __('panel.news.content'), ['class' => 'control-label  required'])}}
					{{Form::textarea('content', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.news.content')])}}
				</div>
			</div>
			<div class="row">
				@if( $new->photo )
					<div class="col-md-3">
						<img src="{{asset('img/news/'.$new->id.'/'.$new->photo)}}" alt="Foto noticia" class="show">
					</div>
				@endif
				<div class="form-group col-md-{{$new->photo?'9':'12'}} {{$errors->new->first('photo')?'has-error':''}}">
					{{Form::label('photo', __('panel.news.photo'), ['class' => !$new->id?'label-control required':'label-control'])}}
					{{Form::file('photo', ['class' =>!$new->id?'form-control not-empty file image':'form-control file image', 'data-name' => __('panel.news.photo')])}}
				</div>
			</div>
			<div class="row text-left buttons-form">
				{{link_to(route('News'), $title = __('panel.return'), $attributes = ['class' => "btn btn-danger"], $secure = null)}}
				{{Form::submit(__('panel.save'),['class' => 'btn btn-success guardar', 'data-target' => 'newsForm'])}}
			</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
