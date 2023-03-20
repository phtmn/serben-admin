@extends('site.painel.dashboard')

@section('painel')

    @include('messages.msg')

    <div class="container" style="margin-top:20px; padding:20px">
        <div class="row row justify-content-center">
            <div class="col-md-12">
                <h4>Resumo Títulos </h4>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">

                            <div class="table-responsive m-t-20">
                                <table class="table stylish-table">
                                    <thead>
                                    <tr>

                                        <th>Cobrança</th>
                                        <th>Data Vencimento</th>
                                        <th>Valor (R$)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $d)
                                        <tr>
                                            <td>{{ $d->id }}</td>
<<<<<<< HEAD
                                            <td>{{ $d->data_cobranca }}</td>
                                            <td>R$ {{ number_format($d->valor_cobranca,2,',','.')}} </td>
                                            <td><a href="{{ route('segundaViaBoleto',$d->id) }}" target="_blank">Segunda via</a></td>
=======
                                            <td>{{ date('d/m/Y',strtotime($d->data_cobranca)) }}</td>
                                            <td>R$ {{ number_format($d->valor_cobranca,2,',','.')}}</td>
                                            <td><a href="{{ route('segundaViaBoleto',$d->id) }}" target="_blank">Boleto</a></td>
>>>>>>> b54f8885df34355f58b2c52166fdf7ba3ff7ee72
                                        </tr>
                                    @empty
                                        <p>Não existe dados</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <br>



        </div>

    </div>
    </div>
    </div>



@stop