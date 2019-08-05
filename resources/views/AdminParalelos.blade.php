@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Registro de Paralelos</h3>
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
                    <th scope="col">Gestion</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Paralelo</th>
                    <th scope="col">Cupo</th>
                    <th scope="col" style="width: 114px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($paralelos as $paralelo)
                    <tr>
                        <td>{{$paralelo->paraleloGestion->nombre}}</td>
                        <td>{{$paralelo->paraleloTurno->nombre}}</td>
                        <td>{{$paralelo->paraleloCurso->nombre}}
                            de {{$paralelo->paraleloCurso->cursoNivel->nombre}}</td>
                        <td>{{$paralelo->nombre}}</td>
                        <td>{{$paralelo->cupo_maximo}}</td>
                        <td style="text-align: right;width: 114px;">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$paralelo->id}}"
                               data-nombre="{{$paralelo->nombre}}"
                               data-cupo="{{$paralelo->cupo_maximo}}"
                               data-idturno="{{$paralelo->paraleloTurno->id}}"
                               data-idcurso="{{$paralelo->paraleloCurso->id}}"
                               data-idgestion="{{$paralelo->paraleloGestion->id}}"
                               data-turno="{{$paralelo->paraleloTurno->nombre}}"
                               data-curso="{{$paralelo->paraleloCurso->nombre}} de {{$paralelo->paraleloCurso->cursoNivel->nombre}}"
                               data-gestion="{{$paralelo->paraleloGestion->nombre}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminParalelos/{{$paralelo->id}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar a {{$paralelo->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="new-paralelo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Curso Paralelo</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminParalelos/create')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">

                            <div class="row">
                                <div class="form-group col-md-8 pl-1">
                                    <label for="gestion_id">Gestion:</label>
                                    <select class="form-control" id="gestion_id" name="gestion_id">
                                        @foreach ($gestiones as $gestion)
                                            <option value="{{$gestion->id}}">{{$gestion->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 pl-1">
                                    <label for="turno_id">Turnos:</label>
                                    <select class="form-control" id="turno_id" name="turno_id">
                                        @foreach ($turnos as $turno)
                                            <option value="{{$turno->id}}">{{$turno->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="curso_id">Curso:</label>
                                    <select class="form-control" id="curso_id" name="curso_id">
                                        @foreach ($cursos as $curso)
                                            <option value="{{$curso->id}}">{{$curso->nombre}}
                                                de {{$curso->cursoNivel->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div id="nombre" class="form-group col-md-8 pl-1">
                                    <label for="nombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40"
                                           value="{{ old('nombre') }}" required>
                                </div>
                                <div id="cupo" class="form-group col-md-4 pl-1">
                                    <label for="cupo" class="control-label">Cupo:</label>
                                    <input type="text" class="form-control" id="cupo" name="cupo"
                                           value="{{ old('cupo') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="edit-paralelo" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Curso Paralelo</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminParalelos/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="pkparalelo" name="pkparalelo"
                                   value="{{ old('pkparalelo') }}">
                            <div class="row">
                                <div class="form-group col-md-8 pl-1">
                                    <label for="editgestion_id">Gestion:</label>
                                    <select class="form-control" id="editgestion_id" name="editgestion_id">
                                        <option
                                            value="{{Session::get('idgestion')}}">{{Session::get('gestion')}}</option>
                                        @foreach ($gestiones as $gestion)
                                            @if($gestion->id != Session::get('idgestion'))
                                                <option value="{{$gestion->id}}">{{$gestion->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 pl-1">
                                    <label for="editurno_id">Turnos:</label>
                                    <select class="form-control" id="editurno_id" name="editurno_id">
                                        <option value="{{Session::get('idturno')}}">{{Session::get('turno')}}</option>
                                        @foreach ($turnos as $turno)
                                            @if($turno->id != Session::get('idturno'))
                                                <option value="{{$turno->id}}">{{$turno->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editcurso_id">Curso:</label>
                                    <select class="form-control" id="editcurso_id" name="editcurso_id">
                                        <option value="{{Session::get('idcurso')}}">{{Session::get('curso')}}</option>
                                        @foreach ($cursos as $curso)
                                            @if($curso->id != Session::get('idcurso'))
                                                <option value="{{$curso->id}}">{{$curso->nombre}}
                                                    de {{$curso->cursoNivel->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8 pl-1">
                                    <label for="editnombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="editnombre" name="editnombre"
                                           maxlength="40" value="{{ old('editnombre') }}" required>
                                </div>
                                <div class="form-group col-md-4 pl-1">
                                    <label for="editcupo" class="control-label">Cupo:</label>
                                    <input type="number" class="form-control" id="editcupo" name="editcupo"
                                           value="{{ old('editcupo') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
                        </div>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <script>
            $(function () {
                $('#new-paralelo').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-paralelo').modal('show');
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
            $("#editurno_id").empty();
            $("#editcurso_id").empty();
            $("#editgestion_id").empty();
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");
            var cupo = $(this).data("cupo");
            var idturno = $(this).data("idturno");
            var idcurso = $(this).data("idcurso");
            var idgestion = $(this).data("idgestion");
            var turno = $(this).data("turno");
            var curso = $(this).data("curso");
            var gestion = $(this).data("gestion");

            $("#pkparalelo").val(id);
            $("#editnombre").val(nombre);
            $("#editcupo").val(cupo);
            $("#editurno_id").append('<option value="' + idturno + '">' + turno + '</option>');
            $("#editcurso_id").append('<option value="' + idcurso + '">' + curso + '</option>');
            $("#editgestion_id").append('<option value="' + idgestion + '">' + gestion + '</option>');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('turno.fetch') }}",
                method: "POST",
                data: {query: idturno, _token: _token},
                success: function (data) {
                    $("#editurno_id").append(data);
                }
            });
            $.ajax({
                url: "{{ route('curso.fetch') }}",
                method: "POST",
                data: {query: idcurso, _token: _token},
                success: function (data) {
                    $("#editcurso_id").append(data);
                }
            });
            $.ajax({
                url: "{{ route('gestion.fetch') }}",
                method: "POST",
                data: {query: idgestion, _token: _token},
                success: function (data) {
                    $("#editgestion_id").append(data);
                }
            });

            $("#edit-paralelo").modal('show');

        })
    </script>
@endsection


