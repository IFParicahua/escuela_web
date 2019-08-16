@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-11 bg-primary">
                @foreach( $cursos as $curso)
                    <h3 style="text-align: center;color:#ffffff">{{$curso->paraleloCurso->nombre.' '.$curso->nombre.' de '.$curso->paraleloCurso->cursoNivel->nombre}}</h3>
                @endforeach
            </div>
            <div class="col-md-1 bg-primary">
                <a href="/AdminAsignarMateria" class="btn btn-primary btn-fill"> Volver </a>
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
                        <td>@if($asignacion->id_profesores != null)
                                {{$asignacion->asignarProfesor->profesorPersona->nombre.' '.$asignacion->asignarProfesor->profesorPersona->apellidopat.' '.$asignacion->asignarProfesor->profesorPersona->apellidomat}}
                            @else
                                -
                            @endif</td>
                        <td style="text-align: center">
                            @if($asignacion->id_profesores != null)
                                <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                                   id="edit-item" title="Editar"
                                   data-id="{{$asignacion->id}}"
                                   data-idprofesor="{{$asignacion->asignarProfesor->id}}"
                                   data-profesor="{{$asignacion->asignarProfesor->profesorPersona->nombre.' '.$asignacion->asignarProfesor->profesorPersona->apellidopat.' '.$asignacion->asignarProfesor->profesorPersona->apellidomat}}"
                                ></a>
                            @else
                                <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                                   id="edit-item" title="Editar"
                                   data-id="{{$asignacion->id}}"
                                ></a>
                            @endif
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

            $("#pkasignacion").val(id);
            $("#editar_profesor_id").val(idProfesor);
            $("#editar_profesor_name").val(profesor);
            $("#editar-asignacion").modal('show');
        })
    </script>
@endsection
