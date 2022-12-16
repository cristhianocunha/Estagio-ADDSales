<?php

// Include a conexao BD
include_once "db.php";

// Receber os dados enviado pelo JavaScript
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['nome'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>"];
}elseif(empty($dados['email'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>"];
}elseif(empty($dados['data_nascimento'])){
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Necessário preencher o campo situação!</p>"];
}else{

    $query_usuario = "INSERT INTO leads (nome, email, data_nascimento) VALUES (:nome, :email, :data_nascimento)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':email', $dados['email']);
    $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento']);
    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<p style='color: green;'>Usuário cadastrado com sucesso!</p>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>"];
    }    
}
echo json_encode($retorna);