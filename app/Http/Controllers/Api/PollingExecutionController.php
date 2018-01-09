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
        echo '<pre>';
        // print_r($request->input());
        // die();
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
        foreach ($input['cars'] as $carName) {
            $car = new \App\Car();
            $car->fill([ 'model' => $carName ]);
            if ($car->isValid()) {
                $carsToSave[] = $car;
            }
        }

        $polling->cars()->saveMany($carsToSave);

        return response()->json([ 'status' => true, 'polling_id' => $polling->id ]);
    }

    public function show($id) {
        $polling = PollingExecution::with('cars')->where('id', '=', $id)->first();
        return response()->json($polling);
    }

}
