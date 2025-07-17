<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use URL;

class ClassroomsController extends Controller
{
    public function __construct()

    {
         $this->middleware('auth');    
    }
    //Actions 
    public function index(Request $request)
    {
        // active() as the scopeActive
        $classrooms = Classroom::active()
        ->recent()
        ->orderBy('name','DESC')
      //  ->withoutGlobalScope() cancel soft del and all global scopes
        ->get(); 
        $success = session('success');
        // ->orderBy('created_at','DESC')->get();
        return view('classrooms.index',compact('classrooms','success'));
        // compact('classrooms'س) is the same as ['classrooms' => $classrooms]
    }
    public function create()
    {
        return view('classrooms.create' ,[
            'classroom' => new Classroom(), 
        ]);  
    }

    public function show(Classroom $classroom) 
    {     
        $invitation_link = URL::temporarySignedRoute('classrooms.join',now()->addHour(3),[
        'classroom' => $classroom->id,
        'code' => $classroom->code,
        ]);                               
    }
    public function edit(Classroom $classroom) 
    {
        return  view ('classrooms.edit',[
             'classroom' => $classroom, 
        ]);
    }
    public function store(ClassroomRequest $request)
    {
            // first validate the request
            $validated = $request->validated() ;
            if($request->hasFile('cover_image')) {
               $file = $request->file('cover_image'); 
               $path =Classroom::uploadCoverImage($file); 
               $validated['cover_image_path'] = $path; 
            }   
            // $validated['code'] = Str::random(10); 
            $validated['user_id'] = Auth::id();
            DB::beginTransaction();
            try{
                $classroom = Classroom::create($validated);
                $classroom->join(Auth::id(),'teacher');

                DB::commit();
            }catch(QueryException $e){
                DB::rollBack();
                return back()
                ->with('error',$e->getMessage())
                ->withInput();
            }
            return redirect()->route('classrooms.index')
            ->with('success', 'Classroom created successfully.'); 
    }
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $validated = $request->validated() ;

        if($request->hasFile('cover_image')) {
               $file = $request->file('cover_image'); 
               $path = Classroom::uploadCoverImage($file); 
               $validated['cover_image_path'] = $path; 
               $old = $classroom->cover_image_path;
            } 
            $old = $classroom->cover_image_path; 
        $classroom->update($validated); 
        if($old && $old != $classroom->cover_image_path) {
            Classroom::deleteCoverImage($old);
        }
        // Session::flash('success','Classroom Updated');

        return redirect()->route('classrooms.index')
        ->with('success','Updated Successfully');
       
    }
    public function destroy(Classroom $classroom)
    {
         $classroom->delete();

        // Classroom::deleteCoverImage($classroom->cover_image_path);
        return redirect()->route('classrooms.index')
        ->with('success', 'Classroom deleted successfully.'); 
    }
    public function trashed()
    {
        $classrooms = Classroom::onlyTrashed()->latest('deleted_at')->get();// check deleted at null ? ,, latest order by creatd at
        return view('classrooms.trashed', compact('classrooms'));
    }
    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();// update deleted_at to null
         return redirect()
         ->route('classrooms.index')
        ->with('success', "Classroom {{$classroom->name}}restored successfully."); 
    }
    public function forceDelete($id)
    {
                $classroom = Classroom::withTrashed()->findOrFail($id);
                $classroom->forceDelete();
                Classroom::deleteCoverImage($classroom->cover_image_path);


                 return redirect()
         ->route('classrooms.index')
        ->with('success', "Classroom {{$classroom->name}} deleted forever!"); 

    }
}
