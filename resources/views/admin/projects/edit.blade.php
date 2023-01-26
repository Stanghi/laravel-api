@extends('layouts.app')

@section('title')
    | Admin Project-Edit
@endsection

@section('content')
    <div class="container">

        @include('admin.partials.action-in-page')

        @if ($errors->any())
            <div class="alert alert-danger m-5" role="alert">
                <h2><i class="fa-solid fa-triangle-exclamation"></i>Error</h2>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title', $project->title) }}" placeholder="Add title...">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Client name *</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name"
                    name="client_name" value="{{ old('client_name', $project->client_name) }}"
                    placeholder="Add client_name...">
                @error('client_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image"
                    name="cover_image" value="{{ old('cover_image', $project->cover_image) }}"
                    placeholder="Add URL for image..." onchange="showImage(event)">
                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @if ($project->cover_image)
                    <div class="cover-image">
                        <img id="output-image" src="{{ asset('storage/' . $project->cover_image) }}"
                            alt="{{ $project->cover_image_original }}">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <p for="date" class="form-label">Technologies</p>
                @foreach ($technologies as $technology)
                    <input id="{{ $technology->slug }}" type="checkbox" name="technologies[]"
                        value="{{ $technology->id }}"
                        @if (!$errors->all() && $project->technologies->contains($technology)) checked
                        @elseif ($errors->all() && in_array($technology->id, old('technologies', [])))
                            checked @endif>
                    <label class="me-3" for="{{ $technology->slug }}">{{ $technology->name }}</label>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Types</label>
                <select class="form-select" name="type_id" aria-label="Default select example">
                    <option value="">Select type</option>
                    @foreach ($types as $type)
                        <option @if ($type->id == old('type_id', $project->type?->id)) selected @endif value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea id="summary" name="summary" rows="5" placeholder="Add summary...">{{ old('summary', $project->summary) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit
                <i class="fa-solid fa-file-import ms-1"></i>
            </button>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#summary'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            })
            .catch(error => {
                console.error(error);
            });

        function showImage(event) {
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
