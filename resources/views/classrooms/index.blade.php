<x-main-layout title="Classrooms">
    <div class="container">
        <h1>Classrooms</h1>
        {{-- <x-alert name="success" class="alert-success" />
        <x-alert name="error" class="alert-danger" /> --}}
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @foreach ($classrooms as $classroom)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('uploads/' . $classroom->cover_image_path) }}" class="card-img-top"
                            alt="Classroom Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $classroom->name }}</h5>
                            <p class="card-text">{{ $classroom->section }} - {{ $classroom->room }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('classrooms.show', $classroom->id) }}"
                                    class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('classrooms.edit', $classroom->id) }}"
                                    class="btn btn-sm btn-dark">Edit</a>
                                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        @push('scripts')
            <script></script>
        @endpush
</x-main-layout>
