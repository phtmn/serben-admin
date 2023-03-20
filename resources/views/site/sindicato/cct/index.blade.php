@extends('site.painel.dashboard')

@section('painel')

    @include('messages.msg')

    <div class="container" style="margin-top:20px; padding:20px">


                <h4>CCTs vinculadas </h4>


                        <div class="table-responsive m-t-20">
                            <table class="table stylish-table">
                                <thead>
                                <tr>
                                    <th>Codigo Sistema</th>
                                    <th>Nome Categoria</th>
                                    <th>Valor Acordado</th>
                                    <th>CCT</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($data as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->nome}}</td>
                                        <td>R$ {{ number_format($d->valor_beneficio,2,',','.')}} </td>
                                        <td><a href="{{$d->cct}}">Documento  </a><i class="fa fa-file-pdf-o"></i></td>

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