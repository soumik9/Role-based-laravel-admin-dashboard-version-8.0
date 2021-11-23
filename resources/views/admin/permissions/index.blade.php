@extends('admin.layouts.master')
@section('page_title')
    {{__('permission.index.title')}}
@endsection
@section('content')


    <div class="content container-fluid">

    	<div class="page-header">
    		<div class="row">
		    	<div class="col-md-6 col-sm-12">
		    		<h3 class="page-title">
				        {{__('permission.index.title')}}
				        {{ Breadcrumbs::render('permissions.index') }}
				    </h3>
		    	</div>
		    	<div class="col-md-6 col-sm-12">
		    		@can('permission-create')
		    			<a href="{{ route('permissions.create') }}" class="create-button btn btn-outline-primary btn-rounded float-right">
		    				<i class="fe fe-plus"></i> 
		    				{{__('permission.form.add-button')}}
		    			</a>
		    		@endcan
		    	</div>

		    </div>
    	</div>
	    <div class="row">

	    	<div class="col-md-12">
	    		<div class="card">
	    			<div class="card-body">
	    				<table class="table table-report -mt-2" id="permission_table">
							<thead>
								<tr>
									{{-- <th class="">{{__('permission.form.id')}}</th> --}}
									<th class="">{{__('permission.form.name')}}</th>

									@if(Gate::check('permission-edit') || Gate::check('permission-delete'))
										<th class="">{{__('permission.form.action')}}</th>
									@endif 
								</tr>
							</thead>

							<tbody>

								@foreach($permissions as $permission)
									<tr>
										<td>
											{{-- @php
												$string = str_replace('-', ' ', $permission->name);
												echo $string = ucfirst($string);
											@endphp --}}

											{{$permission->name}}
										</td>


										<td>
											


				                            @if(Gate::check('permission-edit'))
				                                <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-sm bg-warning-light">
				                                    <i class="fe fe-pencil"></i>
				                                        {{__('permission.form.edit-button')}}
				                                </a>
											@endif 

											@if( Gate::check('permission-delete'))
												<span class="flex justify-center items-center">
													<button class="btn btn-sm bg-danger-light" data-id="{{ $permission->id }}" data-action="/permissions/destroy">
														<i class="fe fe-trash"></i>
						                                {{__('permission.form.delete-button')}}
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

						


			<script>
				$(document).ready( function () {
				    $('#permission_table').DataTable();
				} );
		    </script>
	    </div>
    </div>
	

@endsection







@push('scripts')
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