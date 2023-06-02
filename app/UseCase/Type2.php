<?php

namespace App\UseCase;

use App\Service\ExcelService;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Type2
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function invoke($file , $text)
    {
        $filePath = storage_path('app/public/'.$file);
        $spreadSheet = IOFactory::load($filePath);
        $sheet = $spreadSheet->getActiveSheet();
        $cell = $this->excelService->getCellValue($sheet , '#tag1.tag2.tag3#');
        $sheet->setCellValue($cell , $text);
        $newSpreadSheet = [];
        $newSpreadSheet = $this->excelService->exportExcel($spreadSheet);

        return $newSpreadSheet;
    }
}