@extends('layouts.base')
@section('title', 'Editar propiedad con ID X')
@section('content')

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

<form action="{{route('properties.update', $property->id)}}" method="POST">
    @csrf
    @method('PUT')
    <h2>{{$property->id}}</h2>
    <h2>{{$property->user_id}}</h2>
    <input type="hidden" name="id" id="id" value="{{$property->id}}">
    <label for="id">Nombre</label>
    <input type="text" name="title" id="title" value="{{$property->title}}">
    <label for="id">description</label>
    <input type="text" name="description" id="description" value="{{$property->description}}">
    <label for="id">address</label>
    <input type="text" name="address" id="address" value="{{$property->address}}">
    <label for="id">city</label>
    <input type="text" name="city" id="city" value="{{$property->city}}">
    <label for="id">comunidad</label>
    <input type="text" name="comunidad" id="comunidad" value="{{$property->comunidad}}">
    <label for="id">codigo_postal</label>
    <input type="text" name="codigo_postal" id="codigo_postal" value="{{$property->codigo_postal}}">
    <button type="submit">Editar propiedad</button>
</form>
<a href="{{ route('properties')}}">Volver a Propiedades</a>
