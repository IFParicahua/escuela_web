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
                                   data-materia="{{$materia->id_materia}}">{{$materia->asignarMateria->nombre}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
        <li>
            <form action="{{url('logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="btn"> Cerrar sesion <span class="btn icon-enter"></span></button>
            </form>
        </li>
    </ul>
    <div class="modal fade col-lg-12" id="editar-calificacion" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title" style="color: #1d2124">Calificacion</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator"
                          role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <input type="hidden" name="pknota" id="pknota"
                                       value="{{ old('pknota') }}" required/>
                                <input type="hidden" name="row" id="row"
                                       value="{{ old('row') }}" required/>

                                <div class="form-group col-md-12 pl-1">
                                    <label for="editar_nota" class="form-label">Profesor:</label>
                                    <input type="text" name="editar_nota" id="editar_nota"
                                           class="form-control" autocomplete="off"
                                           value="{{ old('editar_nota') }}"
                                           onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"
                                    style="color: #1d2124">Cerrar
                            </button>
                            <button type="button" id="Guardar" class="btn btn-primary btn-fill">Guardar</button>
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
        $(document).on('click', "#edit-item", function () {
            var id = $(this).data("id");
            var nota = $(this).data("nota");
            var row = $(this).closest('tr').index();
            // var data = document.getElementById("data_table").rows[row + 1].cells[1].innerHTML;
            $("#pknota").val(id);
            $("#editar_nota").val(nota);
            $("#row").val(row + 1);
            $("#editar-calificacion").modal('show');
        });

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
        $(document).on('click', "#Guardar", function () {
            var id = $("#pknota").val();
            var nota = $("#editar_nota").val();
            var row = $("#row").val();
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
        });
    </script>
@endsection

