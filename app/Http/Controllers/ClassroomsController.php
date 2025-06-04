<?php

namespace App\Http\Controllers;

use App\Test as AppTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Test\Test;

class ClassroomsController extends Controller
{
    //Actions 
    public function index(Request $request,AppTest $test)
    {
        $name = 'Mohanad';
        $title = 'title';
        //return response : view , redirect , json-data , file , string
        // return view('classrooms.index');
        return view('classrooms.index',compact('name','title'));
    }
    public function create()
    {
        return view('classrooms.create');
    }
    public function show($id,$edit = false)
    {
     
        return  view ('classrooms.show')->with('id',$id)
                                       ->with('edit',$edit)
                                       ->with('id',$id);
    }
}
