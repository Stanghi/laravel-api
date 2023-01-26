@extends('layouts.app')

@section('title')
    | Admin Technologies
@endsection

@section('content')
    <div class="container">

        <div class="d-flex align-items-center justify-content-between">
            <h1 class="my-5">Technologies</h1>
        </div>

        @if (session('message'))
            <div class="alert alert-primary" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Add a new tecnology...">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tecnology</th>
                    <th scope="col">Projects count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <td class="d-flex">
                            <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input class="border-0" type="text" name="name" value="{{ $technology->name }}">
                                <button type="submit" class="btn btn-outline-primary me-3">Update</button>
                            </form>

                            @include('admin.partials.form-delete', [
                                'route' => 'technologies',
                                'message' => "Confermi l'eliminatione di $technology->name ?",
                                'entity' => $technology,
                            ])

                        </td>

                        <td>{{ count($technology->projects) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
