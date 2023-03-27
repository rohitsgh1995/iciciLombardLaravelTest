<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travellers;
use App\Models\CityTravelHistory;
use Carbon\Carbon;

class TravellerController extends Controller
{
    public function index(Request $request)
    {
        try {

            $searchTerm = $request->search_term;

            $items_per_page = $request->items_per_page;

            $requestData = ['traveller_name'];

            $list = Travellers::where(function($q) use($requestData, $searchTerm) {
                                            foreach ($requestData as $field)
                                                $q->orWhere($field, 'like', "%{$searchTerm}%");
                            })->paginate($items_per_page);

            return response()->json([
                'status' => true,
                'data' => $list
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
            
        }
    }

    public function travellerById($id)
    {
        try {

            $data = Travellers::where('id', $id)->first();

            if($data == null)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Traveller not found.'
                ], 404);
            }
            else
            {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            }
        
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
            
        }
    }

    public function travellerTravelHistory(Request $request, $id)
    {
        try {

            $t = Travellers::where('id', $id)->first();

            if($t == null)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Traveller not found.'
                ], 404);
            }
            else
            {
                if(!empty($request->from_date) && empty($request->to_date))
                {
                    $start_date = Carbon::parse($request->from_date)->format('Y-m-d');
                    
                    $history = CityTravelHistory::with('city')->where('traveller_id', $id)->where('from_date', '>=', $start_date)->orderBy('from_date')->get();
                }
                elseif(empty($request->from_date) && !empty($request->to_date))
                {
                    $end_date = Carbon::parse($request->to_date)->format('Y-m-d');
                    
                    $history = CityTravelHistory::with('city')->where('traveller_id', $id)->where('from_date', '<=', $end_date)->orderBy('from_date')->get();
                }
                elseif(!empty($request->from_date) && !empty($request->to_date))
                {
                    $start_date = Carbon::parse($request->from_date)->format('Y-m-d');
                    $end_date = Carbon::parse($request->to_date)->format('Y-m-d');

                    $history = CityTravelHistory::with('city')->where('traveller_id', $id)->
                                where('from_date', '>=', $start_date)->
                                where('from_date', '<=', $end_date)->
                                orderBy('from_date')->get();
                }
                else
                {
                    $history = CityTravelHistory::with('city')->where('traveller_id', $id)->orderBy('from_date')->get();
                }

                $data = [];
                
                if(!empty($history))
                {
                    foreach($history as $h)
                    {
                        $data[] = [
                            'city_name' => $h->city->city_name,
                            'from_date' => $h->from_date,
                            'to_date' => $h->to_date,
                        ];
                    }

                    return response()->json([
                        'status' => true,
                        'data' => $data
                    ], 200);
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'Travel log history not found.'
                    ], 404);
                }
            }
        
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
            
        }
    }
}
