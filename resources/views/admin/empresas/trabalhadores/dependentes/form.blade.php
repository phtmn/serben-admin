<div class="form-group">
    <label for="nome">Nome*</label>
    {!! Form::text('nome',
    isset($dependente) ? $dependente->nome : null,
    ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="nome">CPF*</label>
    {!! Form::text('cpf',
    isset($dependente) ? $dependente->cpf : null,
    ['class'=>'form-control', 'id' => 'cpf']) !!}
</div>

<div class="form-group">
    <label for="nome">Idade*</label>
    {!! Form::text('idade',
    isset($dependente) ? $dependente->idade : null,
    ['class'=>'form-control', 'id' => 'idade']) !!}
</div>

<div class="form-group">
    <label for="nome">Parentesco</label>
    {!! Form::text('parentesco',
    isset($dependente) ? $dependente->parentesco : null,
    ['class'=>'form-control']) !!}
</div>