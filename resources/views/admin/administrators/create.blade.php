@extends('adminlte::page')

@section('title', 'Los Coches')

@section('content_header')
    <h1>Crear Administrador</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.administrators.store', 'autocomplete' => 'off']) !!}

                @include('admin.partials.form')

                {!! Form::submit('Crear Administrador', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
