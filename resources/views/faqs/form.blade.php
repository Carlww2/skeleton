@extends('layouts.main')
@section('pageTitle', __('panel.faqs'))
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert alert-danger">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1>{{$faq->id ?  __('panel.update') : __('panel.create')}} <span class="semi-bold">@lang('panel.faq')</span></h1>
	</div>
	<div class="row-fluid">
	{{ Form::model($faq, ['route' => !$faq->id?['Faq.store']:['Faq.update', $faq->id], 'class' => 'form valid', 'id' => 'faqsForm' ,'autocomplete' => 'off']) }}
			@if($faq->id)
			{{ method_field('PUT') }}
			@endif
			<div class="row">
				<div class="form-group col-md-12 {{$errors->faq->first('question')?'has-error':''}}">
					{{Form::label('question', __('panel.faqs.question'), ['class' => 'control-label  required'])}}
					{{Form::text('question', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.faqs.question')])}}
					{{@$errors->faq->first('question')}}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12 {{$errors->faq->first('answer')?'has-error':''}}">
					{{Form::label('answer', __('panel.faqs.answer'), ['class' => !$faq->id?'label-control required':'label-control'])}}
					{{Form::textarea ('answer', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.faqs.answer')])}}
				</div>
			</div>
			<div class="row buttons-form">
				{{link_to(route('Faq'), $title = __('panel.return'), $attributes = ['class' => "btn btn-danger"], $secure = null)}}
				{{Form::submit(__('panel.save'),['class' => 'btn btn-success guardar', 'data-target' => 'faqsForm'])}}
			</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
