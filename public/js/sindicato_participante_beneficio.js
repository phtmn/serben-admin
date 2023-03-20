$(document).ready(function(){
  let boxParticipanteBeneficios = $("#boxParticipanteBeneficios");
  let selectTipo_participante = $("#tipo_participante");

  const EMPRESA_PARCEIRA = 5;

  selectTipo_participante.change(function(){
    let tipo_parcipante = selectTipo_participante.val();

    (tipo_parcipante == EMPRESA_PARCEIRA)
      ? pegarEmpresasParceiras(tipo_parcipante)
      : pegarParticipantesPorTipo(tipo_parcipante);
  });

  function pegarParticipantesPorTipo(tipoParticipante) {
    $.getJSON(`/admin/api/tipo_participantes/${tipoParticipante}/participantes`, function(participantes) {
      boxParticipanteBeneficios.html(gerarCampos(participantes));
    });
  }

  function pegarEmpresasParceiras() {
    $.getJSON(`/admin/api/empresa_parceiras/`, function(empresas) {
      boxParticipanteBeneficios.html(gerarCampos(empresas));
    });
  }

  function gerarCampos(dados) {
    let result = `<label for="setor">Participantes*</label>
                    <select class="form-control" id="participante_beneficio" name="participante_beneficio">`;

    $.each(dados, function (i, dado){
      result += `<option value="${dado.id}">${dado.razao_social}</option>`;
    });

    result += '</div>';

    return result;
  }
});