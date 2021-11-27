<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsCategory;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\CmsPage;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class CMSPageController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:cmspage-list', ['only' => ['index','store']]);
		$this->middleware('permission:cmspage-create', ['only' => ['create','store']]);
		$this->middleware('permission:cmspage-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:cmspage-delete', ['only' => ['destroy']]);

        $cmspage_list = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-list';
        })->first();
        $cmspage_create = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-create';
        })->first();
        $cmspage_edit = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-edit';
        })->first();
        $cmspage_delete = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-delete';
        })->first();


        if ($cmspage_list == null) {
            Permission::create(['name'=>'cmspage-list']);
        }
        if ($cmspage_create == null) {
            Permission::create(['name'=>'cmspage-create']);
        }
        if ($cmspage_edit == null) {
            Permission::create(['name'=>'cmspage-edit']);
        }
        if ($cmspage_delete == null) {
            Permission::create(['name'=>'cmspage-delete']);
        }
	}

	public function index(Request $request)
	{	
		if ($request->ajax()) {
            $data = CmsPage::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('cmspage-edit')) {
                        $edit = '<a href="'.route('cmspages.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('default.table.edit').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('cmspage-delete')) {
                        $delete = '<button class="custom-delete-btn remove-cmspage" data-id="'.$row->id.'" data-action="'.route('cmspages.destroy').'">
										<i class="fe fe-trash"></i> '.__('default.table.delete').'
									</button>';
                    }else{
                        $delete = '';
                    }
                    $action = $edit.' '.$delete;
                    return $action;
                })

                ->addColumn('status', function($row){
                	if ($row->status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}

                    $status = "
                            <input type='checkbox' id='status_$row->id' id='cmspage-$row->id' class='check' onclick='changeCmspageStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })

                ->addColumn('category', function($row){
                    if(!empty($row->cms_category_id)){
                        $find = CmsCategory::find($row->cms_category_id);
                        $cmscategory = $find->name;
    
                        return $cmscategory;
                    }else{
                        return null;
                    }
                })

                ->rawColumns(['action'])
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.cmspages.index');
	}

	public function create()
	{
        $cmscategories = CmsCategory::where('status', 1)->get();
		return view('admin.cmspages.create', compact('cmscategories'));
	}

	public function store(Request $request)
	{
        $rules = [
            'title' 		    => 'required|string',
			'slug' 		        => 'required|string|unique:cms_pages,slug',
			'cms_category_id' 	=> 'required|string',
			'description' 	    => 'required|string',
			'meta_title' 	    => 'required|string',
			'meta_description' 	=> 'required|string',
			'meta_keywords' 	=> 'required|string',
			'status' 		    => 'required|numeric',
        ];

        $messages = [
            'name.required'    		    =>  __('default.form.validation.name.required'),
            'slug.required'    	        =>  __('default.form.validation.slug.required'),
            'slug.unique'    		    =>  __('default.form.validation.slug.unique'),
            'cms_category_id.required'  =>  __('default.form.validation.category.required'),
            'description.required'      =>  __('default.form.validation.description.required'),
            'meta_title.required'       =>  __('default.form.validation.meta_title.required'),
            'meta_description.required' =>  __('default.form.validation.meta_description.required'),
            'meta_keywords.required'    =>  __('default.form.validation.meta_keywords.required'),
            'status.required'    	    =>  __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = request()->all();

		try {
			$cmspage 		= CmsPage::create($input);
            Toastr::success(__('cmspages.message.store.success'));
		    return redirect()->route('cmspages.index');
		} catch (Exception $e) {
            Toastr::error(__('cmspages.message.store.error'));
		    return redirect()->route('cmspages.index');
		}
	}

	public function edit($id)
	{
		$cmspage = CmsPage::find($id);
        $cmscategories = CmsCategory::get();
		return view('admin.cmspages.edit',compact('cmspage', 'cmscategories'));
	}

	public function update(Request $request, $id)
	{
        $rules = [
            'title' 		    => 'required|string',
			'slug' 		        => 'string|unique:cms_pages,slug,' . $id,
			'cms_category_id' 	=> 'required|string',
			'description' 	    => 'required|string',
			'meta_title' 	    => 'required|string',
			'meta_description' 	=> 'required|string',
			'meta_keywords' 	=> 'required|string',
			'status' 		    => 'required|numeric',
        ];

        $messages = [
            'name.required'    		    => __('default.form.validation.name.required'),
            'slug.required'    	        => __('default.form.validation.slug.required'),
            'slug.unique'    		    => __('default.form.validation.slug.unique'),
            'cms_category_id.required'  => __('default.form.validation.category.required'),
            'description.required'      => __('default.form.validation.description.required'),
            'meta_title.required'       => __('default.form.validation.meta_title.required'),
            'meta_description.required' => __('default.form.validation.meta_description.required'),
            'meta_keywords.required'    => __('default.form.validation.meta_keywords.required'),
            'status.required'    	    => __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$cmspage = CmsPage::find($id);

        try {
			$cmspage->update($input);
            Toastr::success(__('cms.message.update.success'));
		    return redirect()->route('cmspages.index');
		} catch (Exception $e) {
            Toastr::error(__('cms.message.update.error'));
		    return redirect()->route('cmspages.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');

		try {
			CmsPage::find($id)->delete();
			return back()->with(Toastr::error(__('cms.message.destroy.success')));
		} catch (Exception $e) {
			$error_msg = Toastr::error(__('cms.message.destroy.error'));
			return redirect()->route('cmspages.index')->with($error_msg);
		}
	}

	public function status_update(Request $request)
	{
		$cmspage = CmsPage::find($request->id)->update(['status' => $request->status]);

        if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}
}
