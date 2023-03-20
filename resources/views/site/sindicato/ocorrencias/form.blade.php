<hr>
    
<div class="row">
	<div class="col-md-2">
        <div class="form-group">
           
        </div>
    </div>
	<div class="col-md-3">
        <div class="form-group">
           
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="cpf_trabalhador">Consultar Ocorrências</label>
            {!! Form::text('cpf_trabalhador_consulta',null,['class'=>'form-control', 'id'=>'consultar-cpf', 'placeholder' => 'Digite o CPF']) !!}
            <span id="cpf-consulta-inexistente" style="display: none">CPF não cadastrado</span>
        </div>
    </div>
	<div class="col-md-3">
        <div class="form-group">
           
        </div>
    </div>
	
	<div class="col-md-2">
        <div class="form-group">
           
        </div>
    </div>
</div>