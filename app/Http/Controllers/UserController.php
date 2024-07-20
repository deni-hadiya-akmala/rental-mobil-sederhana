<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax()) {
            $data = User::all();
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-warning edit" data-id="' . $row->id . '" data-username="' . $row->username . '">Edit</button>
                            <button class="btn btn-danger delete" data-id="' . $row->id . '" data-username="' . $row->username . '">Delete</button>';
                })
                ->make(true);
        }
        return view('user.index');
    }

    public function store(Request $request)
    {
        $user = User::updateOrCreate(
            ['id' => $request->id],
            [
                'fullname' => $request->fullname,
                'username' => $request->username,
                'phone' => $request->phone,
                'license_number' => $request->license_number,
                'address' => $request->address,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]
        );

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
