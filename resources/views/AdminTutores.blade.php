@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">
        <div id="prueba">

        </div>
        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Registro de Tutores</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal" data-target="#new-Tutor"
                        data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">CI</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Sexo</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tutores as $tutor)
                    <tr>
                        <td>{{$tutor->tutorPersona->nombre}}</td>
                        <td>{{$tutor->tutorPersona->apellidopat}}</td>
                        <td>{{$tutor->tutorPersona->apellidomat}}</td>
                        <td>{{$tutor->tutorPersona->direccion}}</td>
                        <td>{{$tutor->tutorPersona->ci}}</td>
                        <td>{{$tutor->tutorPersona->telefono}}</td>
                        <td>{{$tutor->tutorPersona->sexo}}</td>
                        <td>
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$tutor->tutorPersona->id}}"
                               data-nombre="{{$tutor->tutorPersona->nombre}}"
                               data-paterno="{{$tutor->tutorPersona->apellidopat}}"
                               data-materno="{{$tutor->tutorPersona->apellidomat}}"
                               data-direccion="{{$tutor->tutorPersona->direccion}}"
                               data-ci="{{$tutor->tutorPersona->ci}}"
                               data-telefono="{{$tutor->tutorPersona->telefono}}"
                               data-sexo="{{$tutor->tutorPersona->sexo}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminTutor/{{$tutor->tutorPersona->idtutor}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar a {{$tutor->tutorPersona->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Gestion new -->
    <div class="modal fade col-lg-12" id="new-Tutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Guardar Tutor</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminTutor/create')}}" role="form"
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
                                <div id="apaterno" class="form-group col-md-6 pl-1">
                                    <label for="apaterno" class="control-label">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="apaterno" name="apaterno" maxlength="40"
                                           value="{{ old('apaterno') }}" required>
                                </div>
                                <div id="amaterno" class="form-group col-md-6 pl-1">
                                    <label for="amaterno" class="control-label">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="amaterno" name="amaterno" maxlength="40"
                                           value="{{ old('amaterno') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div id="direccion" class="form-group col-md-12 pl-1">
                                    <label for="direccion" class="control-label">Direccion:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                           maxlength="149" value="{{ old('direccion') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div id="ci" class="form-group col-md-6 pl-1">
                                    <label for="ci" class="control-label">CI:</label>
                                    <input type="text" class="form-control" id="ci" name="ci" maxlength="40"
                                           value="{{ old('ci') }}" required>
                                </div>
                                <div id="telefono" class="form-group col-md-6 pl-1">
                                    <label for="telefono" class="control-label">Telefono:</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10"
                                           value="{{ old('telefono') }}"
                                           onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                           required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label for="sexo">Sexo:</label>
                                    <select class="form-control" id="sexo" name="sexo" value="{{ old('sexo') }}">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
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
    <!-- Modal Gestion edit -->
    <div class="modal fade col-lg-12" id="edit-tutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Tutor</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminTutor/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="PKpersona" name="PKpersona"
                                   value="{{ old('PKpersona') }}">
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editnombre" class="control-label">Nombre:</label>
                                    <input type="text" class="form-control" id="editnombre" name="editnombre"
                                           maxlength="40" value="{{ old('editnombre') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editapaterno" class="control-label">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="editapaterno" name="editapaterno"
                                           maxlength="40" value="{{ old('editapaterno') }}" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editamaterno" class="control-label">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="editamaterno" name="editamaterno"
                                           maxlength="40" value="{{ old('editamaterno') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="editdireccion" class="control-label">Direccion:</label>
                                    <input type="text" class="form-control" id="editdireccion" name="editdireccion"
                                           maxlength="149" value="{{ old('editdireccion') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editci" class="control-label">CI:</label>
                                    <input type="text" class="form-control" id="editci" name="editci" maxlength="40"
                                           value="{{ old('editci') }}" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label for="edittelefono" class="control-label">Telefono:</label>
                                    <input type="text" class="form-control" id="edittelefono" name="edittelefono"
                                           maxlength="10" value="{{ old('edittelefono') }}"
                                           onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                           required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label for="editsexo">Sexo:</label>
                                    <select class="form-control" id="editsexo" name="editsexo">
                                        <option
                                            value="{{Session::get('dev_id_1')}}">{{Session::get('dev_name_1')}}</option>
                                        <option
                                            value="{{Session::get('dev_id_2')}}">{{Session::get('dev_name_2')}}</option>
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
                $('#new-Tutor').modal('show');
            });
        </script>
    @endif
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-tutor').modal('show');
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
            // toastr.error("Hola");
            $("#editsexo").empty();
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");
            var ap = $(this).data("paterno");
            var am = $(this).data("materno");
            var dir = $(this).data("direccion");
            var ci = $(this).data("ci");
            var telf = $(this).data("telefono");
            var sexo = $(this).data("sexo");
            var valor;
            var valor2;
            var valor3;
            if (sexo == 'M') {
                valor = "Masculino";
                valor2 = "Femenino";
                valor3 = "F";
            } else {
                valor = "Femenino";
                valor2 = "Masculino";
                valor3 = "M";
            }
            $("#PKpersona").val(id);
            $("#editnombre").val(nombre);
            $("#editapaterno").val(ap);
            $("#editamaterno").val(am);
            $("#editdireccion").val(dir);
            $("#editci").val(ci);
            $("#edittelefono").val(telf);
            $("#editsexo").append('<option value="' + sexo + '">' + valor + '</option><option value="' + valor3 + '">' + valor2 + '</option>');
            $("#edit-tutor").modal('show');

        })
    </script>
@endsection
