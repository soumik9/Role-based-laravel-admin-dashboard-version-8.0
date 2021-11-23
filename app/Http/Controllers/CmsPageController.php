<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsCategory;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\CmsPage;
use DataTables;

class CmsPageController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:cmspage-list', ['only' => ['index','store']]);
		$this->middleware('permission:cmspage-create', ['only' => ['create','store']]);
		$this->middleware('permission:cmspage-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:cmspage-delete', ['only' => ['destroy']]);

        $permissions_cmspage_list = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-list';
        })->first();
        $permissions_cmspage_create = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-create';
        })->first();
        $permissions_cmspage_edit = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-edit';
        })->first();
        $permissions_cmspage_delete = Permission::get()->filter(function($item) {
            return $item->name == 'cmspage-delete';
        })->first();


        if ($permissions_cmspage_list == null) {
            Permission::create(['name'=>'cmspage-list']);
        }
        if ($permissions_cmspage_create == null) {
            Permission::create(['name'=>'cmspage-create']);
        }
        if ($permissions_cmspage_edit == null) {
            Permission::create(['name'=>'cmspage-edit']);
        }
        if ($permissions_cmspage_delete == null) {
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
                        $edit = '<a href="'.route('cmspages.edit', $row->id).'" class="btn btn-sm bg-warning-light">
                                    <i class="fe fe-pencil"></i>
                                        '.__('cmspage.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('cmspage-delete')) {
                        $delete = '<button class="remove-cmspage btn btn-sm bg-danger-light" data-id="'.$row->id.'" data-action="'.route('cmspages.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('cmspage.form.delete-button').'
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

                            <input type='checkbox' id='status_$row->id' id='cmspage-$row->id' class='check' onclick='changecmspagestatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $status;
                })

                ->addColumn('category', function($row){
                    if(!empty($row->cat_id)){
                        $find = CmsCategory::find($row->cat_id);
                        $category = $find->name;
    
                        return $category;
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
        $categories = CmsCategory::get();
		return view('admin.cmspages.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$rules = [
            'title' 				=> 'required|string',
			'slug' 					=> 'required|string|unique:cms_pages,slug',
            'cat_id' 			    => 'required',
            'description' 			=> 'required|string',
            'status'                => 'required',
        ];

        $messages = [
            'title.required'    	=> __('cmspage.form.validation.title.required'),
            'slug.required'    		=> __('cmspage.form.validation.slug.required'),
            'slug.unique'    		=> __('cmspage.form.validation.slug.unique'),
            'description.required'  => __('cmspage.form.validation.description.required'),
        ];

        $this->validate($request, $rules, $messages);

		$input = request()->all();


		try {
			$cmspage 		= CmsPage::create($input);
			$success_msg 	= __('cmspage.message.store.success');
			return redirect()->route('cmspages.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg 		= __('cmspage.message.store.error');
			return redirect()->route('cmspages.index')->with('error',$error_msg);
		}

	}


	public function edit($id)
	{
		$cmspage = CmsPage::find($id);
        $categories = CmsCategory::get();
		return view('admin.cmspages.edit',compact('cmspage', 'categories'));
	}

	public function update(Request $request, $id)
	{

        $rules = [
            'title'                 => 'required|string',
            'description'           => 'required|string',
            'status'                => 'required',
        ];

        $messages = [
            'title.required'        => __('cmspage.form.validation.title.required'),
            'slug.required'         => __('cmspage.form.validation.slug.required'),
            'slug.unique'           => __('cmspage.form.validation.slug.unique'),
            'description.required'  => __('cmspage.form.validation.description.required'),
        ];

        $this->validate($request, $rules, $messages);

		$input = $request->all();

		$cmspage = CmsPage::find($id);

		try {
			$cmspage = CmsPage::find($id);
			$cmspage->update($input);
			$success_msg = __('cmspage.message.update.success');
			return redirect()->route('cmspages.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('cmspage.message.update.error');
			return redirect()->route('cmspages.index')->with('error',$error_msg);
		}

	}

	public function destroy()
	{

		$id = request()->input('id');

		try {
			CmsPage::find($id)->delete();
			$success_msg = __('cmspage.message.destroy.success');
			return redirect()->route('cmspages.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('cmspage.message.destroy.error');
			return redirect()->route('cmspages.index')->with('error',$error_msg);
		}
	
	}


	public function status_update(Request $request)
	{
		$cmspage = CmsPage::find($request->id)->update(['status' => $request->status]);
        return response()->json(['success'=>'Status changed successfully.']);
	}



}