<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use City\Contracts\Repositories\CityRepositoryInterface;
use Township\Contracts\Services\TownshipServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;

class TownshipMigrate extends Command
{
    protected $signature = 'migrate:township';

    protected $description = 'Migration township from MIMU Data';

    public function __construct(
        private StateRepositoryInterface $stateRepo,
        private CityRepositoryInterface $cityRepo,
        private DistrictRepositoryInterface $districtRepo,
        private TownshipServiceInterface $townshipService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateTownship();
    }

    public function migrateTownship()
    {
        $data = $this->prepareTownshipData();
        foreach ($data as $key => $value) {
            Log::info("Township migration data >> " . print_r($value, true));
            $stateName = $value['SR_Name_Eng'];
            $statePCode = $value['SR_Pcode'];
            $districtName = $value['District/SAZ_Name_Eng'];
            $districtPCode = $value['District/SAZ_Pcode'];
            $cityName = $value['City_Name_Eng'];
            $cityPCode = $value['City_Pcode'];
            $formattedData = $this->formatTownshipData($value);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            $districtInfo = $this->districtRepo->getDistrictByNameAndPCode($districtName, $districtPCode);
            $cityInfo = $this->cityRepo->getCityByNameAndPCode($cityName, $cityPCode);
            if (!empty($stateInfo) && !empty($districtInfo) && !empty($cityInfo)) {
                $formattedData['district_id'] = $districtInfo->id;
                $formattedData['city_id'] = $cityInfo->id;
                $formattedData['state_id'] = $stateInfo->id;
                $this->townshipService->createTownship($formattedData);
            } else {
                Log::info("Failed to create >> " . $formattedData['en_name']);
                Log::info("State Info >> " . json_encode($stateInfo));
                Log::info("City Info >> " . json_encode($cityInfo));
                Log::info("District Info >> " . json_encode($districtInfo));
                dd();
            }
        }
    }

    private function prepareTownshipData(): array
    {
        $filePath = config('data.township_data');
        Log::info("Preparing township data >> " . $filePath);
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

    private function formatTownshipData(array $data)
    {
        return [
            'en_name' => $data['Township_Name_Eng'],
            'mm_name' => $data['Township_Name_MMR'],
            'p_code' => $data['Tsp_Pcode']
        ];
    }
}
