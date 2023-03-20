@extends('site.painel.dashboard')

@section('painel')

@include('messages.msg')

<div class="container" style="margin-top:20px; padding:20px">
    <div class="row row justify-content-center">

        <div class="com-md-4">
            <div class="card-outline-success" style="width: 18rem;">   
            <div class="card-header">
            
            </div>             
                <div class="card-body text-center">
                 <a href=" {{route('site.trabalhador.create', auth()->user()->empresa()->id) }}   " class="genric-btn primary">NOVO(A) TRABALHADOR(A)</a>
                  <!--  <h4 class="card-title"> {{ Auth::user()->name }}</h4>
                    <h4><small>{{ Auth::user()->email }}</small> </h4>
                    <h5><small>{{ Auth::user()->tipo_usuario ?? '' }}</small> </h5> -->
                </div>
            </div>
        </div>


       


        <div class="col-md-8">
        <div class="card-header">
            
            </div>
            <br>
          
          
                <h4>Trabalhadores Cadastrados </h4>
                <hr>
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                         <!--    <div class="card-body">
                               <div class="d-flex no-block">
                                   <h4 class="card-title">Doação - Patrocínio</h4> -->
                                   <!-- <div class="ml-auto">
                                        <select class="custom-select">
                                            <option selected="">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                        </select>
                                    </div> 
                                </div> -->
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table">
                                         <thead>
                            <tr>
								
                                <th>CPF</th>
                                <th>Data Nascimento</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                <tr>
                                    <td>{{ mask('###.###.###-##',$d->cpf) }}</td>
                                    <td>{{date('d/m/Y', strtotime($d->data_nascimento))}}</td>
                                    <td>{{$d->telefone_1}}</td>
                                    <td>{{$d->email}}</td>
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