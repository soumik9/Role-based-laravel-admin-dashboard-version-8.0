<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Gate;
class FileManagerController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:file-manager', ['only' => ['index']]);

        $permissions_file_manager = Permission::get()->filter(function($item) {
            return $item->name == 'file-manager';
        })->first();


        if ($permissions_file_manager == null) {
            Permission::create(['name'=>'file-manager']);
        }
	}

	public function index(Request $request)
	{
		if (Gate::check('file-manager')) {
            return view('admin.file-manager.index');
        }else{
            return 403;
        }

	}
}