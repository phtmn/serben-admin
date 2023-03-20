<div class="row">

    <div class="form-group col-md-3">
        <label for="razao_social">Razao Social*</label>
        {!! Form::text('razao_social',
        isset($empresa_parceira) ? $empresa_parceira->razao_social : null,
        ['class'=>'form-control', 'id'=>'razao_social']) !!}
    </div>
    <div class="form-group col-md-3">
        <label for="nome_fantasia">Nome Fantasia</label>
        {!! Form::text('nome_fantasia',
        isset($empresa_parceira) ? $empresa_parceira->nome_fantasia : null,
        ['class'=>'form-control', 'id'=>'nome_fantasia']) !!}
    </div>

    <div class="form-group col-md-5">
        <label for="logo">Logo</label>
        {!! Form::file('logo',null,['class'=>'form-control','id'=>'logo']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label for="cnpj">CNPJ*</label>
        {!! Form::text('cnpj',
        isset($empresa_parceira) ? $empresa_parceira->cnpj : null,
        ['class'=>'form-control','id'=>'cnpj']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="atividade_empresa">Atividade empresa*</label>
        {!! Form::text('atividade_empresa',
        isset($empresa_parceira) ? $empresa_parceira->atividade_empresa : null,
        ['class'=>'form-control','id'=>'atividade_empresa']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="telefone 1">Telefone*</label>
        {!! Form::text('telefone',
        isset($empresa_parceira) ? $empresa_parceira->telefone : null,
        ['class'=>'form-control','id'=>'telefone']) !!}
    </div>
</div>
