@extends('en.welcome')

@section('title', 'API Restfull - USER Detail')

@section('title_content', 'User Form')

<!--Styles-->
<link href="/css/veiculos/detalhe.css" rel="stylesheet" />


@section('conteudo') 
<div class="full-height col-sm-12 col-md-12 col-lg-12">
    
    <span class="col-sm-12 col-md-12 col-lg-12 text-center">
        <a href="/users/user" class="btn btn-primary">Clean all Fields / New Register</a>
    </span> 
    
    
    <div class="content col-sm-12 col-md-12 col-lg-12">
        @if(!empty($msg))  <!-- Verificando se exite a variavel mensagem (Flash Message)-->
            <!--Definindo o tipo da Mesnagem-->
            @if($tpMsg==1)
                @php
                    $class  = 'alert-danger';
                    $ttlMsg = html_entity_decode('Attention!');
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
            <h1 class="section-header">User New/Detail</h1>          

            @if (empty($userData))
                {!! Form::open(['method'=>'POST','url'=>'/users/new']) !!}               
            @else
                {!! Form::model($userData, ['method'=>'put', 'url'=>'users/detail'.$userData->id]) !!}
            @endif

            <!--Form Parte 1-->
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <!--Name-->
                <div class="form-group">
                    {!! Form::label('name', 'Name', ['class' => '']) !!}
                    {!! Form::text('name',(empty($userData)?null:$userData->name),['placeholder'=>'Fill with the NAME','class'=>'form-control']) !!}
                </div><!--Name END-->
                
                 <!--Birthday-->
                <div class="form-group">
                    {!! Form::label('birthday', 'Birthday', ['class' => '']) !!}
                    {!! Form::text('birthday',(empty($userData)?null:$userData->Birthday),['placeholder'=>'Fill with the BIRTHDAY','class'=>'form-control']) !!}
                </div><!--Birthday END-->
            </div><!--Form Parte 1 END-->

            <!--Form Parte 2-->
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <!--Phone-->
                <div class="form-group">
                    {!! Form::label('phone', 'Phone', ['class' => '']) !!}
                    {!! Form::text('phone',(empty($userData)?null:$userData->phone),['placeholder'=>'Fill with the PHONE NUMBER','class'=>'form-control']) !!}
                </div><!--Phone END-->
                
                <!--Email-->
                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => '']) !!}
                    {!! Form::text('email',(empty($userData)?null:$userData->email),['placeholder'=>'Fill with the EMAIL','class'=>'form-control']) !!}
                </div><!--Email END-->
            </div><!--Form Parte 2 END-->

            <div class="col-sm-12 col-md-12 col-lg-12">
                @if(empty($userData))
                    <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                        {!! Form::submit('Save',['class'=>'btn btn-round btn-success submit']) !!}
                    </div>
                @else        
                    <div class="form-check text-left col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('active', 'Account Settings', ['class' => 'form-check-label']) !!}
                        {!! Form::select('active', array('1' => 'Active', '2' => 'Inactive'),(empty($dadosVeiculo)?1:($dadosVeiculo->vendido==2?true:false)),['class'=>'form-check-input']) !!}
                    </div>     
                
                    <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                        {!! Form::submit('Update',['class'=>'btn btn-round btn-warning submit']) !!}
                    </div>
                @endif
            </div>
            {!! Form::close() !!}
        </div><!--Form END-->             
    </div><!--content END--> 
</div><!--Page END--> 
@endsection