@php
    use App\Functions\Helper as Help;
@endphp

@extends('layouts.admin')

@section('content')
<section class="h-100 flex-grow-1 sec-index ">
    <div class="container pt-4 w-100 ">

        <div class="mb-2">
            <a href="{{route('admin.projects.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
        </div>


        @if (isset($_GET['toSearch']))
        <div class="mt-2">
            <h1>Progetti trovati per {{$_GET['toSearch']}} : {{$count_search}} </h1>
        </div>
        @endif

        @if ($errors->any())
           <div class="alert alert-danger " role="alert">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
           </div>

       @endif

        @if(session('success'))
        <div class="alert alert-success" role="alert">
        {{ session('success')}}
        </div>
        @endif

        @if(session('update'))
        <div class="alert alert-success" role="alert">
        {{ session('update')}}
        </div>
        @endif


        @if(session('deleted'))
        <div class="alert alert-success" role="alert">
        {{ session('deleted')}}
        </div>
        @endif

      <table class="table  w-100 @if ($count_search == 0)
          d-none @endif">
        <thead>
          <tr>

            <th scope="col"><a href="{{route('admin.orderby', ['direction'=> $direction , 'column'=> 'id'])}}">ID</a></th>
            <th scope="col"> <a href="{{route('admin.orderby', ['direction'=> $direction , 'column'=> 'title'])}}">Title</a></th>
            <th scope="col">Link</th>
            <th scope="col">Tipo</th>
            <th scope="col">Tecnologie</th>
            <th scope="col">Descrizione</th>
            <th scope="col"><a href="{{route('admin.orderby', ['direction'=> $direction , 'column'=> 'updated_at'])}}">Ultima modifica</a></th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>

        <tbody>

            @forelse($projects as $project )
                <tr>
                    <th scope="row">
                        {{$project->id}}
                    </th>
                    <td>
                       {{$project->title}}
                    </td>

                    <td>
                        {{$project->href}}
                    </td>

                    <td>
                        {{$project->type->name}}
                    </td>

                    <td>
                        @forelse ($project->tecnologies as $tecnology )
                        <a href="{{route('admin.tecnology-projects', $tecnology)}}" class="badge rounded-pill text-bg-info text-decoration-none">{{$tecnology->name}}</a>
                        @empty
                            - no tag -
                        @endforelse
                    </td>

                    <td>
                        {{$project->description}}
                    </td>

                    <td>
                        {{Help::dateFormat($project->updated_at)}}
                    </td>

                    <td>
                        <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning my-2"><i
                            class="fa-solid fa-pencil"></i></a>

                            <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary "><i
                            class="fa-solid fa-eye"></i></a>

                            @include('admin.partials.formdelete',[
                                    'route'=> route('admin.projects.destroy', $project),
                                    'message' => "Sei sicuro di voler eliminare   $project->title ?"
                            ])
                            {{-- normalmente il valore della chiave lo vuole con apici singoli , con backtik e i punti per concatenare non funziona, vuole le doppie virgolette e nessuna parentesi --}}
                    </td>

            </tr>
                @empty
                <h3>Non c'è niente Amio!</h3>
            @endforelse
        </tbody>
    </table>
    <div class="paginator">
          {{$projects->links()}}

      </div>
</div>
</section>
@endsection


@section('title')
    Project
@endsection
