@extends('admin.layouts.master')

@section('page_title')
    {{__('role.create.title')}}
@endsection

@section('content')
	<form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
		@csrf()

		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">{{__('role.index.title')}}</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('roles.index') }}">{{ __('role.index.title') }}</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('roles.create') }}">{{ __('role.create.title') }}</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
						</div>
					</div>
				</div>
			</div><!-- /card finish -->	
		</div><!-- /Page Header -->

		<div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Roles Information</h4>
                    </div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-12">

								<div class="form-group">
									<label for="name" class="required">{{ __('default.form.name') }}</label>
									<input type="text" class="form-control" name="name" id="name" class="form-control @error('name') form-control-error @enderror" placeholder="Enter role name" value="{{ old('name') }}" required>

									@error('name')
										<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="code" class="required">{{ __('default.form.code') }}</label>
									<input type="text" class="form-control" name="code" id="code" class="form-control @error('code') form-control-error @enderror" placeholder="Enter code" value="{{ old('code') }}" required>

									@error('code')
										<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="permission"><h5>Permissions</h5></label>
									
									@error('permission')
										<span class="text-danger">{{ $message }}</span>
									@enderror
									
									<div class="checkbox">
										<input type="checkbox" id="checkPermissionAll" value="1"> All
									</div>
									<hr>

									<div class="col-md-10">
										@foreach ($permissions as $permission)
											<div class="checkbox">
												<label>
													<input type="checkbox" class="@error('permission') form-control-error @enderror" name="permission[]" value="{{ $permission->id }}"> {{ $permission->name }}
												</label>
											</div>
										@endforeach
									</div>
								</div>

							</div><!-- end col-md-12 -->
						</div><!-- end row -->
					</div> <!-- end card body -->

				</div> <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div><!-- end row -->

	</form>
@endsection

@push('scripts')
<script>
	$("#checkPermissionAll").click(function(){
		if($(this).is(':checked'))
		{
			$('input[type=checkbox]').prop('checked', true)
		}else
		{
			$('input[type=checkbox]').prop('checked', false)
		}
	})
</script>
@endpush