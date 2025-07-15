    @extends('layouts.master')

    @section('title', $classroom->name)
    

    @section('content')
    
    <div class="container">
    <h1>{{$classroom->name }} - {{ $classroom->id }}</h1>
    <h3>{{$classroom->section}}</h3>
    <div class="col-md-3">
        <div class="border rounded p-3 text-center"> 
            <span class="text-success fs-2">{{$classroom->code}}</span>
        </div>
    </div>
    <div class="col-md-9">

    </div>
    </div>
@endsection