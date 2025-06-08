<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Test as AppTest;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Test\Test;
use Illuminate\Support\Facades\Session; // for session management
use Illuminate\Support\Facades\Storage as FacadesStorage;

class ClassroomsController extends Controller
{
    //Actions 
    public function index(Request $request)
    {
       
        //return response : view , redirect , json-data , file , string
        // return view('classrooms.index');
        $classrooms = Classroom::orderBy('name','DESC')->get(); // return  (Collection of Classroom)(As Array)
        // dd($classrooms); //Classroom::orderBy('name','DESC')->get(); __ querey builder finishes with get() method or first() 
        // session(); // get the session object
        $success = session('success');//get the success message from the session
        // Session::reflash(); 
        // Session::flash('success', 'Whatever|'); // flash message to the session
        return view('classrooms.index',compact('classrooms','success'));// compact('classrooms') is the same as ['classrooms' => $classrooms]
        // return View::make('classrooms.index',compact('classrooms')); // same as above
    }
    public function create()// show form and storing data
    {
        
        return view('classrooms.create' ,[
            'classroom' => new Classroom(), // create a new instance of Classroom model
        ]);
        
    }

    public function show(Classroom $classroom) // or Classroom $classroom
    {
        // Classroom::where('id','=',$id)->first(); // return first record that matches the id
    //  $classroom = Classroom::findOrFail($id);// like above
        
        return  view ('classrooms.show')
        ->with([
            'classroom' => $classroom,
            
        ]);
                                      
                                       
    }
    public function edit(Classroom $classroom) // or Classroom $classroom
    {
        return  view ('classrooms.edit',[
            // 'classroom' => Classroom::findOrFail($id), // find the classroom by id
             // pass edit variable to the view
             'classroom' => $classroom, // or Classroom::findOrFail($id) // find the classroom by id
        ]);
        
    }
    public function store(ClassroomRequest $request)
    {

        // first validate the request


                    $validated = $request->validated() ;

       
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


            if($request->hasFile('cover_image')) {
               $file = $request->file('cover_image'); // return the file object (uploaded file)
               $path =Classroom::uploadCoverImage($file); // upload the file and return the path
               $validated['cover_image_path'] = $path; // add the path to the validated data
            } 
            
            $validated['code'] = Str::random(10); // add code to the validated data
            $classroom = Classroom::create( $validated);// insert into database return same as method 1

            // // m 3
            // $classroom = new Classroom($request->all());
            

            // // m4

            // $classroom = new Classroom();
            // $classroom->fill($request->all())->save();
            // $classroom->forceFill( $request->all() )->save();
           


              // put variable in session
        return redirect()->route('classrooms.index')
        ->with('success', 'Classroom created successfully.'); // redirect to index with success message
    }
    public function update(ClassroomRequest $request, Classroom $classroom)

    {
        // $classroom =  Classroom::findOrFail($id);
         // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->save();//insert into database

        //mass assignment
        $validated = $request->validated() ;

        if($request->hasFile('cover_image')) {
               $file = $request->file('cover_image'); // return the file object (uploaded file)
               $path = Classroom::uploadCoverImage($file); 
               $validated['cover_image_path'] = $path; // add the path to the validated data
            } 
            $old = $classroom->cover_image_path; // get the old cover image path
        $classroom->update($validated); // update the classroom with the validated data
        if($old && $old != $classroom->cover_image_path) {
            // delete the old cover image file if it exists and is not the same as the new one
            Classroom::deleteCoverImage($old);
        }
        return redirect()->route('classrooms.index')
        ->with('success', 'Classroom updated successfully.'); // redirect to index with success message
       
    }
    public function destroy(Classroom $classroom)
    {
        //  Classroom::destroy($id);// delete the classroom by id just from database object still excest
        // Flash Masseges ___>> sesion
         //$classroom = Classroom::find($id);
         $classroom->delete(); // delete the classroom from database and object
         Classroom::deleteCoverImage($classroom->cover_image_path);
        return redirect()->route('classrooms.index')
        ->with('success', 'Classroom deleted successfully.'); // redirect to index with success message
    }
    
    

    
}
