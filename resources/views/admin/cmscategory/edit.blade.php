@extends('admin.layouts.master')

@section('page_title')
    {{__('cmscategory.edit.title')}}
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

    	<form method="post" action="{{ route('cmscategory.update', $category->id) }}" id="category_edit_form">
    		@csrf()
	    	<div class="page-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h3 class="page-title">
			    			<a href="{{ route('cmscategory.index') }}"><i class="fe fe-arrow-left"></i></a>
					        {{__('cmscategory.edit.title')}}
        					{{ Breadcrumbs::render('cmscategory.edit') }}
					    </h3>

			    	</div>
			    	<div class="col-6">
			    		<button type="submit" class="save-button btn btn-outline-success btn-rounded float-right">
			    			<i class="fe fe-document"></i>
			    			{{__('cmscategory.form.update-button')}}
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
							    	CMS Category Information
							    </h5>
							</div>

					        <div class="card-body">
					        	<div class="row">
					        		<div class="col-md-12">

					        			<div class="form-group">
											<label for="name" class="required">{{__('cmscategory.form.name')}}:</label>
											<input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{$category->name}}">
											@error('name')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="slug" class="required">{{__("cmspage.form.slug")}}:</label>
											<input type="text" name="slug" id="slug" class="form-control" disabled value="{{$category->slug}}">

											@error('slug')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="status" class="required">{{__("cmscategory.form.status")}}:</label>

											<select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
												<option value="1" @if($category->status == "1") selected @endif>Active</option>
												<option value="0" @if($category->status == "0") selected @endif>Inactive</option>
											</select>

											@error('status')
												<span class="text-danger">{{ $message }}</span>
											@enderror

										</div>

					        		</div>
					        	</div>
					        </div> <!-- card-body-finish -->


					    </div> <!-- card-finish -->
	    			</div>
	    		</div> <!-- row-finish -->

			</div> <!-- card-body-finish -->
		</form>
    </div> <!-- container-finish -->
@endsection


@push('scripts')
	<script>
		$("#category_edit_form").validate();
	</script>

<script type="text/javascript">

$("#name").keyup(function(){
    var name = this.value;
    name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
    $("#slug").val(name);
})
</script>
@endpush
