@extends('admin.layouts.master')
@section('page_title')
    {{__('role.index.title')}}
@endsection
@section('content')
	<!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">{{__('role.index.title')}}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('roles.index') }}">{{ __('role.index.title') }}</a>
						</li>
					</ul>
				</div>
				@if (Gate::check('role-create'))
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<a href="{{ route('roles.create') }}" class="btn custom-create-btn">{{ __('role.form.add-button') }}</a>
						</div>
					</div>
				@endif
			</div>
		</div><!-- /card finish -->	
	</div><!-- /Page Header -->

	<div class="row">
		<div class="col-md-12">
			<div class="card">

				<div class="card-body">
					<table class="table table-report" id="role_table">
						<thead>
							<tr>
								<th>{{__('default.table.sl')}}</th>
								<th>{{__('default.table.name')}}</th>
								<th>{{__('default.table.code')}}</th>

								@if(Gate::check('role-edit') || Gate::check('role-delete'))
									<th>{{__('default.table.action')}}</th>
								@endif 
							</tr>
						</thead>

						<tbody>
							@foreach($roles as $role)
								<tr>
									<td>{{$role->id}}</td>
									<td>{{$role->name}}</td>
									<td>{{$role->code}}</td>

									<td>
										@if(Gate::check('role-edit'))
											<a href="{{route('roles.edit', $role->id)}}" class="custom-edit-btn mr-1">
												<i class="fe fe-pencil"></i>
													{{__('default.form.edit-button')}}
											</a>
										@endif 

										@if( Gate::check('role-delete'))
											<span class="flex justify-center items-center">
												<button class="custom-delete-btn remove-role" data-id="{{ $role->id }}" data-action="/admin/roles/destroy">
													<i class="fe fe-trash"></i>
													{{__('default.form.delete-button')}}
												</button>
											</span>
										@endif 
									</td>
								</tr>
							@endforeach
							
						</tbody>
						
					</table>
				</div>
			</div>




		</div>

	</div>
@endsection




@push('scripts')
<script>
	$(document).ready( function () {
		$('#role_table').DataTable();
	} );
</script>

<script type="text/javascript">
	$("body").on("click",".remove-role",function(){
		var current_object = $(this);
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this data!",
			type: "error",
			showCancelButton: true,
			dangerMode: true,
			cancelButtonClass: '#DD6B55',
			confirmButtonColor: '#dc3545',
			confirmButtonText: 'Delete!',
		},function (result) {
			if (result) {
				var action = current_object.attr('data-action');
				var token = jQuery('meta[name="csrf-token"]').attr('content');
				var id = current_object.attr('data-id');

				$('body').html("<form class='form-inline remove-form' method='POST' action='"+action+"'></form>");
				$('body').find('.remove-form').append('<input name="_method" type="hidden" value="post">');
				$('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
				$('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
				$('body').find('.remove-form').submit();
			}
		});
	});
</script>
@endpush