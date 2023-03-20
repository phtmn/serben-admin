@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Dependentes Cadastrados
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trabalhadores</li>
        <li class="active">Dependentes</li>
    </ol>

@stop

@section('content')

    @include('messages.msg')

    <div class="box box-primary">
        <div class="box-header">
            <a href="{{route('trabalhador.dependentes.incluir', request()->route('id'))}}" class="btn btn-primary">Novo Dependente</a>
        </div>
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Idade</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td><a href="{{ route('dependentes.edit',$d->id ) }}">{{$d->nome}}</a></td>
                        <td>{{mask("###.###.###-##", $d->cpf)}}</td>
                        <td>{{ $d->idade }}</td>
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