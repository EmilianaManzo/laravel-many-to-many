@extends('layouts.admin')

@section('content')
<section class="h-100 w-100">
    <div class="container pt-4 w-100 ">
        <div class="row">
            <div class="col">
                <table class="table  w-100 ">
                    <thead>
                      <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Progetti</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type )
                        <tr>
                            <th scope="row">
                                {{$type->name}}
                            </th>

                            <td>
                                <ul class="list-group">
                                    @foreach ($type->projects as $project )

                                    <li class="list-group-item">
                                        <a class="text-uppercase " href="{{route('admin.projects.show', $project)}}">{{$project->id}} - {{$project->title}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginator">
                      {{$types->links()}}

                  </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('title')
    Type-Project
@endsection
