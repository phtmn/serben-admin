<div class="row">
    <div class="form-group col-md-4">
        <label for="tipo_servico">Tipo do serviço*</label>
        {!! Form::select('tipo_servico', $tipo_servicos,
        isset($empresa_parceira) ? $tipo_servico_cadastrado->id : null,
        ['class'=>'form-control','id'=>'tipo_servico']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="servico">Serviço*</label>
        {!! Form::text('servico',
        isset($empresa_parceira) ? $empresa_parceira->servico : null,
        ['class'=>'form-control','id'=>'servico']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="valor_vida 1">Valor cobrado por vida</label>
        {!! Form::text('valor_vida',
        isset($empresa_parceira) ? $empresa_parceira->valor_vida : null,
        ['class'=>'form-control','id'=>'valor_vida']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="valor_massa 2">Valor cobrado por massa</label>
        {!! Form::text('valor_massa',
        isset($empresa_parceira) ? $empresa_parceira->valor_massa : null,
        ['class'=>'form-control','id'=>'valor_massa']) !!}
    </div>

    <div class="form-group col-md-4">
        <label for="valor_evento">Valor cobrado por evento</label>
        {!! Form::text('valor_evento',
        isset($empresa_parceira) ? $empresa_parceira->valor_evento : null,
        ['class'=>'form-control','id'=>'valor_evento']) !!}
    </div>
</div>