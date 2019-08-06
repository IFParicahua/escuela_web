@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Registro de Inscripciones</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal"
                        data-target="#new-inscripcion" data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Inscripcion</th>
                    <th scope="col">Observacion</th>
                    <th scope="col" style="width: 114px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($inscripciones as $inscripcion)
                    <tr>
                        <td>
                            {{$inscripcion->inscripcionAlumno->alumnoPersona->nombre}} {{$inscripcion->inscripcionAlumno->alumnoPersona->apellidopat}} {{$inscripcion->inscripcionAlumno->alumnoPersona->apellidomat}}
                        </td>
                        <td>
                            {{$inscripcion->inscripcionParalelo->paraleloCurso->nombre}} {{$inscripcion->inscripcionParalelo->nombre}}
                            de {{$inscripcion->inscripcionParalelo->paraleloCurso->cursoNivel->nombre}}
                        </td>
                        <td>
                            {{$inscripcion->inscripcionParalelo->paraleloTurno->nombre}}
                        </td>
                        <td>{{date("d/m/Y",strtotime($inscripcion->fecha))}}</td>
                        <td>{{$inscripcion->observacion}}</td>
                        <td style="text-align: right;width: 114px;">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$inscripcion->id}}"
                               data-observacion="{{$inscripcion->observacion}}"
                               data-idcurso="{{$inscripcion->inscripcionParalelo->id}}"
                               data-curso="{{$inscripcion->inscripcionParalelo->paraleloCurso->nombre}} {{$inscripcion->inscripcionParalelo->nombre}} de {{$inscripcion->inscripcionParalelo->paraleloCurso->cursoNivel->nombre}}"
                               data-idalumno="{{$inscripcion->inscripcionAlumno->id}}"
                               data-alumno="{{$inscripcion->inscripcionAlumno->alumnoPersona->nombre}} {{$inscripcion->inscripcionAlumno->alumnoPersona->apellidopat}} {{$inscripcion->inscripcionAlumno->alumnoPersona->apellidomat}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminInscripcion/{{$inscripcion->id}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar la inscripcion de {{$inscripcion->inscripcionAlumno->alumnoPersona->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="new-inscripcion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Inscripcion</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminInscripcion/create')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="alumno_name" class="form-label">Alumno:</label>
                                    <input type="text" name="alumno_name" id="alumno_name" class="form-control"
                                           autocomplete="off" value="{{ old('alumno_name') }}" required/>
                                    <input type="hidden" name="alumno_id" id="alumno_id" class="form-control"
                                           value="{{ old('alumno_id') }}"/>
                                    <div id="alumnoList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#alumno_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminAlumno.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#alumnoList').fadeIn();
                                                            $('#alumnoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.alumno', function () {
                                                if ($('#curso_id').val() == 0) {
                                                    $("#btn-guardar").prop("disabled", true);
                                                } else {
                                                    $("#btn-guardar").prop("disabled", false);
                                                }
                                                $('#alumno_name').val($(this).text());
                                                $('#alumno_id').val($(this).attr("id"));
                                                $('#alumnoList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="curso_name" class="form-label">Curso:</label>
                                    <input type="text" name="curso_name" id="curso_name" class="form-control"
                                           autocomplete="off" value="{{ old('curso_name') }}" required/>
                                    <input type="hidden" name="curso_id" id="curso_id" class="form-control"
                                           value="{{ old('curso_id') }}"/>
                                    <div id="cursoList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#curso_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminParalelo.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#cursoList').fadeIn();
                                                            $('#cursoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.paralelo', function () {
                                                if ($('#alumno_id').val() == 0) {
                                                    $("#btn-guardar").prop("disabled", true);
                                                } else {
                                                    $("#btn-guardar").prop("disabled", false);
                                                }
                                                $('#curso_name').val($(this).text());
                                                $('#curso_id').val($(this).attr("id"));
                                                $('#cursoList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div id="observacion" class="form-group col-md-12 pl-1">
                                    <label for="observacion" class="control-label">Observacion:</label>
                                    <input type="text" class="form-control" id="observacion" name="observacion"
                                           maxlength="40" value="{{ old('observacion') }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar
                                </button>
                                <button type="submit" id="btn-guardar" class="btn btn-primary btn-fill">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- Modal Gestion edit -->
    <div class="modal fade col-lg-12" id="edit-inscripciones" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Inscripcion</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminInscripcion/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="pkinscripcion" name="pkinscripcion"
                                   maxlength="40" value="{{ old('pkinscripcion') }}" required>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="edit_alumno_name" class="form-label">Alumno:</label>
                                    <input type="text" name="edit_alumno_name" id="edit_alumno_name"
                                           class="form-control"
                                           autocomplete="off" value="{{ old('edit_alumno_name') }}" required/>
                                    <input type="hidden" name="edit_alumno_id" id="edit_alumno_id" class="form-control"
                                           value="{{ old('edit_alumno_id') }}"/>
                                    <div id="editAlumnoList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#edit_alumno_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminAlumno.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#editAlumnoList').fadeIn();
                                                            $('#editAlumnoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.alumno', function () {
                                                if ($('#edit_curso_id').val() == 0) {
                                                    $("#edit-btn-guardar").prop("disabled", true);
                                                } else {
                                                    $("#edit-btn-guardar").prop("disabled", false);
                                                }
                                                $('#edit_alumno_name').val($(this).text());
                                                $('#edit_alumno_id').val($(this).attr("id"));
                                                $('#editAlumnoList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="edit_curso_name" class="form-label">Curso:</label>
                                    <input type="text" name="edit_curso_name" id="edit_curso_name" class="form-control"
                                           autocomplete="off" value="{{ old('edit_curso_name') }}" required/>
                                    <input type="hidden" name="edit_curso_id" id="edit_curso_id" class="form-control"
                                           value="{{ old('edit_curso_id') }}"/>
                                    <div id="editCursoList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#edit_curso_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminParalelo.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#editCursoList').fadeIn();
                                                            $('#editCursoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.paralelo', function () {
                                                if ($('#edit_alumno_id').val() == 0) {
                                                    $("#edit-btn-guardar").prop("disabled", true);
                                                } else {
                                                    $("#edit-btn-guardar").prop("disabled", false);
                                                }
                                                $('#edit_curso_name').val($(this).text());
                                                $('#edit_curso_id').val($(this).attr("id"));
                                                $('#editCursoList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="edit_observacion" class="control-label">Observacion:</label>
                                    <input type="text" class="form-control" id="edit_observacion"
                                           name="edit_observacion" maxlength="40" value="{{ old('edit_observacion') }}"
                                           required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar
                                </button>
                                <button type="submit" id="edit-btn-guardar" class="btn btn-primary btn-fill">Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <script>
            $(function () {
                $('#new-inscripcion').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-inscripciones').modal('show');
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
        $("#nuevo").click(function () {
            $("#btn-guardar").prop("disabled", true);
        })
        $(document).on('click', "#edit-item", function () {
            $("#editparalelos_id").empty();
            var id = $(this).data("id");
            var observacion = $(this).data("observacion");
            var idcurso = $(this).data("idcurso");
            var curso = $(this).data("curso");
            var idalumno = $(this).data("idalumno");
            var alumno = $(this).data("alumno");

            $("#pkinscripcion").val(id);
            $("#edit_observacion").val(observacion);

            $("#edit_alumno_name").val(alumno);
            $("#edit_alumno_id").val(idalumno);

            $("#edit_curso_id").val(idcurso);
            $("#edit_curso_name").val(curso);
            $("#edit-inscripciones").modal('show');

        })
    </script>
@endsection




