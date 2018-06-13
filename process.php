<?php

$data = array();
$error = array();

if(isset($_POST['step']) || !empty($_POST['step'])){
    
    if($_POST['step']=="1"){
        
        if(empty($_POST['data']) || !isset($_POST['data'])){
            
            $error['email'] = 'E-mail é obrigatorio';
        } else {
            if(trim($_POST['data'])=="victormelo@id.uff.br"){
                $data['success'] =true;
                $data['email'] = "E-mail validado!";
            } else {
                
                $error['email'] = "E-mail invalido!";
            }
        }
    } elseif ($_POST['step']=="2") {
        if( empty($_POST['data']) || !isset($_POST['data']) ){
            $error['password'] = 'Senha incorreta!';
        } else {
            if(trim($_POST['data'])=="37076149"){
                $data['success'] =true;
                $data['password'] = "Senha validado!";
            } else {
                $error['password'] = "Senha invalido!";
            }
        }
    }
} else {
    $error['default'] = 'Verifique os campos informados!';
}

if(!empty($error)){
    $data['success'] = false;
    $data['errors'] = $error;
} else {
    $data['success'] = true;
    $data['message'] = "Success";
}


echo json_encode($data);