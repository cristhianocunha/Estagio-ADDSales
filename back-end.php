<?php
    
 

// Include a conexao BD
include_once "db.php";

// Receber os dados enviado pelo JavaScript
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);



    $query_usuario = "INSERT INTO leads (nome, email, data_nascimento, telefone, email, regiao, unidade) VALUES (:nome, :email, :data_nascimento, :telefone, :email, :regiao, :unidade)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':data_nascimento', $dados['data_nascimento']);
    $cad_usuario->bindParam(':telefone', $dados['telefone']);
    $cad_usuario->bindParam(':email', $dados['email']);
    $cad_usuario->bindParam(':regiao', $dados['regiao']);
    $cad_usuario->bindParam(':unidade', $dados['unidade']);
    $cad_usuario->execute();




?>