@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Empresas parceiras Cadastradas
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Empresas parceiras</li>
    </ol>

@stop

@section('content')

@include('messages.msg')

<div class="box box-primary">
              <div class="box-header">
                  <a href="{{route('empresa_parceiras.create')}}" class="btn bg-orange btn-flat">Nova Empresa</a>
              </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                            <tr>
                                <th>Razao Social</th>
                                <th>Fantasia</th>
                                <th>CNPJ</th>
                                <th>Telefone</th>
                                <th>Serviço</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>                               
                                    <td><a href="{{ route('empresa_parceiras.edit',$d->id) }}">{{$d->razao_social}}</a></td>
                                    <td>{{$d->nome_fantasia}}</td>
                                    <td>{{mask('##.###.###/####-##',$d->cnpj)}}</td>
                                    <td>{{$d->telefone}}</td>
                                    <td>{{$d->servico}}</td>
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