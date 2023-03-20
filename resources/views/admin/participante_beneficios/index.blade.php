@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Participantes Cadastrados
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Participantes Beneficio</li>
    </ol>

@stop

@section('content')

@include('messages.msg')

<div class="box box-primary">
              <div class="box-header">
                  <a href="{{route('participante_beneficios.create')}}" class="btn bg-orange btn-flat">Novo Participante</a>
              </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                            <tr>
                                <th>Razao Social</th>
                                <th>CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>                               
                                    <td><a href="{{ route('participante_beneficios.edit',$d->id ) }}">{{$d->razao_social}}</a></td>
                                    <td>{{mask('##.###.###/####-##', $d->cnpj)}}</td>
                                    <td>{{$d->telefone_1}}</td>
                                    <td>{{$d->email}}</td>
                                    <td><span class="label label-success">{{$d->tipoParticipanteBeneficio()->nome}}</span></td>
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
    <script>
        $(function(){
            $('#table').dataTable();
        })
    </script>

@stop