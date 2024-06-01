@extends('layouts.base')
@section('title', 'Propiedad con ID X')
@section('content')

@if(session('success'))
    <div class="uccess">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

<h2>{{$property['id']}}</h2>
<h2>{{$property['user_id']}}</h2>
<h2>{{$property['title']}}</h2>
<h2>{{$property['description']}}</h2>
<h2>{{$property['address']}}</h2>
<h2>{{$property['city']}}</h2>
<h2>{{$property['comunidad']}}</h2>
<h2>{{$property['codigo_postal']}}</h2>

<form action="{{ route('properties.destroy', $property->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar propiedad</button>
</form>


<form action="{{ route('properties.edit', $property->id) }}" method="GET">
    @csrf
    <button type="submit" class="btn btn-danger">Editar propiedad</button>
</form>
<a href="{{ route('properties')}}">Volver a Propiedades</a>
