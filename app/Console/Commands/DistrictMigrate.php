<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use District\Contracts\Services\DistrictServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class DistrictMigrate extends Command
{
    protected $signature = 'migrate:district {--saz}';

    protected $description = 'Migration district from MIMU Data';

    public function __construct(
        private StateRepositoryInterface $stateRepo,
        private DistrictServiceInterface $districtService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $sazSad = $this->option('saz');
        if ( $sazSad) {
            $this->migrateSazSad();
        } else {
            $this->migrateDistrict();
        }
    }

    public function migrateDistrict()
    {
        $data = $this->prepareDistrictData();
        foreach ($data as $key => $value) {
            // Log::info("District migration data >> " . print_r($value, true));
            $stateName = $value['SR_Name_Eng'];
            $statePCode = $value['SR_Pcode'];
            $formattedData = $this->formatDistrictData($value);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            if (!empty($stateInfo)) {
                $formattedData['state_id'] = $stateInfo->id;
                $this->districtService->firstOrCreateDistrict($formattedData);
            } else {
                Log::info("Failed to create >> " . $formattedData['en_name']);
                Log::info("State info >> " . json_encode($stateInfo));
                dd();
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

    public function migrateSazSad()
    {
        $data = $this->prepareSazSadData();
        foreach ($data as $key => $value) {
            // Log::info("District migration data >> " . print_r($value, true));
            $stateName = $value['SR_Name_Eng'];
            $statePCode = $value['SR_Pcode'];
            $formattedData = $this->formatSazSadData($value);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            if (!empty($stateInfo)) {
                $formattedData['state_id'] = $stateInfo->id;
                $this->districtService->firstOrCreateDistrict($formattedData);
            } else {
                Log::info("Failed to create >> " . $formattedData['en_name']);
                Log::info("State info >> " . json_encode($stateInfo));
                dd();
            }
        }
    }

    private function prepareSazSadData(): array
    {
        $filePath = config('data.saz_sad_data');
        Log::info("Preparing saz sad data >> " . $filePath);
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

    private function formatSazSadData(array $data)
    {
        return [
            'en_name' => $data['SAD/SAZ_Name_Eng'],
            'mm_name' => $data['SAD/SAZ_Name_MMR'],
            'p_code' => $data['SAD/SAZ_Pcode']
        ];
    }
}
