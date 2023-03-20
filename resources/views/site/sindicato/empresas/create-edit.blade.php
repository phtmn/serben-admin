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
          <h3 class="box-title">Dados da Empresa</h3>
            <div class="box-header with-border">
                <p><strong>Os campos com (*) são obrigatórios</strong></p>
            </div>
        </div>


        <div class="box-body">
            @if(isset($empresa))
                {!! Form::model($empresa,['route'=>['sindicato-empresas.update',$empresa->id]]) !!}
                <input type="hidden" value="PUT" name="_method">
            @else
                {{ Form::open(['route'=>['sindicato-empresas.store']]) }}
            @endif

            @include('site.sindicato.empresas.form')

            {!! Form::close() !!}
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