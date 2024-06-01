@extends('layouts.base')
@section('title', 'Lista de Propiedades')
@section('content')
@if (count($errors) > 0 )
<div class="error">
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@else

@if ($errors->any())
<div class="error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Address</th>
            <th>City</th>
            <th>Comunidad</th>
            <th>Codigo Postal</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Ir a Propiedad</th>
        </tr>
    @foreach ($properties as $property)
        <tr>
            <td>{{$property['id']}}</td>
            <td>{{$property['user_id']}}</td>
            <td>{{$property['title']}}</td>
            <td>{{$property['description']}}</td>
            <td>{{$property['address']}}</td>
            <td>{{$property['city']}}</td>
            <td>{{$property['comunidad']}}</td>
            <td>{{$property['codigo_postal']}}</td>
            <td>{{$property['created_at']}}</td>
            <td>{{$property['updated_at']}}</td>
            <td><a href="{{ route('properties.show', $property->id) }}">Propiedad</a></td>

        </tr>
    @endforeach
    </table>
@endif
