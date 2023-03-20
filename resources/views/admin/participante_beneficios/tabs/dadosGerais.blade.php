<div class="row">
    <div class="form-group col-md-4">
        <label for="tipo_participante">Tipo Participante*</label>
        {!! Form::select('tipo_participante',$tipo_participantes,
        isset($tipo_participante_cadastrado->id) ? $tipo_participante_cadastrado->id : null,
        ['class'=>'form-control','id'=>'tipo_participante']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="sigla">Sigla</label>
        {!! Form::text('sigla',
        isset($participante_beneficio->sigla) ? $participante_beneficio->sigla : null,
        ['class'=>'form-control','id'=>'sigla']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="logo">Logo</label>
        {!! Form::file('logo',null,['class'=>'form-control','id'=>'logo']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="razao_social">Razao Social*</label>
        {!! Form::text('razao_social',
        isset($participante_beneficio->razao_social) ? $participante_beneficio->razao_social : null,
        ['class'=>'form-control', 'id'=>'razao_social']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="cnpj">CNPJ*</label>
        {!! Form::text('cnpj',
        isset($participante_beneficio->cnpj) ? $participante_beneficio->cnpj : null,
        ['class'=>'form-control','id'=>'cnpj']) !!}
    </div>
    
    <div class="form-group col-md-4">
        <label for="numero_trabalhadores">Nº aprox trabalhadores</label>
        {!! Form::text('numero_trabalhadores',
        isset($participante_beneficio->numero_trabalhadores) ? $participante_beneficio->numero_trabalhadores : null,
        ['class'=>'form-control','id'=>'numero_trabalhadores']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="email 1">E-mail*</label>
        {!! Form::text('email',
        isset($participante_beneficio->email) ? $participante_beneficio->email : null,
        ['class'=>'form-control','id'=>'email']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('telefone_1',
        isset($participante_beneficio->telefone_1) ? $participante_beneficio->telefone_1 : null,
        ['class'=>'form-control','id'=>'telefone_1']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('telefone_2',
        isset($participante_beneficio->telefone_2) ? $participante_beneficio->telefone_2 : null,
        ['class'=>'form-control','id'=>'telefone_2']) !!}
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

@empty($participante_beneficio)
    <div class="row" id="boxTipoParticipante">
        <div class="form-group col-md-3">
            <label for="birth_date">Nº sindicatos afiliados</label>
            {!! Form::text('sindicatos_afiliados',
            isset($participante_beneficio->sigla) ? $participante_beneficio->sigla : null,
            ['class'=>'form-control','id'=>'sindicatos_afiliados']) !!}
        </div>
    </div>
@endEmpty

