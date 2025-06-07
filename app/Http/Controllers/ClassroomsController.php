<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Test as AppTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Test\Test;

class ClassroomsController extends Controller
{
    //Actions 
    public function index(Request $request,AppTest $test)
    {
       
        //return response : view , redirect , json-data , file , string
        // return view('classrooms.index');
        $classrooms = Classroom::orderBy('name','DESC')->get(); // return  (Collection of Classroom)(As Array)
        // dd($classrooms); //Classroom::orderBy('name','DESC')->get(); __ querey builder finishes with get() method or first() 
        
        return view('classrooms.index',compact('classrooms'));// compact('classrooms') is the same as ['classrooms' => $classrooms]
        // return View::make('classrooms.index',compact('classrooms')); // same as above
    }
    public function create()// show form and storing data
    {
        return view('classrooms.create' );
    }
    public function show(string $id)
    {
        // Classroom::where('id','=',$id)->first(); // return first record that matches the id
     $classroom = Classroom::findOrFail($id);// like above
        
        return  view ('classrooms.show')
        ->with([
            'classroom' => $classroom,
            'id' => $id,
        ]);
                                      
                                       
    }
    public function edit($id,$edit = false)
    {
        return  view ('classrooms.edit',[
            'classroom' => Classroom::findOrFail($id), // find the classroom by id
             // pass edit variable to the view
        ]);
        
    }
    public function store(Request $request)
    {
        // dd ($request->all()) ; // return all data from the request
        // dd( $request->only('name','section'));
        // dd( $request->except('name','section')); // return all except name and section from the request
        // dd( $request->input('name')); // return name from the request

        // Method 1 
        // $classroom = new Classroom();
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->code = Str::random(10);
        // $classroom->save();//insert into database
            // PRG: Post Redirect Get

            // Method 2 : Mass assignment
            // create fillable fields in the model


            $request->merge([
                'code' => Str::random(10), // generate random code
                'theme' => 'default', // default theme
                'cover_image_path' => 'default.jpg', // default cover image
            ]);
            $classroom = Classroom::create( $request->all());// insert into database return same as method 1

            // // m 3
            // $classroom = new Classroom($request->all());
            

            // // m4

            // $classroom = new Classroom();
            // $classroom->fill($request->all())->save();
            // $classroom->forceFill( $request->all() )->save();
            
        return redirect()->route('classrooms.index');
    }
    public function update(Request $request, string $id)

    {
        $classroom =  Classroom::findOrFail($id);
         // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->save();//insert into database

        //mass assignment
        $classroom->update($request->all());
        return redirect()->route('classrooms.index');
       
    }
    public function destroy(string $id)
    {
         Classroom::destroy($id);// delete the classroom by id just from database object still excest
        
        return redirect()->route('classrooms.index');
    }
    
    

    
}
