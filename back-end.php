<?php

/*
* Capturando dados do fron-end via Ajax
* Enviando para banco de dados
*/


// POST Data
$data['nome'] = $_POST['nome'];
$data['data_nascimento'] = $_POST['data_nascimento'];
$data['email'] = $_POST['email'];
$data['telefone'] = $_POST['telefone'];
$data['regiao'] = $_POST['regiao'];
$data['unidade'] = $_POST['unidade'];

// variaveis

$x = $data['regiao'];
$dataNasc = $data['data_nascimento'];
$ponts = 10;
$idade = 0;
// calculando idade

$data = $dataNasc;
list($ano, $mes, $dia) = explode('-', $data);
$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
echo $idade;

// calculando o pontos com idade
if ($idade < 18 or $idade >= 100){
    $ponts -= 5;
}elseif($idade >= 40 && $idade <= 99 ) {
    $ponts -= 3;
}


// calculando pontuação da regiao

switch ($x){
    case "sul":
        $ponts -= 4;
        break;
    case "sude":
        $ponts -= 1;
        break;
    case "cent":
        $ponts -= 3;
        break;
    case "nord":
        $ponts -= 2;
        break;
    case "nort":
        $ponts -= 5;
        
}


// return json_encode($data);
echo json_encode($data);
include_once "db.php";

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    $query_usuario = "INSERT INTO leads (nome, data_nascimento, email, telefone, regiao, unidade, ponts) VALUES (:nome, :data_nascimento, :email, :telefone, :regiao, :unidade, :ponts )";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $data['nome']);
    $cad_usuario->bindParam(':data_nascimento', $data['data_nascimento']);
    $cad_usuario->bindParam(':email', $data['email']);
    $cad_usuario->bindParam(':telefone', $data['telefone']);
    $cad_usuario->bindParam(':regiao', $data['regiao']);
    $cad_usuario->bindParam(':unidade', $data['unidade']);
    $cad_usuario->bindParam(':ponts', $ponts);
    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<p style='color: green;'>Usuário cadastrado com sucesso!</p>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>"];
    }    
