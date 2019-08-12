@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                @foreach( $cursos as $curso)
                    <h3 style="text-align: center;color:#ffffff">{{$curso->paraleloCurso->nombre.' '.$curso->nombre.' de '.$curso->paraleloCurso->cursoNivel->nombre}}</h3>
                @endforeach
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal"
                        data-target="#new-asignacion"
                        data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Materia</th>
                    <th scope="col">Profesor</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($asignaciones as $asignacion)
                    <tr>
                        <td>{{$asignacion->asignarMateria->nombre}}</td>
                        <td>{{$asignacion->asignarProfesor->profesorPersona->nombre.' '.$asignacion->asignarProfesor->profesorPersona->apellidopat.' '.$asignacion->asignarProfesor->profesorPersona->apellidomat}}</td>
                        <td style="text-align: center">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$asignacion->id}}"
                               data-idprofesor="{{$asignacion->asignarProfesor->id}}"
                               data-profesor="{{$asignacion->asignarProfesor->profesorPersona->nombre}}"
                               data-idmateria="{{$asignacion->asignarMateria->id}}"
                               data-materia="{{$asignacion->asignarMateria->nombre}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="/AdminAsignarMaterias/{{$asignacion->id}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar {{$asignacion->asignarMateria->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade col-lg-12" id="new-asignacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Asignacion de Materia</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminAsignarMaterias/create')}}"
                          role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="profesor_name" class="form-label">Profesor:</label>
                                    <input type="text" name="profesor_name" id="profesor_name" class="form-control"
                                           autocomplete="off" value="{{ old('profesor_name') }}" required/>
                                    <input type="hidden" name="profesor_id" id="profesor_id"
                                           value="{{ old('profesor_id') }}" class="form-control"/>
                                    <div id="profesorList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#profesor_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminProfesor.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#profesorList').fadeIn();
                                                            $('#profesorList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.profesor', function () {
                                                $('#profesor_name').val($(this).text());
                                                $('#profesor_id').val($(this).attr("id"));
                                                $('#profesorList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="materia_id">Materia:</label>
                                    <select class="form-control" id="materia_id" name="materia_id">
                                        @foreach ($materias as $materia)
                                            <option
                                                value="{{$materia->materiaMateria->id}}">{{$materia->materiaMateria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    <div class="modal fade col-lg-12" id="editar-asignacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Asignacion de Materia</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminAsignarMaterias/edit')}}"
                          role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <input type="hidden" name="pkasignacion" id="pkasignacion"
                                       value="{{ old('pkasignacion') }}" required/>

                                <div class="form-group col-md-12 pl-1">
                                    <label for="editar_profesor_name" class="form-label">Profesor:</label>
                                    <input type="text" name="editar_profesor_name" id="editar_profesor_name"
                                           class="form-control" autocomplete="off"
                                           value="{{ old('editar_profesor_name') }}" required/>
                                    <input type="hidden" name="editar_profesor_id" id="editar_profesor_id"
                                           value="{{ old('editar_profesor_id') }}" class="form-control"/>
                                    <div id="editar_profesorList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#editar_profesor_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminProfesor.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#editar_profesorList').fadeIn();
                                                            $('#editar_profesorList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.profesor', function () {
                                                $('#editar_profesor_name').val($(this).text());
                                                $('#editar_profesor_id').val($(this).attr("id"));
                                                $('#editar_profesorList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editar_materia_id">Materia:</label>
                                    <select class="form-control" id="editar_materia_id" name="editar_materia_id">
                                        @foreach ($materias as $materia)
                                            @if($materia->id != Session::get('idmateria'))
                                                <option
                                                    value="{{$materia->materiaMateria->id}}">{{$materia->materiaMateria->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <script>
            $(function () {
                $('#new-asignacion').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#editar-asignacion').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $('a[data-confirm]').click(function (ev) {
                var href = $(this).attr('href');
                if (!$('#dataConfirmModal').length) {
                    $('body').append('<div class="modal fade in" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancelar</button><a style="color: #ffffff" class="btn btn-primary btn-fill" id="dataConfirmOK">Aceptar</a></div></div></div></div>');
                }
                $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                $('#dataConfirmOK').attr('href', href);
                $('#dataConfirmModal').modal({show: true});
                return false;
            });
        });
        $(document).on('click', "#edit-item", function () {
            $("#editar_materia_id").empty();
            var id = $(this).data("id");
            var idProfesor = $(this).data("idprofesor");
            var profesor = $(this).data("profesor");
            var idmateria = $(this).data("idmateria");
            var materia = $(this).data("materia");

            $("#pkasignacion").val(id);
            $("#editar_profesor_id").val(idProfesor);
            $("#editar_profesor_name").val(profesor);
            $("#editar_materia_id").append('<option value="' + idmateria + '">' + materia + '</option>');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('Materias.filter') }}",
                method: "POST",
                data: {query: idmateria, _token: _token},
                success: function (data) {
                    $("#editar_materia_id").append(data);
                }
            });
            $("#editar-asignacion").modal('show');
        })
    </script>
@endsection
