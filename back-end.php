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
$data['score'] = 10;

// variaveis

$x = $data['regiao'];
$dataNasc = $data['data_nascimento'];
$score = 10;

$idade = CalculandoIdade($dataNasc);
$score = calculandoPontosIdade($idade, $score) - calculandoRegiao($x, $score);
$score = abs($score);



// calculando pontuação da regiao
function calculandoRegiao($x, $score)
{
    switch ($x){
        case "Sul":
            $score -= 4;
            break;
        case "Sudeste":
            $score -= 1;
            break;
        case "Centro-Oeste":
            $score -= 3;
            break;
        case "Nordeste":
            $score -= 2;
            break;
        case "Norte":
            $score -= 5;
            
    }
    return $score;
}
// calculando o pontos com idade
function calculandoPontosIdade($idade, $score){

    if ($idade < 18 or $idade >= 100){
    $score -= 5;
    }elseif($idade >= 40 && $idade <= 99 ) {
    $score -= 3;
    }
    return $score;
}

// calculando idade

function CalculandoIdade($dataNasc) 
{
    list($ano, $mes, $dia) = explode('-', $dataNasc);
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
}



// return json_encode($data);
echo json_encode($data);
include "db.php";


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    $query_usuario = "INSERT INTO leads (nome, data_nascimento, email, telefone, regiao, unidade, score, enviado) VALUES (:nome, :data_nascimento, :email, :telefone, :regiao, :unidade, :score, 'no' )";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $data['nome']);
    $cad_usuario->bindParam(':data_nascimento', $data['data_nascimento']);
    $cad_usuario->bindParam(':email', $data['email']);
    $cad_usuario->bindParam(':telefone', $data['telefone']);
    $cad_usuario->bindParam(':regiao', $data['regiao']);
    $cad_usuario->bindParam(':unidade', $data['unidade']);
    $cad_usuario->bindParam(':score', $score);
    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<p style='color: green;'>Usuário cadastrado com sucesso!</p>"];       
    }else{
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>"];
    }    


