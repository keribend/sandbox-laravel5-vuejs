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

        $answers = new PollingExecution();
        $input = $request->input();
        $answers->fill($input);
        if (!$answers->isValid()) {
            return response()->json([
                'status' => false,
                'errors' => $answers->errors,
            ]);
        }
        return response()->json([ 'status' => true ]);
    }

}
