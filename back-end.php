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

// calculando idade

var_dump($idade);

// calculando o pontos com idade
if ($idade < 18 or $idade >= 100){
    $score -= 5;
}elseif($idade >= 40 && $idade <= 99 ) {
    $score -= 3;
}


// calculando pontuação da regiao

switch ($x){
    case "sul":
        $score -= 4;
        break;
    case "sude":
        $score -= 1;
        break;
    case "cent":
        $score -= 3;
        break;
    case "nord":
        $score -= 2;
        break;
    case "nort":
        $score -= 5;
        
}

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
include_once "db.php";

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    $query_usuario = "INSERT INTO leads (nome, data_nascimento, email, telefone, regiao, unidade, score) VALUES (:nome, :data_nascimento, :email, :telefone, :regiao, :unidade, :score )";
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



// // // URL de SUA API
// // $url = 'http://api-bra1.addsales.com/join-asbr/ti/lead?token=ab565c3c42d7a5253285362dbb3dee40';
// // // cria um resource cURL
// $url  = 'https://api-bra1.addsales.com/join-asbr/ti/lead?token=ab565c3c42d7a5253285362dbb3dee40';
// $ch   = curl_init();
// var_dump($data);
// die;
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// $result = curl_exec($ch);
// var_dump($result);
// curl_close($ch);