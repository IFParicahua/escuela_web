@extends('layout.menuProfesor')
@section('content-menu')

    <ul>
        @foreach($niveles as $nivel)
            <li class="submenu">
                <a>{{$nivel->cursoNivel->nombre}}</a>
                <ul>
                    @foreach($cursos as $curso)
                        @if($curso->inscripcionParalelo->paraleloCurso->id_nivel == $nivel->id_nivel)
                            <li style="height: 30px;">
                                <a id="cuotas_alumnos" data-id="{{$curso->inscripcionParalelo->id}}"><span
                                        class="btn icon-diamonds"></span>{{$curso->inscripcionParalelo->paraleloCurso->nombre.' '.$curso->inscripcionParalelo->nombre}}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
        <li>
            <form action="{{url('logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="btn"> Cerrar sesion <span class="btn icon-exit"></span></button>
            </form>
        </li>
    </ul>
    <div class="modal fade col-lg-12" id="edit-cuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title" style="color: #1d2124">Cuotas</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminArea/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="text" class="form-control" id="pkcuota" name="pkcuota"
                                   value="{{ old('pkcuota') }}">
                            <input type="hidden" class="form-control" id="fila" name="fila"
                                   value="{{ old('fila') }}">
                            <div class="row">
                                <div class="form-group col-md-6 pl-1">
                                    <label style="color: #1d2124" for="fecha" class="control-label">Nombre:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha"
                                           value="{{ old('fecha') }}" required>
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label style="color: #1d2124" for="estado">Fecha:</label>
                                    <select class="form-control" id="estado" name="estado" value="{{ old('estado') }}">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="Guardar" class="btn btn-primary btn-fill">Guardar</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('content')
    <div id="Contenedor">
    </div>
    <script>
        $(document).on('click', "#edit-item", function () {
            $("#estado").empty();
            var id = $(this).data("id");
            var estado = $(this).data("estado");
            var fecha = $(this).data("fecha");
            if (estado == 'p') {
                $("#fecha").val(' ');
            } else {
                if (estado == 'v') {
                    $("#fecha").val(' ');
                } else {
                    var cadena = fecha.split("-");
                    var day = cadena[2].split(":");
                    var dia = day[0].split(" ");
                    $("#fecha").val(cadena[0] + '-' + cadena[1] + '-' + dia[0]);
                }
            }
            // if(estado == 'c'){

            // }
            var row = $(this).closest('tr').index() + 1;
            var col = $(this).closest('td').index() - 1;
            $("#fila").val(row + '-' + col);
            // $("#col").val(col - 1);
            $("#pkcuota").val(id);


            switch (estado) {
                case 'p':
                    $("#estado").append('<option value="p">Pendiente</option><option value="c">Cancelado</option><option value="v">Vencido</option>');
                    break;
                case 'c':
                    $("#estado").append('<option value="c">Cancelado</option><option value="p">Pendiente</option><option value="v">Vencido</option>');
                    break;
                case 'v':
                    $("#estado").append('<option value="v">Vencido</option><option value="p">Pendiente</option><option value="c">Cancelado</option>');
                    break;
            }
            $("#edit-cuota").modal('show');
        });
        $(document).on('click', "#cuotas_alumnos", function () {
            var id = $(this).data("id");
            if (id != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Contador.alumnos') }}",
                    method: "POST",
                    data: {id: id, _token: _token},
                    success: function (data) {
                        $('#Contenedor').fadeIn();
                        $('#Contenedor').html(data);
                    }
                });
            }
        });
        $('#estado').change(function () {
            var estado = $("#estado").val();
            switch (estado) {
                case 'p':
                    $("#fecha").prop('disabled', true);
                    break;
                case 'c':
                    $("#fecha").prop('disabled', false);
                    break;
                case 'v':
                    $("#fecha").prop('disabled', true);
                    break;
            }
        });

        $(document).on('click', "#Guardar", function () {
            var id = $("#pkcuota").val();
            var estado = $("#estado").val();
            var fecha = $("#fecha").val();

            var fila = $("#fila").val();
            var separador = "-";
            var cadena = fecha.split(separador);
            var f = fila.split(separador);
            var dat = cadena[2] + '/' + cadena[1] + '/' + cadena[0];
            if (id != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Contador.edit') }}",
                    method: "POST",
                    data: {id: id, estado: estado, fecha: fecha, _token: _token},
                    success: function (data) {
                        if (data == "fallo") {
                            toastr.error("Error. No se pudo guardar los cambios");
                        } else {
                            if (fecha == 0) {
                                document.getElementById('data_table').rows[f[0]].cells[f[1]].innerText = estado;
                            } else {
                                document.getElementById('data_table').rows[f[0]].cells[f[1]].innerText = estado + ' ' + dat;
                            }
                            $("#edit-cuota").modal('hide');
                        }
                    }
                });
            }
        });
    </script>
@endsection

