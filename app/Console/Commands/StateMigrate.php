<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use State\Contracts\Services\StateServiceInterface;

class StateMigrate extends Command
{
    protected $signature = 'migrate:state';

    protected $description = 'Migration state from MIMU Data';

    public function __construct(
        private StateServiceInterface $stateService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->migrateState();
    }

    public function migrateState()
    {
        $data = $this->prepareStateData();
        foreach ($data as $key => $value) {
            $formattedData = $this->formatStateData($value);
            $this->stateService->firstOrCreateState($formattedData);
        }
    }

    private function prepareStateData(): array
    {
        $filePath = config('data.state_data');
        Log::info("Preparing state data >> " . $filePath);
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

    private function formatStateData(array $data)
    {
        return [
            'en_name' => $data['SR_Name_Eng'],
            'mm_name' => $data['SR_Name_MMR'],
            'p_code' => $data['SR_Pcode']
        ];
    }
}
