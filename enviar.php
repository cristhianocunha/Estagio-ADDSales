<?php 

include_once "db.php";
executar($conn);



function buscarLead($conn){
    return $conn->query( "SELECT * FROM `leads` WHERE enviado = 'no' limit 1 ")->fetch(PDO::FETCH_ASSOC);
} 

function updateLead($id, $conn){      
    $query = $conn->prepare("UPDATE leads SET enviado = :enviado WHERE id = :id");
    $query->execute(array(
        ':id' => $id,
        ':enviado' => "yes"
    ));
    
}
function enviarParaApi($data){
    $url  = 'https://api-bra1.addsales.com/join-asbr/ti/lead?token=ab565c3c42d7a5253285362dbb3dee40';
    $ch   = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function executar($conn){
    $row = buscarLead($conn);

    if (!$row)
    {
        echo "   para enviar sem leads";
        exit;
    } else {
        $leadid = $row['id'];
        $data = json_encode($row);
        $rescultado = enviarParaApi($data);
            if ($rescultado){
                updateLead($leadid, $conn);
            }
        
    }
}