<hr>

<div class="row">
	<div class="col-md-3">
	    <div class="form-group">
           
        </div>
    </div>
	<div class="col-md-3">
	    <div class="form-group">
            <label for="cpf_trabalhador">Cadastrar Ocorrências</label>
            {!! Form::text('cpf_trabalhador',null,['class'=>'form-control', 'id'=>'registrar-cpf', 'placeholder' => 'CPF do trabalhador']) !!}
            <span id="cpf-registro-inexistente" style="display: none">CPF não cadastrado</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="cpf_trabalhador">Consultar  Ocorrências</label>
            {!! Form::text('cpf_trabalhador_consulta',null,['class'=>'form-control', 'id'=>'consultar-cpf', 'placeholder' => 'CPF do trabalhador']) !!}
            <span id="cpf-consulta-inexistente" style="display: none">CPF não cadastrado</span>
        </div>
    </div>
	<div class="col-md-3">
	    <div class="form-group">
           
        </div>
    </div>
	
</div>

<div id="box-ocorrencia">
    <div id="box-dados-trabalhador"> {{-- Dados gerados dinamicamente --}} </div>

    <div id="box-reponsavel-ocorrencia"> {{-- Dados gerados dinamicamente --}} </div>

    <div class="form-group" id="box-tipo-ocorrencia" style="display: none">
        <label for="tipo_ocorrencia">Tipo da ocorrência</label>
        {!! Form::select('tipo_ocorrencia',$tipoOcorrencias, old('tipo_ocorrencia'), ['class'=>'form-control','id'=>'tipo_ocorrencia']) !!}
    </div>

    <div id="box-detalhe-tipo-ocorrencia"> {{-- Dados gerados dinamicamente --}} </div>

    <hr>
    <div class="row">
        <div class="form-group col-md-12" id="submit-form" style="display: none;">
            {!! Form::submit('SALVAR',['class'=>'genric-btn primary']) !!}
            <a href="{{route('empresa-ocorrencias.index')}}" class='btn btn-default'>Voltar</a>
        </div>
    </div>
</div>