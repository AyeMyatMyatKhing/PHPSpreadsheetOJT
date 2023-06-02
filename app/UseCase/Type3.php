<?php

namespace App\UseCase;

use App\Service\ExcelService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class Type3
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    } 
    
    public function invoke($file , $data)
    {
        $filePath = storage_path('app/public/'.$file);
        $spreadSheet = IOFactory::load($filePath);
        $sheet = $spreadSheet->getActiveSheet();
        $cell = $this->excelService->getCellValue($sheet , '#tag1.tag2.tag3#');
        $sheet->setCellValue($cell , $data['text']);

        //get the next cell coordinate
        [$currentColumn, $currentRow] = Coordinate::coordinateFromString($cell);
        $nextColumn = Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($currentColumn) + 1);
        $nextCellCoordinates = $nextColumn . $currentRow;
        $sheet->setCellValue($nextCellCoordinates , $data['input_format']);
        $cellStyle = $sheet->getStyle($cell);
        $cellStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setrgb($data['cell_color']);
        $newSpreadSheet = [];
        $newSpreadSheet = $this->excelService->exportExcel($spreadSheet);

        return $newSpreadSheet;
    }
}