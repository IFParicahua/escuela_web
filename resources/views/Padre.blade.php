@extends('layout.menuProfesor')
@section('content-menu')
    <ul>
        @foreach ($hijos as $hijo)
            <li class="submenu">
                <a>{{$hijo->alumnoPersona->nombre.' '.$hijo->alumnoPersona->apellidopat.' '.$hijo->alumnoPersona->apellidomat}}</a>
                <ul>
                    <li><a id="notas" data-id="{{$hijo->id}}"><span class="btn icon-minus"></span>Notas</a></li>
                    <li><a id="comportamiento" data-id="{{$hijo->id}}"><span class="btn icon-minus"></span>Comportamiento</a>
                    </li>
                </ul>
            </li>
        @endforeach
        <li>
            <form action="{{url('logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="btn"> Cerrar sesion <span class="btn icon-enter"></span></button>
            </form>
        </li>
    </ul>
@endsection
@section('content')
    <div id="Contenedor">
        <div class="row">
            <script>
                $(document).on('click', "#notas", function () {
                    var id = $(this).data("id");
                    if (id != '') {
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('Tutor.Alumno') }}",
                            method: "POST",
                            data: {id: id, _token: _token},
                            success: function (data) {
                                $('#Contenedor').fadeIn();
                                $('#Contenedor').html(data);
                            }
                        });
                    }
                });
                $(document).on('click', "#comportamiento", function () {
                    var id = $(this).data("id");
                    if (id != '') {
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('Alumno.Comportamiento') }}",
                            method: "POST",
                            data: {id: id, _token: _token},
                            success: function (data) {
                                $('#Contenedor').fadeIn();
                                $('#Contenedor').html(data);
                            }
                        });
                    }
                });

            </script>
@endsection
