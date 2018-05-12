<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

//Setando as Models a serem utilizadas
use App\Veiculo;

class IndexController extends Controller
{
    //Index
     public function index($msg='',$tpMsg=0){
        $modelVeiculo = new Veiculo();
        $listaVeiculos = $modelVeiculo->all();
        
        return view('lista',array('listaVeiculos'=>$listaVeiculos,'tpMsg'=>$tpMsg,'msg'=>$msg));
    }//index
    
    //Detalhe
    //$tpMsg = 0-N/i / 1-Erro / 2-Sucesso
    public function detalhe($id,$tpMsg=0,$msg=''){
        $modelVeiculo = new Veiculo();
        $dadosVeiculo = $modelVeiculo->findOrFail(['id'=>$id])->first();
      
        return view('detalhe',array('id'=>$id,'dadosVeiculo'=>$dadosVeiculo,'tpMsg'=>$tpMsg,'msg'=>$msg));
    }//detalhe
    
    
    //Novo CADASTRO - Tela
    public function novo(){
        return view('detalhe',array('id'=>'','dadosVeiculo'=>'','tpMsg'=>0,'msg'=>''));
    }//Novo CADASTRO - Tela
    
    //Novo  CADASTRO - Dados
    public function cadastrar(Request $request){
        $dadosVeiculo = '';
        $id='';
        $msg='';
        $tpMsg=0;
        
        //Fazendo a validaçao dos dados
        $validation = validator($request->all(),$this->_rules(),$this->_rulesMessages());
                    
        //Verificando se possui erros na validaçao
        if($validation->fails()){
            $tpMsg=1;
            //Tratando retorno dos erros - Mensagens Personalizadas
            $verifErros = $validation->errors();
            foreach ($verifErros->messages() as $errosArray){                    
                foreach($errosArray as $erroStr){
                     $msg .= trim($erroStr).' <br> ';
                }//foreach msgs erros
            }//foreach valida erross
        }else{
            //Recupera o ultimo registro incluido
            $novoVeiculo = new Veiculo();
            
            //Setando os dados para registro do novo veiculo
            //Dados a serem inseridos
            $novoVeiculo->marca = $request->marca;
            $novoVeiculo->veiculo=$request->veiculo;
            $novoVeiculo->ano=$request->ano;
            $novoVeiculo->vendido=isset($request->vendido) ? $request->vendido : 1;
            $novoVeiculo->descricao=$request->descricao;
            
            //Salvando dados
            if($novoVeiculo->save()){
                $tpMsg=2;
                $id = $novoVeiculo->id;    
                $msg = '3';
                
                //$this->detalhe($id, $tpMsg, $msg);
                return redirect('/veiculos/'.$id.'/'.$tpMsg.'/'.$msg);
            }else{
                $tpMsg = 1;
                $msg = 'Nao foi possivel salvar os dados do registro.';
            }//if / else sanvalndo dados            
        }//validando dados 
                
        return view('detalhe',array('id'=>$id,'dadosVeiculo'=>$dadosVeiculo,'tpMsg'=>$tpMsg,'msg'=>$msg));        
    }//Novo  CADASTRO - Dados
    
    //Editando dados
    public function editar(Request $request){
        //variaveis de controle
        $msg='';
        $tpMsg=0;
        
        //Verificando dados atuais do registo
        $modelVeiculo = new Veiculo();
        $dadosVeiculo = $modelVeiculo->findOrFail(['id'=>$request->id])->first();
        
        //Valida dados
         //Fazendo a validaçao dos dados
        $validation = validator($request->all(),$this->_rules(),$this->_rulesMessages());
                    
        //Verificando se possui erros na validaçao
        if($validation->fails()){
            $tpMsg=1;
            //Tratando retorno dos erros - Mensagens Personalizadas
            $verifErros = $validation->errors();
            foreach ($verifErros->messages() as $errosArray){                    
                foreach($errosArray as $erroStr){
                     $msg .= trim($erroStr).' <br> ';
                }//foreach msgs erros
            }//foreach valida erross
        }else{
            //Setando as alteraçoes
            $dadosVeiculo->veiculo   = $request->veiculo;
            $dadosVeiculo->descricao = $request->descricao;
            $dadosVeiculo->marca     = $request->marca;
            $dadosVeiculo->ano       = $request->ano;
            $dadosVeiculo->vendido   = isset($request->vendido) ? $request->vendido:1;
            
            //Editando
            if($dadosVeiculo->save()){
                $msg = 'Registro atualizado com sucesso.';
                $tpMsg = 2;
            }else{
                $msg = 'Falha ao atualizar os dados do registro.';
                $tpMsg = 1;
            }//if / else ediçao registro            
        }//if / else 
        
        return view('detalhe',array('id'=>$dadosVeiculo->id,'dadosVeiculo'=>$dadosVeiculo,'tpMsg'=>$tpMsg,'msg'=>$msg));
    }//editando dados
    
