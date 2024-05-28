@php
    use App\Functions\Helper as Help;
@endphp

@extends('layouts.admin')

@section('content')

<section class="h-100 flex-grow-1 sec-index ">
    <div class="container pt-4 w-100 ">

        <div class="row">
            <div class="col"><h1 class="mb-5">Dettagli</h1></div>
        </div>

        <div class="row">
            <div class="col">
                <img
                  src="{{asset('storage/' . $project->image)}}"
                  class="card-img-top img-fluid"
                  alt="{{$project->title}}"
                  onerror="this.src='/img/noimg.jpg'">
            </div>
            <div class="col">
                      <h5 class="card-title mb-2  text-capitalize"><span class="fw-bold me-2">Nome:</span> {{$project->title}}</h5>
                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Link:</span> {{$project->href}}</p>
                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Tipo:</span> {{$project->type->id}} {{$project->type->name}}</p>
                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Ultima modifica:</span> {{Help::dateFormat($project->updated_at)}}</p>
                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Descrizione:</span> {{$project->description}}</p>

                    <div class="d-flex mb-3">

                        @include('admin.partials.formdelete',[
                            'route'=> route('admin.projects.destroy', $project),
                            'message' =>  "Sei sicuro di voler eliminare   $project->title ?"
                            ])


                        <a href="{{route('admin.projects.index')}}" class="btn btn-success m-2">Torna ai projects</a>
                    </div>


            </div>
        </div>

    </div>
</section>
@endsection

@section('title')
    Project
@endsection
