@extends('layout.menuadmin')
@section('content')
    <div class="col-11" style="margin: auto;">
        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Registro de Cursos</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-alumno"
                        data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Grado</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Nivel</th>
                    <th scope="col" style="width: 114px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cursos as $curso)
                    <tr>
                        <td>{{$curso->nombre}}</td>
                        <td>{{$curso->grado}}</td>
                        <td>
                            @if ($curso->estado == 0)
                                Abierto
                            @else
                                Cerrado
                            @endif
                        </td>
                        <td>{{$curso->cursoNivel->nombre}}</td>
                        <td style="text-align: right;width: 114px;">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$curso->id}}"
                               data-nombre="{{$curso->nombre}}"
                               data-grado="{{$curso->grado}}"
                               data-idnivel="{{$curso->cursoNivel->id}}"
                               data-nivel="{{$curso->cursoNivel->nombre}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminCursos/{{$curso->id}}/delete"
                               data-confirm="¿Estas seguro que quieres desactivar {{$curso->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="new-alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Curso</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminCursos/create')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">

                            <div class="row">
                                <div id="nombre" class="form-group col-md-12 pl-1">
                                    <label for="nombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="40"
                                           value="{{ old('nombre') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div id="grado" class="form-group col-md-6 pl-1">
                                    <label for="grado" class="control-label">Grado:</label>
                                    <input type="number" class="form-control" id="grado" name="grado"
                                           value="{{ old('grado') }}" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label for="nivel">Nivel:</label>
                                    <select class="form-control" id="nivel" name="nivel" value="{{ old('nivel') }}">
                                        @foreach ($niveles as $nivel)
                                            <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="edit-curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Curso</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminCursos/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="pkcurso" name="pkcurso"
                                   value="{{ old('pkcurso') }}">

                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editnombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="editnombre" name="editnombre"
                                           maxlength="40" value="{{ old('editnombre') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editgrado" class="control-label">Grado:</label>
                                    <input type="number" class="form-control" id="editgrado" name="editgrado"
                                           value="{{ old('editgrado') }}" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editnivel">Nivel:</label>
                                    <select class="form-control" id="editnivel" name="editnivel">
                                        <option value="{{Session::get('idnivel')}}">{{Session::get('nivel')}}</option>
                                        @foreach ($niveles as $nivel)
                                            @if($nivel->id != Session::get('idnivel'))
                                                <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <script>
            $(function () {
                $('#new-alumno').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-curso').modal('show');
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
            $("#editnivel").empty();
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");
            var grado = $(this).data("grado");
            var idnivel = $(this).data("idnivel");
            var nivel = $(this).data("nivel");

            $("#pkcurso").val(id);
            $("#editnombre").val(nombre);
            $("#editgrado").val(grado);
            $("#editnivel").val(nivel);
            $("#editnivel").append('<option value="' + idnivel + '">' + nivel + '</option>');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('nivel.fetch') }}",
                method: "POST",
                data: {query: idnivel, _token: _token},
                success: function (data) {
                    $("#editnivel").append(data);
                }
            });
            $("#edit-curso").modal('show');
        })
    </script>
@endsection
