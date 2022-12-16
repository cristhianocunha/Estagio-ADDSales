<?php
include_once 'db.php';


$errors = [];
$data = [];

if (empty($_POST['name'])) {
    $errors['name'] = 'Name is required.';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
}

if (empty($_POST['telefone'])) {
    $errors['telefone'] = 'telefone alias is required.';
}

if (empty($_POST['data_nascimento'])) {
    $errors['data_nascimento'] = 'telefone alias is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
}

echo json_encode($data);

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

    $sql = "INSERT INTO MyGuests (nome, data_nascimento, email, telefone, regiao, unidade, ponts) VALUES ('$nome', '$data_nascimento', '$email','$telefone', '0','0','0')";
    
$conn = null;
?>