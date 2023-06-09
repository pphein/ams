<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use City\Contracts\Services\CityServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class CityMigrate extends Command
{
    protected $signature = 'migrate:city';

    protected $description = 'Migration city from MIMU Data';

    public function __construct(
        private StateRepositoryInterface $stateRepo,
        private CityServiceInterface $cityService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateCity();
    }

    public function migrateCity()
    {
        $data = $this->prepareCityData();
        foreach ($data as $key => $value) {
            Log::info("City migration data >> " . print_r($value, true));
            $stateName = $value['SR Name_Eng'];
            $statePCode = $value['SR_Pcode'];
            $formattedData = $this->formatCityData($value);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            if (!empty($stateInfo)) {
                $formattedData['state_id'] = $stateInfo->id;
                // $formattedData['country_id'] = $stateInfo->country_id;
                $this->cityService->createCity($formattedData);
            }
        }
    }

    private function prepareCityData(): array
    {
        $filePath = config('data.city_data');
        Log::info("Preparing city data >> " . $filePath);
        $reader = new Xlsx();
        $spreadsheet = $reader->load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $header = null;
        $data = [];
        foreach ($sheetData as $row) {
            if (!$header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }
        return $data;
    }

    private function formatCityData(array $data)
    {
        return [
            'en_name' => $data['City_Name_Eng'],
            'mm_name' => $data['City_Name_MMR'],
            'p_code' => $data['City_Pcode']
        ];
    }
}
