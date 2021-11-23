<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\Setting;
use App\Models\Currency;
use DataTables;

class SettingController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:setting-edit', ['only' => ['edit','update']]);

        $permissions_setting_edit = Permission::get()->filter(function($item) {
            return $item->name == 'setting-edit';
        })->first();


        if ($permissions_setting_edit == null) {
            Permission::create(['name'=>'setting-edit']);
        }



        $setting = Setting::find(1);

        if ($setting == null) {
            Setting::create();
        }
	}




	public function edit()
	{
        $setting = Setting::find(1);
        $currencies = Currency::where('status',1)->get();
		return view('admin.settings.edit',compact('setting','currencies'));
	}

	public function update(Request $request, $id=1)
	{

		$rules = [
            'website_title' 			=> 'nullable|string',
            'website_logo_dark'         => 'nullable|string',
            'website_logo_light'        => 'nullable|string',
            'website_logo_small'        => 'nullable|string',
            'website_favicon'           => 'nullable|string',
            'meta_title'                => 'nullable|string',
            'meta_description'          => 'nullable|string',
            'meta_tag'                  => 'nullable|string',
            'currency'                  => 'nullable|string',
            'address'                   => 'nullable|string',
            'phone'                     => 'nullable|string',
            'email'                     => 'nullable|string',
        ];

        
        $messages = [
            
        ];

        $this->validate($request, $rules, $messages);

		$input = $request->all();





		$setting = Setting::find($id);
        if (empty($input['website_logo'])) {
            $input['website_logo'] = $setting->website_logo;
        }
        if (empty($input['website_logo_small'])) {
            $input['website_logo_small'] = $setting->website_logo_small;
        }
        if (empty($input['website_favicon'])) {
            $input['website_favicon'] = $setting->website_favicon;
        }

		try {
			$setting->update($input);
			$success_msg = __('setting.message.update.success');
			return redirect()->route('settings.site-setting.edit')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('setting.message.update.error');
			return redirect()->route('settings.site-setting.edit')->with('error',$error_msg);
		}

	}



}