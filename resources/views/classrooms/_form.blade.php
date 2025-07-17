<x-alert name="error" id="errror" class="alert-danger"/>



<x-form.floating-control name="name">
      <x-slot:label>{{-- Custom slot --}}
        <label for="name">Classroom Name</label>
</x-slot:label>
  <x-form.input name="name" :value="$classroom->name" placeholder="Class Name" />
 </x-form.floating-control>

<x-form.floating-control name="section" >
       <x-slot:label name="section">{{-- Custom slot --}}
        <label for="section">Section Name</label>
</x-slot:label>
  <x-form.input name="section" :value="$classroom->section" placeholder="Section" />
      </x-form.floating-control>

<x-form.floating-control name="subject" >
       <x-slot:label>{{-- Custom slot --}}
        <label for="subject">Subject Name</label>
</x-slot:label>
  <x-form.input name="subject" :value="$classroom->subject" placeholder="Subject" />
  </x-form.floating-control>

<x-form.floating-control name="room" >
       <x-slot:label>{{-- Custom slot --}}
        <label for="room">Room Name</label>
</x-slot:label>
      <x-form.input name="room" :value="$classroom->room" placeholder="Room Name" />
  </x-form.floating-control>
 
   
  <div class="form-floating mb-3">
    @if ($classroom->cover_image_path)
        {{-- <img src="{{Storage::disk('uploads')->url( $classroom->cover_image_path)}}" alt="Classroom Image" class="card-img-top"> --}}
      <img src="/uploads/{{$classroom->cover_image_path}}" class="card-img-top" alt="Classroom Image">

    @endif
      <x-form.input type="file" name="cover_image" value="{{$classroom->cover_image_path}}" placeholder="Cover Image" />
  <label for="cover_image">Cover Image</label>
    <x-form.error name="cover_image" />

  <button type="submit" class="btn btn-primary">{{$button_label}}</button>
</div>