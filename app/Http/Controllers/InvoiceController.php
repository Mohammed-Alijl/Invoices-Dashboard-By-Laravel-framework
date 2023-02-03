<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoices\CreateRequest;
use App\Http\Requests\Invoices\DestroyRequest;
use App\Http\Requests\Invoices\IndexRequest;
use App\Http\Requests\Invoices\ShowRequest;
use App\Http\Requests\Invoices\EditRequest;
use App\Http\Requests\Invoices\StoreRequest;
use App\Http\Requests\Invoices\UpdateRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request)
    {
        return $request->run();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request,$id)
    {
        return $request->run($id);
    }

    public function edit(EditRequest $request, $id)
    {
        return $request->run($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $request->run($id);
    }

    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }
}
