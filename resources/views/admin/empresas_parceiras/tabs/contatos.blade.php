<div class="row">
    <div class="form-group col-md-4">
        <label for="nome_responsavel">Responsável*</label>
        {!! Form::text('nome_responsavel',
        isset($empresa_parceira) ? $empresa_parceira->nome_responsavel : null,
        ['class'=>'form-control','id'=>'nome_responsavel']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="departamento">Departamento*</label>
        {!! Form::text('departamento_responsavel',
        isset($empresa_parceira) ? $empresa_parceira->departamento : null,
        ['class'=>'form-control','id'=>'departamento']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="telefone_1_responsavel">Telefone 1*</label>
        {!! Form::text('telefone_1_responsavel',
        isset($empresa_parceira) ? $empresa_parceira->telefone_1 : null,
        ['class'=>'form-control','id'=>'telefone_1']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="telefone_2_responsavel">Telefone 2</label>
        {!! Form::text('telefone_2_responsavel',
        isset($empresa_parceira) ? $empresa_parceira->telefone_2 : null,
        ['class'=>'form-control','id'=>'telefone_2']) !!}
    </div>

    @empty($empresa_parceira)
        <div class="form-group col-md-4">
            <label for="email_responsavel">E-mail*</label>
            {!! Form::text('email_responsavel',null,['class'=>'form-control','id'=>'email_responsavel']) !!}
        </div>

        <div class="form-group col-md-4">
            <label for="password">Senha*</label>
            {!! Form::password('password', ['class'=>'form-control','id'=>'password']) !!}
        </div>
    @endEmpty
</div>