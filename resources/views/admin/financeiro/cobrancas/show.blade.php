@extends('admin.layouts.template.admin')
@section('content-header')
    <h1>
        Cobranças

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cobranças</li>
    </ol>

@stop
@section('content')
    @include('messages.msg')

<div class="box">
        <div class="box-body">

            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {{$empresa->razao_social}}
                    <small class="pull-right">{{$cobranca->created_at}}</small>
                </h2>
            </div>


                Dados do Pagador:
                <address>
                    <strong>{{$empresa->nome_fantasia}}</strong><br>
                    {{$empresa->cnpj}}<br>
                    {{$empresa->endereco()->rua}}<br>
                    {{$empresa->telefone_1}}<br>
                    {{$empresa->email_avisos_mensais}}
                </address>


            <h3>Sindicatos da Empresa</h3>
            <table class="table table-condensed">
                <thead>
                    <tr>
                    <th>Sindicato</th>
                    <th>CNPJ</th>
                    </tr>
                </thead>
                @foreach($sindicatos as $sd)
                    <tr>
                        <td>{{$sd->razao_social}}</td>
                        <td>{{$sd->cnpj}}</td>
                    </tr>
                @endforeach
            </table>


            <h3>Categorias da Empresa</h3>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Valor Acordado(RS)</th>
                    <th>Qtd Trabalhadores</th>
                    <th>Total por Categoria</th>
                </tr>
                </thead>
                @foreach($categorias as $cs)
                    <tr>
                        <td>{{ $cs->nome }}</td>
                        <td>{{ $cs->valor_beneficio }}</td>
                        <td>{{ $cs->trabalhadores()->where('empresa_id',$empresa->id)->count() }}</td>
                        <td>{{ $cs->trabalhadores()->where('empresa_id',$empresa->id)->count() * $cs->valor_beneficio }}</td>
                    </tr>
                @endforeach
            </table>

            <h3>Participantes Envolvidos</h3>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Cobrança</th>
                    <th>Participante</th>
                    <th>Status Pagamento</th>
                    <th>Valor do Repasse</th>
                </tr>
                </thead>
                @foreach($repasses as $rep)
                    <tr>
                        <td>{{ $rep->cobranca_id }}</td>
                        <td>{{ $rep->participante_id }}</td>
                        <td>{{ $rep->status_pagamento_id}}</td>
                        <td>{{ $rep->valor_repasse }}</td>
                    </tr>
                @endforeach
            </table>


        <h2 class="pull-right">Valor da Cobrança: R${{ number_format($valor_boleto,2,',','.')}}</h2>

    </div>


@stop