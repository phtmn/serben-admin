
    <div class="form-group">
        <label for="responsavel_acesso">Responsável pelo acesso*</label>
        {!! Form::text('responsavel_acesso',null,['class'=>'form-control','id'=>'responsavel_acesso']) !!}
    </div>

    <div class="form-group">
        <label for="telefone 1">Telefone 1*</label>
        {!! Form::text('responsavel_acesso_telefone_1',null,['class'=>'form-control','id'=>'responsavel_acesso_telefone_1']) !!}
    </div>

    <div class="form-group">
        <label for="telefone 2">Telefone 2</label>
        {!! Form::text('responsavel_acesso_telefone_2',null,['class'=>'form-control','id'=>'responsavel_acesso_telefone_2']) !!}
    </div>

    <div class="form-group">
        <label for="email">E-mail*</label>
        {!! Form::text('responsavel_acesso_email',null,['class'=>'form-control','id'=>'responsavel_acesso_email']) !!}
    </div>

    <div class="form-group">
        <label for="email">Senha*</label>
        {!! Form::password('responsavel_acesso_password', ['class'=>'form-control','id'=>'responsavel_acesso_password']) !!}
    </div>
