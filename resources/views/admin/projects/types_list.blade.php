@extends('layouts.app')

@section('title')
    | Admin Project-Filtered list
@endsection

@section('content')
    <div class="container d-flex justify-content-between">
        <table class="table my-5 me-5">
            <thead>
                <tr>
                    <th scope="col">Technologies</th>
                    <th scope="col">Projects</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $tecnology)
                    <tr>
                        <th>{{ $tecnology->name }}</th>
                        <td>
                            <ul>
                                @foreach ($tecnology->projects as $project)
                                    <li>
                                        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <table class="table my-5">
            <thead>
                <tr>
                    <th scope="col">Types</th>
                    <th scope="col">Projects</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <th>{{ $type->name }}</th>
                        <td>
                            <ul>
                                @foreach ($type->projects as $project)
                                    <li>
                                        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
