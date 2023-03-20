<div class="row">
    <div class="form-group col-md-4">
        <label for="setor">Sindicatos (CNPJ)</label>
        {!! Form::select('sindicato',$sindicatos, old('sindicato'),
        ['class'=>'form-control','id'=>'sindicato']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="setor">Categorias</label>
        {!! Form::select('categoria_sindicatos',$categoria_sindicatos, old('categoria_sindicatos'),
        ['class'=>'form-control','id'=>'categoria_sindicatos']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="valor acordado">Valor acordado</label>
        {!! Form::text('valor_beneficio ',
        $categoria_padrao_select->valor_beneficio,
        ['class'=>'form-control', 'id'=>'valor_beneficio', 'readonly']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('empresas.index')}}" class='btn btn-default'>Voltar</a>
    </div>
</div>