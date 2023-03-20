<div class="form-group">
    <label for="beneficio">Status da ocorrência*</label>
    {!! Form::select('status_ocorrencia',$status_ocorrencias,
    isset($ocorrencia) ? $status_ocorrencia_cadastrada->id : null,
    ['class'=>'form-control','id'=>'status_ocorrencia']) !!}
</div>

<div class="form-group">
    <label for="tipo_ocorrencia">Tipo da ocorrência*</label>
    {!! Form::select('tipo_ocorrencia',$tipos_ocorrencias,
    isset($ocorrencia) ? $tipo_ocorrencia_cadastrada->id : null,
    ['class'=>'form-control','id'=>'tipo_ocorrencia', 'disabled']) !!}
</div>

<div class="form-group">
    <label for="beneficio">Benefício Social*</label>
    {!! Form::select('beneficio',$beneficios_sociais,
    isset($ocorrencia) ? $beneficio_cadastrado->id : null,
    ['class'=>'form-control','id'=>'beneficio', 'disabled']) !!}
</div>

<div class="form-group">
    <label for="nome">Trabalhador*</label>
    {!! Form::text('trabalhador',
    isset($ocorrencia) ? $ocorrencia->trabalhador()->nome : null,
    ['class'=>'form-control', 'id' => 'trabalhador', 'readonly']) !!}
</div>

<div class="form-group">
    <label for="nome">Responsável*</label>
    {!! Form::text('nome_responsavel',
    isset($ocorrencia) ? $ocorrencia->nome_responsavel : null,
    ['class'=>'form-control', 'id' => 'nome_responsavel', 'readonly']) !!}
</div>

<div class="form-group">
    <label for="nome">Departamento*</label>
    {!! Form::text('departamento',
    isset($ocorrencia) ? $ocorrencia->departamento : null,
    ['class'=>'form-control', 'id' => 'departamento', 'readonly']) !!}
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('ocorrencias.index')}}" class='btn btn-default'>Voltar</a>
    </div>
</div>
