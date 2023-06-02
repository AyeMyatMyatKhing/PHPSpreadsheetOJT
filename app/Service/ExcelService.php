<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelService
{
    /**
     * import excel file
     */
    public function importExcel($file , $filename)
    {
        try {
            if (Storage::disk('public')->exists($filename)) {
                Storage::disk('public')->delete($filename);
            }
            Storage::disk('public')->put($filename , file_get_contents($file));
            return true;
        } catch(\Exception $e) {
            info($e->getMessage());
            return false;
        }
    }

    /**
     * export modified excel file
     */
    public function exportExcel($spreadSheet)
    {
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="new_file.xlsx"',
        ];
        //Save the modified spreadsheet
        $writer = IOFactory::createWriter($spreadSheet , 'Xlsx');
        $tempFilePath = storage_path('app/public/temp/example_temp.xlsx');
        $writer->save($tempFilePath);

        return [$tempFilePath , $headers];
    }

    /**
     * get cell value
     */
    public function getCellValue($sheet , $searchValue)
    {
        foreach ($sheet->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                if ($cell->getValue() == $searchValue) {
                    // Get the cell coordinates
                    $cellCoordinates = $cell->getCoordinate();
                    
                    // Return the cell coordinates
                    return $cellCoordinates;
                }
            }
        }
        return null;
    }
}