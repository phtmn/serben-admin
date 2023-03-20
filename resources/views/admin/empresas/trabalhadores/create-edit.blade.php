@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>Cadastro de Trabalhador</h1>
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
            @if(session('msg'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Sucesso!</strong> {{ session('msg') }}
            </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Sucesso!</strong> {{ session('error') }}
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p><strong>Os campos com (*) são obrigatórios</strong></p>
                </div>

                <div class="box-body">
                    @if(isset($trabalhador))
                        {!! Form::model($trabalhador,['route'=>['trabalhadores.update',$trabalhador->id]]) !!}
                        @method('PUT')
                    @else
                        {{ Form::open(['route'=>['trabalhadores.store']]) }}
                        {{ Form::hidden('empresa_id', request()->route('id')) }}
                    @endif
                    <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Dados Gerais</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Endereço</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1"> @include('admin.empresas.trabalhadores.tabs.dadosGerais')</div>
                        <div class="tab-pane" id="tab_2">@include('admin.empresas.trabalhadores.tabs.endereco')</div>
                    </div>
                    
                </div>                   
                    
                <div class="form-group col-md-12">
                    {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('empresa.trabalhadores.listar', (isset($trabalhador)) ? $empresa->id : request()->route('id'))}}"
                       class='btn btn-default'>Voltar</a>
                </div>
                    {!! Form::close() !!}                    
                </div>                
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/viaCep.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/empresa_trabalhador_categoria_sindicato.js') }}"></script>

    <script>
      $(document).ready(function(){
        $("#cpf,#dependente_cpf").mask('000.000.000-00');
        $("#rg").mask('0.000.000');
        $("#cep").mask('00000-000');
        $("#numero").mask('00000');
        $("#telefone_1,#telefone_2").mask('(00)00000-0000');
        $("#dependente_idade").mask('000');
      });
    </script>
@stop