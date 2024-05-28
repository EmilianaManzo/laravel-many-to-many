@extends('layouts.admin')

@section('content')
    <section>
        <div class="container pt-4 w-100 ">
            <div class="row row-cols-2 ">
                <div class="col">
                        <h1>Progetti</h1>
                        <div class="card">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Link</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)

                                <tr>
                                  <th>{{$project->title}}</th>
                                  <td>{{$project->href}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                </div>

                <div class="col h-50">
                    <h1>Tecnologie</h1>
                        <div class="card ">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tecns as $tecn)

                                <tr>
                                  <th>{{$tecn->id}}</th>
                                  <td>{{$tecn->name}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <h1>Tipi</h1>
                        <div class="card ">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)

                                <tr>
                                  <th>{{$type->id}}</th>
                                  <td>{{$type->name}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </section>
@endsection
