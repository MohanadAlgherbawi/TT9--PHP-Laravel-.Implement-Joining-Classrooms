    <div class="form-floating mb-3">
  <input type="text" value="{{old('name',$classroom->name)}}" @class(['form-control ','is-invalid' => $errors->has('name')])  name="name" id="name" placeholder="Classroom Name">
  <label for="name">Class Name</label>
  @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-floating mb-3">
  <input type="text"value="{{old('section',$classroom->section)}}" @class(['form-control ','is-invalid' => $errors->has('section')]) name="section" id="section"  placeholder="Section">
  <label for="section">Section</label>
  <div class="form-floating mb-3">
  <input type="text" value="{{old('subject',$classroom->subject)}}"@class(['form-control ','is-invalid' => $errors->has('subject')]) name="subject" id="subject" placeholder="Subject">
  <label for="subject"><Samp></Samp>ubject</label>
</div>
<div class="form-floating mb-3">
  <input type="text"value="{{old('room',$classroom->room)}}" @class(['form-control ','is-invalid' => $errors->has('room')]) name="room" id="room"  placeholder="Room">
  <label for="room">Room</label>
  <div class="form-floating mb-3">
    @if ($classroom->cover_image_path)
        <img src="{{Storage::disk('uploads')->url($classroom->cover_image_path)}}" alt="" class="img-fluid mb-3">
    
    @endif
  <input type="file" @class(['form-control ','is-invalid' => $errors->has('cover_image_path')]) name="cover_image" id="cover_image"  placeholder="Cover Image">
  <label for="cover_image">Cover Image</label>
  <button type="submit" class="btn btn-primary">{{$button_label}}</button>
</div>