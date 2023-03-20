<div class="row">
    <div class="form-group col-md-6">
        <label for="responsavel_nome">Nome do responsável*</label>
        {!! Form::text('responsavel_nome',
        isset($responsavel->nome) ? $responsavel->nome : null,
        ['class'=>'form-control','id'=>'responsavel_nome']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="responsavel_cpf">CPF*</label>
        {!! Form::text('responsavel_cpf',
        isset($responsavel->cpf) ? $responsavel->cpf : null,
        ['class'=>'form-control','id'=>'responsavel_cpf']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="responsavel_telefone_1 1">Telefone 1*</label>
        {!! Form::text('responsavel_telefone_1',
        isset($responsavel->telefone_1) ? $responsavel->telefone_1 : null,
        ['class'=>'form-control','id'=>'responsavel_telefone_1']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="responsavel_telefone_2 2">Telefone 2</label>
        {!! Form::text('responsavel_telefone_2',
        isset($responsavel->telefone_2) ? $responsavel->telefone_2 : null,
        ['class'=>'form-control','id'=>'responsavel_telefone_2']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="setor">Setor*</label>
        {!! Form::select('responsavel_setor',$setores,
        isset($setor_cadastrado->id) ? $setor_cadastrado->id : null,
        ['class'=>'form-control','id'=>'responsavel_setor']) !!}
    </div>
</div>

@empty($empresa)
    <h4>Acesso ao Sistema</h4>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="birth_date">E-mail*</label>
            {!! Form::text('responsavel_email',null,['class'=>'form-control','id'=>'responsavel_email']) !!}
        </div>
        <div class="form-group col-md-4">
            <label for="email">Senha*</label>
            {!! Form::password('responsavel_password', ['class'=>'form-control','id'=>'responsavel_password']) !!}
        </div>
    </div>
@endEmpty

