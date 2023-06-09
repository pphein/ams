<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use City\Contracts\Repositories\CityRepositoryInterface;
use Township\Contracts\Services\TownshipServiceInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;

class TownshipMigrate extends Command
{
    protected $signature = 'migrate:township';

    protected $description = 'Migration township from MIMU Data';

    public function __construct(
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
            $districtName = $value['District/SAZ_Name_Eng'];
            $districtPCode = $value['District/SAZ_Pcode'];
            $cityName = $value['City_Name_Eng'];
            $cityPCode = $value['City_Pcode'];
            $formattedData = $this->formatTownshipData($value);
            $districtInfo = $this->districtRepo->getDistrictByNameAndPCode($districtName, $districtPCode);
            $cityInfo = $this->cityRepo->getCityByNameAndPCode($cityName, $cityPCode);
            if (!empty($districtInfo) && !empty($cityInfo)) {
                $formattedData['district_id'] = $districtInfo->id;
                $formattedData['city_id'] = $cityInfo->id;
                if ($districtInfo->state_id == $cityInfo->state_id) {
                    $formattedData['state_id'] = $districtInfo->state_id;
                }
                // $formattedData['country_id'] = $stateInfo->country_id;
                $this->townshipService->createTownship($formattedData);
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
