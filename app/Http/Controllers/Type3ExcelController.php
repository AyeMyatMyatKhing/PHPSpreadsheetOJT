<?php

namespace App\Http\Controllers;

use App\UseCase\Type3;
use App\Service\ExcelService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Type3ExcelRequest;
use App\Http\Requests\UploadExcelRequest;

class Type3ExcelController extends Controller
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    /**
     * Import type3 excel file
     */
    public function import(UploadExcelRequest $request)
    {
        $file = $request->file('excel_file');
        $fileName = 'type3_excel.' . $file->getClientOriginalExtension();
        $success = $this->excelService->importExcel($file , $fileName);
        if(!$success) {
            return response()->json(['errorMessage' => "Can't import file."]);
        }
        return response()->json(['message'=>'file import successfully.']);
    }

    /**
     * export type3 excel file
     */
    public function export(Type3ExcelRequest $request,Type3 $useCase)
    {
        $file = "type3_excel.xlsx";
        $data = ['text' => $request->type3_text, 
                'input_format' => $request->input_format,
                'cell_color' =>  $request->cell_color];
        if (Storage::disk('public')->exists($file)) {
            $response = $useCase->invoke($file , $data);

            return response()->download($response[0]  , 'new_file.xlsx' , $response[1])->deleteFileAfterSend();
        }
        
        return response()->json(['message'=>'There is no excel file.']); 
    }
}
