<?php

Auth::routes();

Route::get('/', function () {
    return view('site.index');
});



Route::get('/home', 'HomeController@index')->name('home');
Route::view('/quem-somos', 'site.paginas.quemSomos')->name('quemSomos');
Route::get('/beneficio-social-familiar', 'Site\SiteController@beneficios')->name('beneficioSocialFamiliar');
Route::view('/contato', 'site.paginas.contato')->name('contato');

Route::group(['prefix' => 'api'], function() {
    Route::get('trabalhadores/{cpf}', 'Site\TrabalhadorController@getByCpf');
});

Route::group(['prefix'=>'api', 'middleware'=> 'auth'],function(){
    Route::get('sindicatos/{id}/empresas/{empresa_id}/categorias', 'Admin\SindicatoController@pegarCategoriasPorIdEmpresa');
    Route::get('trabalhadores/{cpf}/ocorrencias', 'Site\TrabalhadorController@pegarOcorrencia');
});

Route::group(['prefix'=>'painel','namespace'=>'Site'],function(){
    
    Route::get('/','DashboardController@painel')->name('painel');
    
    Route::group(['middleware'=>'can:sindicato'],function(){
        Route::resource('sindicato-empresas','EmpresaController');
        Route::get('sindicato-ocorrencias','TrabalhadorController@listarOcorrencias')->name('site.listar.ocorrencias');
        Route::get('/empresas','SindicatoController@empresas')->name('empresas.financeiro');
        Route::get('sindicato-ccts','SindicatoController@listarCct')->name('site.listar.cct');
        Route::get('sindicato-beneficios','SindicatoController@listarBeneficios')->name('site.listar.beneficios');
    });

    Route::group(['middleware'=>'can:empresa'],function(){
        Route::resource('empresa-trabalhadores','TrabalhadorController');
        Route::resource('empresa-ocorrencias','OcorrenciaController');
        Route::get('segunda-via','EmpresaController@segundaVia')->name('segundaVia');
        Route::get('/boleto/{id}','EmpresaController@segundaViaBoleto')->name('segundaViaBoleto');
        Route::get('empresa-trabalhadores/{id}/create', 'TrabalhadorController@create')->name('site.trabalhador.create');
    });

    Route::group(['middleware'=>'can:empresa_parceira'],function(){
        Route::resource('site-empresa_parceiras','EmpresaParceiraController');
    });
    
    Route::resource('empresa-ocorrencias','OcorrenciaController', ['only' => ['index']])->middleware('can:trabalhador');
    Route::get('trabalhador-beneficios','TrabalhadorController@listarBeneficios')->name('site.listar.trabalhador.beneficios');
});

Route::group(['prefix'=>'api', 'namespace'=>'Site', 'middleware'=>'can:empresa'],function(){
    Route::get('trabalhadores/{cpf}/tipo_ocorrencia/{tipo_id}/beneficios', 'TrabalhadorController@pegarBeneficiosDoTipoOcorrencia');
});

Route::group(['middleware'=> ['auth', 'check.permission'],'prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('dashboard','DashboardController@index')->name('dashboard');

    Route::get('/empresa/{id}/sindicatos/','EmpresaController@sindicatosListar')->name('empresa.sindicatos.listar');
    Route::post('empresa/{id}/sindicatos/','EmpresaController@sindicatosIncluir')->name('empresa.sindicatos.incluir');

    Route::get('/empresa/{id}/trabalhadores/','EmpresaController@trabalhadoresListar')->name('empresa.trabalhadores.listar');
    Route::get('/empresa/{id}/trabalhadores/create','EmpresaController@trabalhadoresIncluir')->name('empresa.trabalhadores.incluir');

    Route::get('/sindicato/{id}/categorias/','CategoriaSindicatoController@index')->name('sindicato.categorias.listar');
    Route::get('/sindicato/{id}/categorias/create','CategoriaSindicatoController@create')->name('sindicato.categorias.incluir');


    Route::get('/categoria/{id}/beneficios/','CategoriaSindicatoController@beneficiosListar')->name('categoria.beneficios.listar');
    Route::get('/categoria/{id}/beneficios/create','CategoriaSindicatoController@beneficiosFormIncluir')->name('categoria.beneficios.form');
    Route::post('/categoria/{id}/beneficios/','CategoriaSindicatoController@beneficiosIncluir')->name('categoria.beneficios.incluir');
    Route::get('/categoria/{id}/categoria-beneficio/{categoria_beneficio_id}/','CategoriaSindicatoController@beneficiosFormAtualizar')->name('categoria.beneficios.form.autualizar');
    Route::put('/categoria/{id}/categoria-beneficio/{categoria_beneficio_id}/','CategoriaSindicatoController@beneficiosAtualizar')->name('categoria.beneficios.atualizar');

    Route::get('/sindicato/{id}/participantes/','SindicatoController@participantesListar')->name('sindicato.participantes.listar');
    Route::post('/sindicato/{id}/participantes/','SindicatoController@participantesIncluir')->name('sindicato.participantes.incluir');

    Route::get('/beneficio/{id}/tipo_ocorrencias/','BeneficioSocialController@tipoOcorrenciasListar')->name('beneficio.tipo_ocorrencias.listar');
    Route::post('/beneficio/{id}/tipo_ocorrencias/','BeneficioSocialController@tipoOcorrenciasIncluir')->name('beneficio.tipo_ocorrencias.incluir');

    Route::get('/trabalhador/{id}/dependentes/','TrabalhadorController@dependentesListar')->name('trabalhador.dependentes.listar');
    Route::get('/trabalhador/{id}/dependentes/create','TrabalhadorController@dependentesIncluir')->name('trabalhador.dependentes.incluir');

    Route::group(['prefix'=>'api'],function(){
        Route::get('sindicatos/{id}/categorias', 'SindicatoController@pegarCategorias');

        Route::get('categorias/{id}', 'CategoriaSindicatoController@pegarCategoria');

        Route::get('tipo_participantes/{id}/participantes', 'ParticipanteBeneficioController@pegarParticipantesPorTipo');

        Route::get('trabalhadores/{id}/empresa', 'TrabalhadorController@pegarEmpresa');

        Route::get('empresa_parceiras/', 'EmpresaParceiraController@pegarEmpresas');
    });

    Route::resources([
        'empresas'                  => 'EmpresaController',
        'beneficios_sociais'        => 'BeneficioSocialController',
        'trabalhadores'             => 'TrabalhadorController',
        'dependentes'               => 'DependenteController',
        'papeis'                    => 'PapelController',
        'sindicatos'                => 'SindicatoController',
        'categoria_sindicatos'      => 'CategoriaSindicatoController',
        'participante_beneficios'   => 'ParticipanteBeneficioController',
        'empresa_parceiras'         => 'EmpresaParceiraController',
        'ocorrencias'               => 'OcorrenciasController'

    ]);

});

//cobrancas
Route::get('/admin/cobrancas','Financeiro\CobrancasController@index')->name('cobrancas.index');
Route::get('/admin/cobrancas/{id}','Financeiro\CobrancasController@show')->name('cobrancas.show');
Route::post('/admin/cobrancas','Financeiro\CobrancasController@store')->name('cobrancas.store');
Route::post('/retorno','Financeiro\CobrancasController@retorno')->name('retorno');

//boletos
Route::get('/boleto/{id}','Financeiro\BoletoController@gerarBoleto')->name('boleto');
Route::get('/remessa','Financeiro\BoletoController@gerarRemessa')->name('remessa');

//repassses
Route::get('/repasses','Financeiro\RepasseController@index')->name('repasses.index');