@extends('layouts.app')

@section('title')
    | Admin Projects
@endsection

@section('content')
    <div class="container">

        <div class="d-flex align-items-center justify-content-between">
            <h1 class="my-5">Projects</h1>
            <a href="{{ route('admin.projects.create') }}" title="Create" class="btn btn-outline-primary"><i
                    class="fa-solid fa-plus"></i>
            </a>
        </div>

        @if (session('deleted'))
            <div class="alert alert-primary" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('deleted') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 mb-5">

            @foreach ($projects as $project)
                <div class="col p-3">
                    @include('admin.partials.card')
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center"> {{ $projects->links() }} </div>

    </div>
@endsection
