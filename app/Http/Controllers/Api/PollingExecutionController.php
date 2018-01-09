<?php

namespace App\Http\Controllers;

use App\PollingExecution;
use Illuminate\Http\Request;

class PollingExecutionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $polling = new PollingExecution();
        $input = $request->input();
        $polling->fill($input);
        if (!$polling->isValid()) {
            return response()->json([
                'status' => false,
                'errors' => $polling->errors,
            ]);
        }

        $polling->save();

        $carsToSave = [];
        if ($input['cars']) {
            foreach ($input['cars'] as $rawCar) {
                $car = new \App\Car();
                $car->fill([ 'model' => $rawCar['name'] ]);
                if ($car->isValid()) {
                    $carsToSave[] = $car;
                }
            }
        }

        $polling->cars()->saveMany($carsToSave);

        return response()->json([ 'status' => true, 'pollingId' => $polling->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $polling = PollingExecution::with('cars')->where('id', '=', $id)->first();
        return response()->json($polling);
    }

    public function bullet1() {
        $pollings = PollingExecution::all();

        $kids = $pollings->where('age', '<', 18);
        $adults = $pollings->where('age', '>=', 18);

        $json_data = [
            [
                "label" => "Kids",
                "data" => [$kids->count()]
            ],
            [
                "label" => "Adults",
                "data" => [$adults->count()]
            ],
        ];
        
        return response()->json([
            'status' => true,
            'data' => $json_data,
        ]);
    }

    public function bullet2() {
        $pollings = PollingExecution::all();

        $licensed = $pollings->where('drivingLicenseOwned', true);

        $json_data = [
            [
                "label" => "Licensed",
                "data" => [$licensed->count()]
            ],
            [
                "label" => "Not-eligible",
                "data" => [$pollings->count() - $licensed->count()]
            ],
        ];
        
        return response()->json([
            'status' => true,
            'data' => $json_data,
        ]);
    }
}
