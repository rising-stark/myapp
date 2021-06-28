<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Exports\BookExport;
use Maatwebsite\Excel\Facades\Excel;

class BookExportController extends Controller{

    public function exportTableCSV(Request $request){
		try{
			return Excel::download(new BookExport($request->input('cols')), 'books.csv');
		}catch(Exception $e){
			return 0;
		}
	}

	public function exportTableXML(Request $request){
		try{
			//error_log($request);
			/*$export_type_arr = explode (",", substr($request->export_type, 1, -1));
			$export_cols_arr = explode (",", substr($request->export_cols, 1, -1));
			
			foreach($export_cols_arr as $i){
				error_log($i);
			}*/
			return Excel::download(new BookExport, 'books.xlsx');
		}catch(Exception $e){
			return 0;
		}
	}
}
