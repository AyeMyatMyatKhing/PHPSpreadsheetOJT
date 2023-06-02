<?php

namespace App\Http\Controllers;

use App\UseCase\Type1;
use App\Service\ExcelService;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Requests\UploadExcelRequest;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExcelController extends Controller
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    /**
     * upload excel file
     */
    public function import(UploadExcelRequest $request)
    {
        $file = $request->file('excel_file');
        $fileName ='excel_file.'. $file->getClientOriginalExtension();
        $success = $this->excelService->importExcel($file , $fileName);
        if(!$success) {
            return response()->json(['errorMessage' => "Can't import file."]);
        }
        return response()->json(['message'=>'file import successfully.']);
    }

    /**
     * download excel file
     */
    public function export(Type1 $useCase)
    {
        $file = "excel_file.xlsx";
        if (Storage::disk('public')->exists($file)) {
            $response = $useCase->invoke($file);
            return response()->download($response[0] , 'new_file.xlsx' , $response[1])->deleteFileAfterSend();
        }
        return response()->json(['message'=>'There is no excel file.']); 
    }
}
