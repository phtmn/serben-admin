@extends('admin.layouts.template.admin')
@section('content-header')
    <h1>
       Cobranças
    
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cobranças</li>
    </ol>

@stop
@section('content')
    @include('messages.msg')

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ number_format($confirmadas,2,',','.')}}</h3>

                    <p>Confirmadas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-inbox"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ number_format($enviadas,2,',','.')}}</h3>

                    <p>Geradas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-right"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ number_format($pagas,2,',','.')}}</h3>

                    <p>Pagas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->

    </div>
<div class="box">
    <div class="box-body">
        <button type="button" class="btn bg-purple btn-flat" data-toggle="modal" data-target="#modal-default">
            Incluir Cobrança
        </button>
        <button class="btn bg-orange btn-flat" data-toggle="modal" data-target="#modal-retorno">
            Processar Arquivo de Retorno
            <i class="fa fa-arrow-down"></i>
        </button>

        <a href="{{ route('remessa') }}" class="btn bg-purple btn-flat">
            Gerar Remessa de Cobranças
            <i class="fa fa-arrow-up"></i>
        </a>
        <br><br>

        <table class="table table-bordered table-hover" id="table">
            <thead>
            <tr>
                <th>Razao Social</th>
                <th>Valor (RS)</th>
                <th>Situacao</th>
                <th>Data Ocorrencia</th>
                <th>Data Credito</th>
                <th>Valor do Credito</th>

                <th></th>

            </tr>
            </thead>
            <tbody>
            @forelse($data as $d)
                <tr>
                    <td>{{$d->empresa->razao_social}}</td>
                    <td>{{$d->valor_cobranca}}</td>
                    <td>{{$d->ocorrenciaDescricao}}</td>
                    <td>{{$d->data_ocorrencia}}</td>
                    <td>{{$d->data_credito}}</td>
                    <td>{{$d->valor_recebido}}</td>

                    <td>
                        <a href="{{route('boleto',$d->id)}}" class="btn btn-xs btn-success"><i class="fa fa-send-o"></i> Boleto</a>
                        <a href="{{route('cobrancas.show',$d->id) }}" class="btn bg-purple btn-flat btn-xs"><i class="fa fa-eye"></i> </a>
                    </td>
                </tr>
            @empty
                <p>Não existem dados</p>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modals -->

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cobrança Manual</h4>
              </div>
              <div class="modal-body">
                    {!! Form::open(['route'=>'cobrancas.store','method'=>'POST']) !!}
                        <div class="form-group">
                            <label for="Empresa">Empresa</label>
                            {!! Form::select('empresa_id',$empresas, null,
                            ['class'=>'form-control','required'=>'true']) !!}
                        </div>

                        <div class="form-group">
                            <label for="">Data Vencimento</label>
                            {!! Form::date('data_cobranca',null,['class'=>'form-control']) !!}
                        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Gerar Cobrança</button>
                    {!! Form::close() !!}
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    <div class="modal fade" id="modal-retorno">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Processar Retorno</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=>'retorno','method'=>'POST','enctype'=>"multipart/form-data"]) !!}
                    <div class="form-group">
                        <label for="Empresa">Selecione o Arquivo de retorno .RET</label>
                      {!! Form::file('retorno',null,['class'=>'form-control']) !!}
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Processar</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@stop

@section('js')
    <script>
        $(function(){
           $('#table').DataTable();
        });
    </script>
@stop