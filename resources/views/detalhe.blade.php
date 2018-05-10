@extends('welcome')

@section('title', 'API Restfull - Detalhes do Veículos')

@section('titulo_conteudo', 'Detalhes Veículo')

<!--Styles-->
<link href="/css/veiculos/detalhe.css" rel="stylesheet" />


@section('conteudo') 
<div class="full-height col-sm-12 col-md-12 col-lg-12">
    
    <span class="col-sm-12 col-md-12 col-lg-12 text-center">
        <a href="/novo" class="btn btn-primary">Novo Registro</a>
    </span> 
    
    
    <div class="content col-sm-12 col-md-12 col-lg-12">
        @if(!empty($msg))  <!-- Verificando se exite a variavel mensagem (Flash Message)-->
            <!--Definindo o tipo da Mesnagem-->
            @if($tpMsg==1)
                @php
                    $class  = 'alert-danger';
                    $ttlMsg = html_entity_decode('Atenç&atilde;o!');
                @endphp                    
            @else
                @php
                    $class  = 'alert-success';
                    $ttlMsg = '';
                @endphp                    
            @endif
            
            @if($msg==3)
                @php
                    $msg = 'Registro cadastrado com sucesso'; 
                @endphp
            @endif
            
            <div class="alert {{ $class }} col-sm-12 col-md-12 col-lg-12">
                <h3><b>{{ $ttlMsg }}</b></h3><br>
                <!--{!! html_entity_decode(Session::get('mensagem')) !!}-->
                {!! html_entity_decode($msg) !!}
            </div>
        @endif <!-- Verificando se exite a variavel mensagem (Flash Message) END -->
        
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="section-header">Dados do Ve&iacute;culo</h1>          

            @if (empty($dadosVeiculo))
                {!! Form::open(['method'=>'POST','url'=>'/veiculos']) !!}               
            @else
                {!! Form::model($dadosVeiculo, ['method'=>'put', 'url'=>'veiculos/'.$dadosVeiculo->id]) !!}
            @endif

            <!--Form Parte 1-->
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <!--Marca-->
                <div class="form-group">
                    {!! Form::label('marca', 'Marca do Ve&iacute;culo', ['class' => '']) !!}
                    {!! Form::text('marca',(empty($dadosVeiculo)?null:$dadosVeiculo->marca),['placeholder'=>'Informe a marca do veiculo','class'=>'form-control']) !!}
                </div><!--Marca END-->

                <!--Veiculo-->
                <div class="form-group">
                    {!! Form::label('veiculo', 'Modelo do Ve&iacute;culo', ['class' => '']) !!}
                    {!! Form::text('veiculo',(empty($dadosVeiculo)?null:$dadosVeiculo->veiculo),['placeholder'=>'Informe o modelo do veiculo','class'=>'form-control']) !!}
                </div><!--Veiculo END-->

                <!--Ano-->
                <div class="form-group">
                    {!! Form::label('ano', 'Ano do Ve&iacute;culo', ['class' => '']) !!}
                    {!! Form::text('ano',(empty($dadosVeiculo)?null:$dadosVeiculo->ano),['placeholder'=>'Informe o ano do veiculo','class'=>'form-control']) !!}
                </div><!--Ano END-->
            </div><!--Form Parte 1 END-->

            <!--Form Parte 2-->
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <!--Descricao-->
                <div class="form-group">
                    {!! Form::label('descricao', 'Descriç&atilde;o', ['class' => '']) !!}
                    {!! Form::textarea('descricao',(empty($dadosVeiculo)?null:$dadosVeiculo->descricao),['placeholder'=>'Informe demais caracteristicas do veiculo','class'=>'form-control','style'=>'width:100%']) !!}
                </div><!--Descricao END-->
            </div><!--Form Parte 2 END-->

            <div class="col-sm-12 col-md-12 col-lg-12">
                @if(empty($dadosVeiculo))
                    <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                        {!! Form::submit('Cadastrar',['class'=>'btn btn-round btn-success submit']) !!}
                    </div>
                @else        
                    <div class="form-check text-left col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('vendido', 'Veiculo Vendido', ['class' => 'form-check-label']) !!}
                        {!! Form::checkbox('vendido',(empty($dadosVeiculo)?1:($dadosVeiculo->vendido==2?true:false)), ['class'=>'form-check-input']) !!}
                    </div>     
                
                    <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                        {!! Form::submit('Editar',['class'=>'btn btn-round btn-warning submit']) !!}
                    </div>
                @endif
            </div>
            {!! Form::close() !!}
        </div><!--Form END-->             
    </div><!--content END--> 
</div><!--Page END--> 
@endsection