@extends('layouts.admin')

@section('content')
<section class="h-100 w-100">
    <div class="container pt-4 w-100 ">
        <div class="row">
            <div class="col col-12 ">
                @if ($errors->any())
                <div class="alert alert-danger " role="alert">
                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- questo errore è per la tecnologia già esistente --}}
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                {{ session('error')}}
                </div>
            @endif

            {{-- questo errore è per la creazione fatta con successo --}}
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                {{ session('success')}}
                </div>
            @endif

            {{-- questo errore è per la modifica fatta con successo --}}
            @if(session('update'))
                <div class="alert alert-success" role="alert">
                {{ session('update')}}
                </div>
            @endif

            {{-- questo errore è per la l'eliminazione fatta con successo --}}
            @if(session('deleted'))
                <div class="alert alert-success" role="alert">
                {{ session('deleted')}}
                </div>
            @endif
            </div>
            <div class="col">
                <h1>Tipi</h1>


                <table class="table  w-100 ">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>

                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type )
                        <tr>
                            <th scope="row">
                                {{$type->id}}
                            </th>

                            <td>

                                <form action="{{route('admin.types.update', $type)}}" method="post"
                                id="form-edit-{{$type->id}}">
                                @csrf
                                @method('PUT')
                                        <input
                                            type="text"
                                            class="form-control  brd-no"

                                            name="name"
                                            value="{{$type->name}}">
                                </form>
                            </td>
                            <td class="d-flex">
                                    <button
                                    type="submit"
                                    onclick="submitForm({{$type->id}})"
                                    class="btn btn-warning m-2"
                                    ><i
                                    class="fa-solid fa-pencil"></i></button>

                                    @include('admin.partials.formdelete',[
                                        'route'=> route('admin.types.destroy', $type),
                                        'message' => "Sei sicuro di voler eliminare $type->name ?"
                                    ])


                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="paginator">
                    {{$types->links()}}
                </div>

            </div>

            <div class="col">
                <h1>Nuovo Tipo</h1>



                <form
                  action="{{route('admin.types.store')}}"
                  method="post" >
                  @csrf
                  <div class="mb-3">
                        <label for="name" class="form-label">Tipo</label>
                        <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{old('name')}}">

                    </div>
                    <button type="submit" class="btn btn-primary">Crea</button>

                </form>
            </div>
        </div>
    </div>


</section>
<script>
    function submitForm(id){
        const form = document.getElementById(`form-edit-${id}`);
        console.log(form);
        form.submit()
    }
</script>
@endsection

@section('title')
    Type
@endsection

