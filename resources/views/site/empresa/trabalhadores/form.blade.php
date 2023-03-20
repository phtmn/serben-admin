
 <hr>
 <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nome">Nome Completo*</label>
            {!! Form::text('nome',null,['class'=>'form-control','id'=>'nome']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="cpf">CPF*</label>
            {!! Form::text('cpf',null,['class'=>'form-control','id'=>'cpf']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="rg">RG</label>
            {!! Form::text('rg',null,['class'=>'form-control','id'=>'rg']) !!}
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label for="setor">Sexo*</label>
            {!! Form::select('sexo',['M' => 'Masculino', 'F' => 'feminino'], old('sexo'), ['class'=>'form-control','id'=>'sexo']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="data_nascimento">Data Nascimento</label>
            {!! Form::date('data_nascimento',null,['class'=>'form-control','id'=>'data_nascimento']) !!}
        </div>
    </div>
</div>


 <div class="row">

    <div class="col-md-2">
        <div class="form-group">
            <label for="cep">CEP</label>
            {!! Form::text('cep',null,['class'=>'form-control','id'=>'cep']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="telefone">Rua</label>
            {!! Form::text('rua',null,['class'=>'form-control','id'=>'rua']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="numero">Nº</label>
            {!! Form::text('numero',null,['class'=>'form-control','id'=>'numero']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="numero">Complemento</label>
            {!! Form::text('complemento',null,['class'=>'form-control','id'=>'complemento']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="bairro">Bairro</label>
            {!! Form::text('bairro',null,['class'=>'form-control','id'=>'bairro']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="numero">Cidade</label>
            {!! Form::text('cidade',null,['class'=>'form-control','id'=>'cidade']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="estado">Estado</label>
            {!! Form::text('uf',null,['class'=>'form-control','id'=>'uf']) !!}
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="email">E-mail</label>
            {!! Form::text('email',null,['class'=>'form-control','id'=>'email']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="email">Senha</label>
            {!! Form::password('password', ['class'=>'form-control','id'=>'password']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="telefone_1">Telefone 1</label>
            {!! Form::text('telefone_1',null,['class'=>'form-control','id'=>'telefone_1']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="telefone_2">Telefone 2</label>
            {!! Form::text('telefone_2',null,['class'=>'form-control','id'=>'telefone_2']) !!}
        </div>
    </div>
</div>

 <div class="row">

    <div class="col-md-5">
        <div class="form-group">
            <label for="setor">Sindicato*</label>
            {!! Form::select('sindicato',$sindicatos, old('sindicato'), ['class'=>'form-control','id'=>'sindicato']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group" id="boxCategoriaSindicatos">
            <label for="setor">Categoria do sindicato*</label>
            {!! Form::select('categoria_sindicato',$categoria_sindicatos, old('categoria_sindicato'), ['class'=>'form-control','id'=>'categoria_sindicato']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="profissao">Profissão</label>
            {!! Form::text('profissao',null,['class'=>'form-control','id'=>'profissao']) !!}
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="form-group col-md-12"> <center>
        {!! Form::submit('SALVAR',['class'=>'genric-btn primary']) !!}
        <a href="{{route('empresa-trabalhadores.index')}}" class='btn btn-default'>Voltar</a></center>
    </div> 
</div>