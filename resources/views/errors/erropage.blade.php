@extends('welcome')

@section('title', 'API Restfull - Erro')

@section('titulo_conteudo', 'Erro encontrado')
        
@section('conteudo') 
<!--<div class="flex-center position-ref full-height">-->
<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="alert alert-danger">
        <h3>Erro ao processar requisiçao</h3>
          @if(!empty($msg))
            {!! html_entity_decode($msg) !!}
          @else
          <b>Erro n&atilde;o identificado!!!</b> 
          @endif
    </div>
</div>        
@endsection