@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Cadastro de dependentes
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
                    @if(isset($dependente))
                        {!! Form::model($dependente,['route'=>['dependentes.update',$dependente->id]]) !!}
                        @method('PUT')
                    @else
                        {{ Form::open(['route'=>['dependentes.store']]) }}
                        {{ Form::hidden('trabalhador', request()->route('id')) }}
                    @endif
                    
                    @include('admin.empresas.trabalhadores.dependentes.form')

                    <div class="form-group col-md-12">
                        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
                        <a href="{{route('trabalhador.dependentes.listar', (isset($dependente)) ? $dependente->trabalhador()->id : request()->route('id'))}}"
                           class='btn btn-default'>Voltar</a>
                    </div>
                    {!! Form::close() !!}
                </div>

                {!! Form::close() !!}
                </div>                
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>

    <script>
      $(document).ready(function(){
        $("#idade").mask('000');
        $("#cpf").mask('000.000.000-00');
      });
    </script>
@stop