<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\TapalDetail;
use App\Models\LetterType;
use App\Models\Department;

class DashboardController extends Controller
{

    // public function index()
    // {
    //     $letter_type_list = LetterType::latest()->get();
    //     $post_count = TapalDetail::latest()->get();
    //     $letter_list = [];
    //     foreach($letter_type_list as $list)
    //     {
    //         $letter_list[$list->letter_type_name]['count'] = 0;
    //         foreach($post_count as $count)
    //         {
    //             if($list->id == $count->letter_type)
    //             {
    //                 $letter_list[$list->letter_type_name]['count'] = TapalDetail::where('letter_type', '=', $list->id)->count();
    //             }
    //         }
    //     }
        
    //     return view('admin.dashboard')->with([
    //         'letter_list'=> $letter_list
    //     ]);
    // }

    public function index()
    {
        $letter_type_list = LetterType::latest()->get();
        $letter_list = [];

        
        // Check if the user role is 'department'
        $isDepartmentRole = auth()->user()->roles->pluck('name')[0] === 'Department'; // Adjust this according to your role attribute

        foreach ($letter_type_list as $list) {
            // Initialize count for each letter type
            $letter_list[$list->letter_type_name]['count'] = 0;

            // Use a conditional query based on the user role
            $query = TapalDetail::where('letter_type', '=', $list->id);

            if ($isDepartmentRole) {
                // If the role is department, filter by the user's department
                $query->where('department', auth()->user()->department); // Assuming 'department_id' is the field in TapalDetail
            }

            // Get the count for the current letter type
            $letter_list[$list->letter_type_name]['count'] = $query->count();
        }

        return view('admin.dashboard')->with([
            'letter_list' => $letter_list
        ]);
    }


    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
