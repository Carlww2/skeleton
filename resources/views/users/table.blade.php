<div class="table-responsive">
	<table class="table table-hover table-condense datatable">
		<thead>
			<th class="hide">ID</th>
			<th>@lang('panel.users.profile-picture')</th>
			<th>@lang('panel.users.fullname')</th>
			<th>@lang('panel.users.email')</th>
			<th>@lang('panel.users.role')</th>
			<th>@lang('status')</th>
			@if(Route::currentRouteName() == 'User.index1')
			<th>@lang('actions')</th>
			@endif
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="hide">{{$user->id}}</td>
					<td width="15%">
						<img src="{{asset($user->photo)}}" alt="Foto de perfil" style="width:50%;border-radius: 100px;">
					</td>
					<td>{{$user->fullname}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role->name}}</td>
					<td>
						@if($user->status)
							<span class="label label-success status" data-url="{{route('User.status')}}" data-id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.status')}}">@lang('panel.active')</span>
						@else
							<span class="label label-danger status" data-url="{{route('User.status')}}" data-id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.status')}}">@lang('panel.inactive')</span>
						@endif
					</td>

					@if( Route::currentRouteName() == 'User.index1' )
						<td>
							<a class="btn btn-xs btn-mini btn-primary" href="{{route('User.form',$user->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.edit')}}"><i class="fa fa-pencil"></i></a>
							<a href="{{route('User.destroy',$user->id) }}" class="btn btn-xs btn-mini btn-danger delete_row" data-toggle="tooltip" data-placement="top" title="{{__('panel.delete')}}"><i class="fa fa-trash"></i></a>
							@php
							/*<a class="btn btn-xs btn-mini btn-default" href="{{route('User.show',$user->id)}}" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-eye"></i></a>*/
							@endphp
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
</div>