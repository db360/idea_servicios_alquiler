@extends('layouts.base')
@section('title', 'Crear una nueva propiedad')
@section('content')

<form action="{{route('create')}}" method="post">
    @csrf
    <label for="user_id">user_id</label>
    <input type="text" name="user_id" id="user_id">
    <label for="title">title</label>
    <input type="title" name="title" id="title">
    <label for="description">description</label>
    <input type="text" name="description" id="description">
    <label for="address">address</label>
    <input type="text" name="address" id="address">
    <label for="city">city</label>
    <input type="text" name="city" id="city">
    <label for="comunidad">comunidad</label>
    <input type="text" name="comunidad" id="comunidad">
    <label for="codigo_postal">codigo_postal</label>
    <input type="text" name="codigo_postal" id="codigo_postal">
    <input type="submit" value="Crear Propiedad">
</form>

@if ($errors->any())
<div class="error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif