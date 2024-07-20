<?php

namespace App\Http\Controllers;


use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use DataTables;

class CarController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax()) {
            $data = Car::all();
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-warning edit" data-id="' . $row->id . '" data-plate_number="' . $row->plate_number . '">Edit</button>
                            <button class="btn btn-danger delete" data-id="' . $row->id . '" data-plate_number="' . $row->plate_number . '">Delete</button>';
                })
                ->editColumn('rental_price', function ($row) {
                    return formatRupiah($row->rental_price);
                })
                ->make(true);
        }
        return view('car.index');
    }

    public function store(Request $request, $sts = 0)
    {
        try {
            $rules = [
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
            ];

            if ($sts == 0) {
                $rules = array_merge($rules, [
                    'plate_number' => ['required', 'string', 'max:255', Rule::unique('cars')],
                    'rental_price' => 'required|integer|min:1',
                    'is_available' => 'required|boolean',
                ]);
            } else {
                // $rules['plate_number'] = ['required', 'string', 'max:255', Rule::unique('cars')->ignore($request->id)];
                $rules['rental_price'] = 'integer|min:1';
                $rules['is_available'] = 'boolean';
            }

            $request->validate($rules);

            $carData = $request->only(['brand', 'model', 'plate_number', 'rental_price', 'is_available']);

            if ($sts == 0) {
                $car = Car::create($carData);
            } else {
                $car = Car::findOrFail($request->id);
                $car->update($carData);
            }

            return response()->json($car);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Duplicate entry detected.'], 400);
        }
    }

    public function update(Request $request, Car $car)
    {
        return $this->store($request->merge(['id' => $car->id]), 1);
    }


    public function show($id)
    {
        $car = Car::find($id);
        return response()->json($car);
    }

    public function destroy($id)
    {
        Car::destroy($id);
        return response()->json(['success' => 'Car deleted successfully.']);
    }
}
