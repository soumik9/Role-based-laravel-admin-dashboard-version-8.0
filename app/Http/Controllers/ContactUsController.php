<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Models\Currency;
use App\Models\Room;
use App\Models\Setting;
use DataTables;

class ContactUsController extends Controller
{

    public function index($slug = null)
    {
        $room = Room::where('id', $slug)->first();
        $setting = Setting::find(1);
        return view('frontend.custom.contact_us', compact('room','setting'));
    }

    function __construct()
	{
		$this->middleware('permission:mail-list', ['only' => ['view']]);
		$this->middleware('permission:mail-delete', ['only' => ['destroy']]);

        $permissions_currency_list = Permission::get()->filter(function($item) {
            return $item->name == 'mail-list';
        })->first();
        $permissions_currency_delete = Permission::get()->filter(function($item) {
            return $item->name == 'mail-delete';
        })->first();


        if ($permissions_currency_list == null) {
            Permission::create(['name'=>'mail-list']);
        }
        if ($permissions_currency_delete == null) {
            Permission::create(['name'=>'mail-delete']);
        }
	}
    public function store(Request $request)
    {
        $rules = [
            'name'                 => 'required|string',
            'email'                => 'required|string',
            'phone'                => 'required|string',
            'subject'              => 'required|string',
            'content'              => 'required|string',
        ];

        $messages = [
            'name.required'          => __('contactus.form.validation.name.required'),
            'email.required'         => __('contactus.form.validation.email.required'),
            'phone.unique'           => __('contactus.form.validation.phone.unique'),
            'subject.required'       => __('contactus.form.validation.subject.required'),
            'content.required'       => __('contactus.form.validation.content.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = request()->all();

        if ($input) {
            try {
                $contactus = ContactUs::create($input);
                if($contactus)
                {
                    Mail::send(['text'=>'mail'], $input, function($message) {
                        $message->to('support@gmail.com','Support')->subject(request()->subject);
                        $message->from(request()->email, request()->name);
                    });
                    $success_msg     = __('contactus.message.store.success');
                    return redirect()->route('contactus')->with('success', $success_msg);
                }       
            } catch (Exception $e) {
                $error_msg         = __('contactus.message.store.error');
                return redirect()->route('contactus')->with('error', $error_msg);
            }
        }
    }

    public function view(Request $request)
    {
        $this->middleware('auth');
        if ($request->ajax()) {
            $data = ContactUs::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if (Gate::check('mail-delete')) {
                        $delete = '<button class="remove-mail btn btn-sm bg-danger-light" data-id="'.$row->id.'" data-action="'.route('mails.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('contactus.form.delete-button').'
									</button>';
                    }else{
                        $delete = '';
                    }

                    $action = $delete;
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
      
        return view('admin.mails.index');
    }

    public function destroy()
    {
        $this->middleware('auth');
        $id = request()->input('id');

		try {
			ContactUs::find($id)->delete();
			$success_msg = __('contactus.message.destroy.success');
			return redirect()->route('mails.view')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('contactus.message.destroy.error');
			return redirect()->route('mails.view')->with('error',$error_msg);
		}
    }

}
