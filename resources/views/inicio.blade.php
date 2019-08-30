@extends('layout.app')
@section('content')
    <div class="menu">
        <ul>
            @foreach ($roles as $rol)
                <li><a href="rol/{{$rol->rolRoles->id}}"><img
                            src="{{ asset('iconos/icono'.$rol->rolRoles->id.'.svg') }}" style="width: 100px"
                            alt="">{{$rol->rolRoles->categoria_rol}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
