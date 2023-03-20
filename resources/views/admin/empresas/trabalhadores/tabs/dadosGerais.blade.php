<div class="row">
    <div class="form-group col-md-4">
        <label for="nome">Nome Completo*</label>
        {!! Form::text('nome',
        isset($trabalhador) ? $trabalhador->nome : null,
        ['class'=>'form-control','id'=>'nome']) !!}
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF*</label>
        {!! Form::text('cpf',
        isset($trabalhador) ? $trabalhador->cpf : null,
        ['class'=>'form-control','id'=>'cpf']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="rg">RG*</label>
        {!! Form::text('rg',
        isset($trabalhador) ? $trabalhador->rg : null,
        ['class'=>'form-control','id'=>'rg']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="setor">Sexo*</label>
        {!! Form::select('sexo',['M' => 'Masculino', 'F' => 'feminino'],
        isset($trabalhador) ? $trabalhador->sexo : null,
        ['class'=>'form-control','id'=>'sexo']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label for="data_nascimento">Data de nascimento*</label>
        {!! Form::date('data_nascimento',
        isset($trabalhador->data_nascimento) ? $trabalhador->data_nascimento->format('Y-m-d') : null,
        ['class'=>'form-control','id'=>'data_nascimento']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="profissao">Profissão*</label>
        {!! Form::text('profissao',
        isset($trabalhador) ? $trabalhador->profissao : null,
        ['class'=>'form-control','id'=>'profissao']) !!}
    </div>
    <div class="form-group col-md-3">
        <label for="setor">Sindicatos*</label>
        {!! Form::select('sindicato',$sindicatos,
        isset($sindicato_cadastro) ? $sindicato_cadastro->id : null,
        ['class'=>'form-control','id'=>'sindicato']) !!}
    </div>

    <div class="form-group col-md-3" id="boxCategoriaSindicatos">
        <label for="setor">Categorias*</label>
        {!! Form::select('categoria_sindicatos',$categoria_sindicatos,
        isset($categoria_cadastrada) ? $categoria_cadastrada->id : null,
        ['class'=>'form-control','id'=>'categoria_sindicatos']) !!}
    </div>

    <!--  -->
</div>

<div class="row">
    <div class="form-group col-md-3">
        <label for="email">Email*</label>
        {!! Form::text('email',
        isset($trabalhador) ? $trabalhador->email : null,
        ['class'=>'form-control','id'=>'email']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="password">Senha*</label>
        {!! Form::password('password', ['class'=>'form-control','id'=>'password']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="telefone_1">Telefone 1*</label>
        {!! Form::text('telefone_1',
        isset($trabalhador) ? $trabalhador->telefone_1 : null,
        ['class'=>'form-control','id'=>'telefone_1']) !!}
    </div>

    <div class="form-group col-md-3">
        <label for="telefone_2">Telefone 2</label>
        {!! Form::text('telefone_2',
        isset($trabalhador) ? $trabalhador->telefone_2 : null,
        ['class'=>'form-control','id'=>'telefone_2']) !!}
    </div>
</div>