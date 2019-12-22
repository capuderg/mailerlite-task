<?php

namespace App\Http\Controllers;

use App\Field;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Field::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subscriber                $subscriber
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subscriber $subscriber)
    {
        $request->validate($this->validationRules());

        $field = $subscriber->fields()->create($request->all());

        return response()->json($field, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        return $field;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $request->validate($this->validationRules());

        $field->update($request->all());

        return response()->json($field, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();

        return response()->json(null, 204);
    }

    /**
     * Prepare the validation rules to be used in the validate method.
     *
     * @return array
     */
    private function validationRules()
    {
        return [
            'title' => 'required',
            'type' => [
                'nullable',
                Rule::in(Field::TYPES)
            ]
        ];
    }
}
