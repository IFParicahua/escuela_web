<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('style.css') }}"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('boostrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


    <title>dashboard</title>
</head>
<body>
<div class="sidebar">
    <div class="titulos">
        <span class="usuario">{{Session('session-user')}}</span>
        <span class="rol">{{Session('sesion-rol')}}</span>
    </div>
    <ul>
        <li><a href="/AdminArea">Area</a></li>
        <li><a href="/AdminMateria">Materias</a></li>
        <li><a href="/AdminMateriaCursos">Materia - Curso</a></li>
        <li><a href="/AdminAsignarMateria">Asignacion de Profesores</a></li>
        <li><a href="/AdminTipoCalificacion">Tipo de Calificaciones</a></li>
        <li><a href="/AdminTutor">Tutor</a></li>
        <li><a href="/AdminAlumno">Alumno</a></li>
        <li><a href="/AdminProfesor">Profesor</a></li>
        <li><a href="/AdminGestion">Gestion</a></li>
        <li><a href="/AdminNivel">Nivel</a></li>
        <li><a href="/AdminCurso">Curso</a></li>
        <li><a href="/AdminTurno">Turno</a></li>
        <li><a href="/AdminParalelo">Curso paralelo</a></li>
        <li><a href="/AdminInscripcion">Inscripcion</a></li>
        <li>
            <form action="{{url('logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="btn icon-enter"> Cerrar sesion</button>
            </form>
        </li>
    </ul>
</div>
<div class="contenido">
    <img src="{{ asset('menuicon.png') }}" style="width: 40px" class="menu-bar">
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script src="{{ asset('js/estilo.js') }}"></script>
</body>
<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
</html>
