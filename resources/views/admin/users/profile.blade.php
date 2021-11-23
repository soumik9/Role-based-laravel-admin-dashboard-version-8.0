@extends('admin.layouts.master')
@section('page_title')
    {{__('user.profile.title')}} - {{Auth::user()->name}}
@endsection
@section('content')

			
	<div class="page-breadcrumb">
        {{-- {{ Breadcrumbs::render('profile') }} --}}
    </div>
    


    <div class="card">

    	<form method="post" action="{{ route('profile.update') }}" id="profile" autocomplete="off">

    		@csrf()

	    	<div class="card-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h2 class="card-title">
					        <i data-feather="user" class="feather-icon"></i> {{Auth::user()->name}}
					    </h2>
			    	</div>
			    	<div class="col-6">
			    		<button type="submit" class="btn btn-primary float-right" style="margin-left: 15px;"><i data-feather="save" class="feather-icon"></i> {{__('user.form.save-button')}}</button>
			    	</div>
			    </div>
	    	</div>
	    	<div class="card-body">
				
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label for="name">{{__('user.form.name')}}:</label>
							<input type="text" class="form-control" disabled readonly value="{{Auth::user()->name}}">
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label for="email">{{__('user.form.email')}}:</label>
							<input type="email" class="form-control" disabled readonly value="{{Auth::user()->email}}">
						</div>
					</div>


					<div class="col-md-6">
						<div class="form-group @error('password') has-error @enderror">
							<label for="password">Password:</label>
							<input type="password" id="password" name="password" class="form-control @error('password') form-control-error @enderror" placeholder="Enter Password" >
							@error('password')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group @error('confirm-password') has-error @enderror">
							<label for="confirm-password">Confirm Password:</label>
							<input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Enter Confirm Passowrd">
							@error('confirm-password')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
					

				</div>
			
	
	    	</div>
	    </form>

    </div>
	

@endsection