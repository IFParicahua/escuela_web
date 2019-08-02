@extends('layout.app')
@section('content')
    <style>
    </style>
    <div class="menu">
        <ul>
            @foreach ($roles as $rol)
                <li><a href="rol/{{$rol->personaRol[0]->id}}"><img
                            src="{{ asset('iconos/icono'.$rol->personaRol[0]->id.'.svg') }}" style="width: 100px"
                            alt="">{{$rol->personaRol[0]->categoria_rol}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
