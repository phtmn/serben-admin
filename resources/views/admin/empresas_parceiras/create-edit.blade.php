@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Cadastro de Empresa parceira
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
                    @if(isset($empresa_parceira))
                        {!! Form::model($empresa_parceira,['route'=>['empresa_parceiras.update',$empresa_parceira->id]]) !!}
                        @method('PUT')
                    @else
                        {{ Form::open(['route'=>['empresa_parceiras.store']]) }}
                    @endif
                    <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Dados Gerais</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Endereço</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Contatos</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Serviços</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1"> @include('admin.empresas_parceiras.tabs.dadosGerais')</div>
                        <div class="tab-pane" id="tab_2">@include('admin.empresas_parceiras.tabs.endereco')</div>
                        <div class="tab-pane" id="tab_3">@include('admin.empresas_parceiras.tabs.contatos')</div>
                        <div class="tab-pane" id="tab_4">@include('admin.empresas_parceiras.tabs.servicos')</div>
                    </div>
                </div>
                <!-- nav-tabs-custom -->
                </div>                   
                <div class="form-group col-md-12">
                    {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('empresa_parceiras.index')}}" class='btn btn-default'>Voltar</a>
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
          $("#cnpj").mask('00.000.000/0000-00');
          $("#numero").mask('00000');
          $("#telefone_1,#telefone_2,#telefone").mask('(00)00000-0000');
          $("#cep").mask('00000-000');
          $("#valor_vida,#valor_massa,#valor_evento").mask('000.00', {reverse: true});
        });
    </script>
@stop