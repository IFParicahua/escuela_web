@extends('layout.app')
@section('content')
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="card card-block w-25 mx-auto">
                <form data-toggle="validator" role="form" method="post" action="{{url('login')}}" id="form-new">
                    {{ csrf_field() }}
                    <div class="titulo"><label>Bienvenido</label></div>
                    <div class="texto">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Usuario"
                                   autocomplete="off"
                                   value="{{old('username')}}">
                            {!! $errors->first('username', '<label style="margin-bottom: 0px;color:red">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña">
                            {!! $errors->first('password', '<label style="margin-bottom: 0px;color:red">:message</label>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
