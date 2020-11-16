<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Section;
use Illuminate\Http\Request;
use Auth;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = translate('class');
        return view('backend.'.Auth::user()->role.'.class.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $class = new Classes;
        $class->name = $request->name;
        $class->school_id = school_id();


        if($class->save()){
            $this->createSection($class->id);
            flash(translate('class_added_successfully'))->success();
               
        }else {
            flash('failed to add')->error();
            
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show($class_id)
    {
        $classes = Classes::find($class_id);
        return view('backend.'.Auth::user()->role.'.class.section', compact('classes'));
    }

    public function list()
    {
        return view('backend.'.Auth::user()->role.'.class.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classes::find($id);
        return view('backend.'.Auth::user()->role.'.class.edit', compact('classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $classes = Classes::find($id);
        $classes->name = $request->name;
        $classes->school_id = school_id();

        if($classes->save()){
            flash(translate('class_updated_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_updating_class')->error();
            
        }

        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Classes::destroy($id)){
            flash(translate('class_deleted_successfully'))->success();
               
            
        }else {
            flash('an_error_occured_when_deleting_class')->error();
            
        }

        return redirect()->back();
    }

    public function createSection($class_id = "") {
            $section = new Section;
            $section->name = "A";
            $section->school_id = school_id();
            $section->class_id = $class_id;
            $section->save();
    }
}
