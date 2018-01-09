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

    public function show($id) {
        $polling = PollingExecution::with('cars')->where('id', '=', $id)->first();
        return response()->json($polling);
    }

}
