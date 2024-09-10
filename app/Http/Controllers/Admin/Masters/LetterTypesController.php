<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\LetterTypes\StoreLetterTypeRequest;
use App\Http\Requests\Admin\Masters\LetterTypes\UpdateLetterTypeRequest;
use App\Models\LetterType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LetterTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letter_types = LetterType::latest()->get();

        return view('admin.masters.letterTypes')->with(['letter_types'=> $letter_types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterTypeRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            LetterType::create($input);
            DB::commit();

            return response()->json(['success'=> 'Letter Type created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Letter Type');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LetterType $letter_type)
    {
        if ($letter_type)
        {
            $response = [
                'result' => 1,
                'letter_type' => $letter_type,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterTypeRequest $request, LetterType $letter_type)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $letter_type->update($input);
            DB::commit();

            return response()->json(['success'=> 'Letter Type updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Letter Type');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LetterType $letter_type)
    {
        try
        {
            DB::beginTransaction();
            $letter_type->delete();
            DB::commit();

            return response()->json(['success'=> 'Letter type deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Letter Type');
        }
    }
}
