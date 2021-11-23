@extends('admin.layouts.master')

@section('page_title')
    {{__('cmspage.create.title')}}
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

    	<form method="post" action="{{ route('cmspages.store') }}" enctype="multipart/form-data" id="cmspage_create_form">
    		@csrf()
	    	<div class="page-header">
	    		<div class="row">
			    	<div class="col-6">
			    		<h3 class="page-title">
			    			<a href="{{ route('cmspages.index') }}"><i class="fe fe-arrow-left"></i></a>
					        {{__('cmspage.create.title')}}
        					{{ Breadcrumbs::render('cmspages.create') }}
					    </h3>

			    	</div>
			    	<div class="col-6">
			    		<button type="submit" class="save-button btn btn-outline-success btn-rounded float-right">
			    			<i class="fe fe-document"></i> 
			    			{{__('cmspage.form.save-button')}}
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
							    	Page Information
							    </h5>
							</div>
					      
					        <div class="card-body">

					        	<div class="row">
					        		<div class="col-md-12">
					        			<div class="form-group">
											<label for="title" class="required">{{__('cmspage.form.title')}}:</label>

											<input type="text" name="title" id="title" class="form-control @error('title') form-control-error @enderror" required="required" value="{{old('title')}}">

											@error('title')
												<span class="text-danger">{{ $message }}</span>
											@enderror

										</div>


										<div class="form-group">
											<label for="slug" class="required">{{__("cmspage.form.slug")}}:</label>
											<input type="text" name="slug" id="slug" class="form-control @error('slug') form-control-error @enderror" required="required" value="{{old('slug')}}">

											@error('slug')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

										<div class="form-group">
											<label for="cat_id" class="required">{{__("cmspage.form.category")}}:</label>
											<select type="text" name="cat_id" id="cat_id" class="form-control @error('cat_id') form-control-error @enderror" required="required">
												@foreach ($categories as $category)
													<option value="{{$category->id}}">{{$category->name}}</option>
												@endforeach	
											</select>

											@error('cat_id')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>


										<div class="form-group">
											<label for="description" class="required">{{__("cmspage.form.description")}}:</label>

											<textarea name="description" id="description" class="form-control @error('description') form-control-error @enderror" required="required" style="height: 80vh">{{old('description')}}</textarea>

											@error('description')
												<span class="text-danger">{{ $message }}</span>
											@enderror
											
										</div>


										<div class="form-group">
											<label for="status" class="required">{{__("cmspage.form.status")}}:</label>

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
		$("#cmspage_create_form").validate();
	</script>


	{{-- <script>
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
	</script> --}}


	<script> 

		tinymce.init({
		  selector: '#description',
	
		  browser_spellcheck : true,
		  paste_data_images: false,
	
		  responsive: true,
	
		  plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste imagetools",
				"autosave codesample directionality wordcount"
			],
	
			toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",
	
			content_style: 'body { font-family:Poppins",sans-serif;}',
	
			imagetools_toolbar: "imageoptions",
	
		  file_picker_callback (callback, value, meta) {
			let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
			let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight
	
			tinymce.activeEditor.windowManager.openUrl({
			  url : '/file-manager/tinymce5',
			  title : 'File manager',
			  width : x * 0.8,
			  height : y * 0.8,
			  onMessage: (api, message) => {
				callback(message.content, { text: message.text })
			  }
			})
		  }
		});
	</script>

	<script type="text/javascript">

		$("#title").keyup(function(){
			var title = this.value;
			title = title.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
			$("#slug").val(title);
		})
	</script>
@endpush