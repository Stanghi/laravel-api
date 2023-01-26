@extends('layouts.app')

@section('title')
    | Admin Project-Create
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

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" placeholder="Add title..." value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Client name *</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name"
                    name="client_name" placeholder="Add client name..." value="{{ old('client_name') }}">
                @error('client_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image"
                    name="cover_image" placeholder="Add image..." onchange="showImage(event)"
                    value="{{ old('cover_image') }}">

                <div class="cover-image mt-3 debug">
                    <img id="output-image" src="" alt="">
                </div>

                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <p for="date" class="form-label">Technologies</p>
                @foreach ($technologies as $technology)
                    <input id="{{ $technology->slug }}" type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                        @if (in_array($technology->id, old('technologies', []))) checked @endif>
                    <label class="me-3" for="{{ $technology->slug }}">{{ $technology->name }}</label>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Types</label>
                <select class="form-select" name="type_id" aria-label="Default select example">
                    <option value="">Select type</option>
                    @foreach ($types as $type)
                        <option @if ($type->id == old('type_id')) selected @endif value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">summary</label>
                <textarea class="form-control" id="summary" name="summary" value="{{ old('summary') }}" rows="5"
                    placeholder="Add summary..."></textarea>
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
