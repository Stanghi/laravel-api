<div class="d-flex align-items-center justify-content-between my-5">
    <a href="{{ route('admin.projects.index') }}" title="Go back" class="btn btn-outline-primary me-3">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <h1>
        @if (Route::currentRouteName() === 'admin.projects.create')
            Create new project
        @elseif (Route::currentRouteName() === 'admin.projects.edit')
            Edit {{ $project->title }}
        @elseif (Route::currentRouteName() === 'admin.projects.show')
            {{ $project->title }}
        @endif

    </h1>

    <div class="d-flex align-items-center">
        @if (Route::currentRouteName() != 'admin.projects.create')
            @if (Route::currentRouteName() != 'admin.projects.edit')
                <a href="{{ route('admin.projects.edit', $project) }}" title="Edit" class="btn btn-outline-primary me-3">
                    <i class="fa-solid fa-pen"></i>
                </a>
            @endif

            @include('admin.partials.form-delete', [
                'route' => 'projects',
                'message' => "Confermi l'eliminatione di $project->title ?",
                'entity' => $project,
            ])

        @endif
    </div>
</div>
