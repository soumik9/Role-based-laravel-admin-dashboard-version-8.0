@extends('admin.layouts.master')

@section('page_title')
    {{__('cms.edit.title')}}
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}
	</style>
@endpush

@section('content')
	<form method="POST" action="{{ route('cmspages.update', $cmspage->id) }}" enctype="multipart/form-data">
		@csrf()

		<!-- Page Header -->
		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">{{__('cms.index.title')}}</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('cmspages.index') }}">{{ __('cms.index.title') }}</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('cmspages.edit', $cmspage->id) }}">{{ __('cms.edit.title') }} - ({{ $cmspage->title }})</a>
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

		<section class="crud-body">
			<div class="row">
				<div class="col-md-12">

					<div class="card">

						<div class="card-header">
							<h5 class="card-title">
								CMS Page Information - ({{ $cmspage->title }})
							</h5>
						</div>
						
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">

									<div class="form-group">
										<label for="title" class="required">{{__('default.form.title')}}:</label>
										<input type="text" name="title" id="title" class="form-control @error('title') form-control-error @enderror" required="required" value="{{$cmspage->title}}">

										@error('title')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="slug" class="required">{{__("default.form.slug")}}:</label>
										<input type="text" name="slug" id="slug" class="form-control" readonly value="{{$cmspage->slug}}">

										@error('slug')
											<span class="text-danger">{{ $message }}</span>
										@enderror						
									</div>

									<div class="form-group">
										<label for="cms_category_id" class="required">{{__("default.form.category")}}:</label>
										<select type="text" name="cms_category_id" id="cms_category_id" class="form-control @error('cms_category_id') form-control-error @enderror" required="required">
											@foreach ($cmscategories as $cmscategory)
												<option value="{{$cmscategory->id}}"  @if ($cmspage->cat_id == $cmscategory->id) @endif selected>{{$cmscategory->name}}</option>
											@endforeach
										</select>
										@error('cms_category_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="form-group">
										<label for="description" class="required">{{__("default.form.description")}}:</label>
										<textarea name="description" id="description" class="form-control @error('description') form-control-error @enderror" rows="20">{{$cmspage->description}}</textarea>

										@error('description')
											<span class="text-danger">{{ $message }}</span>
										@enderror									
									</div>

									<div class="form-group">
										<label for="status" class="required">{{__("cmspage.form.status")}}:</label>
										<select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
											<option value="1" @if($cmspage->status == "1") selected @endif>Active</option>
											<option value="0" @if($cmspage->status == "0") selected @endif>Inactive</option>
										</select>

										@error('status')
											<span class="text-danger">{{ $message }}</span>
										@enderror							
									</div>

								</div>
							</div>																
						</div>

					</div> <!-- /card -->

					<div class="card">

						<div class="card-header">
							<h4 class="card-name">SEO Information</h4>
						</div>
	
						<div class="card-body">
							<div class="row">
	
								<div class="col-md-12">
				
									<div class="form-group">
										<label for="meta_title" class="required">{{ __('default.form.meta_title') }}</label>
										<input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $cmspage->meta_title }}" required>
	
										@error('meta_title')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
	
									<div class="form-group">
										<label for="meta_description" class="required">{{ __('default.form.meta_description') }}</label>
										<textarea name="meta_description" id="meta_description" class="form-control" rows="10">{{ $cmspage->meta_description }}</textarea>
	
										@error('meta_keywords')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
	
									<div class="form-group">
										<label for="meta_keywords" class="required">{{ __('default.form.meta_keywords') }}</label>
										<input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{ $cmspage->meta_keywords }}" required>
	
										@error('meta_keywords')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
	
	
								</div><!-- end col-md-12 -->
							</div><!-- end row -->
						</div> <!-- end card body -->
						
					</div> <!-- end card -->

				</div>
			</div>				
		</section>
		
	</form>
@endsection


@push('scripts')
<script type="text/javascript">
	$("#title").keyup(function(){
		var name = this.value;
		name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
		$("#slug").val(name);
	})
</script>

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
@endpush