$(document).ready(function(){
  let boxCategoriaSindicatos = $("#boxCategoriaSindicatos");
  let selectSindicato = $("#sindicato");
  let url = $(location).attr('href');
  let empresa_id = pegarEmpresaId(url);

  console.log(empresa_id);

  selectSindicato.change(function(){
    pegarCategoriasPorCnpj(empresa_id,selectSindicato.val());
  });

  function pegarCategoriasPorCnpj(empresa_id,sindicato_id) {
    $.getJSON(`/api/sindicatos/${sindicato_id}/empresas/${empresa_id}/categorias`, function(categorias) {
      boxCategoriaSindicatos.html(gerarCampos(categorias));
    });
  }

  function gerarCampos(categorias) {
    let result = `<label for="setor">Categorias*</label>
                    <select class="form-control" id="categoria_sindicatos" name="categoria_sindicatos">`;

    $.each(categorias, function (i, categoria){
      result += `<option value="${categoria.id}">${categoria.nome}</option>`;
    });

    result += '</div>';

    return result;
  }

  function pegarEmpresaId(url) {
    let empresa_id = true;
    url = url.split('/');

    if (url.includes('edit')) {
      let trabalhador_id = url[5];

      $.ajax({ type: "GET",
        url: `/admin/api/trabalhadores/${trabalhador_id}/empresa`,
        async: false,
        success : function(empresa)
        {
          empresa_id = empresa.id;
        }
      });

      return empresa_id
    }

    return url[5];
  }
});