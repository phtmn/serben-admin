@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Adicionar tipo das ocorrência
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Benefício</li>
        <li class="active">Tipo das ocorrências</li>
    </ol>
@stop

@section('content')
@if(session('msg'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Sucesso!</strong> {{ session('msg') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Atenção!</strong> {{ session('error') }}
    </div>
@endif

<div class="box box-primary">
    <div class="box-body">
        {{ Form::open(['route'=>['beneficio.tipo_ocorrencias.incluir', request()->route('id')]]) }}

        @include('admin.beneficios_sociais.tipo_ocorrencias.form')

        {!! Form::close() !!}
    </div>
</div>

<div class="box box-primary">
    <div class="box-header">
        <h3>Tipo das ocorrências adicionadas</h3>
    </div>
    <div class="box-body">

        <table class="table table-bordered table-hover" id="table">
            <thead>
            <tr>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tipo_ocorrencias_cadastradas as $tcc)
                <tr>
                    <td>{{$tcc->nome}}</td>
                </tr>
            @empty
                <p>Não existem dados</p>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    <script src="{{ asset('js/empresa_categoria_sindicato.js') }}"></script>
@stop