<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Ward\Contracts\Services\WardServiceInterface;
use City\Contracts\Repositories\CityRepositoryInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;
use Township\Contracts\Repositories\TownshipRepositoryInterface;
use Town\Contracts\Repositories\TownRepositoryInterface;
use State\Contracts\Repositories\StateRepositoryInterface;
use Ward\Contracts\Repositories\WardRepositoryInterface;

class WardMigrate extends Command
{
    protected $signature = 'migrate:ward';

    protected $description = 'Migration Ward from MIMU Data';

    public function __construct(
        private StateRepositoryInterface $stateRepo,
        private WardRepositoryInterface $wardRepo,
        private DistrictRepositoryInterface $districtRepo,
        private TownshipRepositoryInterface $townshipRepo,
        private WardServiceInterface $wardService,
        private TownRepositoryInterface $townRepo,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateWard();
    }

    public function migrateward()
    {
        $data = $this->prepareWardData();
        foreach ($data as $key => $value) {
            // Log::info("Town migration data >> " . print_r($value, true));
            $stateName = $value['SR_Name_Eng'];
            $statePCode = $value['SR_Pcode'];
            $districtName = $value['District/SAZ_Name_Eng'];
            $districtPCode = $value['District/SAZ_Pcode'];
            $townshipName = $value['Township_Name_Eng'];
            $townshipPCode = $value['Tsp_Pcode'];
            $townName = $value['Town'];
            $townPCode = $value['Town_Pcode'];
            $formattedData = $this->formatWardData($value);
            $districtInfo = $this->districtRepo->getDistrictByNameAndPCode($districtName, $districtPCode);
            $townshipInfo = $this->townshipRepo->getTownshipByNameAndPCode($townshipName, $townshipPCode);
            $townInfo = $this->townRepo->getTownByNameAndPCode($townName, $townPCode);
            $stateInfo = $this->stateRepo->getStateByNameAndPCode($stateName, $statePCode);
            if (!empty($stateInfo) && !empty($districtInfo) && !empty($townshipInfo) && !empty($townInfo)) {
                $formattedData['town_id'] = $townInfo->id;
                $formattedData['township_id'] = $townshipInfo->id;
                $formattedData['district_id'] = $districtInfo->id;
                $formattedData['state_id'] = $stateInfo->id;
                if ($townshipInfo->city_id = $townInfo->city_id) {
                    $formattedData['city_id'] = $townInfo->city_id;
                }
                // $formattedData['country_id'] = $stateInfo->country_id;
                $this->wardService->firstOrCreateWard($formattedData);
            } else {
                Log::info("Failed to create");
                Log::info("Township Info >> " . print_r($townshipInfo?->toArray(), true));
                Log::info("District Info >> " . print_r($districtInfo?->toArray(), true));
                Log::info("Town Info >> " . print_r($townInfo?->toArray(), true));
                Log::info("State Info >> " . print_r($stateInfo?->toArray(), true));
                Log::info("Ward Name >> " . $value['Ward_Name_Eng']);
                dd();
            }
        }
    }

    private function prepareWardData(): array
    {
        $filePath = config('data.ward_data');
        Log::info("Preparing Ward data >> " . $filePath);
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

    private function formatWardData(array $data)
    {
        return [
            'en_name' => $data['Ward_Name_Eng'],
            'mm_name' => $data['Ward_Name_MMR'],
            'p_code' => $data['Ward_Pcode']
        ];
    }
}
