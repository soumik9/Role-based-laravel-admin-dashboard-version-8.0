<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Gate;
class RoleController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:role-list', ['only' => ['index','store']]);
		$this->middleware('permission:role-create', ['only' => ['create','store']]);
		$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:role-delete', ['only' => ['destroy']]);

        $permissions_role_list = Permission::get()->filter(function($item) {
            return $item->name == 'role-list';
        })->first();
        $permissions_role_create = Permission::get()->filter(function($item) {
            return $item->name == 'role-create';
        })->first();
        $permissions_role_edit = Permission::get()->filter(function($item) {
            return $item->name == 'role-edit';
        })->first();
        $permissions_role_delete = Permission::get()->filter(function($item) {
            return $item->name == 'role-delete';
        })->first();


        if ($permissions_role_list == null) {
            Permission::create(['name'=>'role-list']);
        }
        if ($permissions_role_create == null) {
            Permission::create(['name'=>'role-create']);
        }
        if ($permissions_role_edit == null) {
            Permission::create(['name'=>'role-edit']);
        }
        if ($permissions_role_delete == null) {
            Permission::create(['name'=>'role-delete']);
        }
	}

	public function index(Request $request)
	{
		$roles = Role::all();
		return view('admin.roles.index',compact('roles'));

	}

	public function create()
	{

		$permission = Permission::get();
		return view('admin.roles.create',compact('permission'));
	}

	public function store(Request $request)
	{
		$rules = [
            'name' 					=> 'required|unique:roles,name',
            'code' 					=> 'required|unique:roles,code',
			'permission' 			=> 'required',
        ];

        $messages = [
            'name.required'    		=> __('role.form.validation.name.required'),
            'name.unique'    		=> __('role.form.validation.name.unique'),
            'code.required'    		=> __('role.form.validation.code.required'),
            'code.unique'    		=> __('role.form.validation.code.unique'),
            'permission.required'   => __('role.form.validation.permission.required'),
        ];
        
        $this->validate($request, $rules, $messages);

		try {
			$role = Role::create(['name' => $request->input('name'),'code' => $request->input('code')]);
			$role->syncPermissions($request->input('permission'));

			$success_msg = __('role.message.store.success');
			return redirect()->route('roles.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('role.message.store.error');
			return redirect()->route('roles.index')->with('error',$error_msg);
		}
	}


	public function edit($id)
	{
		$role = Role::find($id);
		$permission = Permission::get();
		$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
			->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
			->all();
		return view('admin.roles.edit',compact('role','permission','rolePermissions'));
	}

	public function update(Request $request, $id)
	{
		$rules = [
            'name' 					=> 'required',
			'permission' 			=> 'required',
        ];

        $messages = [
            'name.required'    		=> __('role.form.validation.name.required'),
            'permission.required'   => __('role.form.validation.permission.required'),
        ];
        
        $this->validate($request, $rules, $messages);



        try {
			$role = Role::find($id);
			$role->name = $request->input('name');
			$role->save();
			$role->syncPermissions($request->input('permission'));

			$success_msg = __('role.message.update.success');
			return redirect()->route('roles.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('role.message.update.error');
			return redirect()->route('roles.index')->with('error',$error_msg);
		}
	}
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy()
	{
		// $id = request()->input('id');
		// $role = Role::find($id);
		// if($role->name == 'Admin'){
		// 	$warning_admin_delete = __('role.message.destroy.warning_admin_delete');
		// 	return redirect()->route('roles.index')->with('warning',$warning_admin_delete);
		// }else{

		// 	try {
		// 		DB::table("roles")->where('id',$id)->delete();
		// 		$success_msg = __('role.message.destroy.success');
		// 		return redirect()->route('roles.index')->with('success',$success_msg);

		// 	} catch (Exception $e) {
		// 		$error_msg = __('role.message.destroy.error');
		// 		return redirect()->route('roles.index')->with('error',$error_msg);
		// 	}


		// }


		$id = request()->input('id');
		$allrole = Role::all();
		$countallrole = $allrole->count();

		if ($countallrole <= 1) {
			$warning_msg = __('role.message.destroy.warning_last_role');
			return redirect()->route('roles.index')->with('warning',$warning_msg);
		}else{
			$getrole = Role::find($id);
			try {
				Role::find($id)->delete();
				$success_msg = __('role.message.destroy.success');
				return redirect()->route('roles.index')->with('success',$success_msg);
			} catch (Exception $e) {
				$error_msg = __('role.message.destroy.error');
				return redirect()->route('roles.index')->with('error',$error_msg);
			}
		}


		
	}
}