    //Excluindo dados
    public function excluir($id){
        //variaveis de controle
        $msg='';
        $tpMsg=0;
        
        //Verificando dados atuais do registo
        $modelVeiculo = new Veiculo();
        $dadosVeiculo = $modelVeiculo->findOrFail(['id'=>$id])->first();
        
        //Deletando registro
        if($dadosVeiculo->count() > 0){
            if($dadosVeiculo->delete()){
                $tpMsg = 2;
                $msg='Registro excluido com sucesso.';
            }else{
                $tpMsg = 1;
                $msg='Erro ao excluir o registro.';
            }//if / else delete gregistro
        }else{
            $tpMsg = 1;
            $msg='Dados de registro nao encontrados para excluir.';
        }//if / else count registro
               
        $listaVeiculos = $modelVeiculo->all();        
        return view('lista',array('listaVeiculos'=>$listaVeiculos,'tpMsg'=>$tpMsg,'msg'=>$msg));
    }//Excluir um registro
    
    
    /*
     * FUNÇOES RELATIVAS A API - JSON
     */
    //Listando todos os registros
     public function apiindex($msg='',$tpMsg=0){
        $modelVeiculo = new Veiculo();
        $listaVeiculos = $modelVeiculo->all();
        
        $json = new JsonResponse(array('total'=>$listaVeiculos->count(),'listaVeiculos'=>$listaVeiculos,'tpMsg'=>$tpMsg,'msg'=>$msg));
        return $json;        
    }//index
    
    //Cadastrando novo Registro - API
    public function apicadastrar(Request $request){
        $dadosVeiculo = '';
        $id='';
        $msg='';
        $tpMsg=0;
        
        //Fazendo a validaçao dos dados
        $validation = validator($request->all(),$this->_rules(),$this->_rulesMessages());
                    
        //Verificando se possui erros na validaçao
        if($validation->fails()){
            $tpMsg=1;
            //Tratando retorno dos erros - Mensagens Personalizadas
            $verifErros = $validation->errors();
            foreach ($verifErros->messages() as $errosArray){                    
                foreach($errosArray as $erroStr){
                     $msg .= trim($erroStr).' <br> ';
                }//foreach msgs erros
            }//foreach valida erross
        }else{
            //Recupera o ultimo registro incluido
            $novoVeiculo = new Veiculo();
            
            //Setando os dados para registro do novo veiculo
            //Dados a serem inseridos
            $novoVeiculo->marca = $request->marca;
            $novoVeiculo->veiculo=$request->veiculo;
            $novoVeiculo->ano=$request->ano;
            $novoVeiculo->vendido=isset($request->vendido) ? $request->vendido : 1;
            $novoVeiculo->descricao=$request->descricao;
            
            //Salvando dados
            if($novoVeiculo->save()){
                $tpMsg=2;
                $id = $novoVeiculo->id;    
                $msg = 'Novo registro incluido com sucesso.';
            }else{
                $tpMsg = 1;
                $msg = 'Nao foi possivel salvar os dados do registro.';
            }//if / else sanvalndo dados            
        }//validando dados 
                
        $json = new JsonResponse(array('id'=>$id,'dadosVeiculo'=>$dadosVeiculo,'tpMsg'=>$tpMsg,'msg'=>$msg));
        return $json;
    }//Novo  CADASTRO - Dados
    
