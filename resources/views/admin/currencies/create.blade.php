@extends('admin.layouts.master')

@section('page_title')
    {{__('currency.create.title')}}
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}

	</style>
@endpush

@section('content')

    <div class="content container-fluid">

    	<form method="post" action="{{ route('currencies.store') }}" enctype="multipart/form-data" id="currency_create_form">
    		@csrf()
	    	<div class="page-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h3 class="page-title">
			    			<a href="{{ route('currencies.index') }}"><i class="fe fe-arrow-left"></i></a>
					        {{__('currency.create.title')}}
        					{{ Breadcrumbs::render('currencies.create') }}
					    </h3>

			    	</div>
			    	<div class="col-6">
			    		<button type="submit" class="save-button btn btn-outline-success btn-rounded float-right">
			    			<i class="fe fe-document"></i> 
			    			{{__('currency.form.save-button')}}
			    		</button>
			    	</div>
			    </div>
	    	</div>

	    	<div class="card-body">

	    		<div class="row">
	    			<div class="col-md-12">
	    				<div class="card">
							<div class="card-header">
							    <h5 class="card-title">
							    	Currency Information
							    </h5>
							</div>
					      
					        <div class="card-body">

					        	<div class="row">
					        		<div class="col-md-8">
					        			<div class="form-group">
											<label for="name" class="required">{{__('currency.form.name')}}:</label>

											<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{old('name')}}">

											@error('name')
												<span class="text-danger">{{ $message }}</span>
											@enderror

										</div>


										<div class="form-group">
											<label for="code" class="required">{{__("currency.form.code")}}:</label>

											<input type="text" name="code" id="code" class="form-control @error('code') form-control-error @enderror" required="required" value="{{old('code')}}">

											@error('code')
												<span class="text-danger">{{ $message }}</span>
											@enderror
											
										</div>


										<div class="form-group">
											<label for="symbol" class="required">{{__("currency.form.symbol")}}:</label>

											<input type="text" name="symbol" id="symbol" class="form-control @error('symbol') form-control-error @enderror" required="required" value="{{old('symbol')}}">

											@error('symbol')
												<span class="text-danger">{{ $message }}</span>
											@enderror
											
										</div>


										<div class="form-group">
											<label for="status" class="required">{{__("currency.form.status")}}:</label>

											<select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>

											@error('status')
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
		$("#currency_create_form").validate();
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