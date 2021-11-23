@extends('admin.layouts.master')
@section('page_title')
    {{__('filemanager.index.title')}}
@endsection

@push('css')
	<style type="text/css">
		.fm-navbar .btn{
			padding: 3px 6px 1px 6px !important;
		}
	</style>
@endpush


@section('content')

	<div class="page-breadcrumb">
        {{ Breadcrumbs::render('filemanager.index') }}
    </div>


    <div class="card">

    	<div class="card-header">
    		<div class="row">
		    	<div class="col-md-6 col-sm-12">
		    		<h2 class="card-title">
				        <i data-feather="file" class="feather-icon"></i>
				        {{__('filemanager.index.title')}}
				    </h2>
		    	</div>
		    	<div class="col-md-6 col-sm-12">
		    		
		    	</div>
		    </div>
    	</div>
	    <div class="card-body">



			@if(Gate::check('file-manager'))
				<div id="fm"></div>
			@endif 

			    
			
	    </div>
    </div>
	

@endsection

