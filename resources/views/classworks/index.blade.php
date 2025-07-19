 
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    create
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" 
        href="{{route('classrooms.classworks.create',[$classroom->id,'type' => 'assignment'])}}"
        >Assignment</a></li>
    <li><a class="dropdown-item" 
        href="{{route('classrooms.classworks.create',[$classroom->id,'type' => 'material'])}}"
        >Material</a></li>
    <li><a class="dropdown-item" 
        href="{{route('classrooms.classworks.create',[$classroom->id,'type' => 'question'])}}"
        >Question</a></li>
  </ul>
</div>
    </h3>
    <hr>
    
    
    <div class="accordion accordion-flush" id="accordionFlushExample">
     

    @forelse ($classworks as $classwork)
        <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" 
      data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" 
        aria-expanded="false" aria-controls="flush-collapseThree">
        {{$classwork->title}}
      </button>
    </h2>
    <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        {{$classwork->description}}
    </div>
    </div>
  </div>
    @empty
    <p class="text-center fs-3">No classworks founds</p>
    @endforelse
     </div>        
    </div>
</x-main-layout>    