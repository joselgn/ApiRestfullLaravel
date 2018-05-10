@extends('welcome')

@section('title', 'API Restfull - Erro 404')

@section('titulo_conteudo', 'Erro encontrado')
        
@section('conteudo') 
<!--<div class="flex-center position-ref full-height">-->
<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="alert alert-danger text-center">
        <h3>Erro ao processar requisiç&atilde;o</h3>
          @if(!empty($msg))
            {!! html_entity_decode($msg) !!}
          @else
            <b>P&aacute;gina n&atilde;o encontrada!!!</b> 
          @endif
    </div>
</div>        
@endsection