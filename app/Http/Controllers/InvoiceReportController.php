<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceReports\IndexRequest;
use App\Http\Requests\InvoiceReports\SearchRequest;

class InvoiceReportController extends Controller
{
    public function index(IndexRequest $request){
        return $request->run();
    }
    public function search(SearchRequest $request){
        return $request->run();
    }
}
