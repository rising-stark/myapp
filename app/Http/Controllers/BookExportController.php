<?php

namespace App\Http\Controllers;

use Response;
use Exception;
use Illuminate\Http\Request;
use App\Exports\BookExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BooksAuthor;
use Illuminate\Support\Facades\DB;

class BookExportController extends Controller{

	private function array_to_xml($data, &$xml) {
		foreach( $data as $key => $value ) {
			if( is_array($value) ) {
				if( is_numeric($key) ){
					$key = 'Item'.$key; //dealing with <0/>..<n/> issues
				}
				$subnode = $xml->addChild($key);
				$this->array_to_xml($value, $subnode);
			} else {
				$xml->addChild("$key",htmlspecialchars("$value"));
			}
		 }
	}

	public function exportTableCSV(Request $request){
		try{
			return Excel::download(new BookExport($request->input('cols')), 'books.csv');
		}catch(Exception $e){
			error_log($e);
			return 0;
		}
	}

	public function exportTableXML(Request $request){
		try{
			$export_cols_arr = $request->input('cols');
			
			$books = DB::table('books_authors')
						->join('books', 'books_authors.book_title', '=', 'books.book_title')
						->join('authors', 'books_authors.author_name', '=', 'authors.author_name');

			foreach($export_cols_arr as $i){
				$books = $books->addSelect('books_authors.'.$i);
			}

			$books = $books->get()->toArray();

			$books = array_map(function ($value) {
				return (array)$value;
			}, $books);

			$xml = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
			
			$this->array_to_xml($books, $xml);

			return response($xml->asXML(), 200)
					->header('Content-Type', 'application/xml')
					->header('Content-Disposition','attachment; filename="myfile.xml"');;

		}catch(Exception $e){
			error_log($e);
			return 0;
		}
	}
}
