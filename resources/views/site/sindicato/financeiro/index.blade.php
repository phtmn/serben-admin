@extends('site.painel.dashboard')

@section('painel')

    @include('messages.msg')

    <div class="container" style="margin-top:20px; padding:20px">


        <h4>Cobranças Geradas</h4>


        <div class="table-responsive m-t-20">
            <table class="table stylish-table">
                <thead>
                <tr>
                    <th>Cod. Cobrança</th>
                    <th>Empresa</th>
                    <th>Data Vencimento</th>
                    <th>Valor Cobrança (R$)</th>
                    <th>Status</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{$d->id}}</td>
                        <td>{{$d->empresa->razao_social}}</td>
                        <td>{{ date('d/m/Y',strtotime($d->data_cobranca))}}</td>
                        <td>R$ {{ number_format($d->valor_cobranca,2,',','.')}} </td>
                        <td>{{ $d->ocorrenciaDescricao }}</td>

                    </tr>
                @empty
                    <p>Não existem dados</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <br>

    </div>
@stop