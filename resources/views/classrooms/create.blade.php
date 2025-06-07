
   @include('partials.header')
   <div class="container">
    <h1>Create Classroom</h1>
    <form action="{{ route('classrooms.store') }}" method="POST">
        {{--
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{csrf_field()}}// return input field
        --}}
        @csrf
        <div class="form-floating mb-3">
  <input type="text" class="form-control" name="name" id="name" placeholder="Classroom Name">
  <label for="floatingInput">Class Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" name="section" id="section"  placeholder="Section">
  <label for="floatingPassword">Section</label>
  <div class="form-floating mb-3">
  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
  <label for="floatingInput"><Samp></Samp>ubject</label>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" name="room" id="room"  placeholder="Room">
  <label for="floatingPassword">Room</label>
  <div class="form-floating mb-3">
  <input type="file" class="form-control" name="cover_image" id="cover_image"  placeholder="Cover Image">
  <label for="floatingPassword">Cover Image</label>
  <button type="submit" class="btn btn-primary">Create Room</button>
</div>
    </form>
    </div>
    @include('partials.footer')
    {{-- relative to view folder --}}