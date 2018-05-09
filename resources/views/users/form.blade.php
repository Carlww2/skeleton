@extends('layouts.main')
@section('pageTitle', 'Usuarios')
@section('content')
<div class="container-fluid content-body">
	@if(session('msg'))
	<div class="alert alert-danger">
		{{session('msg')}}
	</div>
	@endif
	<div class="page-title">
		<h1>{{$user->id ?  __('panel.update') : __('panel.create')}} <span class="semi-bold">Administrador</span></h1>
	</div>
	<div class="row-fluid">
		{{ Form::model($user, ['route' => !$user->id?'User.store':['User.update',$user->id], 'class' => 'form valid', 'id' => 'UserForm' ,'autocomplete' => 'off']) }}
			@if($user->id)
			{{ method_field('PUT') }}
			@endif
			<div class="row">
				<div class="form-group col-md-12 {{$errors->user->first('fullname')?'has-error':''}}">
					{{Form::label('fullname', 'Nombre', ['class' => 'control-label  required'])}}
					{{Form::text('fullname', null, ['class' => 'form-control not-empty', 'data-name' => 'Nombre'])}}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6 {{$errors->user->first('email')?'has-error':''}}">
					{{Form::label('email', 'Correo electrónico', ['class' => 'control-label  required'])}}
					{{Form::email('email', null,['class' => 'form-control not-empty email', 'data-name' => "Email", 'readonly' => $user->id?true:false])}}
					{{@$errors->user->first('email')}}
				</div>
				<div class="form-group col-md-6 {{$errors->user->first('password')?'has-error':''}}">
					@php
						$req = $user->id?'':'required';
					@endphp
					{{Form::label('password', 'Contraseña', ["class" => "control-label ".$req])}}
					{{Form::password('password', ['class' => !$user->id?'form-control not-empty length':'form-control length', 'data-name' => "Contraseña", 'data-min' => '8'])}}
				</div>
			</div>
			@if( $user->role_id != 2 )
			<div class="row">
				<div class="form-group col-md-12 {{$errors->user->first('role_id')?'has-error':''}}">
					{{Form::label('role_id', 'Rol', ['class' => 'control-label  required'])}}
					{{Form::select('role_id', $roles, $user->id?$user->role_id:0,['class' => 'form-control not-empty', 'data-name' => "Rol"])}}
				</div>
			</div>
			@endif
			<div class="row buttons-form">
				{{link_to(route('User.index1'), $title = __('panel.return'), $attributes = ['class' => "btn btn-danger"], $secure = null)}}
				{{Form::submit(__('panel.save'),['class' => 'btn btn-success guardar', 'data-target' => 'UserForm'])}}
			</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
