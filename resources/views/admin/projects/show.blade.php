@extends('layouts.app')

@section('title')
    | Admin Project-Show
@endsection

@section('content')
    <div class="container">

        @include('admin.partials.action-in-page')

        @if ($project->technologies)
            <div class="mb-3">
                @foreach ($project->technologies as $technology)
                    <span class="badge text-bg-success">{{ $technology->name }}</span>
                @endforeach
            </div>
        @endif

        @if ($project->type)
            <div class="mb-3">
                <span class="badge text-bg-success">{{ $project->type->name }}</span>
            </div>
        @endif

        @if ($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->cover_image_original }}">
            <p>{{ $project->cover_image_original }}</p>
        @endif

        <p>Client name: {{ $project->client_name }}</p>
        <p>{!! $project->summary !!}</p>
    </div>
@endsection
