@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="button-right">
            <a href="{{ url('admin/recipes/create') }}" class="btn btn-primary" role="button">Añadir receta</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">                    
            <div class="panel panel-default">
                <div class="panel-heading">Recetas</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Duracción</th>
                                <th>Nivel</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recipes as $recipe)
                            <tr>
                                <th scope="row">{{ $loop->index }}</th>
                                <td>{{ $recipe->name }}</td>
                                <td>{{ $recipe->duration }}</td>
                                <td>{{ $recipe->level }}</td>
                                <td><a href="{{ url('admin/recipes/'.Hashids::encode($recipe->id).'/edit') }}">Editar</a> | <a href="{{ url('admin/recipes/destroy/'.Hashids::encode($recipe->id).'') }}">Borrar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
