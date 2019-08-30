@extends('layout.menuadmin')
@section('content')

    <div class="col-11" style="margin: auto;">

        <div class="row">
            <div class="col-md-10 bg-primary">
                <h3 style="text-align: center;color:#ffffff">Materia asignadas a Cursos</h3>
            </div>
            <div class="col-md-2 bg-primary" style="text-align: right;">
                <button type="button" class="btn btn-primary icon-plus" data-toggle="modal"
                        data-target="#new-materia-curso"
                        data-toggle="tooltip" title="Agregar" id="nuevo">Registrar
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-scroll table-striped" style="background:#ffffff;">
                <thead class="bg-primary" style="color:#ffffff">
                <tr>
                    <th scope="col">Curso</th>
                    <th scope="col" style="text-align: center">Materia</th>
                    <th scope="col" style="text-align: center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($materias_cursos as $materias_curso)
                    <tr>
                        <td>{{$materias_curso->materiaCurso->nombre}}
                            de nivel {{$materias_curso->materiaCurso->cursoNivel->nombre}}</td>
                        <td style="text-align: center">{{$materias_curso->materiaMateria->nombre}}</td>
                        <td style="text-align: center">
                            <a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-pencil "
                               id="edit-item" title="Editar"
                               data-id="{{$materias_curso->id}}"
                               data-idcurso="{{$materias_curso->materiaCurso->id}}"
                               data-curso="{{$materias_curso->materiaCurso->nombre}} de nivel {{$materias_curso->materiaCurso->cursoNivel->nombre}}"
                               data-idmateria="{{$materias_curso->materiaMateria->id}}"
                               data-materia="{{$materias_curso->materiaMateria->nombre}}"
                            ></a>
                            <a class="btn btn-danger icon-bin" data-toggle="tooltip" title="Eliminar"
                               href="AdminMateriaCursos/{{$materias_curso->id}}/delete"
                               data-confirm="¿Estas seguro que quieres eliminar {{$materias_curso->materiaMateria->nombre}} del curso {{$materias_curso->materiaCurso->nombre}} de {{$materias_curso->materiaCurso->cursoNivel->nombre}}?"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade col-lg-12" id="new-materia-curso" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" style="padding-right: 500px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content card-body" style="width: 892px">
                <div>
                    <h5 class="modal-title">Registro de Materias en Cursos Paralelo</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminMateriaCursos/create')}}"
                          role="form" id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="curso_name" class="form-label">Curso:</label>
                                    <input type="text" name="curso_name" id="curso_name" class="form-control"
                                           autocomplete="off" value="{{ old('curso_name') }}" required>
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
                                                        url: "{{ route('AdminCurso.complte') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#cursoList').fadeIn();
                                                            $('#cursoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.curso', function () {
                                                $('#curso_name').val($(this).text());
                                                $('#curso_id').val($(this).attr("id"));
                                                $('#cursoList').fadeOut();
                                                var query = $(this).attr("id");
                                                var _token = $('input[name="_token"]').val();
                                                $.ajax({
                                                    url: "{{ route('AdminCursos.fetch') }}",
                                                    method: "POST",
                                                    data: {query: query, _token: _token},
                                                    success: function (data) {
                                                        $('#listaCursos').fadeIn();
                                                        $('#listaCursos').html(data);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="row" id="listaCursos">
                                <label style="color: red">*Debe seleccionar un curso para mostrar lista de
                                    materias</label>
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


    <div class="modal fade col-lg-12" id="edit-materia-curso" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" style="height: 50px;" role="document">
            <div class="modal-content card-body">
                <div>
                    <h5 class="modal-title">Editar Materias en Cursos Paralelo</h5>
                </div>
                <div class="modal-body">
                    <form data-toggle="validator" method="post" action="{{url('AdminMateriaCursos/edit')}}" role="form"
                          id="form-new">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <input type="hidden" name="pkcursomateria" id="pkcursomateria" class="form-control"
                                   autocomplete="off" value="{{ old('pkcursomateria') }}" required>

                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="edit_curso_name" class="form-label">Curso:</label>
                                    <input type="text" name="edit_curso_name" id="edit_curso_name" class="form-control"
                                           autocomplete="off" value="{{ old('edit_curso_name') }}" required>
                                    <input type="hidden" name="edit_curso_id" id="edit_curso_id" class="form-control"
                                           value="{{ old('edit_curso_id') }}"/>
                                    <div id="editcursoList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#edit_curso_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminCurso.complte') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#editcursoList').fadeIn();
                                                            $('#editcursoList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.curso', function () {
                                                $('#edit_curso_name').val($(this).text());
                                                $('#edit_curso_id').val($(this).attr("id"));
                                                $('#editcursoList').fadeOut();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 pl-1">
                                    <label for="edit_materia_name" class="form-label">Materia:</label>
                                    <input type="text" name="edit_materia_name" id="edit_materia_name"
                                           class="form-control"
                                           autocomplete="off" value="{{ old('edit_materia_name') }}" required>
                                    <input type="hidden" name="edit_materia_id" id="edit_materia_id"
                                           class="form-control"
                                           value="{{ old('edit_materia_id') }}"/>
                                    <div id="editmateriaList">
                                    </div>
                                    {{ csrf_field() }}
                                    <script>
                                        $(document).ready(function () {
                                            $('#edit_materia_name').keyup(function () {
                                                var query = $(this).val();
                                                if (query != '') {
                                                    var _token = $('input[name="_token"]').val();
                                                    $.ajax({
                                                        url: "{{ route('AdminMateria.fetch') }}",
                                                        method: "POST",
                                                        data: {query: query, _token: _token},
                                                        success: function (data) {
                                                            $('#editmateriaList').fadeIn();
                                                            $('#editmateriaList').html(data);
                                                        }
                                                    });
                                                }
                                            });
                                            $(document).on('click', '.materia', function () {
                                                $('#edit_materia_name').val($(this).text());
                                                $('#edit_materia_id').val($(this).attr("id"));
                                                $('#editmateriaList').fadeOut();
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <script>
            $(function () {
                $('#edit-materia-curso').modal('show');
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
            var idMateria = $(this).data("idmateria");
            var Materia = $(this).data("materia");
            var idCurso = $(this).data("idcurso");
            var Curso = $(this).data("curso");

            $("#pkcursomateria").val(id);
            $("#edit_materia_id").val(idMateria);
            $("#edit_materia_name").val(Materia);
            $("#edit_curso_id").val(idCurso);
            $("#edit_curso_name").val(Curso);

            $("#edit-materia-curso").modal('show');

        })
    </script>
@endsection
