<?php

namespace App\Http\Controllers\Admin\Salons;

use Auth;
use App\User;
use App\Salon;
use Carbon\Carbon;
use App\SalonOwnerDetail;
use Illuminate\Support\Str;
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
            $data = Salon::all('id', 'name', 'email', 'open_at', 'close_at');
            // dd($data);
            return DataTables::of($data)
                ->editColumn('salon_name', function($data) {
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
                    // dd(route('admin.salons.edit', $))
                    // return "Action";
                    // <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".owner_details">Large modal</button>
                    $btn = '<a href="'.route('admin.salons.edit', $data->id).'"><i class="fa fa-edit fa-lg text-warning"></i></a> <a href="javascript:;" data-id="'.$data->id.'"><i class="fa fa-user-o fa-lg text-primary" title="Add Owner Details"></i></a>';
                    return $btn;
                })
                ->rawColumns(['salon_name', 'email', 'open_at', 'close_at', 'action'])
                ->make(true);
        }
        return view('admin.salons.index');
    }

    public function create(Request $request)
    {
        return view('admin.salons.create.create');
    }

    public function store(SalonsRequest $request)
    {
        $valid = $request->validated();
        // dd($valid, 'in store fun');
        try {
            $salon = Salon::create($valid);
            return redirect()->route('admin.salons.index')->with('success', 'Your Salon has been added successfully.');
        } catch (\QueryException $e) {
            dd($e);
            return redirect()->route('admin.salons.index')->with('error', 'Something went wrong. Please, try again.');
        }
    }

    public function edit(Request $request, $salon_id)
    {
        try {
            $salon = Salon::findOrFail($salon_id);
            // dd($salon);
            return view('admin.salons.create.create', compact('salon'));
        } catch (QueryException $e) {
            return redirect()->route('admin.salons.index')->with('error', 'Request Salon not found. Please, try again.');
        }
    }

    public function update(SalonsRequest $request, $salon_id)
    {
        $valid = $request->validated();
        // dd($valid);
        try {
            $salon = Salon::where('id', $salon_id)->update($valid);
            return redirect()->back()->with('success', 'Salon has been updated successfully.');
        } catch (QueryException $e) {
            // dd($e);
            return redirect()->back()->with('error', 'Salon could not been updated successfully.');
        }
    }

    public function updateOwnerDetails(SalonsRequest $request, $salon_id)
    {
        // dd($request->request, $salon_id);
        $owner_details = $request->validated();
        $owner_details['email'] = $owner_details['owner_email'];
        unset($owner_details['owner_email']);
        // dd($owner_details);
        try {
            $owner_details = SalonOwnerDetail::updateOrCreate(['salons_id' => $salon_id], $owner_details);
            return redirect()->back()->with('success_salon_details', 'Owner Detils are added successfully.');
        } catch (\QueryException $e) {
            dd($e);
            return redirect()->back()->with('error_salon_details', 'Owner Details are not added successfully.');
        }

    }
}
