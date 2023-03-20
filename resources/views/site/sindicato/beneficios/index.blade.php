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
                                    <th>Destinado a</th>
                                    <th>Número de Parcelas</th>
                                    <th>Quantidade de Kits</th>
                                    <th>Valor (R$)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categorias as $categoria)
                                    @foreach($categoria->beneficioSociais()->get() as $beneficio)
                                        <tr>
                                            <td>{{$categoria->nome}}</td>
                                            <td><a href="{{ route('beneficioSocialFamiliar') }}"> {{$beneficio->nome}} </a></td>
                                            @if($beneficio->pivot->ehTrabalhador) <td>Trabalhador</td> @endif
                                            @if($beneficio->pivot->ehConjuge) <td>Cônjuge</td> @endif
                                            @if($beneficio->pivot->ehFilhosMenores) <td>Filhos menores</td> @endif
                                            @if($beneficio->pivot->ehEmpresa) <td>Empresa</td> @endif
                                            @if($beneficio->pivot->ehSindicato) <td>Sindicato</td> @endif
                                            <td>{{$beneficio->pivot->numero_parcelas}}</td>
                                            <td>{{$beneficio->pivot->quantidade_kit}}</td>
                                            <td>R$ {{ number_format($beneficio->pivot->valor,2,',','.')}}</td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <p>Não existem dados</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
            <br>
@stop