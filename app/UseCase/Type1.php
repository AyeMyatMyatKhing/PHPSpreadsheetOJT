<?php

namespace App\UseCase;

use App\Service\ExcelService;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Type1
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function invoke($file)
    {
        $filePath = storage_path('app/public/'.$file);
            $spreadSheet = IOFactory::load($filePath);
            $sheet = $spreadSheet->getActiveSheet();
            $lastRow = $sheet->getHighestRow();
            for ($row = $lastRow; $row >= 1; $row--) {
                $sheet->removeRow($row);
            }
            $sheet->setCellValue('A2' , 'Hello World');
            $newSpreadSheet = [];
            $newSpreadSheet = $this->excelService->exportExcel($spreadSheet);

            return $newSpreadSheet;
    }
}