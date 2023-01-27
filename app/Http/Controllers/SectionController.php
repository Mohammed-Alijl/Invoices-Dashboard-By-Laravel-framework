<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\section\UpdateRequest;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Front-end.sections');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $section = new Section();
            $section->name = $request->section_name;
            $section->description = $request->description;
            if ($section->save()){
                session()->put('success_msg','تم اضافة القسم بنجاح');
                return redirect()->back();
            }

        }catch (Exception $ex){
            return redirect()->back()->withErrors('failed_msg',$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $section = Section::find($request->id);
            if(!$section)
                return redirect()->back()->withErrors('msg','هذا القسم غير موجود');
            if ($request->filled('name'))
                $section->name = $request->name;
            if ($request->filled('description'))
                $section->description = $request->description;
            if($section->save()){
                Session::put('success_msg','تم اضافة التعديلات على القسم بنجاح');
                return redirect()->back();
            }
        }catch (Exception $ex){
            return redirect()->back()->withErrors('failed_msg',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
