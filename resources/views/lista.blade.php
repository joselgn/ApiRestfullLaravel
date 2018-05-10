@extends('welcome')

@section('title', 'API Restfull - Lista de Veículos')

@section('titulo_conteudo', 'Lista de Veículos')

@section('conteudo') 
<div class="flex-center position-ref full-height col-sm-12 col-md-12 col-lg-12">
    <div class="content col-sm-12 col-md-12 col-lg-12">
        <span class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="/novo" class="btn btn-primary">Novo Registro</a>
        </span> 
        
        
        <div class="links">
            <table class="table table-striped">
                <tr>
                    <th>
                        Marca
                    </th>
                    <th>
                        Modelo
                    </th>
                    <th>
                        Ano
                    </th>
                    <th>
                        Descriç&atilde;o
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>            
                
                @foreach($listaVeiculos as $dados)
                    <tr>
                        <td>
                            {{ $dados->marca }}
                        </td>
                        <td>
                            {{ $dados->veiculo }}
                        </td>
                        <td>
                            {{ $dados->ano }}
                        </td>                      
                        <td>
                            {{ $dados->descricao }}
                        </td>                      
                        <td>
                            {{ $dados->vendido==1 ? "-" : "Vendido" }}
                        </td>                      
                        <td>
                            <a class="btn btn-round btn-info" href="/veiculos/{{ $dados->id }}">Editar</a>
                            
                            {!! Form::model($dados, ['method'=>'delete', 'url'=>'veiculos/'.$dados->id]) !!}
                                <input type="submit" class="btn btn-round btn-danger " value="Excluir"/>
                            {!! Form::close() !!}
                        </td>                      
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection