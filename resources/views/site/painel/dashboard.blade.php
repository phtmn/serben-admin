@extends('site.master')

@section('content')

	
		
<div class=" mt-80 ">
<!--<img src="{{asset('/images/linha2.png')}}" alt="" title=""  style="width:100%" /></a> -->
    <nav class="navbar navbar-expand-lg navbar-light  " >
        <div class="container main-menu ">
            <a class="navbar-brand text-dark" href="#">  </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
               <ul class="nav-menu justify-content-center ml-auto text-center">
                    @can('sindicato')
                        <li class="nav-item active">
                                <a class="nav-link text-dark" href="{{route('sindicato-empresas.index')}}">Empresas <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                               <a class="nav-link text-dark" href="{{route('site.listar.ocorrencias')}}">Ocorrências <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-dark" href="{{route('empresas.financeiro')}}">Financeiro<span class="sr-only">(current)</span></a></li>
                       <li class="nav-item active">
                           <a class="nav-link text-dark" href="{{route('site.listar.cct')}}">Convenção Coletivas<span class="sr-only">(current)</span></a></li>
                        <li class="nav-item active">
                            <a class="nav-link text-dark" href="{{route('site.listar.beneficios')}}">Benefícios Compactuados <span class="sr-only">(current)</span></a>
                        </li>
                    @endcan()

                    @can('empresa')
                        <li class="nav-item active"><a class="nav-link text-dark" href="{{route('empresa-trabalhadores.index')}}">Trabalhadores <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item active"><a class="nav-link text-dark" href="{{route('empresa-ocorrencias.create')}}"> Ocorrências<span class="sr-only">(current)</span></a></li>
                        <li class="nav-item active"><a class="nav-link text-dark" href="#">Banco de Vagas/currículos<span class="sr-only">(current)</span></a></li>
                    @endcan()

                    @can('empresa_parceira')
                        <li class="nav-item active"><a class="nav-link text-dark" href="{{route('site-empresa_parceiras.index')}}">Perfil <span class="sr-only">(current)</span></a></li>
                    @endcan()

                    @can('trabalhador')                        
                        <li class="nav-item active"><a class="nav-link text-dark" href="{{route('site.listar.trabalhador.beneficios')}}">Meus Benefícios <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item active"><a class="nav-link text-dark" href="{{route('empresa-ocorrencias.index')}}">Ocorrências<span class="sr-only">(current)</span></a></li>
						<li class="nav-item active"><a class="nav-link text-dark" href="#">Banco de Vagas <span class="sr-only">(current)</span></a></li>
                        
                    @endcan()
                </ul> 
            </div>
    </div>
	
    </nav>
	<img src="{{asset('/images/linha2.png')}}" alt="" title=""  style="width:100%" /></a>
    <div class="container mt-20">
	
        @yield('painel')    
    
    </div>
    
</div>



<!--

<div class="container" style="margin-top:20px; padding:20px">
    <div class="row row justify-content-center">

        <div class="com-md-4">
            <div class="card-outline-success" style="width: 18rem;">   
            <div class="card-header">
            
            </div>             
                <div class="card-body text-center">
                 
                   <h4 class="card-title">Olá, {{ Auth::user()->name }}</h4>
                    <h4><small>{{ Auth::user()->email }}</small> </h4>
					
                    
                </div>
            </div>
        </div>


       


        <div class="col-md-8">
        <div class="card-header">
            
            </div>
            <br>
          
          
                <h4>SERBEN Benefícios </h4>
                <hr>
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                       
                                <div class="table-responsive m-t-20">
                                  <p align="justify" class="sample-text" style="text-indent: 15px;" > Relacionamento é fundamental e sempre se tem espaço para melhora na Gestão e Administração de Benefícios.
								   
								  <p align="justify" class="sample-text" style="text-indent: 15px;" >Uníamos Empresários, Entidades e Trabalhadores, assim, começamos a estudar os anseios de cada grupo muitas vezes conflitantes, mas com muita conversa e participação ativa de todos e com o entendimento de que diante dos problemas sociais que se agravam cada vez mais teria que se fazer alguma coisa, então, nasceu o conceito Colaborativo de Beneficio Social Familiar. </p> 
								 
								 
								 <p align="justify" class="sample-text" style="text-indent: 15px;" > Criamos uma ferramenta de gestão e administração colaborativa em benefício social onde cada um tem o seu papel fundamental e gerando benefícios para todos os envolvidos ( EMPRESAS, ENTIDADES E TRABALHADORES ). </p> 
								 
								 
								
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>

               
                    <br>

          
    
                    </div>
                
        </div>
    </div>
</div> -->


















@endsection