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
                 <a href="{{route('sindicato-empresas.create') }}" class="genric-btn primary">NOVA EMPRESA</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card-header"> </div>
            <br>

            <h4>Empresas Cadastradas </h4>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive m-t-20">
                        <table class="table stylish-table">
                            <thead>
                                <tr>
                                   <th>Razão Social</th>
                                    <th>Nome Fantasia</th>
                                    <th>CNPJ</th>
	    							<th>Atividade</th>
		    						<th>CNAE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $d)
                                <tr>                               
                                    <td>{{$d->razao_social}}</td>
                                    <td>{{$d->nome_fantasia}}</td>
                                    <td>{{$d->cnpj}}</td>
									<td>{{$d->atividade_empresa}} </td>
									<td>{{$d->cnae}}</td>
                                </tr>
                            @empty
                            <p>Não existem dados</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

















<!--
<div class="box box-primary">
              <div class="box-header">
                  <a href="{{route('sindicato-empresas.create') }}" class="genric-btn primary">NOVA EMPRESA</a>
              </div>
                    <div class="table-responsive">
		
                        <table  class=" table table-responsive table-hover progress-table-wrap " id="table" style="width:100%;">
                            <thead>
                            <tr>
                                <th>Razão Social</th>
                                <th>Nome Fantasia</th>
                                <th>CNPJ</th>
								<th>Atividade</th>
								<th>CNAE</th>
								<th>Número de funcionários</th>
                                <th>Sindicato</th>                                
							<!--	<th>Categoria do Sindicato</th>    
								  
                            </tr>
                            </thead>
                            <tbody>
                          
                            </tbody>
                        </table>
						  </div>
                  
        </div>
-->

@stop