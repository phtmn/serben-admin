<h4 class="box-title">Dados do Responsável pela Presidencia</h4>
<hr>

<div class="row">
    <div class="form-group col-md-4">
        <label for="presidente">Presidente*</label>
        {!! Form::text('presidente',
             isset($presidente->nome) ? $presidente->nome : null,
             ['class'=>'form-control','id'=>'presidente']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('presidente_telefone_1',
            isset($presidente->telefone_1) ? $presidente->telefone_1 : null,
            ['class'=>'form-control','id'=>'presidente_telefone_1']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('presidente_telefone_2',
            isset($presidente->telefone_2) ? $presidente->telefone_1 : null,
            ['class'=>'form-control','id'=>'presidente_telefone_2']) !!}
    </div>
    
    <div class="form-group col-md-4">
        <label for="email">E-mail*</label>
        {!! Form::text('presidente_email',
            isset($presidente->email)? $presidente->email:null,
            ['class'=>'form-control','id'=>'email']) !!}
    </div>
</div>

<h4 class="box-title">Dados do Responsável Jurídico</h4>
<hr>
<div class="row">
    <div class="form-group col-md-4">
        <label for="responsavel_juridico">Responsável Jurídico*</label>
        {!! Form::text('responsavel_juridico',
            isset($juridico->nome) ? $juridico->nome :null,
            ['class'=>'form-control','id'=>'responsavel_juridico']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('responsavel_juridico_telefone_1',
            isset($juridico->telefone_1) ? $juridico->telefone_1 :null,
            ['class'=>'form-control','id'=>'responsavel_juridico_telefone_1']) !!}
    </div>
    
    <div class="form-group col-md-2">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('responsavel_juridico_telefone_2',
            isset($juridico->telefone_2) ? $juridico->telefone_2 :null,
            ['class'=>'form-control','id'=>'responsavel_juridico_telefone_2']) !!}
    </div>
    
    <div class="form-group col-md-4">
        <label for="email">E-mail*</label>
        {!! Form::text('responsavel_juridico_email',
            isset($juridico->email) ? $juridico->email :null,
            ['class'=>'form-control','id'=>'responsavel_juridico_email']) !!}
    </div>
</div>



