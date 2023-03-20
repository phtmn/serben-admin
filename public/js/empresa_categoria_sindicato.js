$(document).ready(function(){
  let selectCategoriaSindicato = $('#categoria_sindicatos');
  let selectSindicato = $("#sindicato");
  let inputValorAcordado = $('#valor_beneficio');

  selectSindicato.change(function(){
    pegarCategoriasPorSindicatoCnpj(selectSindicato.val());
  });

  selectCategoriaSindicato.change(function() {
    pegarValorAcordadoDaCategoria(selectCategoriaSindicato.val());
  });

  function pegarValorAcordadoDaCategoria(id) {
    $.getJSON(`/admin/api/categorias/${id}`, function(categorias) {
      inputValorAcordado.val(categorias.valor_beneficio);
    });
  }

  function pegarCategoriasPorSindicatoCnpj(id) {
    $.getJSON(`/admin/api/sindicatos/${id}/categorias`, function(categorias) {
      selectCategoriaSindicato.html(gerarCampos(categorias));
      (categorias.length) ? inputValorAcordado.val(categorias[0].valor_beneficio) : inputValorAcordado.val('');
    });
  }

  function gerarCampos(categorias) {
    let result = '';

    $.each(categorias, function (i, categoria){
      result += `<option value="${categoria.id}">${categoria.nome}</option>`;
    });

    return result;
  }
});