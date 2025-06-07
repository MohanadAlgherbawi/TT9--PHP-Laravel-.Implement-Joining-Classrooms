@include('partials.header');
    <div class="container">
    <h1>Classrooms</h1>
    
    <div class="row">
@foreach ($classrooms as $classroom)
<div class="col-md-3">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title">Classroom Name</h5>
    <p class="card-text">{{$classroom->section}} - {{$classroom->room}}</p>
    <a href="{{route('classrooms.show',$classroom->id)}}" class="btn btn-sm btn-primary">View</a>
        <a href="{{route('classrooms.edit',$classroom->id)}}" class="btn btn-sm btn-dark">Edit</a>
    <form action="{{route('classrooms.destroy',$classroom->id)}}" method="post" >
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
      </form>
  </div>
</div>
</div>
@endforeach
    
    
    </div>
@include('partials.footer');