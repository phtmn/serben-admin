@extends('admin.layouts.template.admin')

@section('content-header')
    <h4>
       Incluir Participante ao Sindicato: {{ $sindicato->razao_social }}
    </h4>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sindicatos</li>
        <li class="active">Participante Benefício</li>
    </ol>
@stop

@section('content')

@include('messages.msg')

<div class="box box-primary">
    <div class="box-body">
        {{ Form::open(['route'=>['sindicato.participantes.incluir', request()->route('id')]]) }}

        @include('admin.sindicatos.participantes_beneficio.form')

        {!! Form::close() !!}
    </div>
</div>

<div class="box box-primary">
    <div class="box-header">
        <h4>Participantes do Sindicato: {{$sindicato->razao_social}}</h4>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover" id="table">
            <thead>
            <tr>
                <th>Razão Social</th>
                <th>Valor do benefício social (R$)</th>
                <th>CNPJ</th>
                <th>Tipo Participante</th>
            </tr>
            </thead>
            <tbody>
            @forelse($participantes_cadastrados as $pc)
                <tr>
                    <td>{{$pc->razao_social}}</td>
                    <td><span class="label label-success">{{ $pc->pivot->valor_beneficio_social }}</span></td>
                    <td>{{mask('##.###.###/####-##',$pc->cnpj)}}</td>
                    <td><span class="label label-primary">{{isset($pc->servico) ? 'empresa parceira' : $pc->tipoParticipanteBeneficio()->nome}}</span></td>
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
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/sindicato_participante_beneficio.js') }}"></script>

    <script>
      $(document).ready(function(){
        $("#valor_beneficio_social").mask('#.##0,00', {reverse: true});
        $("#fundo_beneficio").mask('#.##0,00', {reverse: true});
        $("#beneficio_serben_social_familiar").mask('#.##0,00', {reverse: true});
      });
    </script>
@stop