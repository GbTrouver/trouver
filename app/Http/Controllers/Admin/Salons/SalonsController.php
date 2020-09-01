<?php

namespace App\Http\Controllers\Admin\Salons;

use Auth;
use File;
use Image;
use App\User;
use App\Salon;
use Carbon\Carbon;
use App\SalonOwnerDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\Admin\Salons\SalonsRequest;

class SalonsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->search['value'] != '') {
                $data = Salon::where('name', 'LIKE', '%'.$request->search['value'].'%');
            } else {
                $data = Salon::all('id', 'logo', 'name', 'email', 'open_at', 'close_at');
            }

            // dd($data);
            return DataTables::of($data)
                ->editColumn('logo', function ($data) {
                    $logo = '<img src="'.asset(config('constants.salon_logo_path').$data->logo).'" width="50px" height="50px" alt="Logo">';
                    return $logo;
                })
                ->editColumn('name', function($data) {
                    $name = '<span title="'.$data->name.'">'.Str::limit($data->name, 15, '...').'</span>';
                    return $name;
                })
                ->editColumn('email', function($data) {
                    $email = '<span title="'.$data->email.'">'.Str::limit($data->email, 15, '...').'</span>';
                    return $email;
                })
                ->editColumn('open_at', function($data) {
                    return Carbon::parse($data->open_at)->format('h:i A');
                })
                ->editColumn('close_at', function($data) {
                    return Carbon::parse($data->close_at)->format('h:i A');
                })
                ->addColumn('action', function($data) {
                    $btn = '<a href="'.route('admin.salons.edit', $data->id).'"><i class="fa fa-edit fa-lg text-warning"></i></a> <a href="'.route('admin.salons.edit', ['salon_id' => $data->id, 'active_tab' => 'owner_details']).'"><i class="fa fa-user-o fa-lg text-primary" title="Add/Edit Owner Details"></i></a>';
                    return $btn;
                })
                ->rawColumns(['logo', 'name', 'email', 'open_at', 'close_at', 'action'])
                ->make(true);
        }
        return view('admin.salons.index');
    }

    public function create(Request $request)
    {
        $active_tab = 'salon_details';
        return view('admin.salons.create.create', compact('active_tab'));
    }

    public function store(SalonsRequest $request)
    {
        $valid = $request->validated();
        // dd($valid, 'in store fun');
        $active_tab = $request->has('active_tab') ? $request->get('active_tab') : '';
        $next_tab = $request->has('next_tab') ? $request->get('next_tab') : '';
        if (!empty($valid['logo'])) {
            // Image saving code starts
            $image_temp = $valid['logo'];
            $image_name = Carbon::now()->timestamp.'.'.$valid['logo']->getClientOriginalExtension();
            $path = public_path().\Config::get('constants.salon_logo_path');
            $image_path = $path.$image_name;
            $valid['logo'] = $image_name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Image::make($image_temp)->save($image_path);
            } else {
                Image::make($image_temp)->save($image_path);
            }
            // Image saving code ends
            $valid['logo'] = $image_name;
            // unset($owner_details['image']);
        }
        if (!empty($valid['banner'])) {
            // Image saving code starts
            $image_temp = $valid['banner'];
            $image_name = Carbon::now()->timestamp.'.'.$valid['banner']->getClientOriginalExtension();
            $path = public_path().\Config::get('constants.salon_banner_path');
            $image_path = $path.$image_name;
            $valid['banner'] = $image_name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Image::make($image_temp)->save($image_path);
            } else {
                Image::make($image_temp)->save($image_path);
            }
            // Image saving code ends
            $valid['banner'] = $image_name;
            // unset($owner_details['image']);
        }
        try {
            $salon = Salon::create($valid)->id;
            return redirect()->route('admin.salons.edit', ['salon_id' => $salon, 'active_tab' => $next_tab])->with('success_salon_details', 'Your Salon Details has been added successfully.');
        } catch (\QueryException $e) {
            // dd($e);
            return redirect()->back()->with('error_salon_details', 'Something went wrong. Please, try again.');
        }
    }

    public function edit(Request $request, $salon_id)
    {
        $active_tab = $request->has('active_tab') ? $request->get('active_tab') : 'salon_details';
        // dd($active_tab);
        try {
            $salon = Salon::findOrFail($salon_id);
            $owner_details = $salon->getOwners;
            // dd($owner_details);
            return view('admin.salons.create.create', compact('salon', 'owner_details', 'active_tab'));
        } catch (QueryException $e) {
            return redirect()->route('admin.salons.index')->with('error', 'Requested Salons not found. Please, try again.');
        }
    }

    public function update(SalonsRequest $request, $salon_id)
    {
        $active_tab = $request->get('active_tab');
        $next_tab = $request->get('next_tab');
        $valid = $request->validated();
        // dd($valid);
        if (!empty($valid['logo'])) {
            // Image saving code starts
            $image_temp = $valid['logo'];
            $image_name = Carbon::now()->timestamp.'.'.$valid['logo']->getClientOriginalExtension();
            $path = public_path().\Config::get('constants.salon_logo_path');
            $image_path = $path.$image_name;
            $valid['logo'] = $image_name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Image::make($image_temp)->save($image_path);
            } else {
                Image::make($image_temp)->save($image_path);
            }
            // Image saving code ends
            $valid['logo'] = $image_name;
            // unset($owner_details['image']);
        }
        if (!empty($valid['banner'])) {
            // Image saving code starts
            $image_temp = $valid['banner'];
            $image_name = Carbon::now()->timestamp.'.'.$valid['banner']->getClientOriginalExtension();
            $path = public_path().\Config::get('constants.salon_banner_path');
            $image_path = $path.$image_name;
            $valid['banner'] = $image_name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Image::make($image_temp)->save($image_path);
            } else {
                Image::make($image_temp)->save($image_path);
            }
            // Image saving code ends
            $valid['banner'] = $image_name;
            // unset($owner_details['image']);
        }
        try {
            $salon = Salon::where('id', $salon_id)->update($valid);
            return redirect()->route('admin.salons.edit', ['salon_id' => $salon_id, 'active_tab' => $next_tab])->with('success_salon_details', 'Salon has been updated successfully.');
        } catch (QueryException $e) {
            // dd($e);
            return redirect()->back()->with('error', 'Salon could not been updated successfully.');
        }
    }

    public function updateOwnerDetails(SalonsRequest $request, $salon_id)
    {
        // dd($request->request, $salon_id);
        $active_tab = $request->get('active_tab');
        $owner_details = $request->validated();
        if (!empty($owner_details['owner_image'])) {
            // Image saving code starts
            $image_temp = $owner_details['owner_image'];
            $image_name = Carbon::now()->timestamp.'.'.$owner_details['owner_image']->getClientOriginalExtension();
            $path = public_path().\Config::get('constants.salon_owners_images_path');
            $image_path = $path.$image_name;
            $owner_details['owner_image'] = $image_name;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Image::make($image_temp)->save($image_path);
            } else {
                Image::make($image_temp)->save($image_path);
            }
            // Image saving code ends
            $owner_details['image'] = $image_name;
            unset($owner_details['image']);
        }
        $owner_details['email'] = $owner_details['owner_email'];
        unset($owner_details['owner_email']);
        // dd($owner_details);
        try {
            $owner_details = SalonOwnerDetail::updateOrCreate(['salons_id' => $salon_id], $owner_details);
            return redirect()->route('admin.salons.index')->with('success', 'Owner Detils are added successfully.');
        } catch (\QueryException $e) {
            dd($e);
            return redirect()->back()->with('error_salon_details', 'Owner Details are not added successfully.');
        }

    }
}
