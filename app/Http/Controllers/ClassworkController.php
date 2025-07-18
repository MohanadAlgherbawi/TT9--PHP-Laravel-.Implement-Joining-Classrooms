<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
 


class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        //
        $classworks = $classroom->classworks()// بستدعي بروبيرتي مش ميثود هيك (بدةن قواس)
        ->orderBy('published_at')
        ->get();
        $assignments = $classroom->classworks()        // هان برجع العلاقة
        ->where('type','=',Classwork::TYPE_ASSIGMEMNT)
        ->get();

        return view('classworks.index',[
            'classroom' => $classroom,
            'classworks' => $classworks,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Classroom $classroom)
    {
        //
        return view('classworks.create',[
            'classroom' => $classroom,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {
        //must validation 
        $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'topic_id' => ['nullable','int','exists:topics,id']
        ]);
        $request->merge([
            'user_id' => Auth::id(),
            // 'classroom_id' => $classroom->id,
        ]);
        $classwork = $classroom->classworks()->create($request->all());// ع مستوى الكلاس ورك بعمل كرييت
        return redirect()
        ->route('classrooms.classworks.index',$classroom->id)
        ->with('success','Classwork created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
        //
        return View::make('classworks.show')->with([
            'classwork' => $classwork,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom,Classwork $classwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Classroom $classroom, Classwork $classwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom,Classwork $classwork)
    {
        //
    }
}
