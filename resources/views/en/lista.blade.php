@extends('en.welcome')

@section('title', 'API Restfull - Users')

@section('title_content','Users List')

@section('conteudo') 
<div class="flex-center position-ref full-height col-sm-12 col-md-12 col-lg-12">
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

        <div class="alert {{ $class }} col-sm-12 col-md-12 col-lg-12">
            <h3><b>{{ $ttlMsg }}</b></h3><br>
            <!--{!! html_entity_decode(Session::get('mensagem')) !!}-->
            {!! html_entity_decode($msg) !!}
        </div>
    @endif <!-- Verificando se exite a variavel mensagem (Flash Message) END -->
    
    <div class="content col-sm-12 col-md-12 col-lg-12">
        <span class="col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="/users/user" class="btn btn-primary">New Register</a>
        </span> 
        
        
        <div class="links">
            <table class="table table-striped">
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Birthday
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Active
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>            
                
                @foreach($listUsers as $data)
                    <tr>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                            {{ $data->birth }}
                        </td>
                        <td>
                            {{ $data->email }}
                        </td>                      
                        <td>
                            {{ $data->phone }}
                        </td>                      
                        <td>
                            {{ $data->active==1 ? "Active" : "Inactive" }}
                        </td>                      
                        <td>
                            <a class="btn btn-round btn-info" href="/users/user/{{ $data->id }}">Edit</a>
                            
                            {!! Form::model($data, ['method'=>'post', 'url'=>'users/user/'.$data->id]) !!}
                                 {{ method_field('DELETE') }}
                                 {!! Form::button('Delete',['class'=>'btn btn-round btn-danger','onclick'=>'if(confirm("Are you sure that you want to DELETE this register?"))submit();']) !!}
                            {!! Form::close() !!}
                        </td>                      
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection