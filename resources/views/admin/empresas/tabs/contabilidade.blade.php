<div class="row">
    <div class="form-group col-md-6">
        <label for="firma_contabilidade 2">Firma de contabilidade*</label>
        {!! Form::text('firma_contabilidade',
        isset($contabilidade) ? $contabilidade->nome : null,
        ['class'=>'form-control','id'=>'firma_contabilidade']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="contabilidade_cnpj 2">CNPJ*</label>
        {!! Form::text('contabilidade_cnpj',
        isset($contabilidade) ? $contabilidade->cnpj : null,
        ['class'=>'form-control','id'=>'contabilidade_cnpj']) !!}
    </div>
</div>


<div class="row">    
    <div class="form-group col-md-2">
        <label for="contabilidade_cep">CEP*</label>
        {!! Form::text('contabilidade_cep',
        isset($contabilidade) ? $contabilidade->endereco()->cep : null,
        ['class'=>'form-control','id'=>'contabilidade_cep']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="contabilidade_rua">Rua*</label>
        {!! Form::text('contabilidade_rua',
        isset($contabilidade) ? $contabilidade->endereco()->rua : null,
        ['class'=>'form-control','id'=>'contabilidade_rua']) !!}
    </div>

    <div class="form-group col-md-1">
        <label for="contabilidade_numero">Numero</label>
        {!! Form::text('contabilidade_numero',
        isset($contabilidade) ? $contabilidade->endereco()->numero : null,
        ['class'=>'form-control','id'=>'contabilidade_numero']) !!}
    </div>

    <div class="form-group col-md-5">
        <label for="contabilidade_complemento">Complemento</label>
        {!! Form::text('contabilidade_complemento',
        isset($contabilidade) ? $contabilidade->endereco()->complemento : null,
        ['class'=>'form-control','id'=>'contabilidade_complemento']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="contabilidade_bairro">Bairro*</label>
        {!! Form::text('contabilidade_bairro',
        isset($contabilidade) ? $contabilidade->endereco()->bairro : null,
        ['class'=>'form-control','id'=>'contabilidade_bairro']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="contabilidade_cidade">Cidade*</label>
        {!! Form::text('contabilidade_cidade',
        isset($contabilidade) ? $contabilidade->endereco()->cidade : null,
        ['class'=>'form-control','id'=>'contabilidade_cidade']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="contabilidade_uf">Estado*</label>
        {!! Form::text('contabilidade_uf',
        isset($contabilidade) ? $contabilidade->endereco()->uf : null,
        ['class'=>'form-control','id'=>'contabilidade_uf']) !!}
    </div>
</div>

<h4>Dados do Responsável</h4>
<hr>
<div class="row">
    <div class="form-group col-md-6">
        <label for="contador_nome">Nome do responsável*</label>
        {!! Form::text('contador_nome',
        isset($contabilidade) ? $contabilidade->responsavel()->nome : null,
        ['class'=>'form-control','id'=>'contador_nome']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="contador_cpf ">CPF*</label>
        {!! Form::text('contador_cpf',
        isset($contabilidade) ? $contabilidade->responsavel()->cpf : null,
        ['class'=>'form-control','id'=>'contador_cpf']) !!}
    </div>
    <div class="form-group col-md-4">
        <label for="setor">Setor*</label>
        {!! Form::select('contador_setor',$setores,
        isset($contabilidade) ? $contabilidade->responsavel()->setor()->id : null,
        ['class'=>'form-control','id'=>'contador_setor']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('contador_telefone_1',
        isset($contabilidade) ? $contabilidade->responsavel()->telefone_1 : null,
        ['class'=>'form-control','id'=>'contador_telefone_1']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('contador_telefone_2',
        isset($contabilidade) ? $contabilidade->responsavel()->telefone_2 : null,
        ['class'=>'form-control','id'=>'contador_telefone_2']) !!}
    </div>
</div>

@empty($empresa)
<h4>Dados do Acesso</h4>
<hr>
<div class="row">
    <div class="form-group col-md-4">
        <label for="birth_date">E-mail*</label>
        {!! Form::text('contador_email',null,['class'=>'form-control','id'=>'contador_email']) !!}
    </div>
    <div class="form-group col-md-4">
        <label for="email">Senha*</label>
        {!! Form::password('contador_password', ['class'=>'form-control','id'=>'contador_password']) !!}
    </div>
</div>
@endEmpty



