@extends('site.painel.dashboard')

@section('painel')

    @if(session('msg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> {{ session('msg') }}
        </div>
    @endif
    <div class="box box-primary">
        <div class="box-body">

            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>Razao social</th>
                    <th>CNPJ</th>
                    <th>Serviço</th>
                    <th>Telefone</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$data->razao_social}}</td>
                    <td>{{ mask('##.###.###/####-##',$data->cnpj) }}</td>
                    <td>{{$data->servico}}</td>
                    <td>{{$data->telefone   }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop