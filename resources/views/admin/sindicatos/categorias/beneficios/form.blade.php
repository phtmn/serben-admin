<div class="form-group">
    <label for="opcao">Benefício*</label>
    {!! Form::select('beneficio',$beneficios,
    isset($beneficio_cadastrado) ? $beneficio_cadastrado->id : null,
    ['class'=>'form-control','id'=>'beneficio']) !!}
</div>

<div class="form-group">
    <label for="opcao">Destinado a*</label>
    {!! Form::select('opcao',$opcoes,
    isset($beneficio_cadastrado) ? $opcao_cadastrada : null,
    ['class'=>'form-control','id'=>'opcao']) !!}
</div>

<div class="form-group">
    <label for="numero_parcelas">Nº de parcelas*</label>
    {!! Form::text('numero_parcelas',
    isset($beneficio_cadastrado) ? $numero_parcelas : null,
    ['class'=>'form-control', 'id' => 'numero_parcelas']) !!}
</div>

<div class="form-group">
    <label for="quantidade_kit">Quantidade Kits*</label>
    {!! Form::text('quantidade_kit',
    isset($beneficio_cadastrado) ? $quantidade_kit : null,
    ['class'=>'form-control', 'id' => 'quantidade_kit']) !!}
</div>

<div class="form-group">
    <label for="valor">Valor*</label>
    {!! Form::text('valor',
    isset($beneficio_cadastrado) ? $valor : null,
    ['class'=>'form-control', 'id' => 'valor']) !!}
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('categoria.beneficios.listar', request()->route('id'))}}" class='btn btn-default'>Voltar</a>
    </div>
</div>