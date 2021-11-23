@extends('admin.layouts.master')

@section('page_title')
    {{__('user.create.title')}}
@endsection

@push('css')
	<style>
		#output{
			height: 300px;
			width: 300px;
		}

	</style>
@endpush

@section('content')

    <div class="content container-fluid">

    	<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" id="user_create_form">
    		@csrf()
	    	<div class="page-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h3 class="page-title">
			    			<a href="{{ route('users.index') }}"><i class="fe fe-arrow-left"></i></a>
					        {{__('user.create.title')}}
        					{{ Breadcrumbs::render('users.create') }}
					    </h3>

			    	</div>
			    	<div class="col-6">
			    		<button type="submit" class="save-button btn btn-outline-success btn-rounded float-right">
			    			<i class="fe fe-document"></i> 
			    			{{__('user.form.save-button')}}
			    		</button>
			    	</div>
			    </div>
	    	</div>

	    	<div class="card-body">

	    		<div class="row">
	    			<div class="col-md-4 col-sm-12" style="margin: auto;">

						<div class="input-group mb-5">
			            	
			            		<img src="" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/admin/img/user.png') }}';">

			                <input type="text" hidden id="image1" class="form-control" name="image" aria-label="Image" aria-describedby="button-image">
			                <div class="input-group-append" style="width: 100%;">
			                    <button class="btn btn-secondary btn-lg btn-block" type="button" id="button-image">
			                    <i data-feather="image" class="feather-icon"></i>
			                    Select User's Image
			                 	</button>
			                </div>
			            </div>



					</div>


					@push('scripts')

                        <script>
                          var loadFileImageFront = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                          };
                        </script>

                    @endpush
	    		</div>




	    		<div class="row">
	    			<div class="col-md-4">
	    				<div class="card">
							<div class="card-header">
							    <h5 class="card-title">
							    	Personal Information
							    </h5>
							</div>
					      
					        <div class="card-body">
										
										
								<div class="form-group">
									<label for="name" class="required">{{__('user.form.name')}}:</label>

									<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{old('name')}}">

									@error('name')
										<span class="text-danger">{{ $message }}</span>
									@enderror

								</div>


								<div class="form-group">
									<label for="mobile" class="required">{{__("user.form.mobile")}}:</label>

									<input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror" required="required" value="{{old('mobile')}}">

									@error('mobile')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

					        </div>
					    </div>
	    			</div>

	    			<div class="col-md-4">
	    				<div class="card">
							<h5 class="card-header">
							  Authentication
							</h5>

							<div class="card-body">

								<div class="form-group">
									<label for="email" class="required">{{__("user.form.email")}}:</label>

									<input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" required="required" value="{{old('email')}}">

									@error('email')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

								<div class="form-group">
									<label for="password" class="required">{{__("user.form.password")}}:</label>

									<input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror" required="required">

									@error('password')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

								<div class="form-group">
									<label for="password-confirm" class="required">{{__("user.form.password-confirm")}}:</label>

									<input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror" required="required">

									@error('confirm-password')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

							</div>
					    </div>
	    			</div>

	    			<div class="col-md-4">
	    				<div class="card">
							<h5 class="card-header">
							  Role & Permission
							</h5>

					        <div class="card-body">
								<div class="form-group">

									<label for="roles" class="required">{{__("user.form.role")}}:</label>
									{!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple', 'required' => 'required')) !!}

									@error('roles')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>
					        </div>
					    </div>
	    			</div>
	    		</div>
					    



				    


					    
				 
			</div>
			
		</form>

    </div>
	

@endsection


@push('scripts')
	<script>
		$("#user_create_form").validate();
	</script>


	<script>
	  document.addEventListener("DOMContentLoaded", function() {

	    document.getElementById('button-image').addEventListener('click', (event) => {
	      event.preventDefault();

	      inputId = 'image1';

	      window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
	    });

	  });

	  // input
	  let inputId = '';
	  let output = 'output';

	  // set file link
	  function fmSetLink($url) {
	    document.getElementById(inputId).value = $url;
	    document.getElementById(output).src = $url;
	  }
	</script>












	<script>
        $(document).ready(function() {
            $("#country").on('change', function() {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        type: 'GET',
                        url: '/customer/state/'+country_id,
                        dataType:'json',
                        success: function(data){                                           
                            if(data){
                                $("#state").empty();
                                $("#state").append('<option>Select State</option>');
                                $.each(data, function(key,value){
                                    $("#state").append('<option value="'+value+'">'+key+'</option>');
                                    $("#upozilla").removeAttr( "disabled" );

                                });               
                            }else{
                               $("#state").empty();
                            } 
                        }
                    });
                }else{
                    $("#state").empty();
                    $("#district").empty();
                    $("#upozilla").empty();
                    $("#upozilla").removeAttr( "disabled" );
                }                 
            });
            $('#state').on('change', function(){
                var state_id = $(this).val();    
                if (state_id) {
                    $.ajax({
                        type: 'GET',
                        url: '/customer/district/'+state_id,
                        dataType:'json',
                        success:function(data){               
                            if(data){
                                $("#district").empty();
                                $("#district").append('<option>Select District</option>');
                                $.each(data, function(key,value){
                                    $("#district").append('<option value="'+value+'">'+key+'</option>');
                                    $("#upozilla").removeAttr( "disabled" );
                                    $("#upozilla").empty();
                                    $("#upozilla").append('<option>Select Upozilla</option>');
                                });               
                            }else{
                                $("#district").empty();
                                $("#upozilla").empty();
                                $("#upozilla").append('<option>Select Upozilla</option>');
                            }
                        }
                    });
                }else{
                    $("#district").empty();
                    $("#upozilla").empty();
                }        
            });
            $('#district').on('change', function(){
                var district_id = $(this).val();
                if(district_id){
                    $.ajax({
                        type:"GET",
                        url:'/customer/upozilla/'+district_id,
                        dataType:'json',
                        success:function(data){
                        if(data){
                            $("#upozilla").empty();
                            $.each(data, function(key,value){
                                $("#upozilla").append('<option value="'+value+'">'+key+'</option>');
                            });

                            if(data == ""){
                                $("#upozilla").attr("disabled", "disabled");
                                $("#upozilla").append('<option value="0">City Corporation Don\'t have any Upozilla</option>');
                            }else{
                                $("#upozilla").removeAttr( "disabled" );
                            }
                        }else{
                            $("#upozilla").empty();
                        }
                       }
                    });
                }else{
                    $("#upozilla").empty();
                }
            });
        });
    </script>
@endpush