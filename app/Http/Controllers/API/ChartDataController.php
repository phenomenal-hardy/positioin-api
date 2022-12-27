<?php 

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use \App\Models\ChartData;
use \App\Http\Requests\StoreChartDataRequest;

class ChartDataController extends Controller {


    public function index(Request $request) {

        $results = ChartData::where('user_id', $request->input('userId'))
        ->orderBy('chart_date', 'asc')
        ->select(['id', 'user_id', 'chart_date', 'chart_amount'])
        ->get();

        return response()->json(compact('results'));

    }

    public function store(StoreChartDataRequest $request) {

        $validated = $request->safe()->only(['userId', 'chartDate', 'chartAmount']);

        $userId = $validated['userId'];
        $chartDate = $validated['chartDate'];
        $chartAmount = $validated['chartAmount'];

        $row = ChartData::where('user_id', $userId)->where('chart_date', $chartDate)->first();

        if(! $row) {

            ChartData::create([
                'user_id' => $userId,
                'chart_date' => $chartDate,
                'chart_amount' => $chartAmount
            ]);
                
        } else {

            $row->chart_amount = $chartAmount;
            $row->save();
        }

        return response()->json(compact('validated'));
    }

}