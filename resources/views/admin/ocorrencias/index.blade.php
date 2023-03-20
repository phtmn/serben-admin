@extends('admin.layouts.template.admin')

@section('content-header')
    <h1>
        Registro de Ocorrencias
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ocorrencias</li>
    </ol>

@stop

@section('content')

    @include('messages.msg')

    <div class="box box-primary">
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Responsável</th>
                    <th>Departamento</th>
                    <th>Tipo Ocorrencia</th>
                    <th>Beneficio Social</th>
                    <th>Trabalhador</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td><a href="{{ route('ocorrencias.edit',$d->id) }}">{{ $d->nome_responsavel }}</a></td>
                        <td>{{ $d->departamento }} </td>
                        <td>{{ $d->tipoOcorrencia()->nome }}</td>
                        <td>{{ $d->beneficioSocial()->nome }}</td>
                        <td>{{ $d->trabalhador()->nome }} </td>
                        <td>{{ $d->statusOcorrencia()->nome }}</td>
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