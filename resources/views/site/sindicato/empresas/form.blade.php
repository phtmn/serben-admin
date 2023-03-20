 <hr>
 <div class="row">
     <div class="col-md-6">
        <div class="form-group">
            <label for="full_name">Razao Social*</label>
            {!! Form::text('razao_social',null,['class'=>'form-control', 'id'=>'razao_social']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="full_name">Nome Fantasia</label>
            {!! Form::text('nome_fantasia',null,['class'=>'form-control', 'id'=>'nome_fantasia']) !!}
        </div>
    </div>
</div>


 <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="birth_date">CNPJ*</label>
            {!! Form::text('cnpj',null,['class'=>'form-control','id'=>'cnpj']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="birth_date">CNAE*</label>
            {!! Form::text('cnae',null,['class'=>'form-control','id'=>'cnae']) !!}
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group">
            <label for="birth_date">Atividade*</label>
            {!! Form::text('atividade_empresa',null,['class'=>'form-control','id'=>'atividade_empresa']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="birth_date">QTD. de funcionários</label>
            {!! Form::text('numero_funcionarios',null,['class'=>'form-control','id'=>'numero_funcionarios']) !!}
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="setor">Categoria do sindicato*</label>
            {!! Form::select('categoria_sindicato',$categoria_sindicatos, old('categoria_sindicato'), ['class'=>'form-control','id'=>'categoria_sindicato']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="rua">CEP*</label>
            {!! Form::text('cep',null,['class'=>'form-control','id'=>'cep']) !!}
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="logo">Rua*</label>
            {!! Form::text('rua',null,['class'=>'form-control','id'=>'rua']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="numero">Número</label>
            {!! Form::text('numero',null,['class'=>'form-control','id'=>'numero']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="logo">Complemento</label>
            {!! Form::text('complemento',null,['class'=>'form-control','id'=>'complemento']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="logo">Bairro*</label>
            {!! Form::text('bairro',null,['class'=>'form-control','id'=>'bairro']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="logo">Cidade*</label>
            {!! Form::text('cidade',null,['class'=>'form-control','id'=>'cidade']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="logo">Estado*</label>
            {!! Form::text('uf',null,['class'=>'form-control','id'=>'uf']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 1">Telefone 1*</label>
            {!! Form::text('empresa_telefone_1',null,['class'=>'form-control','id'=>'empresa_telefone_1']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 2">Telefone 2</label>
            {!! Form::text('empresa_telefone_2',null,['class'=>'form-control','id'=>'empresa_telefone_2']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">E-mail para avisos mensais*</label>
            {!! Form::text('email_para_avisos_mensais',null,['class'=>'form-control','id'=>'email_para_avisos_mensais']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">E-mail para contabilidade</label>
            {!! Form::text('email_para_contabilidade',null,['class'=>'form-control','id'=>'email_para_contabilidade']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">Nome do responsável*</label>
            {!! Form::text('responsavel_nome',null,['class'=>'form-control','id'=>'responsavel_nome']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="birth_date">CPF*</label>
            {!! Form::text('responsavel_cpf',null,['class'=>'form-control','id'=>'responsavel_cpf']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">E-mail*</label>
            {!! Form::text('responsavel_email',null,['class'=>'form-control','id'=>'responsavel_email']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="email">Senha*</label>
            {!! Form::password('responsavel_password', ['class'=>'form-control','id'=>'responsavel_password']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 1">Telefone 1*</label>
            {!! Form::text('responsavel_telefone_1',null,['class'=>'form-control','id'=>'responsavel_telefone_1']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 2">Telefone 2*</label>
            {!! Form::text('responsavel_telefone_2',null,['class'=>'form-control','id'=>'responsavel_telefone_2']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="setor">Setor*</label>
            {!! Form::select('responsavel_setor',$setores, old('responsavel_setor'),
            ['class'=>'form-control','id'=>'responsavel_setor']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="telefone 2">Firma de contabilidade</label>
            {!! Form::text('firma_contabilidade',null,['class'=>'form-control','id'=>'firma_contabilidade']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="telefone 2">CNPJ</label>
            {!! Form::text('contabilidade_cnpj',null,['class'=>'form-control','id'=>'contabilidade_cnpj']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="rua">CEP</label>
            {!! Form::text('contabilidade_cep',null,['class'=>'form-control','id'=>'contabilidade_cep']) !!}
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="logo">Rua</label>
            {!! Form::text('contabilidade_rua',null,['class'=>'form-control','id'=>'contabilidade_rua']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="numero">Número</label>
            {!! Form::text('contabilidade_numero',null,['class'=>'form-control','id'=>'contabilidade_numero']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="logo">Complemento</label>
            {!! Form::text('contabilidade_complemento',null,['class'=>'form-control','id'=>'contabilidade_complemento']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="logo">Bairro</label>
            {!! Form::text('contabilidade_bairro',null,['class'=>'form-control','id'=>'contabilidade_bairro']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="logo">Cidade</label>
            {!! Form::text('contabilidade_cidade',null,['class'=>'form-control','id'=>'contabilidade_cidade']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="logo">Estado</label>
            {!! Form::text('contabilidade_uf',null,['class'=>'form-control','id'=>'contabilidade_uf']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">Nome do responsável</label>
            {!! Form::text('contador_nome',null,['class'=>'form-control','id'=>'contador_nome']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="birth_date">CPF</label>
            {!! Form::text('contador_cpf',null,['class'=>'form-control','id'=>'contador_cpf']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date">E-mail</label>
            {!! Form::text('contador_email',null,['class'=>'form-control','id'=>'contador_email']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="email">Senha</label>
            {!! Form::password('contador_password', ['class'=>'form-control','id'=>'contador_password']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 1">Telefone 1</label>
            {!! Form::text('contador_telefone_1',null,['class'=>'form-control','id'=>'contador_telefone_1']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="telefone 2">Telefone 2</label>
            {!! Form::text('contador_telefone_2',null,['class'=>'form-control','id'=>'contador_telefone_2']) !!}
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="setor">Setor</label>
            {!! Form::select('contador_setor',$setores, old('contador_setor'),
            ['class'=>'form-control','id'=>'contador_setor']) !!}
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="form-group col-md-12">
     <center>   {!! Form::submit('SALVAR',['class'=>'genric-btn primary']) !!}
        <a href="{{route('sindicato-empresas.index')}}" class='btn btn-default'>Voltar</a> </center>
    </div>
</div>