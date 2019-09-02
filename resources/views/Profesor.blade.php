@extends('layout.menuProfesor')
@section('content-menu')
    <ul>
        @foreach($cursos as $curso)
            <li class="submenu">
                <a>{{$curso->asignarParalelo->paraleloCurso->nombre.' '.$curso->asignarParalelo->nombre.' de nivel '.$curso->asignarParalelo->paraleloCurso->cursoNivel->nombre}}</a>
                <ul>
                    @foreach($materias as $materia)
                        @if($materia->asignarParalelo->id == $curso->asignarParalelo->id)
                            <li>
                                <a id="notas-alumnos" data-id="{{$materia->id}}"
                                   data-materia="{{$materia->id_materia}}"><span
                                        class="btn icon-minus"></span>{{$materia->asignarMateria->nombre}}</a>
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
    <div class="modal fade col-lg-12" id="editar-calificacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title" style="color: #1d2124">Calificacion
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator"
                          role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="md-form input-group mb-3">
                                <input type="hidden" name="pknota" id="pknota"
                                       value="{{ old('pknota') }}" required/>
                                <input type="hidden" name="row" id="row"
                                       value="{{ old('row') }}" required/>

                                <input type="text" class="form-control" name="editar_nota" id="editar_nota"
                                       autocomplete="off"
                                       value="{{ old('editar_nota') }}"
                                       onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                       required/>
                                <div class="input-group-prepend">
                                    <button class="btn btn-md btn-primary m-0 px-3" type="button" id="Guardar">Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    <div class="modal fade col-lg-12" id="add-comportamiento" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title" style="color: #1d2124">Comportamiento
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" class="form-control" id="pkins-comp" name="pkins-comp"
                                   value="{{ old('pkins-comp') }}">
                            <input type="hidden" class="form-control" id="pk-materia" name="pk-materia"
                                   value="{{ old('pk-materia') }}">
                            <div class="row">
                                <label for="comment" style="color: #1d2124" id="text-comp"></label>
                                <textarea class="form-control" rows="5" id="comportamiento" maxlength="230"></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1" style="text-align: right">
                                    <button id="AddComp" type="button" class="btn btn-primary btn-fill">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@endsection
@section('content')
    <div id="Contenedor">
    </div>
    <script>
        $(document).on('click', "#notas-alumnos", function () {
            var id = $(this).data("id");
            var materia = $(this).data("materia");
            if (id != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Profesor.Curso') }}",
                    method: "POST",
                    data: {id: id, materia: materia, _token: _token},
                    success: function (data) {
                        $('#Contenedor').fadeIn();
                        $('#Contenedor').html(data);
                    }
                });
            }
        });

        $(document).on('click', "#edit-item", function () {
            var id = $(this).data("id");
            var nota = $(this).data("nota");
            var row = $(this).closest('tr').index();
            $("#pknota").val(id);
            $("#editar_nota").val(nota);
            $("#row").val(row + 1);
            $("#editar-calificacion").modal('show');
        });
        $(document).on('click', "#mensaje-item", function () {
            var id = $(this).data("idins");
            var materia = $(this).data("idmateria");
            var alumno = $(this).data("alumno");
            $("#pkins-comp").val(id);
            $("#pk-materia").val(materia);
            $("#text-comp").empty();
            $("#text-comp").append(alumno);
            $("#add-comportamiento").modal('show');
        });


        $(document).on('click', "#Guardar", function () {
            var id = $("#pknota").val();
            var nota = $("#editar_nota").val();
            var row = $("#row").val();
            if (nota > "34" || nota < "101") {
                if (id != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('ProfesorNota.edit') }}",
                        method: "POST",
                        data: {id: id, nota: nota, _token: _token},
                        success: function (data) {
                            if (data == "fallo") {
                                toastr.error("Error. No se pudo guardar los cambios");
                            } else {
                                document.getElementById('data_table').rows[row].cells[1].innerText = nota;
                                $("#editar-calificacion").modal('hide');
                            }
                        }
                    });
                }
            } else {
                toastr.error("La nota debe ser entre 35 y 100 puntos");
            }
        });
        $(document).on('click', "#AddComp", function () {
            var id = $("#pkins-comp").val();
            var materia = $("#pk-materia").val();
            var comp = $("#comportamiento").val();
            if (id != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Comportamiento.edit') }}",
                    method: "POST",
                    data: {id: id, comp: comp, materia: materia, _token: _token},
                    success: function (data) {
                        if (data == "fallo") {
                            toastr.error("Error. No se pudo guardar los cambios.");
                        } else {
                            toastr.success("Se guardo correctamente.");
                            $("#add-comportamiento").modal('hide');
                        }
                    }
                });
            }
        });
    </script>
@endsection
