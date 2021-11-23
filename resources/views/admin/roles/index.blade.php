@extends('admin.layouts.master')
@section('page_title')
    {{__('role.index.title')}}
@endsection
@section('content')


    <div class="content container-fluid">

    	<div class="page-header">
    		<div class="row">
		    	<div class="col-md-6 col-sm-12">
		    		<h3 class="card-title">
				        {{__('role.index.title')}}
				        {{ Breadcrumbs::render('roles.index') }}
				    </h3>
		    	</div>
		    	<div class="col-md-6 col-sm-12">
		    		@can('role-create')
		    			<a href="{{ route('roles.create') }}" class="create-button btn btn-outline-primary btn-rounded float-right">
		    				<i class="fe fe-plus"></i> 
		    				{{__('role.form.add-button')}}
		    			</a>
		    		@endcan
		    	</div>
		    </div>
    	</div>
	    <div class="row">

	    	<div class="col-md-12">
			    
			    <div class="card">
			    	<div class="card-body">
			    		<table class="table table-report" id="role_table">
							<thead>
								<tr>
									<th class="">{{__('role.form.id')}}</th>
									<th class="">{{__('role.form.name')}}</th>
									<th class="">{{__('role.form.code')}}</th>

									@if(Gate::check('role-edit') || Gate::check('role-delete'))
										<th class="">{{__('role.form.action')}}</th>
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
				                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm bg-warning-light">
				                                    <i class="fe fe-pencil"></i>
				                                        {{__('role.form.edit-button')}}
				                                </a>
											@endif 

											@if( Gate::check('role-delete'))
												<span class="flex justify-center items-center">
													<button class="btn btn-sm bg-danger-light" data-id="{{ $role->id }}" data-action="/roles/destroy">
														<i class="fe fe-trash"></i>
						                                {{__('role.form.delete-button')}}
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



				<script>
					$(document).ready( function () {
					    $('#role_table').DataTable();
					} );
			    </script>
	    	</div>

	    </div>
    </div>
	

@endsection




@push('scripts')
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