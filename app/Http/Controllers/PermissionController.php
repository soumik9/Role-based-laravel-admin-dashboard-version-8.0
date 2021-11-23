<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:permission-list', ['only' => ['index','store']]);
		$this->middleware('permission:permission-create', ['only' => ['create','store']]);
		$this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:permission-delete', ['only' => ['destroy']]);

        $permissions_permission_list = Permission::get()->filter(function($item) {
            return $item->name == 'permission-list';
        })->first();
        $permissions_permission_create = Permission::get()->filter(function($item) {
            return $item->name == 'permission-create';
        })->first();
        $permissions_permission_edit = Permission::get()->filter(function($item) {
            return $item->name == 'permission-edit';
        })->first();
        $permissions_permission_delete = Permission::get()->filter(function($item) {
            return $item->name == 'permission-delete';
        })->first();


        if ($permissions_permission_list == null) {
            Permission::create(['name'=>'permission-list']);
        }
        if ($permissions_permission_create == null) {
            Permission::create(['name'=>'permission-create']);
        }
        if ($permissions_permission_edit == null) {
            Permission::create(['name'=>'permission-edit']);
        }
        if ($permissions_permission_delete == null) {
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
            'name.required'    		=> __('role.form.validation.name.required'),
            'name.unique'    		=> __('role.form.validation.name.unique'),
        ];
        
        $this->validate($request, $rules, $messages);

		try {
			$permissions = Permission::create(['name' => $request->input('name')]);

			$success_msg = __('permission.message.store.success');
			return redirect()->route('permissions.create')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('permission.message.store.error');
			return redirect()->route('permissions.create')->with('error',$error_msg);
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
			'name' => 'required',
        ];

        $messages = [
            'name.required'    		=> __('role.form.validation.name.required'),
        ];
        
        $this->validate($request, $rules, $messages);

		try {
			$permissions = Permission::find($id);
			$permissions->name = $request->input('name');
			$permissions->save();

			$success_msg = __('permission.message.update.success');
			return redirect()->route('permissions.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('permission.message.update.error');
			return redirect()->route('permissions.index')->with('error',$error_msg);
		}


	}

	public function destroy()
	{
		$id = request()->input('id');

		try {
			$permissions = Permission::find($id);
			DB::table("permissions")->where('id',$id)->delete();
			$success_msg = __('permission.message.destroy.success');
			return redirect()->route('permissions.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('permission.message.destroy.error');
			return redirect()->route('permissions.index')->with('error',$error_msg);
		}
	}
}