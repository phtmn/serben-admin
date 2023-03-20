
<section class="services-area section-gap">

<div class="container">

      <!-- Heading Row -->
      <div class="row my-4">
		  <div id="carousel-example-generic" class="carousel slide col-lg-9" data-ride="carousel">
			  <div class="carousel-inner" role="listbox">
				  <div class="item active">
					  <img style="width:100%" src="{{asset('/images/7.jpg')}}" alt="">
					  <div class="carousel-caption">
						  ...
					  </div>
				  </div>
				  <div class="item">
					  <img style="width:100%" src="{{asset('/images/banner.jpg')}}" alt="">
					  <div class="carousel-caption">
						  ...
					  </div>
				  </div>
			  </div>
		  </div>

		  {{--<div id="myCarousel" class="carousel slide" data-ride="carousel">--}}
			  {{--<!-- Indicators -->--}}
			  {{--<ol class="carousel-indicators">--}}
				  {{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
				  {{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
				  {{--<li data-target="#myCarousel" data-slide-to="2"></li>--}}
			  {{--</ol>--}}

			  {{--<!-- Wrapper for slides -->--}}
			  {{--<div class="carousel-inner">--}}
				  {{--<div class="item active">--}}
					  {{--<img src="{{asset('/images/7.jpg')}}" alt="Los Angeles" style="width:100%;">--}}
				  {{--</div>--}}

				  {{--<div class="item">--}}
					  {{--<img src="{{asset('/images/7.jpg')}}" alt="Chicago" style="width:100%;">--}}
				  {{--</div>--}}

				  {{--<div class="item">--}}
					  {{--<img src="{{asset('/images/7.jpg')}}" alt="New york" style="width:100%;">--}}
				  {{--</div>--}}
			  {{--</div>--}}

			  {{--<!-- Left and right controls -->--}}
			  {{--<a class="left carousel-control" href="#myCarousel" data-slide="prev">--}}
				  {{--<span class="glyphicon glyphicon-chevron-left"></span>--}}
				  {{--<span class="sr-only">Previous</span>--}}
			  {{--</a>--}}
			  {{--<a class="right carousel-control" href="#myCarousel" data-slide="next">--}}
				  {{--<span class="glyphicon glyphicon-chevron-right"></span>--}}
				  {{--<span class="sr-only">Next</span>--}}
			  {{--</a>--}}
		  {{--</div>--}}
        <!-- /.col-lg-8 -->
		
        <div class="col-lg-3">
		<br><br>
		 <div class="row block-form" style="border: 2px solid #fcb034; padding: 8px; border-radius: 8px">
		  <h1>Ocorrências</h1> 	  
		  
		  	  <img src="{{asset('/images/linha2.png')}}" alt="" title=""  style="width:90%" /></a>
          <p align="justify" style="text-indent: 25px;" >
								Acompanhe suas ocorrências 	</p>
			<div class="col-sm-8 form-group sinistro-home" unselectable="on">
				<input name="" type="text" maxlength="14" id="consultar-cpf-home" tabindex="1" class="form-control" placeholder="Digite seu CPF"/>
				<span id="cpf-consulta-inexistente" style="display: none">CPF não cadastrado</span>
				<span id="usuario-guest" style="display: none">É necessário fazer login!</span>
				<span id="access-block" style="display: none">Acesso negado!</span>
				<span id="empty" style="display: none">Não há ocorrências!</span>
			</div>
			<div class="col-sm-4 form-group cpf-home" unselectable="on">
				<button id="search-worker" class="genric-btn primary" style="float: right;"><span class="lnr lnr-magnifier"></span>	</button>
		
			</div>
			
		</div>
        </div>
        <!-- /.col-md-4 -->
      </div>
	  
	  
     
      

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->



  

<!-- MODAL -->
  
<div class="modal fade" id="modal-ocorrencias" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        	<div class="modal-header" id="modal-header">
				{{-- Conteúdo adicionado dinamicamente--}}
        	</div>
        	<div class="modal-body" id="modal-body">
          		{{-- Conteúdo adicionado dinamicamente--}}
			</div>
		</div>
    </div>
  </div>
 		
				<div class="container">
				 
		             <div class="row d-flex justify-content-center">
		                <div class="menu-content  col-lg-12">
		                    <div class="title text-center">
		                        <h1 class="mb-10">A gestora serben social:</h1>
		                        <p style="text-indent: 15px;" align="justify"> Proporciona acesso para todo trabalhador ter o benefício assistencial com a mais alta
									qualidade do mercado, oferecendo atendimento imediato aos trabalhadores e suas famílias de
									forma ágil e desburocratizada, proporcionando proteção e segurança aos beneficiários,
									gerando inclusão e bem estar social através de mecanismos sustentáveis. </p>
								<img src="{{asset('/images/linha2.png')}}" alt="" title=""  style="width:90%" /></a>
		                    </div>
		                </div>
						
						
		            </div>						 
					<div class="row">	
									
						<div class="col-lg-4 col-md-6">
							<div class="single-services">
								<span class="lnr lnr-store"></span>
								<a href="{{url('/login')}}"><h3>Sindicatos</h3></a>
								<p align="justify" style="text-indent: 15px;" >Proporcionar uma gestão com inovação, eficiência e transparência do Benefício Serben
                                    Social Familiar, oferecendo consultas, relatórios e cadastros.
								</p> 
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-services">
								<span class="lnr lnr-apartment"></span>
								<a href="{{url('/login')}}"><h3>Empresas</h3></a>
								<p align="justify" style="text-indent: 15px;" >
                                    Proporcionar a maior quantidade de benefícios assistenciais, gestão com base em CCT’s,
                                    impressão de boletos e serviços online com total amparo, informação e comodidade para o
                                    empresário.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-services">
								<span class="lnr lnr-users"></span>
								<a href="{{url('/login')}}"><h3>Trabalhadores</h3></a>
								<p align="justify" style="text-indent: 15px;" >
                                    Proporcionar bem estar e conhecimento total dos benefícios assistenciais e o acesso facilitado
                                    aos mesmos acordados em CCT’s, preenchendo assim o espaço entre o imprevisto e a
                                    reestruturação financeira.
								</p> 
							</div>				
						</div>
											
					</div>
				</div>	
			</section>
			<!-- End services Area -->
            <div class="segunda-via">
                <a href="{{route('segundaVia')}}"><img src="{{asset('images/segunda-via.jpg')}}" class="text-center" width="100%" height="300px" alt=""></a>
            </div>

@section('js')
	<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
	<script src="{{ asset('js/ocorrencias.js') }}"></script>
	<script src="{{ asset('js/consultar_ocorrencias.js') }}"></script>

	<script>
      $("#consultar-cpf-home").mask('000.000.000-00');
	</script>
@stop