<?php

namespace App\Http\Controllers;

use App\Models\CmsCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use DataTables;
 
class CmsCategoryController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:cmscategory-list', ['only' => ['index','store']]);
		$this->middleware('permission:cmscategory-create', ['only' => ['create','store']]);
		$this->middleware('permission:cmscategory-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:cmscategory-delete', ['only' => ['destroy']]);

        $permissions_category_list = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-list';
        })->first();
        $permissions_category_create = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-create';
        })->first();
        $permissions_category_edit = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-edit';
        })->first();
        $permissions_category_delete = Permission::get()->filter(function($item) {
            return $item->name == 'cmscategory-delete';
        })->first();

        if ($permissions_category_list == null) {
            Permission::create(['name'=>'cmscategory-list']);
        }
        if ($permissions_category_create == null) {
            Permission::create(['name'=>'cmscategory-create']);
        }
        if ($permissions_category_edit == null) {
            Permission::create(['name'=>'cmscategory-edit']);
        }
        if ($permissions_category_delete == null) {
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
                        $edit = '<a href="'.route('cmscategory.edit', $row->id).'" class="btn btn-sm bg-warning-light">
                                    <i class="fe fe-pencil"></i>
                                        '.__('cmscategory.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('cmscategory-delete')) {
                        $delete = '<button class="remove-category btn btn-sm bg-danger-light" data-id="'.$row->id.'" data-action="'.route('cmscategory.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('cmscategory.form.delete-button').'
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

        return view('admin.cmscategory.index');
    }

    public function create()
    {
        return view('admin.cmscategory.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' 					=> 'required|string|unique:cms_categories,name',
            'status'                => 'required|boolean',
        ];

        $messages = [
            'name.required'    		=> __('category.form.validation.name.required'),
            'name.unique'    		=> __('category.form.validation.name.unique'),
        ];

        $this->validate($request, $rules, $messages);
		$input = request()->all();

		try {
			$category 		= CmsCategory::create($input);
			$success_msg 	= __('cmscategory.message.store.success');
			return redirect()->route('cmscategory.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg 		= __('cmscategory.message.store.error');
			return redirect()->route('cmscategory.index')->with('error',$error_msg);
		}
    } 

    public function edit($id)
	{
		$category = CmsCategory::find($id);
		return view('admin.cmscategory.edit',compact('category'));
	} 

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 					=> 'required|string',
            'status'                => 'required|integer',
        ];

        $messages = [
            'name.required'    		=> __('cmscategory.form.validation.name.required'),
        ];

        $this->validate($request, $rules, $messages);
		$input = $request->all();
		$category = CmsCategory::find($id);

		try {
			$category = CmsCategory::find($id);
			$category->update($input);
			$success_msg = __('cmscategory.message.update.success');
			return redirect()->route('cmscategory.index')->with('success',$success_msg);
		} catch (Exception $e){
			$error_msg = __('cmscategory.message.update.error');
			return redirect()->route('cmscategory.index')->with('error',$error_msg);
		}
	} 

    public function destroy()
    {
        $id = request()->input('id');

		try {
			CmsCategory::find($id)->delete();
			$success_msg = __('cmscategory.message.destroy.success');
			return redirect()->route('cmscategory.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('cmscategory.message.destroy.error');
			return redirect()->route('cmscategory.index')->with('error',$error_msg);
		}
    }

    public function status_update(Request $request)
	{
		$department = CmsCategory::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);

	}
}
