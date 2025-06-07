
   @include('partials.header') {{--relative to view folder--}}
   <div class="container">
    <h1>Edit Classroom</h1>
    <form action="{{ route('classrooms.update',$classroom->id) }}" method="post">

        {{--
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{csrf_field()}}// return input field
        --}}
        @csrf
        @method('put') {{-- to specify the method for the form submission --}}
        <div class="form-floating mb-3">
  <input type="text" class="form-control" value="{{$classroom->name}}" name="name" id="name" placeholder="Classroom Name">
  <label for="floatingInput">Class Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control"  value="{{$classroom->section}}" name="section" id="section"  placeholder="Section">
  <label for="floatingPassword">Section</label>
  <div class="form-floating mb-3">
  <input type="text" class="form-control"   value="{{$classroom->subject}}" name="subject" id="subject" placeholder="Subject">
  <label for="floatingInput"><Samp></Samp>Subject</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control"   value="{{$classroom->room}}" name="room" id="room"  placeholder="Room">
  <label for="floatingPassword">Room</label>
  <div class="form-floating mb-3">
  <input type="file" class="form-control" name="cover_image" id="cover_image"  placeholder="Cover Image">
  <label for="floatingPassword">Cover Image</label>
  <button type="submit" class="btn btn-primary">Edit</button>
</div>
    </form>
    </div>
    @include('partials.footer')
    {{-- relative to view folder --}}