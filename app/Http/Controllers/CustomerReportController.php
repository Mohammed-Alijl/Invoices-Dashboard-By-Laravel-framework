<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerReport\IndexRequest;
use App\Http\Requests\CustomerReport\SearchRequest;

class CustomerReportController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    public function search(SearchRequest $request)
    {
        return $request->run();
    }
}
