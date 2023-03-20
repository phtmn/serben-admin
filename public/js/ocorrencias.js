$(document).ready(function(){
  let cpf = $("#registrar-cpf");
  let boxResponsavelOcorrencia = $("#box-reponsavel-ocorrencia");
  let boxDadosTrabalhador = $("#box-dados-trabalhador");
  let boxSelectTipoOcorrencias = $("#box-tipo-ocorrencia");
  let selectTipoOcorrencia = $("#tipo_ocorrencia");
  let boxDetalhesTipoOcorrencia = $("#box-detalhe-tipo-ocorrencia");
  let SubmitForm = $("#submit-form");
  let error = $("#cpf-registro-inexistente");

  const FALECIMENTO                               = '1';
  const INCAPACITACAO_PERMANENTE_PARA_O_TRABALHO  = '2';
  const AFASTAMENTO_POR_ENFERMIDADE               = '3';
  const AFASTAMENTO_POR_ACIDENTE                  = '4';
  const NASCIMENTO_FILHO_OU_DOACAO                = '5';
  const CASAMENTO                                 = '6';

  cpf.click(function(){
    $("#consultar-cpf").val('');
    $("#box-consulta-ocorrencia").html('');
    $("#cpf-consulta-inexistente").css({'display':'none'});
  });

  selectTipoOcorrencia.change(function() {
    let cpf_value = cpf.val().replace(/[^\d]+/g,'');

    pegarBeneficiosDoTipoOcorrencia(cpf_value, selectTipoOcorrencia.val());
  });

  cpf.keyup(function(){
    let cpf_value = cpf.val();

    if (cpf_value.length === 14)
    {
      cpf_value = cpf.val().replace(/[^\d]+/g,'');

      $.getJSON(`/api/trabalhadores/${cpf_value}`, function(trabalhador) {
        if($.isEmptyObject(trabalhador)) {
          error.css({'display':'block'});
        }
        else {

          boxResponsavelOcorrencia.html(gerarCamposResponsavel());

          boxDadosTrabalhador.html(gerarCamposDadosTrabalhador(trabalhador));

          boxSelectTipoOcorrencias.css({'display': 'block'});

          pegarBeneficiosDoTipoOcorrencia(cpf_value, selectTipoOcorrencia.val());

          SubmitForm.css({'display': 'block'});

          error.css({'display':'none'});
        }
      });
    }
  });

  function gerarCamposDadosTrabalhador(trabalhador)
  {
    return `<div class="row">
	<div class="col-md-3">
			<div class="form-group">
				<label for="">CPF</label>
                <input class="form-control" type="text" placeholder="${trabalhador.cpf}" readonly>
            </div>
			 </div>
			
			<div class="col-md-5">
            <div class="form-group">
				<label for="">Nome</label>
                <input class="form-control" type="text" placeholder="${trabalhador.nome}" readonly>
            </div>
			 </div>
			
			<div class="col-md-4">
            <div class="form-group">
				<label for="">E-mail</label>
                <input class="form-control" type="text" placeholder="${trabalhador.email}" readonly>
            </div>
			 </div>
 </div>`;
  }

  function gerarCamposResponsavel()
  {
    return ` <div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label for="nome">Responsável*</label>
                <input class="form-control" id="nome_responsavel" name="nome_responsavel" type="text">
            </div>
			 </div>
			<div class="col-md-6">
            <div class="form-group">
                <label for="departamento">Departamento*</label>
                <input class="form-control" id="departamento" name="departamento" type="text">
            </div>
			 </div>
			  </div>`;
  }

  // API
  function pegarBeneficiosDoTipoOcorrencia(cpf, tipo_ocorrencia_id)
  {
    return $.getJSON(`/api/trabalhadores/${cpf}/tipo_ocorrencia/${tipo_ocorrencia_id}/beneficios/`, function(beneficios) {
      boxDetalhesTipoOcorrencia.html(gerarCamposDetalhesTipoOcorrencia(tipo_ocorrencia_id, beneficios));
    });
  }

  function gerarCamposDetalhesTipoOcorrencia(tipoOcorrencia, beneficios) {
    let result = '';

    switch (tipoOcorrencia) {
      case FALECIMENTO:
        result += `<div class="form-group">
                  <label for="tipo_morte">Tipo</label>
                  <select class="form-control" id="tipo_morte" name="tipo_morte">
                      <option value="Acidental">Acidental</option>
                      <option value="Natural">Natural</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="atestado_obito">Atestado de óbito</label>
                    <input class="form-control" id="atestado_obito"  name="atestado_obito" type="text"/>
                </div>
                <div class="form-group">
                    <label for="data_ocorrencia">Data da ocorrência</label>
                    <input class="form-control" id="data_ocorrencia"  name="data_ocorrencia" type="date"/>
                </div>
                <div class="form-group">
                    <label for="beneficio">Benefício</label>
                    <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      case INCAPACITACAO_PERMANENTE_PARA_O_TRABALHO:
        result += `<div class="form-group">
                  <label for="informacoes_doenca">Informações sobre a doença</label>
                  <textarea class="form-control" id="informacoes_doenca"  name="informacoes_doenca" style="resize:none" rows=5/>
              </div>
              <div class="form-group">
                  <label for="laudo_medico">Laudo médico com CID10 INSS</label>
                  <input class="form-control" id="laudo_medico"  name="laudo_medico" type="text"/>
              </div>
              <div class="form-group">
                  <label for="carta_concessao">Carta de Concessão de Auxílio</label>
                  <input class="form-control" id="carta_concessao"  name="carta_concessao" type="text"/>
              </div>
              <div class="form-group">
                    <label for="data_ocorrencia">Data da ciência da incapacitação permanente</label>
                    <input class="form-control" id="data_ocorrencia"  name="data_ocorrencia" type="date"/>
                </div>
              <div class="form-group">
                  <label for="beneficio">Benefício</label>
                  <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      case AFASTAMENTO_POR_ENFERMIDADE:
        result += `<div class="form-group">
                  <label for="informacoes_doenca">Informações sobre a doença</label>
                  <textarea class="form-control" id="informacoes_doenca"  name="informacoes_doenca" style="resize:none" rows=5/>
              </div>
              <div class="form-group">
                  <label for="laudo_medico">Laudo médico com CID10</label>
                  <input class="form-control" id="laudo_medico"  name="laudo_medico" type="text"/>
              </div>
              <div class="form-group">
                  <label for="carta_concessao">Carta de Concessão de Auxílio</label>
                  <input class="form-control" id="carta_concessao"  name="carta_concessao" type="text"/>
              </div>
              <div class="form-group">
                    <label for="data_ocorrencia">Data do afastamento</label>
                    <input class="form-control" id="data_ocorrencia"  name="data_ocorrencia" type="date"/>
                </div>
              <div class="form-group">
                  <label for="beneficio">Benefício</label>
                  <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      case AFASTAMENTO_POR_ACIDENTE:
        result += `<div class="form-group">
                  <label for="informacoes_doenca">Informações sobre a doença</label>
                  <textarea class="form-control" id="informacoes_doenca"  name="informacoes_doenca" style="resize:none" rows=5/>
              </div>
              <div class="form-group">
                  <label for="laudo_medico">Laudo médico com CID10</label>
                  <input class="form-control" id="laudo_medico"  name="laudo_medico" type="text"/>
              </div>
              <div class="form-group">
                  <label for="carta_concessao">Carta de Concessão de Auxílio</label>
                  <input class="form-control" id="carta_concessao"  name="carta_concessao" type="text"/>
              </div>
              <div class="form-group">
                    <label for="data_ocorrencia">Data do afastamento</label>
                    <input class="form-control" id="data_ocorrencia"  name="data_ocorrencia" type="date"/>
                </div>
              <div class="form-group">
                  <label for="beneficio">Benefício</label>
                  <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      case NASCIMENTO_FILHO_OU_DOACAO:
        result += `<div class="form-group">
                  <label for="nome">Nome do recém nascido</label>
                  <input class="form-control" id="laudo_medico"  name="laudo_medico" type="text"/>
              </div>
              <div class="form-group">
                  <label for="cpf">CPF</label>
                  <input class="form-control" id="cpf"  name="cpf" type="text"/>
              </div>
              <div class="form-group">
                  <label for="data_nascimento">Data do nascimento</label>
                  <input class="form-control" id="data_nascimento"  name="data_nascimento" type="date"/>
              </div>
              <div class="form-group">
                  <label for="sexo">Sexo</label>
                  <select class="form-control" id="sexo" name="sexo">
                      <option value="M">Masculino</option>
                      <option value="F">Feminino</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="adotivo">Filho adotivo?</label>
                  <select class="form-control" id="adotivo" name="adotivo">
                      <option value="true">Sim</option>
                      <option value="false">Não</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="beneficio">Benefício</label>
                  <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      case CASAMENTO:
        result += `<div class="form-group">
                        <label for="certidao_casamento_uniao_estavel">Certidão Casamento ou União Estavel</label>
                        <input class="form-control" id="certidao_casamento_uniao_estavel"  name="certidao_casamento_uniao_estavel" type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="data_ocorrencia">Data</label>
                        <input class="form-control" id="data_ocorrencia"  name="data_ocorrencia" type="date"/>
                    </div>
                    <div class="form-group">
                        <label for="beneficio">Benefício</label>
                        <select class="form-control" id="beneficio" name="beneficio">`;

        $.each(beneficios, function (i, beneficio) {
          result += `<option value="${beneficio.id}">${beneficio.nome}</option>`;
        });

        result += `</select></div>`;

        return result;

      default:
        return `<div class="form-group">
                <label for="outro_beneficio">Qual seria a assistência? </label>
                <textarea class="form-control" id="outro_beneficio"  name="outro_beneficio" style="resize:none" rows=5/>
            </div>`;
    }
  }
});