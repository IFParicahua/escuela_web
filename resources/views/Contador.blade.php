@extends('layout.app')
@section('content')
    <div class="row h-100">
        <div class="col-sm-12 my-auto">
            <div class="card card-block w-25 mx-auto">
                <form class="text-center border border-light p-5" data-toggle="validator" method="post"
                      action="{{url('Contador/monto')}}" role="form">
                    {!! csrf_field() !!}
                    <input type="text" id="monto" name="monto" class="form-control mb-4" placeholder="Monto a cobrar">
                    <button class="btn btn-info " type="submit">Siguiente<span style="color: #ffffff"
                                                                               class="btn icon-point-right"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
