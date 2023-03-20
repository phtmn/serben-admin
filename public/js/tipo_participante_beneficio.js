$(document).ready(function(){
  let boxTipoParticipante = $("#boxTipoParticipante");
  let selectTipoParticipante = $("#tipo_participante");

  const FEDERACAO         = '1';
  const CONFEDERACAO      = '2';
  const CENTRAL_SINDICAL  = '3';

  selectTipoParticipante.change(function(){
    boxTipoParticipante.html(gerarCampos(selectTipoParticipante.val()));
  });

  function gerarCampos(tipoPartipante)
  {
    switch(tipoPartipante)
    {
      case FEDERACAO: return camposFederacao();
      case CONFEDERACAO: return camposConfederacao();
      case CENTRAL_SINDICAL: return camposCentralSindical();
      default: return camposEntidadePatronal();
    }
  }

  function camposFederacao()
  {
    return `<div class="form-group col-md-3">
                <label for="birth_date">Nº sindicatos afiliados</label>
                <input class="form-control" id="sindicatos_afiliados" name="sindicatos_afiliados" type="text">
            </div>`;
  }

  function camposConfederacao()
  {
    return camposFederacao() +
        `<div class="form-group col-md-3">
            <label for="birth_date">Nº federações afiliadas</label>
            <input class="form-control" id="federacoes_afiliadas" name="federacoes_afiliadas" type="text">
          </div>`;
  }

  function camposCentralSindical()
  {
    return camposConfederacao() +
        `<div class="form-group col-md-3">
            <label for="birth_date">Nº confederações afiliadas</label>
            <input class="form-control" id="confederacoes_afiliadas" name="confederacoes_afiliadas" type="text">
          </div>`;
  }

  function camposEntidadePatronal()
  {
    return `<div class="form-group col-md-3">
                <label for="birth_date">Nº empresas</label>
                <input class="form-control" id="empresas" name="empresas" type="text">
            </div>`;
  }
});