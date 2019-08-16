@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Registro de Tipo de Calificaciones</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal"
                        data-target="#new-TCalificacion" data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fin</th>
                    <th scope="col" style="text-align: center">Estado</th>
                    <th scope="col" style="width: 114px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($TCalificaciones as $TCalificacion)
                    <tr>
                        <td>{{$TCalificacion->nombre}}</td>
                        <td>{{date("d/m/Y",strtotime($TCalificacion->fecha_inicial))}}</td>
                        <td>{{date("d/m/Y",strtotime($TCalificacion->fecha_final))}}</td>
                        <td style="text-align: center">
                            @if ($TCalificacion->estado == 0)
                                Abierto
                            @else
                                Cerrado
                            @endif
                        </td>
                        <td style="text-align: right;width: 114px;">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$TCalificacion->id}}"
                               data-nombre="{{$TCalificacion->nombre}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminTipoCalificacion/{{$TCalificacion->id}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar a {{$TCalificacion->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="new-TCalificacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Tipo de Calificacion</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminTipoCalificacion/create')}}"
                          role="form" id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <div id="nombre" class="form-group col-md-12 pl-1">
                                    <label for="nombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="20"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div id="inicio" class="form-group col-md-6 pl-1">
                                    <label for="inicio" class="control-label">Fecha Inicio:</label>
                                    <input type="date" class="form-control" id="inicio" name="inicio"
                                           value="{{ old('inicio') }}" required>
                                </div>
                                <div id="fin" class="form-group col-md-6 pl-1">
                                    <label for="fin" class="control-label">Fecha Fin:</label>
                                    <input type="date" class="form-control" id="fin" name="fin" value="{{ old('fin') }}"
                                           required>
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
    <!-- Modal TCalificacion edit -->
    <div class="modal fade col-lg-12" id="edit-TCalificacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Tipo de Calificacion</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminTipoCalificacion/edit')}}"
                          role="form" id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="pkTCalificacion" name="pkTCalificacion"
                                   value="{{ old('pkTCalificacion') }}">
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editnombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="editnombre" name="editnombre"
                                           maxlength="20" value="{{ old('editnombre') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div id="edit_inicio" class="form-group col-md-6 pl-1">
                                    <label for="edit_inicio" class="control-label">Fecha edit_inicio:</label>
                                    <input type="date" class="form-control" id="edit_inicio" name="edit_inicio"
                                           value="{{ old('edit_inicio') }}" required>
                                </div>
                                <div id="edit_fin" class="form-group col-md-6 pl-1">
                                    <label for="edit_fin" class="control-label">Fecha edit_fin:</label>
                                    <input type="date" class="form-control" id="edit_fin" name="edit_fin"
                                           value="{{ old('edit_fin') }}"
                                           required>
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
                $('#new-TCalificacion').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-TCalificacion').modal('show');
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
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");

            $("#pkTCalificacion").val(id);
            $("#editnombre").val(nombre);

            $("#edit-TCalificacion").modal('show');

        })
    </script>
@endsection

