<div class="row">

    <div class="form-group col-md-4">
        <label for="razao_social">Razao Social</label>
        {!! Form::text('razao_social',
        isset($empresa->razao_social) ? $empresa->razao_social : null,
        ['class'=>'form-control', 'id'=>'razao_social']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="nome_fantasia">Nome Fantasia</label>
        {!! Form::text('nome_fantasia',
        isset($empresa->nome_fantasia) ? $empresa->nome_fantasia : null,
        ['class'=>'form-control', 'id'=>'nome_fantasia']) !!}
    </div>
    
    <div class="form-group col-md-3">
        <label for="cnpj">CNPJ*</label>
        {!! Form::text('cnpj',
        isset($empresa->cnpj) ? $empresa->cnpj : null,
        ['class'=>'form-control','id'=>'cnpj']) !!}
    </div>

</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="atividade_empresa">Atividade da empresa*</label>
        {!! Form::text('atividade_empresa',
        isset($empresa->atividade_empresa) ? $empresa->atividade_empresa : null,
        ['class'=>'form-control','id'=>'atividade_empresa']) !!}
    </div>
    
    <div class="form-group col-md-6">
        <label for="cnae">CNAE*</label>
        {!! Form::text('cnae',
        isset($empresa->cnae) ? $empresa->cnae : null,
        ['class'=>'form-control','id'=>'cnae']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="numero_funcionarios">Nº aprox funcionarios</label>
        {!! Form::text('numero_funcionarios',
        isset($empresa->numero_funcionarios) ? $empresa->numero_funcionarios : null,
        ['class'=>'form-control','id'=>'numero_funcionarios']) !!}
    </div>


</div>

<div class="row">

    <div class="form-group col-md-3">
        <label for="empresa_telefone_1 1">Telefone 1*</label>
        {!! Form::text('empresa_telefone_1',
        isset($empresa->telefone_1) ? $empresa->telefone_1 : null,
        ['class'=>'form-control','id'=>'empresa_telefone_1']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="empresa_telefone_2 2">Telefone 2</label>
        {!! Form::text('empresa_telefone_2',
        isset($empresa->telefone_2) ? $empresa->telefone_2 : null,
        ['class'=>'form-control','id'=>'empresa_telefone_2']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="email_para_avisos_mensais">E-mail para avisos mensais*</label>
        {!! Form::text('email_para_avisos_mensais',
        isset($empresa->email_avisos_mensais) ? $empresa->email_avisos_mensais : null,
        ['class'=>'form-control','id'=>'email_para_avisos_mensais']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="email_para_contabilidade">E-mail para contabilidade</label>
        {!! Form::text('email_para_contabilidade',
        isset($empresa->email_contabilidade) ? $empresa->email_contabilidade : null,
        ['class'=>'form-control','id'=>'email_para_contabilidade']) !!}
    </div>
</div>

