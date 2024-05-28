@extends('layouts.admin')

@section('content')
<section class="h-100 w-100">
    <div class="container pt-4 w-100 ">
        <div class="row">
            <div class="col">
                <h1 class="mb-2">Elenco progetti per la tecnologia {{$tecnology->name}}</h1>
                <ul class="list-group">
                    @foreach ($tecnology->projects as $project)
                        <li class="list-group-item">
                            <a href="{{route('admin.projects.show', $project)}}">
                                {{$project->id}} - {{$project->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@section('title')
    Tecnology-Project
@endsection
