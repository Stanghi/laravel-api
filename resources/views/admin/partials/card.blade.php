<div class="card">
    @if ($project->cover_image)
        <img class="card-img-top" src="{{ asset('storage/' . $project->cover_image) }}"
            alt="{{ $project->cover_image_original }}">
    @else
        <img class="card-img-top" src="https://www.umberto.it/wp-content/uploads/2022/10/placeholder.png"
            alt="Placeholder">
    @endif

    <div class="card-body d-flex flex-column justify-content-between">
        <p class="card-text fw-bold mb-3">{{ $project->title }}</p>

        <div class="mb-3">
            {{-- <span class="badge text-bg-success">{{ $project->type?->name }}</span> --}}
            @forelse ($project->technologies as $technology)
                <span class="badge text-bg-success">{{ $technology->name }}</span>
            @empty
                <span class="badge text-bg-success"> - </span>
            @endforelse
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.projects.show', $project) }}" title="Show" class="btn btn-outline-primary">
                <i class="fa-solid fa-eye"></i>
            </a>

            <a href="{{ route('admin.projects.edit', $project) }}" title="Edit" class="btn btn-outline-primary"><i
                    class="fa-solid fa-pen"></i>
            </a>

            @include('admin.partials.form-delete', [
                'route' => 'projects',
                'message' => "Confermi l'eliminatione di $project->title ?",
                'entity' => $project,
            ])
        </div>

    </div>
</div>
