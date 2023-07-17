<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Town\Contracts\Services\TownServiceInterface;
use City\Contracts\Repositories\CityRepositoryInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;
use Township\Contracts\Repositories\TownshipRepositoryInterface;

class TownMigrate extends Command
{
    protected $signature = 'migrate:town';

    protected $description = 'Migration Town from MIMU Data';

    public function __construct(
        private CityRepositoryInterface $cityRepo,
        private DistrictRepositoryInterface $districtRepo,
        private TownshipRepositoryInterface $townshipRepo,
        private TownServiceInterface $townService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateTown();
    }

    public function migrateTown()
    {
        $data = $this->prepareTownData();
        foreach ($data as $key => $value) {
            // Log::info("Town migration data >> " . print_r($value, true));
            $districtName = $value['District/SAZ_Name_Eng'];
            $districtPCode = $value['District/SAZ_Pcode'];
            $cityName = $value['City_Name_Eng'];
            $cityPCode = $value['City_Pcode'];
            $townshipName = $value['Township_Name_Eng'];
            $townshipPCode = $value['Tsp_Pcode'];
            $formattedData = $this->formatTownData($value);
            $districtInfo = $this->districtRepo->getDistrictByNameAndPCode($districtName, $districtPCode);
            $cityInfo = $this->cityRepo->getCityByNameAndPCode($cityName, $cityPCode);
            $townshipInfo = $this->townshipRepo->getTownshipByNameAndPCode($townshipName, $townshipPCode);
            if (!empty($districtInfo) && !empty($cityInfo) && !empty($townshipInfo)) {
                $formattedData['township_id'] = $townshipInfo->id;
                $formattedData['district_id'] = $districtInfo->id;
                $formattedData['city_id'] = $cityInfo->id;
                if ($districtInfo->state_id == $cityInfo->state_id) {
                    $formattedData['state_id'] = $districtInfo->state_id;
                }
                // $formattedData['country_id'] = $stateInfo->country_id;
                $this->townService->createTown($formattedData);
            } else {
                Log::info("Failed to create");
                Log::info("Township Info >> " . print_r($townshipInfo?->toArray(), true));
                Log::info("District Info >> " . print_r($districtInfo?->toArray(), true));
                Log::info("City Info >> " . print_r($cityInfo?->toArray(), true));
                Log::info("Town Name >> " . $value['Town_Name_Eng']);
            }
        }
    }

    private function prepareTownData(): array
    {
        $filePath = config('data.town_data');
        Log::info("Preparing Town data >> " . $filePath);
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

    private function formatTownData(array $data)
    {
        return [
            'en_name' => $data['Town_Name_Eng'],
            'mm_name' => $data['Town_Name_MMR'],
            'p_code' => $data['Tsp_Pcode']
        ];
    }
}
