<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

//Setando as Models a serem utilizadas
use App\User;

class UserController extends Controller
{
    //Index - Manual
    public function index(){
        return view('en.manual');
    }//index - Manual
    
    //List of users
    public function lista($msg='',$tpMsg=0){
        $modelUsers = new User();
        $listUsers = $modelUsers->all();
        
        return view('en.lista',array('listUsers'=>$listUsers,'tpMsg'=>$tpMsg,'msg'=>$msg));        
    }//lista
    
    //User new/update Panel
    public function userform($msg='',$tpMsg=0){
        return view('en.form',array('userData'=>null,'tpMsg'=>$tpMsg,'msg'=>$msg));
    }//User new/update Panel
    
    //Adding new user
    public function addnew(Request $request){
        $tpMsg =0;
        $msg='';
        $id='';
        $userData = '';
        
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
            //Instance of new User
            $newUser = new User();           
            
            //Set values to the new element
            $newUser->name = $request->name;
            $newUser->email=$request->email;
            $newUser->phone=$request->phone;
            $newUser->birthday=$this->__dateToDb($request->birthday);
            
            
            echo '<pre/>';
            var_dump($newUser);
            
            exit;
            
            
//            
//            //Salvando dados
//            if($novoVeiculo->save()){
//                $tpMsg=2;
//                $id = $novoVeiculo->id;    
//                $msg = '3';
//                
//                //$this->detalhe($id, $tpMsg, $msg);
//                return redirect('/veiculos/'.$id.'/'.$tpMsg.'/'.$msg);
//            }else{
//                $tpMsg = 1;
//                $msg = 'Nao foi possivel salvar os dados do registro.';
//            }//if / else sanvalndo dados            
        }//if / else
                
        return view('en.form',array('id'=>$id,'userData'=>$userData,'tpMsg'=>$tpMsg,'msg'=>$msg)); 
    }//Add new user
    
    
    
    
    
    
    
    
    
    
    
     /************************************************************************************\
     * Internal Functions
    /*************************************************************************************/
    //Validate Rules of input
    private function _rules(){
        //Kinds of Validation
        return [
            'name'     => 'bail|required|min:5|max:250|regex:/^[\pL\s\-]+$/u',
            'birthday' => 'bail|required|date_format:d/m/Y',
            'phone'    => 'bail|required|digits_between:8,14',
            'email'    => 'bail|required|min:5|max:255|email',
        ];
    }//rules
    
    //Validate messages
    private function _rulesMessages(){
        //Mensagens de Validaçao
        return [
            //Input Name
            'name.required' => '- The field <b>NAME</b> is required!',
            'name.min'      => '- The field <b>NAME</b> must have 5 characters minimum!',
            'name.max'      => '- The field <b>NAME</b> must have 250 characters maximum!',
            'name.regex'    => '- The field <b>NAME</b> may only contain letters and space!',
            
            //Input BIRTHDAY            
            'birthday.required'    => '- The field <b>BIRTHDAY</b> is required!',
            'birthday.date_format' => '- The format of the field <b>BIRTHDAY</b> should be dd/MM/YYYY!',
            
            //Input PHONE            
            'phone.required'       => '- The field <b>PHONE</b> is required!',
            'phone.digits_between' => '- The field <b>PHONE</b> must have between 8 - 14 digits!',
            
            //Input EMAIL            
            'email.required' => '- The field <b>EMAIL</b> is required!',
            'email.email'    => '- The field <b>EMAIL</b> is invalid address, please verify!',
            'email.min'      => '- The field <b>EMAIL</b> must have 5 characters minimum!',
            'email.max'      => '- The field <b>EMAIL</b> must have 255 characters maximum!',
        ];
    }//rules message
    
    
}//Class User
