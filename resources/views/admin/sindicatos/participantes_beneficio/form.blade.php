<div class="row">
    <div class="form-group col-md-6">
        <label for="setor">Tipo do Participante Benefício*</label>
        {!! Form::select('tipo_participante',$tipo_participantes, old('tipo_participante'),
        ['class'=>'form-control','id'=>'tipo_participante']) !!}
    </div>

    <div class="form-group col-md-6" id="boxParticipanteBeneficios">
        <label for="setor">Participantes*</label>
        {!! Form::select('participante_beneficio',$participante_beneficios, old('participante_beneficio'),
        ['class'=>'form-control','id'=>'participante_beneficio']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label for="valor_beneficio_social">Valor Benefício Social*</label>
        {!! Form::text('valor_beneficio_social',null,['class'=>'form-control','id'=>'valor_beneficio_social']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        <a href="{{route('sindicatos.index')}}" class='btn btn-default'>Voltar</a>
    </div>
</div>