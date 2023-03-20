<div class="form-group">
    <label for="cobertura">Item*</label>
    {!! Form::text('item',
    isset($beneficio) ? $beneficio->item : null,
    ['class'=>'form-control', 'id' => 'item']) !!}
</div>

<div class="form-group">
    <label for="nome">Nome*</label>
    {!! Form::text('nome',
    isset($beneficio) ? $beneficio->nome : null,
    ['class'=>'form-control', 'id' => 'nome']) !!}
</div>

<div class="form-group">
    <label for="descricao">Descrição*</label>
    {!! Form::textarea('descricao',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="descricao">Descrição Privada*</label>
    {!! Form::textarea('descricao_privada',null,['class'=>'form-control']) !!}
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('beneficios_sociais.index')}}" class='btn btn-default'>Voltar</a>
    </div>
</div>
