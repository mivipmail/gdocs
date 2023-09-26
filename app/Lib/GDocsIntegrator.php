<?php

namespace App\Lib;

// use Google\Client;
// use Revolution\Google\Sheets\Facades\Sheets;

class GDocsIntegrator
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    protected $spreadsheetUrl;

    public function __construct()
    {
        $this->client = new \Google\Client();
    
        $this->client->setAuthConfig(config('google.service.file'));
        $this->client->setScopes([\Google\Service\Sheets::DRIVE, \Google\Service\Sheets::SPREADSHEETS]);
    }

    public function createSpreadsheet()
    {
        $this->service = new \Google\Service\Sheets($this->client);
    
        $spreadsheetProperties = new \Google\Service\Sheets\SpreadsheetProperties();
        $spreadsheetProperties->setTitle('Таблица');

        $spreadsheet = new \Google\Service\Sheets\Spreadsheet();
        $spreadsheet->setProperties($spreadsheetProperties);
        $response = $this->service->spreadsheets->create($spreadsheet);

        $this->spreadsheetId = $response->spreadsheetId;
        $this->spreadsheetUrl = $response->spreadsheetUrl;

        return $this->spreadsheetUrl;
    }

    public function setReadPermissionsForGuests() {
        $drive = new \Google\Service\Drive($this->client);

        $drivePermisson = new \Google\Service\Drive\Permission();
        $drivePermisson->setType('anyone');
        $drivePermisson->setRole('reader');

        $response = $drive->permissions->create($this->spreadsheetId, $drivePermisson);
        return $response;
    }

    public function insertValues($values) {
        $valueRange = new \Google\Service\Sheets\ValueRange();
        $valueRange->setValues($values);

        $options = [
            'valueInputOption' => 'USER_ENTERED'
        ];
    
        $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            'Sheet1!A1:Z',
            $valueRange,
            $options
        );
    }

    public function getSpreadsheetUrl() {
        return $this->spreadsheetUrl;
    }
}
