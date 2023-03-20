<div class="row">
    <div class="form-group col-md-2">
        <label for="rua">CEP*</label>
        {!! Form::text('cep',
                isset($endereco->cep) ? $endereco->cep : null,
                ['class'=>'form-control','id'=>'cep']) !!}
    </div>
    
    <div class="form-group col-md-4">
        <label for="logo">Rua*</label>
        {!! Form::text('rua',
                isset($endereco->rua) ? $endereco->rua : null,
                ['class'=>'form-control','id'=>'rua']) !!}
    </div>
    
    <div class="form-group col-md-1">
        <label for="numero">Numero</label>
        {!! Form::text('numero',
                isset($endereco->numero) ? $endereco->numero : null,
                ['class'=>'form-control','id'=>'numero']) !!}
    </div>
    
    <div class="form-group col-md-5">
        <label for="logo">Complemento</label>
        {!! Form::text('complemento',
                isset($endereco->complemento) ? $endereco->complemento : null,
                ['class'=>'form-control','id'=>'complemento']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="logo">Bairro*</label>
        {!! Form::text('bairro',
                isset($endereco->bairro) ? $endereco->bairro : null,
                ['class'=>'form-control','id'=>'bairro']) !!}
    </div>
    
    <div class="form-group col-md-4">
        <label for="logo">Cidade*</label>
        {!! Form::text('cidade',
                isset($endereco->cidade) ? $endereco->cidade : null,
                ['class'=>'form-control','id'=>'cidade']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="logo">Estado*</label>
        {!! Form::text('uf',
                isset($endereco->uf) ? $endereco->uf : null,
                ['class'=>'form-control','id'=>'uf']) !!}
    </div>
</div>