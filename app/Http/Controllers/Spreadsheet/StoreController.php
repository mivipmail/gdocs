<?php

namespace App\Http\Controllers\Spreadsheet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lib\GDocsIntegrator;
use App\Models\Spreadsheet;
use App\Http\Resources\SpreadsheetResource;

class StoreController extends Controller
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
            $data = $request->all();

            $values = [
                [ 'Имя', $data['name'] ],
                [ 'Фамилия', $data['surname'] ],
                [ 'Телефон', $data['phone'] ],
                [ 'Текст', $data['content'] ]
            ];

            $gDocsIntegrator = new GDocsIntegrator();
            $spreadsheetUrl = $gDocsIntegrator->createSpreadsheet();
            $gDocsIntegrator->setReadPermissionsForGuests();
            $gDocsIntegrator->insertValues($values);

            $spreadsheet = Spreadsheet::create([
                'url' => $spreadsheetUrl
            ]);

            return response()->json(['result' => new SpreadsheetResource($spreadsheet)]);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 403);
        }
    }
}
