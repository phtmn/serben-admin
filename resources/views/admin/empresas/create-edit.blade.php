@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Cadastro de Empresa
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p><strong>Os campos com (*) são obrigatórios</strong></p>
                    <p><strong>Contabilidade é uma aba opcional!</strong></p>
                </div>

                <div class="box-body">
                    @if(isset($empresa))
                        {!! Form::model($empresa,['route'=>['empresas.update',$empresa->id]]) !!}
                        @method('PUT')
                    @else
                        {{ Form::open(['route'=>['empresas.store']]) }}                        
                    @endif
                    <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Dados Gerais</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Endereço</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Contatos</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Contabilidade</a></li>                                
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1"> @include('admin.empresas.tabs.dadosGerais')</div>
                        <div class="tab-pane" id="tab_2">@include('admin.empresas.tabs.endereco')</div>
                        <div class="tab-pane" id="tab_3">@include('admin.empresas.tabs.contatos')</div>
                        <div class="tab-pane" id="tab_4">@include('admin.empresas.tabs.contabilidade')</div>              
                    </div>
                    
                </div>
                <!-- nav-tabs-custom -->
                </div>                   
                <div class="form-group col-md-12">
                    {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('empresas.index')}}" class='btn btn-default'>Voltar</a>
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

    <script>
        $(document).ready(function(){
          $("#cnpj,#contabilidade_cnpj").mask('00.000.000/0000-00');
          $("#cnae").mask('0000000');
          $("#numero_funcionarios").mask('00000');
          $("#numero,#contabilidade_numero").mask('00000');
          $("#empresa_telefone_1,#empresa_telefone_2").mask('(00)00000-0000');
          $("#responsavel_cpf,#contador_cpf").mask('000.000.000-00');
          $("#cep,#contabilidade_cep").mask('00000-000');
          $("#responsavel_telefone_1,#responsavel_telefone_2").mask('(00)00000-0000');
          $("#contador_telefone_1,#contador_telefone_2").mask('(00)00000-0000');
        });
    </script>
@stop