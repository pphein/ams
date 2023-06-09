<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use District\Contracts\Services\DistrictServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class DistrictMigrate extends Command
{
    protected $signature = 'migrate:district';

    protected $description = 'Migration district from MIMU Data';

    public function __construct(
        private StateRepositoryInterface $stateRepo,
        private DistrictServiceInterface $districtService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateDistrict();
    }

    public function migrateDistrict()
    {
        $data = $this->prepareDistrictData();
        foreach ($data as $key => $value) {
            Log::info("District migration data >> " . print_r($value, true));
            $stateName = $value['SR Name_Eng'];
            $statePCode = $value['SR'];
            $formattedData = $this->formatDistrictData($value);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            if (!empty($stateInfo)) {
                $formattedData['state_id'] = $stateInfo->id;
                // $formattedData['country_id'] = $stateInfo->country_id;
                $this->districtService->createDistrict($formattedData);
            }
        }
    }

    private function prepareDistrictData(): array
    {
        $filePath = config('data.district_data');
        Log::info("Preparing district data >> " . $filePath);
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

    private function formatDistrictData(array $data)
    {
        return [
            'en_name' => $data['District_Name_Eng'],
            'mm_name' => $data['District_Name_MMR'],
            'p_code' => $data['District_Pcode']
        ];
    }
}
