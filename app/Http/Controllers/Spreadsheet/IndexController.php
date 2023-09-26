<?php

namespace App\Http\Controllers\Spreadsheet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpreadsheetResource;
use App\Models\Spreadsheet;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            return response()->json([
                'result' => SpreadsheetResource::collection(Spreadsheet::all())
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 403);
        }
    }
}
