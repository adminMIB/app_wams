<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $data = Timeline::orderBy("created_at" , "DESC")->paginate(10);

        return response()->json([
            "status" => "true",
            "data" => $data
        ]);

    }

    public function store(Request $request)
    {
        try{
            $validate = Validator::make($request->all(), [
                "Timeline" => "required|string|unique:timelines"
            ]);
            
            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            Timeline::create([
                "Timeline" => $request->Timeline
            ]);

            return response()->json([
                "status" => true,
                "message" => "berhasil dibuat"
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    // public function perbulan()
    // {
    //     $now = now();
    //     if ($now > new Carbon('first day of July ' . date('m'), 'Australia/Adelaide')) {
    //         $year_start = $now->month(1)->day(1)->format('m-d');
    //         $year_end   = $now->month(3)->day(30)->format('m-d');
    //     } elseif() {
    //         $year_start = $now->month(1)->day(1)->format('m-d');
    //         $year_end   = $now->month(3)->day(30)->format('m-d');
    //     }
    // }

    
}
