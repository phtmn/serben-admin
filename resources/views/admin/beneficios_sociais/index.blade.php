@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
       Benefícios Cadastrados
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Benefícios</li>
    </ol>

@stop

@section('content')

@include('messages.msg')

<div class="box box-primary">
              <div class="box-header">
                  <a href="{{route('beneficios_sociais.create')}}" class="btn bg-orange btn-flat">Novo Benefício</a>
              </div>
                    <div class="box-body">

                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>                               
                                    <td><a href="{{ route('beneficios_sociais.edit',$d->id) }}">{{$d->item}}</a></td>
                                    <td>{{$d->nome}}</td>
                                    <td>
                                        <a href="{{route('beneficio.tipo_ocorrencias.listar', $d->id)}}" class="btn btn-xs btn-primary">
                                            <i class="fa fa-plus" style="padding-right: 4px;"></i>Tipo Ocorrência</a>
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