<?php

namespace App\Http\Controllers\Admin\TapalDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TapalDetail\StoreTapalDetailRequest;
use App\Http\Requests\Admin\TapalDetail\UpdateTapalDetailRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\TapalDetail;
use App\Models\LetterType;
use App\Models\Department;

class TapalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Start building the query
        $tapal_detail_query = TapalDetail::join('letter_types', 'letter_types.id', '=', 'tapal_details.letter_type')
            ->join('departments', 'departments.id', '=', 'tapal_details.department')
            ->select('tapal_details.*', 'letter_types.letter_type_name', 'departments.department_name')
            ->orderBy('tapal_details.id', 'desc');
        
        if ( auth()->user()->roles->pluck('name')[0] == 'Department' ) {
            $tapal_detail_query->where('tapal_details.department', auth()->user()->department);
        }

        
        $tapal_detail = $tapal_detail_query->get();
        
        
        $letter_type_list = LetterType::latest()->get();
        $department_list = Department::latest()->get();

        return view('admin.TapalDetail.tapalDetail')->with([
            'tapal_detail' => $tapal_detail,
            'letter_type_list' => $letter_type_list,
            'department_list' => $department_list,
        ]);
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
    public function store(StoreTapalDetailRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            TapalDetail::create($input);
            DB::commit();

            return response()->json(['success'=> 'Tapal Detail Store successfully!']);
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
    public function edit(TapalDetail $tapal_detail)
    {
        if ($tapal_detail)
        {
            $response = [
                'result' => 1,
                'tapal_detail' => $tapal_detail,
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
    public function update(UpdateTapalDetailRequest $request, TapalDetail $tapal_detail)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $tapal_detail->update($input);
            DB::commit();

            return response()->json(['success'=> 'Tapal detail updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Tapal detail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TapalDetail $tapal_detail)
    {
        try
        {
            DB::beginTransaction();
            $tapal_detail->delete();
            DB::commit();

            return response()->json(['success'=> 'Tapal detail deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Tapal detail');
        }
    }

    public function report(Request $request)
    {
        $selected_letter_type = $request->input('letter_type');
        $start_date = $request->input('fromdate');
        $end_date = $request->input('todate');
        $start_datetime = $start_date . ' 00:00:00';
        $end_datetime = $end_date . ' 23:59:59';

        
        $query = TapalDetail::join('letter_types', 'letter_types.id', '=', 'tapal_details.letter_type')
            ->join('departments', 'departments.id', '=', 'tapal_details.department');

        
        if ($selected_letter_type) {
            $query->where('tapal_details.letter_type', '=', $selected_letter_type);
        }

        
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('tapal_details.created_at', [$start_datetime, $end_datetime]);
        }

        
        if (auth()->user()->roles->pluck('name')[0] == 'Department') {
            $query->where('tapal_details.department', '=', auth()->user()->department);
        }

        // Execute the query and get the results
        $tapal_detail = $query->select('tapal_details.*', 'letter_types.letter_type_name', 'departments.department_name')
            ->orderBy('tapal_details.id', 'desc')
            ->get();

        // Fetch the letter type and department lists
        $letter_type_list = LetterType::latest()->get();
        $department_list = Department::latest()->get();

        // Return the view with the required data
        return view('admin.reports.report')->with([
            'tapal_detail' => $tapal_detail,
            'letter_type_list' => $letter_type_list,
            'department_list' => $department_list,
        ]);
    }

}
