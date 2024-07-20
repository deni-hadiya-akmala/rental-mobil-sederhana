<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class RentalController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax()) {
            $data = Rental::with('car', 'user')->get();
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex justify-content-center">
                    <button class="btn btn-info view" data-id="' . $row->id . '">View</button>
                    <button class="btn btn-sm btn-warning edit mx-2" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete" data-id="' . $row->id . '" data-user="' . $row->user->name . '">Delete</button>
                    </div>
                    ';
                })
                ->addColumn('car_details', function ($row) {
                    return $row->car->brand . ' ' . $row->car->model . ' (' . $row->car->plate_number . ')';
                })
                ->addColumn('user_details', function ($row) {
                    return $row->user->fullname . ' (' . $row->user->username . ')';
                })
                ->editColumn('total_cost', function ($row) {
                    return formatRupiah($row->total_cost);
                })
                ->make(true);
        }
        return view('rental.index');
    }



    public function store(Request $request, $sts = 0)
    {
        try {
            $rules = [
                'user_id' => 'required|exists:users,id',
                'car_id' => 'required|exists:cars,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'total_cost' => 'required|numeric|min:1',
                'returned' => 'required|boolean',
            ];

            if ($sts == 1) {
                $rules['total_cost'] = 'numeric|min:1';
                $rules['returned'] = 'boolean';
            }

            $request->validate($rules);

            $rentalData = $request->only(['user_id', 'car_id', 'start_date', 'end_date', 'total_cost', 'returned']);

            if ($sts == 0) {
                $rental = Rental::create($rentalData);
            } else {
                $rental = Rental::findOrFail($request->id);
                $rental->update($rentalData);
            }

            return response()->json($rental);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Duplicate entry detected.'], 400);
        }
    }

    public function update(Request $request, Rental $rental)
    {
        return $this->store($request->merge(['id' => $rental->id]), 1);
    }

    public function show($id)
    {
        $rental = Rental::with('user', 'car')->findOrFail($id);
        return response()->json($rental);
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->delete();
        return response()->json(['success' => 'Rental deleted successfully']);
    }
}
