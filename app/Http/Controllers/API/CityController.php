<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\CityTravelHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function distinctTraveller(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'from_date' => 'required|date_format:Y-m-d|before:to_date',
                'to_date' => 'required|date_format:Y-m-d|after:from_date'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
            $to_date = Carbon::parse($request->to_date)->format('Y-m-d');

            $cities = DB::table('cities')->join('city_travel_histories', 'city_travel_histories.city_id', '=', 'cities.id')->get();

            $history = CityTravelHistory::where('from_date', '>=', $from_date)->where('from_date', '<=', $to_date)->orderBy('from_date')->get();
            
            return response()->json([
                'status' => true,
                'data' => $cities,
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
