@extends('site.painel.dashboard')

@section('painel')

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

    @include('messages.msg')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dados do Trabalhador</h3>
            <div class="box-header with-border">
                <p><strong>Os campos com (*) são obrigatórios</strong></p>
            </div>
        </div>


        <div class="box-body">
            @if(isset($trabalhador))
                {!! Form::model($trabalhador,['route'=>['empresa-trabalhadores.update',$trabalhador->id]]) !!}
                <input type="hidden" value="PUT" name="_method">
            @else
                {{ Form::open(['route'=>['empresa-trabalhadores.store']]) }}
            @endif

                @include('site.empresa.trabalhadores.form')

            {!! Form::close() !!}
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