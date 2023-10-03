<?php

namespace App\Http\Controllers;

use App\Lib\GDocsIntegrator;
use App\Models\Spreadsheet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpreadsheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spreadsheets = Spreadsheet::all();
        return Inertia::render('Index', [ 'spreadsheets' => $spreadsheets ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'surname' => ['required', 'max:50'],
            'phone' => ['required', 'max:50'],
            'content' => ['required'],
        ]);

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

        Spreadsheet::create([
            'url' => $spreadsheetUrl
        ]);

        return redirect()->route('spreadsheet.index');
    }

}
