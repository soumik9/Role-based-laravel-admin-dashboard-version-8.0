@extends('admin.layouts.master')

@section('page_title')
    {{__('permission.index.title')}}
@endsection

@section('content')
	<!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">{{__('permission.index.title')}}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('permissions.index') }}">{{ __('permission.index.title') }}</a>
						</li>
					</ul>
				</div>
				@if (Gate::check('permission-create'))
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<a href="{{ route('permissions.create') }}" class="btn custom-create-btn">{{ __('permission.form.add-button') }}</a>
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
					<table class="table table-report -mt-2" id="permission_table">
						<thead>
							<tr>
								<th>{{__('default.table.sl')}}</th>
								<th>{{__('default.table.name')}}</th>

								@if(Gate::check('permission-edit') || Gate::check('permission-delete'))
									<th>{{__('default.table.action')}}</th>
								@endif 
							</tr>
						</thead>

						<tbody>
							@foreach($permissions as $permission)
								<tr>
									<td>{{ $loop->iteration }}</td>          
									<td>{{ $permission->name }}</td>

									<td>
										@if(Gate::check('permission-edit'))
											<a href="{{route('permissions.edit', $permission->id)}}" class="custom-edit-btn mr-1">
												<i class="fe fe-pencil mr-1"></i>{{__('default.form.edit-button')}}
											</a>
										@endif 

										@if( Gate::check('permission-delete'))
											<button class="custom-delete-btn remove-permission" data-id="{{ $permission->id }}" data-action="/admin/permissions/destroy">
												<i class="fe fe-trash mr-1"></i>{{__('default.form.delete-button')}}
											</button>
										@endif 
									</td>
								</tr>
							@endforeach
						</tbody>		
					</table>
				</div>
			</div>

		</div> <!-- /col-md-12 -->
	</div> <!-- /row -->
@endsection



@push('scripts')
<script>
	$(document).ready( function () {
		$('#permission_table').DataTable();
	} );
</script>

<script type="text/javascript">
	$("body").on("click",".remove-permission",function(){
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