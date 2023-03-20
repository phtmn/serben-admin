@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Sindicatos Cadastrados
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sindicatos</li>
    </ol>
@stop

@section('content')

@include('messages.msg')

<div class="box box-primary">
              <div class="box-header">
                  <a href="{{route('sindicatos.create')}}" class="btn bg-orange btn-flat">Novo Sindicato</a>
              </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                            <tr>
                                <th>Razao Social</th>
                                <th>CNPJ</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>
                                    <td><a href="{{ route('sindicatos.edit',$d->id ) }}">{{$d->razao_social}}</a></td>
                                    <td>{{ mask('##.###.###/####-##',$d->cnpj)}}</td>                               
                                    <td>{{$d->telefone_1}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>
                                        <a href="{{route('sindicato.categorias.listar', $d->id)}}" class="btn btn-xs bg-purple btn-flat">
                                            <i class="fa fa-list-ul" style="padding-right: 4px;"></i>Categorias</a>
                                        <a href="{{route('sindicato.participantes.listar', $d->id)}}" class="btn btn-xs bg-orange btn-flat">
                                            <i class="fa fa-list-ul" style="padding-right: 4px;"></i>Participantes</a>
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
        $(function () {
            $('#table').DataTable()
       })
    </script>

    @stop