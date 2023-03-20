@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Sindicato: {{$sindicato->razao_social}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categorias</li>
    </ol>

@stop

@section('content')

    @include('messages.msg')

    <div class="box box-primary">
        <div class="box-header">
            <a href="{{route('sindicato.categorias.incluir', request()->route('id'))}}" class="btn bg-orange btn-flat">Nova Categoria / CCT</a>
        </div>
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor acordado</th>
                    <th>CCT</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{$d->nome}}</td>
                        <td>R$ {{$d->valor_beneficio}}</td>
                        <td><a href="{{$d->cct}}" target="_blank">{{$d->cct}}</a></td>
                        <td>
                            <a href="{{route('categoria.beneficios.listar', $d->id)}}" class="btn btn-xs bg-purple btn-flat">Benefícios</a>
                        </td>
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