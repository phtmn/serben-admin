$(document).ready(function(){
  let cpf = $("#consultar-cpf");
  let cpf_home = $("#consultar-cpf-home");
  let botaoConsultarCpfHome = $("#search-worker");
  let boxConsultaOcorrencia = $("#box-consulta-ocorrencia");
  let error = $("#cpf-consulta-inexistente");
  let error_guest = $("#usuario-guest");
  let error_access = $("#access-block");
  let error_empty = $("#empty");
  let modal_header = $("#modal-header");
  let modal_body = $("#modal-body");

  cpf.click(function(){
    $("#registrar-cpf").val('');
    $("#box-ocorrencia").html('<hr>');
    $("#cpf-registro-inexistente").css({'display':'none'});
  });

  botaoConsultarCpfHome.click(function() {
    let cpf_value = cpf_home.val().replace(/[^\d]+/g,'');

    error_empty.css({'display':'none'});

    $.getJSON(`/api/trabalhadores/${cpf_value}`, function(response) {
      console.log(response);
      if(response.guest) {
        error_guest.css({'display':'block'});
      }
      else if(response.block) {
        error_access.css({'display':'block'});
      }
      else if($.isEmptyObject(response)) {
        error.css({'display':'block'});
      }
      else {
        error.css({'display':'none'});
        error_guest.css({'display':'none'});
        error_access.css({'display':'none'});

        pegarOcorrenciasProModal(cpf_value);
      }
    });
  });

  cpf.keyup(function(){
    let cpf_value = cpf.val();

    if (cpf_value.length === 14)
    {
      cpf_value = cpf.val().replace(/[^\d]+/g,'');

      $.getJSON(`/api/trabalhadores/${cpf_value}`, function(trabalhador) {
        if($.isEmptyObject(trabalhador)) {
          error.css({'display':'block'});
          $("#box-consulta-ocorrencia").html('');
        }
        else {

          error.css({'display':'none'});

          boxConsultaOcorrencia.css({'display': 'block'});

          pegarOcorrencias(cpf_value);
        }
      });
    }
  });

  function pegarOcorrencias(cpf_trabalhador)
  {
    $.getJSON(`/api/trabalhadores/${cpf_trabalhador}/ocorrencias/`, function(ocorrencias) {
      boxConsultaOcorrencia.html(gerarCamposOcorrencia(ocorrencias));
    });
  }

  function pegarOcorrenciasProModal(cpf_trabalhador)
  {
    $.getJSON(`/api/trabalhadores/${cpf_trabalhador}/ocorrencias/`, function(ocorrencias) {
      if ($.isEmptyObject(ocorrencias)) {
        error_empty.css({'display':'block'});
      }
      else {
        modal_header.html(gerarCabecalhoModal($("#consultar-cpf-home").val()));
        modal_body.html(gerarCamposOcorrencia(ocorrencias));

        $('#modal-ocorrencias').modal('show');
      }
    });
  }

  function gerarCabecalhoModal(cpf) {
    return `<h4 class="modal-title">CPF: ${cpf}</h4>
		  		<button type="button" class="close" data-dismiss="modal">&times;</button>`
  }

  function gerarCamposOcorrencia(ocorrencias) {
    let result = `<div class="container">
        <div class="row row justify-content-center">
            <div class="col-md-12">
                <div class="row">`

    if (!$.isEmptyObject(ocorrencias)) {
      result += `<h4>Trabalhador: ${ocorrencias[0].trabalhador}</h4>`;
    }

    result +=
                `<div class="col-lg-12">
                        <div class="table-responsive m-t-20">
                            <br>
                            <table class="table stylish-table">
                                <thead>
                                  <tr>
                                      <th>Responsável</th>
                                      <th>Departamento</th>
                                      <th>Tipo</th>
                                      <th>Data</th>
                                      <th>Benefício</th>
                                      <th>Valor</th>
                                      <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>`;
    $.each(ocorrencias, function (i, ocorrencia) {
      result += `<tr>`;
      result += `<td>${ocorrencia.responsavel}</td>`;
      result += `<td>${ocorrencia.departamento}</td>`;
      result += `<td>${ocorrencia.tipo}</td>`;
      result += `<td>${ocorrencia.data}</td>`;
      result += `<td>${ocorrencia.beneficio_social}</td>`;
      result += `<td>${ocorrencia.valor}</td>`;
      result += `<td>${ocorrencia.status}</td>`;
      result += `</tr>`;
    });

    result += `</tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>`;

    return result;
  }
});