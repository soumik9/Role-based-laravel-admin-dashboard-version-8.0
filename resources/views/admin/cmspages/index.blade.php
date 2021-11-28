@extends('admin.layouts.master')

@section('page_title')
    {{__('cmspage.index.title')}}
@endsection

@push('css')
	<style>
		.table tr td{
			vertical-align: middle;
		}
	</style>
@endpush

@section('content')

	<!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">{{__('cms.index.title')}}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('cmspages.index') }}">{{ __('cms.index.title') }}</a>
						</li>
					</ul>
				</div>
				@if (Gate::check('cmspage-create'))
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<a href="{{ route('cmspages.create') }}" class="btn custom-create-btn">{{ __('cms.form.add-button') }}</a>
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
					<table class="table table-hover table-center mb-0" id="table">
						<thead>
							<tr>
								<th class="">{{__('default.table.sl')}}</th>
								<th class="">{{__('default.table.title')}}</th>
								<th class="">{{__('default.table.slug')}}</th>
								<th class="">{{__('default.table.category')}}</th>
								<th class="">{{__('default.table.status')}}</th>

								@if(Gate::check('cmspage-edit') || Gate::check('cmspage-delete'))
									<th class="">{{__('default.table.action')}}</th>
								@endif 
							</tr>
						</thead>

						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>

		</div>	
	</div>
@endsection


@push('scripts')
<script>
	$(function() {
		$('#table').DataTable({
			processing	: true,
			responsive 	: false,
			serverSide	: true,
			order:       [[0, 'desc' ]],
			ajax 		: '{{ route('cmspages.index') }}',
			columns			: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
					{ data: 'title', name: 'title' },
					{ data: 'slug', name: 'slug' },
					{ data: 'category', name: 'category' },
					{ data: 'status', name: 'status' },						        

					@if(Gate::check('cmspage-edit') || Gate::check('cmspage-delete'))
						{ data: 'action', name: 'action', orderable: false, searchable: false}
					@endif 
				],

		});
	});
</script>

<script type="text/javascript">
	$("body").on("click",".remove-cmspage",function(){
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


<script type="text/javascript">
	function changeCmspageStatus(_this, id) {
		var status = $(_this).prop('checked') == true ? 1 : 0;
		let _token = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: `{{route('cmspages.status_update')}}`,
			type: 'get',
			data: {
				_token: _token,
				id: id,
				status: status 
			},
			success: function (result) {
				if(status == 1){
					toastr.success(result.message);
				}else{
					toastr.error(result.message);
				} 
			}
		});
	}
</script>
@endpush