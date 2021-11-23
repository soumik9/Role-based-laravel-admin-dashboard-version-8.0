@extends('admin.layouts.master')

@section('page_title')
    {{__('user.edit.title')}}
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

    	<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" id="user_edit_form">
    		@csrf()
	    	<div class="page-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h3 class="page-title">
					        <a href="{{ route('users.index') }}">
					        	<i class="fe fe-arrow-left"></i>
					        </a> 
					        {{__('user.edit.title')}}
        					{{ Breadcrumbs::render('users.edit') }}
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
	    			<div class="col-md-12">
	    				<div class="row">


							<div class="col-md-4 col-sm-12" style="margin: auto;">

						            {{-- <label for="image_label">Image</label> --}}
						            <div class="input-group mb-5">
						            	@if(!empty($user->image))
						            		<img src="{{ $user->image }}" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3"  onerror="this.src='{{ asset('assets/img/user.png') }}';">
						            	@else
						            		<img src="" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/img/user.png') }}';">
						            	@endif

						                <input type="text" hidden id="image1" class="form-control" name="image" aria-label="Image" aria-describedby="button-image">
						                <div class="input-group-append" style="width: 100%;">
						                    <button class="btn btn-secondary btn-lg btn-block" type="button" id="button-image">
						                    <i data-feather="image" class="feather-icon"></i>
						                    Change User's Image
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



						{{-- <div id="accordion">


						    <div class="card">
						      <div class="card-header">
						        <a class="collapsed card-link" data-toggle="collapse" href="#personal_information">
						        Personal Information
						      </a>
						      </div>
						      <div id="personal_information" class="collapse show" data-parent="#accordion">
						        <div class="card-body">
						          	


						          	<div class="row">

										<div class="col-md-8">
											
											<div class="form-group">
												<label for="name" class="required">{{__('user.form.name')}}:</label>

												<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{$user->name}}">

												@error('name')
													<span class="text-danger">{{ $message }}</span>
												@enderror

											</div>


											<div class="form-group">
												<label for="mobile">{{__("user.form.mobile")}}:</label>

												<input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror" value="{{$user->mobile}}">

												@error('mobile')
													<span class="text-danger">{{ $message }}</span>
												@enderror
												
											</div>

										</div>

										<div class="col-md-4">
											<div class="card bg-secondary mb-3 instruction">
												<div class="card-header">
													<i data-feather="help-circle" class="feather-icon"></i> Instructions
												</div>
												<div class="card-body">
													<ul>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
													</ul>
												</div>
											</div>
										</div>


									</div>
						        </div>
						      </div>
						    </div>


						    <div class="card">
						      <div class="card-header">
						        <a class="card-link" data-toggle="collapse" href="#authentication">
						          Authentication
						        </a>
						      </div>
						      <div id="authentication" class="collapse show" data-parent="#accordion">
								<div class="card-body">



									<div class="row">
										
											


										<div class="col-md-8">

											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label for="email">{{__("user.form.email")}}:</label>

													<input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" required="required" value="{{$user->email}}">

													@error('email')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													
												</div>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label for="password">{{__("user.form.password")}}:</label>

													<input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror" autocomplete="off">

													@error('password')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													
												</div>
											</div>

											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label for="password-confirm">{{__("user.form.password-confirm")}}:</label>

													<input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror">

													@error('confirm-password')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													
												</div>
											</div>
										</div>



										<div class="col-md-4">
											<div class="card bg-secondary mb-3 instruction">
												<div class="card-header">
													<i data-feather="help-circle" class="feather-icon"></i> Instructions
												</div>
												<div class="card-body">
													<ul>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
													</ul>
												</div>
											</div>
										</div>
										

									</div>

								</div>
						      </div>
						    </div>


						    <div class="card">
						      <div class="card-header">
						        <a class="collapsed card-link" data-toggle="collapse" href="#role">
						          Role & Permission
						        </a>
						      </div>
						      <div id="role" class="collapse show" data-parent="#accordion">
						        <div class="card-body">
						          	<div class="row">
						          		<div class="col-md-8">
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">

													<label for="roles">{{__("user.form.role")}}:</label>
													{!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple','required' => 'required')) !!}

													@error('roles')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													
												</div>
											</div>
										</div>

										

										<div class="col-md-4">
											<div class="card bg-secondary mb-3 instruction">
												<div class="card-header">
													<i data-feather="help-circle" class="feather-icon"></i> Instructions
												</div>
												<div class="card-body">
													<ul>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
														<li>Lorem</li>
													</ul>
												</div>
											</div>
										</div>
						          	</div>
						        </div>
						      </div>
						    </div>


						 </div> --}}



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

									<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{$user->name}}">

									@error('name')
										<span class="text-danger">{{ $message }}</span>
									@enderror

								</div>


								<div class="form-group">
									<label for="mobile">{{__("user.form.mobile")}}:</label>

									<input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror" disabled value="{{$user->mobile}}">

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
									<label for="email">{{__("user.form.email")}}:</label>

									<input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" value="{{$user->email}}" disabled>

									@error('email')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

								<div class="form-group">
									<label for="password">{{__("user.form.password")}}:</label>

									<input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror">

									@error('password')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>

								<div class="form-group">
									<label for="password-confirm">{{__("user.form.password-confirm")}}:</label>

									<input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror">

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

									<label for="roles">{{__("user.form.role")}}:</label>
									{!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple','required' => 'required')) !!}

									@error('roles')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
								</div>
					        </div>
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
		$("#user_edit_form").validate();
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
@endpush