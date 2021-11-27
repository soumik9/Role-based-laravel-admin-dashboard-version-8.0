@extends('admin.layouts.master')
@section('page_title')
    {{__('permission.edit.title')}}
@endsection
@section('content')
	<form method="POST" action="{{ route('permissions.update', $permissions->id) }}">
		@csrf()

		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">{{__('permission.index.title')}}</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('permissions.index') }}">{{ __('permission.index.title') }}</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('permissions.edit', $permissions->id) }}">{{ __('permission.edit.title') }} - ({{ $permissions->name }})</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
						</div>
					</div>
				</div>
			</div><!-- /card finish -->	
		</div><!-- /Page Header -->

		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<div class="form-group">
						<label for="name">{{__('default.form.name')}}:</label>
						<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{$permissions->name}}">

						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

				</div>
			</div> <!-- /row -->
		</div> <!-- /card-body -->

	</form>
@endsection