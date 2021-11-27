@extends('admin.layouts.master')

@section('page_title')
    {{__('cmscategory.create.title')}}
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}

	</style>
@endpush

@section('content')
	<form method="POST" action="{{ route('cmscategories.store') }}">
		@csrf()

		<div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{__('cmscategory.index.title')}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">
								<a href="{{ route('cmscategories.index') }}">{{ __('cmscategory.index.title') }}</a>
							</li>
                            <li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('cmscategories.create') }}">{{ __('cmscategory.create.title') }}</a>
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

		<section class="crud-body">
			<div class="row">
				<div class="col-md-12">

					<div class="card">

						<div class="card-header">
							<h5 class="card-title"> CMS Category Information </h5>
						</div>

						<div class="card-body">
							<div class="row">
								<div class="col-md-12">

									<div class="form-group">
										<label for="name" class="required">{{__('default.form.name')}}:</label>
										<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{old('name')}}">
										
										@error('name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="slug" class="required">{{__("default.form.slug")}}:</label>
										<input type="text" name="slug" id="slug" readonly class="form-control @error('slug') form-control-error @enderror" required="required">

										@error('slug')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="status" class="required">{{__("default.form.status")}}:</label>
										<select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>

										@error('status')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

								</div> <!-- col-md-12-finish  -->
							</div>	<!-- row-finish  -->
						</div>   <!-- card-body-finish  -->

					</div> <!-- card-finish  -->

				</div>   <!-- col-md-12-finish  -->
			</div>    <!-- row-finish  -->
		</section>

	</form>
@endsection


@push('scripts')
<script type="text/javascript">
	$("#name").keyup(function(){
		var name = this.value;
		name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
		$("#slug").val(name);
	})
</script>
@endpush
