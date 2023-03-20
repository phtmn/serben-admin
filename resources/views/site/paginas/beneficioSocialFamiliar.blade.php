@extends('site.master')

@section('content')
<section class="about-banner">
   <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
           <!-- <div class="about-content col-lg-12">
                <h1 class="text-white">
                   QUEM SOMOS		
                </h1>	
               
            </div>	 -->
        </div> 
    </div>  
</section>

<section class="sample-text-area">
    <div class="container">
	<br>
       <center> <h3 class="text-heading">BENEFÍCIO SOCIAL FAMILIAR</h3> </center>
        
		<p align="justify"style="text-indent: 15px;"   class="sample-text">
       O Beneficio Social Familiar tem como objetivo amparar e transmitir tranquilidade aos trabalhadores e seus familiares em momentos felizes, no caso de nascimento de filhos do trabalhador, ou de fatalidade, seja de que natureza for, independente de idade, doença pré-existente, ou qualquer causa mortis, sem quaisquer burocracias ou carências, independente, inclusive, do fato da empresa estar ou não contribuindo na forma prevista em Convenção Coletiva de Trabalho. 
        </p>
	
		
		
    </div>
</section>


<div class="whole-wrap">

<div class="container">

					
					
					<div class="section-top-border">
						
						<div class="row">
                            @forelse($data as $d)
							<div class="col-lg-12">
								<blockquote class="generic-blockquote" align="justify">
								<h4 class="mb-30">{{ $d->nome }}</h4>
									<p align="justify"style="text-indent: 15px;"   class="sample-text">	{{ $d->descricao }} </p>
								</blockquote>
							</div>
                                @empty
                            <p>Não há registros</p>

                            @endforelse

						</div>
						
						
					</div>
					
					
				
                    
    </div>
	
	   </div>
                    
                    <!-- </div>cotainer -->


                   
@endsection