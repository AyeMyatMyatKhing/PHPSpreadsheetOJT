<?php

namespace App\Http\Controllers;

use App\UseCase\Type2;
use App\Service\ExcelService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Type2ExcelRequest;
use App\Http\Requests\UploadExcelRequest;

class Type2ExcelController extends Controller
{
    protected $excelService;
    
    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    /**
     * Import excel file for type2
     */
    public function import(UploadExcelRequest $request)
    {
        $file = $request->file('excel_file');
        $fileName = 'type2_excel.' . $file->getClientOriginalExtension();
        $success = $this->excelService->importExcel($file , $fileName);
        if(!$success) {
            return response()->json(['errorMessage' => "Can't import file."]);
        }
        return response()->json(['message'=>'file import successfully.']);
    }

    /**
     * export typ2 excel file
     */
    public function export(Type2ExcelRequest $request,Type2 $useCase)
    {
        $file = "type2_excel.xlsx";
        $inputText = $request->type2_text;
        if (Storage::disk('public')->exists($file)) {
            $response = $useCase->invoke($file , $inputText);
            return response()->download($response[0]  , 'new_file.xlsx' , $response[1])->deleteFileAfterSend();
        }
        return response()->json(['message'=>'There is no excel file.']); 
    }
}
