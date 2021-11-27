<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class CMSCategoryController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:cmscategory-list', ['only' => ['index','store']]);
		$this->middleware('permission:cmscategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:cmscategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:cmscategory-delete', ['only' => ['destroy']]);

        $cmscategory_list = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-list';
        })->first();
        $cmscategory_create = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-create';
        })->first();
        $cmscategory_edit = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-edit';
        })->first();
        $cmscategory_delete = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-delete';
        })->first();

        if ($cmscategory_list == null) {
            Permission::create(['name'=>'cmscategory-list']);
        }
        if ($cmscategory_create == null) {
            Permission::create(['name'=>'cmscategory-create']);
        }
        if ($cmscategory_edit == null) {
            Permission::create(['name'=>'cmscategory-edit']);
        }
        if ($cmscategory_delete == null) {
            Permission::create(['name'=>'cmscategory-delete']);
        }
	}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CmsCategory::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('cmscategory-edit')) {
                        $edit = '<a href="'.route('cmscategories.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('default.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('cmscategory-delete')) {
                        $delete = '<button class="custom-delete-btn remove-cmscategory" data-id="'.$row->id.'" data-action="'.route('cmscategories.destroy').'">
										<i class="fe fe-trash"></i> '.__('default.form.delete-button').'
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

                            <input type='checkbox' id='status_$row->id' id='category-$row->id' class='check' onclick='changeCmsCategoryStatus(event.target, $row->id);' " .$current_status. ">
                            <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.cmspages.cmscategories.index');
    }

    public function create()
    {
        return view('admin.cmspages.cmscategories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' 					=> 'required|string|unique:cms_categories,name',
            'slug' 		            => 'required|string|unique:cms_categories,slug',
            'status'                => 'required|boolean',
        ];

        $messages = [
            'name.required'    		=> __('default.form.validation.name.required'),
            'name.unique'    		=> __('default.form.validation.name.unique'),
            'slug.required'    	    => __('default.form.validation.slug.required'),
            'slug.unique'    		=> __('default.form.validation.slug.unique'),
            'status.required'    	=> __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = request()->all();

		try {
			$category 		= CmsCategory::create($input);
            Toastr::success(__('cmscategory.message.store.success'));
		    return redirect()->route('cmscategories.index');
		} catch (Exception $e) {
            Toastr::error(__('cmscategory.message.store.error'));
		    return redirect()->route('cmscategories.index');
		}
    } 

    public function edit($id)
	{
		$cmscategory = CmsCategory::find($id);
		return view('admin.cmspages.cmscategories.edit',compact('cmscategory'));
	} 

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required|string|unique:cms_categories,name,' . $id,
			'slug' 		    => 'required|string|unique:cms_categories,slug,' . $id,
			'status' 		=> 'required|numeric',
        ];

        $messages = [
            'name.required'    		=> __('default.form.validation.name.required'),
            'name.unique'    		=> __('default.form.validation.name.unique'),
            'slug.required'    	    => __('default.form.validation.slug.required'),
            'slug.unique'    		=> __('default.form.validation.slug.unique'),
            'status.required'    	=> __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$cmscategory = CmsCategory::find($id);

        try {
			$cmscategory->update($input);
            Toastr::success(__('cmscategory.message.update.success'));
		    return redirect()->route('cmscategories.index');
		} catch (Exception $e) {
            Toastr::error(__('cmscategory.message.update.error'));
		    return redirect()->route('cmscategories.index');
		}
	} 

    public function destroy()
    {
        $id = request()->input('id');

		try {
			CmsCategory::find($id)->delete();
			return back()->with(Toastr::error(__('cmscategory.message.destroy.success')));
		} catch (Exception $e) {
			$error_msg = Toastr::error(__('cmscategory.message.destroy.error'));
			return redirect()->route('cmscategories.index')->with($error_msg);
		}
    }

    public function status_update(Request $request)
	{
        $cmscategory = CmsCategory::find($request->id)->update(['status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}

}
