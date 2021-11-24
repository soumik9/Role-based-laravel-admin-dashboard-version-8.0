<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\Currency;
use DataTables;

class CurrencyController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:currency-list', ['only' => ['index','store']]);
		$this->middleware('permission:currency-create', ['only' => ['create','store']]);
		$this->middleware('permission:currency-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:currency-delete', ['only' => ['destroy']]);

        $permissions_currency_list = Permission::get()->filter(function($item) {
            return $item->name == 'currency-list';
        })->first();
        $permissions_currency_create = Permission::get()->filter(function($item) {
            return $item->name == 'currency-create';
        })->first();
        $permissions_currency_edit = Permission::get()->filter(function($item) {
            return $item->name == 'currency-edit';
        })->first();
        $permissions_currency_delete = Permission::get()->filter(function($item) {
            return $item->name == 'currency-delete';
        })->first();


        if ($permissions_currency_list == null) {
            Permission::create(['name'=>'currency-list']);
        }
        if ($permissions_currency_create == null) {
            Permission::create(['name'=>'currency-create']);
        }
        if ($permissions_currency_edit == null) {
            Permission::create(['name'=>'currency-edit']);
        }
        if ($permissions_currency_delete == null) {
            Permission::create(['name'=>'currency-delete']);
        }
	}


	public function index(Request $request)
	{
		if ($request->ajax()) {
            $data = Currency::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('currency-edit')) {
                        $edit = '<a href="'.route('currencies.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        '.__('default.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('currency-delete')) {
                        $delete = '<button class="custom-delete-btn remove-currency" data-id="'.$row->id.'" data-action="'.route('currencies.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('default.form.delete-button').'
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
                            <input type='checkbox' id='status_$row->id' id='currency-$row->id' class='check' onclick='changecurrenciestatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $status;
                })

                ->rawColumns(['action'])
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.currencies.index');
	}

	public function create()
	{
		return view('admin.currencies.create');
	}

	public function store(Request $request)
	{
		$rules = [
            'name' 					=> 'required|string',
			'code' 					=> 'required|string|unique:currencies,code',
            'symbol' 				=> 'required|string',
            'status'                => 'required',
        ];

        $messages = [
            'name.required'    		=> __('currency.form.validation.name.required'),
            'code.required'    		=> __('currency.form.validation.code.required'),
            'code.unique'    		=> __('currency.form.validation.code.unique'),
            'symbol.required'       => __('currency.form.validation.symbol.required'),
        ];

        $this->validate($request, $rules, $messages);

		$input = request()->all();


		try {
			$currency 		= Currency::create($input);
			$success_msg 	= __('currency.message.store.success');
			return redirect()->route('currencies.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg 		= __('currency.message.store.error');
			return redirect()->route('currencies.index')->with('error',$error_msg);
		}

	}


	public function edit($id)
	{
		$currency = Currency::find($id);
		return view('admin.currencies.edit',compact('currency'));
	}

	public function update(Request $request, $id)
	{

		$rules = [
            'name' 					=> 'required|string',
            'symbol'                => 'required|string',
            'status'                => 'required',
        ];

        
        $messages = [
            'name.required'         => __('currency.form.validation.name.required'),
            'symbol.required'       => __('currency.form.validation.symbol.required'),
        ];

        $this->validate($request, $rules, $messages);

		$input = $request->all();

		$currency = Currency::find($id);

		try {
			$currency = Currency::find($id);
			$currency->update($input);
			$success_msg = __('currency.message.update.success');
			return redirect()->route('currencies.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('currency.message.update.error');
			return redirect()->route('currencies.index')->with('error',$error_msg);
		}

	}

	public function destroy()
	{

		$id = request()->input('id');

		try {
			Currency::find($id)->delete();
			$success_msg = __('currency.message.destroy.success');
			return redirect()->route('currencies.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('currency.message.destroy.error');
			return redirect()->route('currencies.index')->with('error',$error_msg);
		}
	
	}


	public function status_update(Request $request)
	{
		$currency = Currency::find($request->id)->update(['status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}
}