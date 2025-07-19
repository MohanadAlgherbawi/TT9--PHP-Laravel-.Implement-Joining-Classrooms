<x-main-layout :title="$classroom->name">
     <div class="container">
    <h1>{{$classroom->name }} - {{ $classroom->id }}</h1>
    <h3>Create Classwork</h3>
    <hr>
    <form action="{{route('classrooms.classworks.store',[$classroom->id,'type' => $type])}}"></form>
   @csrf
   <x-form.floating-control name="title" >
       <x-slot:label name="title">{{-- Custom slot --}}
        <label for="tilte">Title</label>
</x-slot:label>
  <x-form.input name="title"placeholder="Title" />
      </x-form.floating-control>
      <x-form.floating-control name="description" >
       <x-slot:label name="description">{{-- Custom slot --}}
        <label for="description">Description (Optional)</label>
</x-slot:label>
  <x-form.textarea name="description"placeholder="Description (Optional)" />
      </x-form.floating-control>
      <x-form.floating-control name="topic_id" >
       <x-slot:label name="topic_id">{{-- Custom slot --}}
        <label for="topic_id">Topic (Optional)</label>
</x-slot:label>
        <select class="form-select" name="topic_id" id="topic_id">
            <option value="">No Topic</option>
            @foreach ($classroom->topics as $topic )
                <option value="{{$topic->id}}">{{$topic->name}}</option>
            @endforeach
        </select>
        <x-form.error name="topic_id"/>
            
      </x-form.floating-control>
    <button type="submit" class="btn btn-primary">Create</button>  
</div>
</x-main-layout>