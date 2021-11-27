<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Brian2694\Toastr\Facades\Toastr;

class PermissionController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:permission-list', ['only' => ['index','store']]);
		$this->middleware('permission:permission-create', ['only' => ['create','store']]);
		$this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:permission-delete', ['only' => ['destroy']]);

        $permission_list = Permission::get()->filter(function($item) {
            return $item->name == 'permission-list';
        })->first();
        $permission_create = Permission::get()->filter(function($item) {
            return $item->name == 'permission-create';
        })->first();
        $permission_edit = Permission::get()->filter(function($item) {
            return $item->name == 'permission-edit';
        })->first();
        $permission_delete = Permission::get()->filter(function($item) {
            return $item->name == 'permission-delete';
        })->first();


        if ($permission_list == null) {
            Permission::create(['name'=>'permission-list']);
        }
        if ($permission_create == null) {
            Permission::create(['name'=>'permission-create']);
        }
        if ($permission_edit == null) {
            Permission::create(['name'=>'permission-edit']);
        }
        if ($permission_delete == null) {
            Permission::create(['name'=>'permission-delete']);
        }
	}

	public function index(Request $request)
	{
		$permissions = Permission::all();
		return view('admin.permissions.index',compact('permissions'));
	}

	public function create()
	{
		$permissions = Permission::get();
		return view('admin.permissions.create',compact('permissions'));
	}

	public function store(Request $request)
	{
		$rules = [
			'name' => 'required|unique:permissions,name',
        ];

        $messages = [
            'name.required'    		=> __('default.form.validation.name.required'),
            'name.unique'    		=> __('default.form.validation.name.unique'),
        ];
        
        $this->validate($request, $rules, $messages);

		try {
			$permissions = Permission::create(['name' => $request->input('name')]);

			Toastr::success(__('permission.message.store.success'));
		    return redirect()->route('permissions.create');
		} catch (Exception $e) {
			Toastr::error(__('permission.message.store.error'));
		    return redirect()->route('permissions.create');
		}
	}

	public function edit($id)
	{
		$permissions = Permission::find($id);
		return view('admin.permissions.edit',compact('permissions'));
	}

	public function update(Request $request, $id)
	{
		$rules = [
			'name' => 'required|unique:permissions,name,' . $id,
        ];

        $messages = [
            'name.required'    		=> __('default.form.validation.name.required'),
            'name.unique'    		=> __('default.form.validation.name.unique'),
        ];
        
        $this->validate($request, $rules, $messages);

		try {
			$permissions = Permission::find($id);
			$permissions->name = $request->input('name');
			$permissions->save();

            Toastr::success(__('permission.message.update.success'));
		    return redirect()->route('permissions.index');

		} catch (Exception $e) {
            Toastr::error(__('permission.message.update.error'));
		    return redirect()->route('permissions.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');
		try {
            Permission::find($id)->delete();
			return redirect()->route('permissions.index')->with(Toastr::error(__('permission.message.destroy.success')));

		} catch (Exception $e) {
            $error_msg = Toastr::error(__('permission.message.destroy.error'));
			return redirect()->route('permissions.index')->with($error_msg);
		}
	}
}
