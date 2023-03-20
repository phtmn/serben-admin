<div class="form-group">
    <label for="setor">Tipo da ocorrência</label>
    {!! Form::select('tipo_ocorrencia',$tipo_ocorrencias, old('tipo_ocorrencia'),
    ['class'=>'form-control','id'=>'tipo_ocorrencia']) !!}
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('beneficios_sociais.index')}}" class='btn btn-default'>Voltar</a>
    </div>
</div>