@extends('site.painel.dashboard')

@section('painel')

    @include('messages.msg')

    <div class="container" style="margin-top:20px; padding:20px">
                <h4>Benefícios Compactuados</h4>
                        <div class="table-responsive m-t-20">
                            <table class="table stylish-table">
                                <thead>
                                <tr>
                                    <th>Categoria do Sindicato</th>
                                    <th>Benefício</th>
                                    <th>Número de Parcelas</th>
                                    <th>Quantidade de kits</th>
                                    <th>Valor (R$)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($beneficios as $beneficio)
                                    <tr>
                                        <td>{{$categoria->nome}}</td>
                                        <td><a href="{{ route('beneficioSocialFamiliar') }}"> {{$beneficio->nome}} </a></td>
                                        <td>{{$beneficio->pivot->numero_parcelas}}</td>
                                        <td>{{$beneficio->pivot->quantidade_kit}}</td>
                                        <td>R$ {{ number_format($beneficio->pivot->valor,2,',','.')}}   </td>
                                    </tr>
                                @empty
                                    <p>Não existem dados</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
            <br>
@stop