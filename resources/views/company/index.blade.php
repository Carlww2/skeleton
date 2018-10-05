@extends('layouts.main')
@section('pageTitle', __('panel.company'))
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert alert-success">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1><span class="semi-bold">@lang('panel.company')</span></h1>
	</div>
	<div class="row-fluid">
		<div id="body-content">
			{{ Form::model($company, ['url' => route('Company.update', $company->id), 'class' => 'form valid', 'id' => 'newsForm' ,'autocomplete' => 'off', 'files' => true]) }}
				@if($company->id)
				{{ method_field('PUT') }}
				@endif
				<div class="row">
					<div class="form-group col-md-12">
						{{Form::label('name', __('panel.company.name'), ['class' => 'control-label  required'])}}
						{{Form::text('name', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.company.name')])}}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						{{Form::label('description',  __('panel.company.description'), ['class' => 'control-label  required'])}}
						{{Form::textarea('description', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.company.description')])}}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						{{Form::label('philosophy', __('panel.company.philosophy'), ['class' => 'control-label  required'])}}
						{{Form::textarea('philosophy', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.company.philosophy')])}}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						{{Form::label('terms_conditions', __('panel.company.terms_conditions'), ['class' => 'control-label  required'])}}
						{{Form::textarea('terms_conditions', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.company.terms_conditions')])}}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-12">
						{{Form::label('privacy', __('panel.company.privacy'), ['class' => 'control-label  required'])}}
						{{Form::textarea('privacy', null, ['class' => 'form-control not-empty', 'data-name' => __('panel.company.privacy')])}}
					</div>
				</div>
				<div class="row">
					@if( $company->logo )
						<div class="col-md-3">
							<img src="{{asset($company->logo)}}" alt="Foto empresa" class="show">
						</div>
					@endif
					<div class="form-group col-md-{{$company->logo?'9':'12'}}">
						{{Form::label('logo',  __('panel.company.logo'), ['class' => !$company->logo?'label-control required':'label-control'])}}
						{{Form::file('logo', ['class' =>!$company->logo?'form-control not-empty file image':'form-control file image', 'data-name' =>  __('panel.company.logo')])}}
					</div>
				</div>
				<div class="row text-left buttons-form">
					{{Form::submit(__('panel.save'),['class' => 'btn btn-success guardar', 'data-target' => 'newsForm'])}}
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection
