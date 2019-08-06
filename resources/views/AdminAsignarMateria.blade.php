@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Cursos</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-paralelo"
                        data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Turno</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Paralelo</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($materias as $materia)
                    <tr>
                        <td>{{$materia->paraleloTurno->nombre}}</td>
                        <td>{{$materia->paraleloCurso->nombre}} de {{$materia->paraleloCurso->cursoNivel->nombre}}</td>
                        <td>{{$materia->nombre}}</td>
                        <td>
                            <a class="btn btn-primary" data-toggle="tooltip" title="Eliminar"
                               href="AdminAsignarMaterias/{{encrypt($materia->id)}}"> Asignacion de Materias</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
