<div class="row">
    <div class="form-group col-md-4">
        <label for="razao_social">Razão Social*</label>
        {!! Form::text('razao_social',
        isset($sindicato->razao_social) ? $sindicato->razao_social : null,
        ['class'=>'form-control','id'=>'razao_social']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="cnpj">CNPJ*</label>
        {!! Form::text('cnpj',
        isset($sindicato->cnpj) ? $sindicato->cnpj : null,
        ['class'=>'form-control','id'=>'cnpj']) !!}
    </div>

    <div class="form-group col-md-1">
        <label for="sigla">Sigla</label>
        {!! Form::text('sigla',
         isset($sindicato->sigla) ? $sindicato->sigla : null,
         ['class'=>'form-control','id'=>'sigla']) !!}
    </div>

    <div class="form-group col-md-5">
        <label for="logo">Logo</label>
        {!! Form::file('logo',
        null,
        ['class'=>'form-control','id'=>'logo']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="email">E-mail*</label>
        {!! Form::text('email',
        isset($sindicato->email) ? $sindicato->email : null,
        ['class'=>'form-control','id'=>'email']) !!}
    </div>
    <div class="form-group col-md-2">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('telefone_1',
        isset($sindicato->telefone_1) ? $sindicato->telefone_1 : null,
        ['class'=>'form-control','id'=>'telefone_1']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('telefone_2',
        isset($sindicato->telefone_2) ? $sindicato->telefone_2 : null,
        ['class'=>'form-control','id'=>'telefone_2']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="numero_trabalhadores">Número aproximado de trabalhadores</label>
        {!! Form::text('numero_trabalhadores',
        isset($sindicato->numero_trabalhadores) ? $sindicato->numero_trabalhadores : null,
        ['class'=>'form-control','id'=>'numero_trabalhadores']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label for="email">Banco*</label>
        {!! Form::text('banco',
        isset($banco->banco) ? $banco->banco : null,
        ['class'=>'form-control','id'=>'banco']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="email">Conta*</label>
        {!! Form::text('conta',
        isset($banco->conta) ? $banco->conta : null,
        ['class'=>'form-control','id'=>'conta']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="email">Agência*</label>

        {!! Form::text('agencia',
        isset($banco->agencia) ? $banco->agencia : null,
        ['class'=>'form-control','id'=>'agencia']) !!}
    </div>
</div>