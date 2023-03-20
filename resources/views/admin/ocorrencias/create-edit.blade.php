@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Edição de Ocorrências
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Editar</li>
    </ol>

@stop
@section('content')
    @if ($errors->any())
        <div class="row">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p><strong>Os campos com (*) são obrigatórios</strong></p>
                </div>

                <div class="box-body">
                    {!! Form::model($ocorrencia,['route'=>['ocorrencias.update',$ocorrencia->id]]) !!}
                    @method('PUT')

                    @include('admin.ocorrencias.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop