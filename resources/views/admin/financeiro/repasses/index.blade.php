@extends('admin.layouts.template.admin')
@section('content-header')
    <h1>
        Repasses

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cobranças</li>
    </ol>

@stop
@section('content')

    <div class="box">
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Cobrança</th>
                    <th>Dt Cobrança</th>
                    <th>Valor</th>
                    <th>Participante</th>
                    <th>Situacao</th>


                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{$d->cobranca->id}}</td>
                        <td>{{ date('d/m/Y', strtotime($d->cobranca->data_cobranca) )}}</td>
                        <td>{{$d->valor_repasse}}</td>
                        <td>{{$d->participante_id}}</td>
                        <td>{{$d->statusPagamento()->nome}}</td>
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
            $('#table').DataTable();
        })
    </script>

@stop