    //Editando dados
    public function apieditar(Request $request){
        //variaveis de controle
        $msg='';
        $tpMsg=0;
        
        //Verificando dados atuais do registo
        $modelVeiculo = new Veiculo();
        $dadosVeiculo = $modelVeiculo->findOrFail(['id'=>$request->id])->first();
        
        //Valida dados
         //Fazendo a validaçao dos dados
        $validation = validator($request->all(),$this->_rules(),$this->_rulesMessages());
                    
        //Verificando se possui erros na validaçao
        if($validation->fails()){
            $tpMsg=1;
            //Tratando retorno dos erros - Mensagens Personalizadas
            $verifErros = $validation->errors();
            foreach ($verifErros->messages() as $errosArray){                    
                foreach($errosArray as $erroStr){
                     $msg .= trim($erroStr).' <br> ';
                }//foreach msgs erros
            }//foreach valida erross
        }else{
            //Setando as alteraçoes
            $dadosVeiculo->veiculo   = $request->veiculo;
            $dadosVeiculo->descricao = $request->descricao;
            $dadosVeiculo->marca     = $request->marca;
            $dadosVeiculo->ano       = $request->ano;
            $dadosVeiculo->vendido   = isset($request->vendido) ? $request->vendido:1;
            
            //Editando
            if($dadosVeiculo->save()){
                $msg = 'Registro atualizado com sucesso.';
                $tpMsg = 2;
            }else{
                $msg = 'Falha ao atualizar os dados do registro.';
                $tpMsg = 1;
            }//if / else ediçao registro            
        }//if / else 
        
        $json = new JsonResponse(array('id'=>$dadosVeiculo->id,'dadosVeiculo'=>$dadosVeiculo,'tpMsg'=>$tpMsg,'msg'=>$msg));
        return $json;
    }//editando dados api
    
     //Excluindo dados
    public function apiexcluir($id){
        //variaveis de controle
        $msg='';
        $tpMsg=0;
        
        //Verificando dados atuais do registo
        $modelVeiculo = new Veiculo();
        $dadosVeiculo = $modelVeiculo->findOrFail(['id'=>$id])->first();
        
        //Deletando registro
        if($dadosVeiculo->count() > 0){
            if($dadosVeiculo->delete()){
                $tpMsg = 2;
                $msg='Registro excluido com sucesso.';
            }else{
                $tpMsg = 1;
                $msg='Erro ao excluir o registro.';
            }//if / else delete gregistro
        }else{
            $tpMsg = 1;
            $msg='Dados de registro nao encontrados para excluir.';
        }//if / else count registro
        
        //retornando json
        $json = new JsonResponse(array('tpMsg'=>$tpMsg,'msg'=>$msg));
        return $json;
    }//Excluir um registro
    
    
    /************************************************************************************\
     * Funçoes Internas
    /*************************************************************************************/
    //Validaçao
    //Funçao de regras para validar inputs
    private function _rules(){
        //Tipos de Validaçao
        return [
            'marca' => 'bail|required|min:3|max:50',
            'veiculo' => 'bail|required|min:3|max:200',
            'ano' => 'bail|required|digits:4',
            'descricao' => 'bail|max:600',
        ];
    }//rules for login variables 
    
    //Funçao de mensagens de erros de validaçao
    private function _rulesMessages(){
        //Mensagens de Validaçao
        return [
            //Input Marca
            'marca.required' => '- O campo <b>MARCA</b> &eacute; de preenchimento obrigat&oacute;rio!',
            'marca.min' => '- O campo <b>MARCA</b> deve possuir o M&Iacute;NIMO de 3 caracteres',
            'marca.max' => '- O campo <b>MARCA</b> n&atilde;o deve exceder o M&Aacute;XIMO de 50 caracteres',
            
            //Input Veiculo            
            'veiculo.required' => '- O campo <b>MODELO do VEICULO</b> &eacute; de preenchimento obrigat&oacute;rio!',
            'veiculo.min' => '- O campo <b>MODELO do VEICULO</b> deve possuir o M&Iacute;NIMO de 3 caracteres',
            'veiculo.max' => '- O campo <b>MODELO do VEICULO</b> n&atilde;o deve exceder o M&Aacute;XIMO de 200 caracteres',
            
            //Input Veiculo            
            'ano.required' => '- O campo <b>ANO</b> &eacute; de preenchimento obrigat&oacute;rio!',
            'ano.digits' => '- O campo <b>ANO</b> deve possuir apenas numeros e conter exatamente 4 digitos!',
        ];
    }//rules message logins
    
    
}//class
