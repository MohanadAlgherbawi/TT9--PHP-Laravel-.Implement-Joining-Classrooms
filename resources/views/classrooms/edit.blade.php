    @extends('layouts.master')
    @section('title', 'Edit Classroom ' . $classroom->name)
    
    

    @section('content')
    
   
   <div class="container">
    <h1>Edit Classroom</h1>
    <form action="{{ route('classrooms.update',$classroom->id) }}" method="post" enctype="multipart/form-data">
       
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{csrf_field()}}
        
       
        @csrf
        @method('put') {{-- to specify the method for the form submission --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    
    @endif
              @include('classrooms._form',[
            'button_label' => 'Update Classroom',
              ])

    </form>
    </div>
@endsection  