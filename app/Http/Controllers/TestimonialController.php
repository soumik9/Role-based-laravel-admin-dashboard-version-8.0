<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use DataTables;

class TestimonialController extends Controller
{

    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:testimonial-list', ['only' => ['index','store']]);
		$this->middleware('permission:testimonial-create', ['only' => ['create','store']]);
		$this->middleware('permission:testimonial-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:testimonial-delete', ['only' => ['destroy']]);

        $permissions_testimonial_list = Permission::get()->filter(function($item) {
            return $item->name == 'testimonial-list';
        })->first();
        $permissions_testimonial_create = Permission::get()->filter(function($item) {
            return $item->name == 'testimonial-create';
        })->first();
        $permissions_testimonial_edit = Permission::get()->filter(function($item) {
            return $item->name == 'testimonial-edit';
        })->first();
        $permissions_testimonial_delete = Permission::get()->filter(function($item) {
            return $item->name == 'testimonial-delete';
        })->first();

        if ($permissions_testimonial_list == null) {
            Permission::create(['name'=>'testimonial-list']);
        }
        if ($permissions_testimonial_create == null) {
            Permission::create(['name'=>'testimonial-create']);
        }
        if ($permissions_testimonial_edit == null) {
            Permission::create(['name'=>'testimonial-edit']);
        }
        if ($permissions_testimonial_delete == null) {
            Permission::create(['name'=>'testimonial-delete']);
        }
	}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::get();
            return Datatables::of($data)
                ->addIndexColumn()


                ->addColumn('action', function($row){

					if (Gate::check('testimonial-edit')) {
                        $edit = '<a href="'.route('testimonials.edit', $row->id).'" class="btn btn-sm bg-warning-light">
                                    <i class="fe fe-pencil"></i>
                                        '.__('testimonial.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }

                    if (Gate::check('testimonial-delete')) {
                        $delete = '<button class="remove-testimonial btn btn-sm bg-danger-light" data-id="'.$row->id.'" data-action="'.route('testimonials.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('room.form.delete-button').'
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

                            <input type='checkbox' id='status_$row->id' id='testimonial-$row->id' class='check' onclick='changeTestimonialStatus(event.target, $row->id);' " .$current_status. ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";

                    return $status;
                })

                ->addColumn('image', function($row){


                    if ($row->image == null or empty($row->image)) {
                    	$image = '
                    	<img
                    		src="/assets/admin/img/default.jpg"
                    		class="w-50 rounded-circle img-fluid img-thumbnail"
                    		onerror="this.src=\'asset(\'assets/admin/img/default.jpg\')" style="max-width: 50px"
                    	>
                    	';
                    }else{
                    	$image = '<img src="'.$row->image.'"  class="w-50 rounded-circle img-fluid img-thumbnail" onerror="this.src=\'asset(\'assets/admin/img/default.jpg\')" style="max-width: 50px">';
                    }

                    return $image;
                })
                ->rawColumns(['action', 'image'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }

        return view('admin.home.testimonials.index');
    }

    public function create()
    {
        return view('admin.home.testimonials.create');
    }

    public function store(Request $request)
	{
		$rules = [
            'name' 			    => 'required|string',
            'position' 			=> 'required|string',
            'description' 		=> 'required|string',
            'image' 		    => 'nullable|string',
        ];

        $messages = [
            'name.required'    		    => __('testimonial.form.validation.name.required'),
            'position.required'    		=> __('testimonial.form.validation.name.required'),
            'description.required'    	=> __('testimonial.form.validation.name.required'),
            'image.required'    	    => __('testimonial.form.validation.image.required'),
        ];


        $this->validate($request, $rules, $messages);
		$input = request()->all();

		try {
			$room = Testimonial::create($input);

			$success_msg = __('testimonial.message.store.success');
			return redirect()->route('testimonials.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('testimonial.message.store.error');
			return redirect()->route('testimonials.index')->with('error',$error_msg);
		}

	}

    public function edit($id)
	{
		$testimonial = Testimonial::find($id);
		return view('admin.home.testimonials.edit',compact('testimonial'));
	}

    public function update(Request $request, $id)
	{
		$rules = [
            'name' 			    => 'required|string',
            'position' 			=> 'required|string',
            'description' 		=> 'required|string',
            'image' 		    => 'nullable|string',
        ];

        $messages = [
            'name.required'    		    => __('testimonial.form.validation.name.required'),
            'position.required'    		=> __('testimonial.form.validation.name.required'),
            'description.required'    	=> __('testimonial.form.validation.name.required'),
            'image.required'    	    => __('testimonial.form.validation.image.required'),
        ];

        $this->validate($request, $rules, $messages);
        $input = $request->all();
		$testimonial = Testimonial::find($id);

		if (empty($input['image'])) {
			$input['image'] = $testimonial->image;
		}

		try {
			$testimonial->update($input);

			$success_msg = __('testimonial.message.update.success');
			return redirect()->route('testimonials.index')->with('success',$success_msg);

		} catch (Exception $e) {
			$error_msg = __('testimonial.message.update.error');
			return redirect()->route('testimonials.index')->with('error',$error_msg);
		}
	}

    public function destroy()
	{
		$id = request()->input('id');

		try {
			Testimonial::find($id)->delete();
			$success_msg = __('testimonial.message.destroy.success');
			return redirect()->route('testimonials.index')->with('success',$success_msg);
		} catch (Exception $e) {
			$error_msg = __('testimonial.message.destroy.error');
			return redirect()->route('testimonials.index')->with('error',$error_msg);
		}
	}

    public function status_update(Request $request)
	{
		$department = Testimonial::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
	}
}
