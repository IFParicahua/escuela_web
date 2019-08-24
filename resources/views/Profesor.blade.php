@extends('layout.menuProfesor')
@section('content-menu')
    <ul>
        @foreach($cursos as $curso)
            <li>
                <a onclick="retornar({{$curso->asignarParalelo->id}})">{{$curso->asignarParalelo->paraleloCurso->nombre.' '.$curso->asignarParalelo->nombre}}</a>
            </li>
        @endforeach
        <li>
            <form action="{{url('logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="btn icon-enter"> Cerrar sesion</button>
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
                    <form data-toggle="validator" method="post" action="{{url('ProfesorNota/edit')}}"
                          role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <input type="hidden" name="pknota" id="pknota"
                                       value="{{ old('pknota') }}" required/>

                                <div class="form-group col-md-12 pl-1">
                                    <label for="editar_nota" class="form-label">Profesor:</label>
                                    <input type="text" name="editar_nota" id="editar_nota"
                                           class="form-control" autocomplete="off"
                                           value="{{ old('editar_nota') }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal"
                                    style="color: #1d2124">Cerrar
                            </button>
                            <button type="submit" class="btn btn-primary btn-fill">Guardar</button>
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
            $("#editar_materia_id").empty();
            var id = $(this).data("id");
            var nota = $(this).data("nota");

            $("#pknota").val(id);
            $("#editar_nota").val(nota);
            $("#editar-calificacion").modal('show');
        });

        function retornar(valor) {
            var query = valor;
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('Profesor.Curso') }}",
                    method: "POST",
                    data: {query: query, _token: _token},
                    success: function (data) {
                        $('#Contenedor').fadeIn();
                        $('#Contenedor').html(data);
                    }
                });
            }
        }
    </script>
@endsection
