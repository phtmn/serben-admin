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
            <a href="{{route('categoria.beneficios.form', request()->route('id'))}}" class="btn bg-orange btn-flat">Novo benefício</a>
        </div>
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>p/ trabalhador</th>
                    <th>p/ cônjuge</th>
                    <th>p/ filhos menores</th>
                    <th>p/ empresa</th>
                    <th>p/ entidade</th>
                    <th>numero parcelas</th>
                    <th>qtd kit</th>
                    <th>valor</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{($d->pivot->ehTrabalhador) ? 'sim' : 'x'}}</td>
                        <td>{{($d->pivot->ehConjuge) ? 'sim' : 'x'}}</td>
                        <td>{{($d->pivot->ehFilhosMenores) ? 'sim' : 'x'}}</td>
                        <td>{{($d->pivot->ehEmpresa) ? 'sim' : 'x'}}</td>
                        <td>{{($d->pivot->ehSindicato) ? 'sim' : 'x'}}</td>
                        <td>{{$d->pivot->numero_parcelas}}</td>
                        <td>{{$d->pivot->quantidade_kit}}</td>
                        <td>R$ {{$d->pivot->valor}}</td>
                        <td><a href="{{ route('categoria.beneficios.form.autualizar',['id' => request()->route('id'), 'categoria_beneficio_id' => $d->pivot->id]) }}">editar</a></td>
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