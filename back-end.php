<?php

// Include a conexao BD



// echo json_encode($retorna);



/*
* 
* capturando dados do fron-end form
*/
// STR_TO_DATE(str,format)

// POST Data
$data['nome'] = $_POST['nome'];
$data['data_nascimento'] = $_POST['data_nascimento'];
$data['email'] = $_POST['email'];
$data['telefone'] = $_POST['telefone'];
$data['regiao'] = $_POST['regiao'];
$data['unidade'] = $_POST['unidade'];
 
// return json_encode($data);
echo json_encode($data);
include_once "db.php";

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    $query_usuario = "INSERT INTO leads (nome, data_nascimento, email, telefone, regiao, unidade) VALUES (:nome, :data_nascimento, :email, :telefone, :regiao, :unidade )";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $data['nome']);
    $cad_usuario->bindParam(':data_nascimento', $data['data_nascimento']);
    $cad_usuario->bindParam(':email', $data['email']);
    $cad_usuario->bindParam(':telefone', $data['telefone']);
    $cad_usuario->bindParam(':regiao', $data['regiao']);
    $cad_usuario->bindParam(':unidade', $data['unidade']);
    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<p style='color: green;'>Usuário cadastrado com sucesso!</p>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>"];
    }    
