<div class="table-responsive">
	<table class="table table-hover table-condense datatable">
		<thead>
			<th class="hide">ID</th>
			<th>
				<div class="checkbox check-success 	">
					<input id="checkboxParent" type="checkbox">
					<label for="checkboxParent"></label>
				</div>
			</th>
			<th>@lang('panel.banner.image')</th>
			<th>@lang('status')</th>
			<th>@lang('actions')</th>
		</thead>
		<tbody>
			@foreach($banners as $banner)
				<tr>
					<td class="hide">{{$banner->id}}</td>
					<td>
						<div class="checkbox check-success">
							<input id="checkbox{{$banner->id}}" class="multiple-delete" type="checkbox" value="{{$banner->id}}">
							<label for="checkbox{{$banner->id}}"></label>
						</div>
					</td>
					<td>
						<img src="{{asset('img/banners/'.$banner->id.'/'.$banner->image)}}" alt="Foto banner" width="25%">
					</td>
					<td>
						@if($banner->status)
						<span class="label label-success status" data-url="{{route('Banner.status')}}" data-id="{{$banner->id}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.status')}}">@lang('panel.active')</span>
						@else
						<span class="label label-danger status" data-url="{{route('Banner.status')}}" data-id="{{$banner->id}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.status')}}">@lang('panel.inactive')</span>
						@endif
					</td>
					<td>
						<a class="btn btn-xs btn-mini btn-primary" href="{{route('Banner.form', $banner->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('panel.edit')}}"><i class="fa fa-pencil"></i></a>
						<a href="{{route('Banner.destroy', $banner->id) }}" class="btn btn-xs btn-mini btn-danger delete_row" data-toggle="tooltip" data-placement="top" title="{{__('panel.delete')}}"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>