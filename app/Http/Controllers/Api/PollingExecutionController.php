<?php

namespace App\Http\Controllers;

use App\PollingExecution;
use App\Car;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
                $car->fill([ 'model' => Str::upper($rawCar['name']) ]);
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

    public function bullet3() {
        $pollings = PollingExecution::where('drivingLicenseOwned', true)->get();

        $careDrifting = $pollings->where('drifting', true);

        $json_data = [
            [
                "label" => "Care about drifting",
                "data" => [$careDrifting->count()]
            ],
            [
                "label" => "Do not",
                "data" => [$pollings->count() - $careDrifting->count()]
            ],
        ];
        
        return response()->json([
            'status' => true,
            'data' => $json_data,
        ]);
    }

    public function bullet4() {
        $pollings = PollingExecution::where('drivingLicenseOwned', true)->get();

        $drivetrain = $pollings->filter(function($polling) {
            return $polling->drivetrain == "FWD" or is_null($polling->drivetrain);
        });

        $json_data = [
            [
                "label" => "FWD or I don't know",
                "data" => [$drivetrain->count()]
            ],
            [
                "label" => "Others",
                "data" => [$pollings->count() - $drivetrain->count()]
            ],
        ];

        return response()->json([
            'status' => true,
            'data' => $json_data,
        ]);
    }

    public function bullet5() {
        $cars = Car::groupBy('polling_execution_id')
            ->select(DB::raw('COUNT(id) as counter'))
            ->get();

        $avgCars = $cars->avg('counter');

        return response()->json([
            'status' => true,
            'average' => $avgCars,
        ]);
    }

    public function bullet6() {
        $cars = DB::table('cars')
            ->select('model', DB::raw('count(id) as Quantity'))
            ->groupBy('model')
            ->get();

        $json_data = [];
        foreach ($cars as $car) {
            $json_data[] = [
                "label" => $car->model,
                "data" => [$car->Quantity],
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $json_data,
        ]);
    }
}
