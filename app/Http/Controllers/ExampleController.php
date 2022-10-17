<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Example;
use Validator;

class ExampleController extends Controller
{
    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'example' => 'required',
        ]);
        if($validator->fails()) {
            return [
                'errors' => $validator->errors()
            ];
        }
        $exampleValue = $request->example;
        $example =  Example::create(['example_field' => $exampleValue]);
        return $example->toJson();
    }

    public function get() 
    {
        return Example::all()->toJson();
    }

    public function getOne($id)
    {
        return Example::find($id);
    }

    public function delete($id)
    {
        $example =  Example::find($id);
        if($example) {
            $example->delete();
            return ['success' => ['message' => 'Example deleted']];
        }

        return ['errors' => ['message' => 'ID provided is invalid']];
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'example' => 'required',
        ]);
        if($validator->fails()) {
            return [
                'errors' => $validator->errors()
            ];
        }
        $example =  Example::find($id);
        if($example) {
            $example->example_field = $request->example;
            $example->save();
            return $example;
        }

        return ['errors' => ['message' => 'ID provided is invalid']];
    }

}
