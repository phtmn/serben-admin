@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>Cadastro de Sindicato</h1>
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
                    <div class="row">
                        @if(isset($sindicato))
                            {!! Form::model($sindicato,['route'=>['sindicatos.update',$sindicato->id]]) !!}
                            @method('PUT')
                        @else
                            {{ Form::open(['route'=>['sindicatos.store']]) }}
                        @endif
                        <div class="col-md-12">

                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Dados Gerais</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Endereço</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Contatos</a></li>
                                    @empty($sindicato)
                                        <li><a href="#tab_4" data-toggle="tab">Acesso ao Sistema</a></li>
                                    @endempty
                                </ul>
                                <div class="tab-content">
                                <div class="tab-pane active" id="tab_1"> @include('admin.sindicatos.tabs.dadosGerais')</div>
                                <div class="tab-pane" id="tab_2">@include('admin.sindicatos.tabs.endereco')</div>
                                <div class="tab-pane" id="tab_3">@include('admin.sindicatos.tabs.contatos')</div>
                                    @empty($sindicato)
                                        <div class="tab-pane" id="tab_4">@include('admin.sindicatos.tabs.acesso')</div>
                                    @endempty
                                </div>

                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
                        <div class="form-group col-md-12">
                            {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                            <a href="{{route('sindicatos.index')}}" class='btn btn-default'>Cancelar</a>
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
        $("#telefone_1,#telefone_2").mask('(00)00000-0000');
        $("#presidente_telefone_1,#presidente_telefone_2").mask('(00)00000-0000');
        $("#responsavel_juridico_telefone_1,#responsavel_juridico_telefone_2").mask('(00)00000-0000');
        $("#responsavel_acesso_telefone_1,#responsavel_acesso_telefone_2").mask('(00)00000-0000');
        $("#cnpj").mask('00.000.000/0000-00');
        $("#numero_trabalhadores").mask('00000');
        $("#numero").mask('00000');
        $("#cep").mask('00000-000');
      });
    </script>
@stop