<?php

$conexao = mysqli_connect('localhost', 'root', '', 'form');
$email = $conexao->real_escape_string($_POST['email']);
$senha = $conexao->real_escape_string($_POST['senha']);

// var_dump($senha); 

if (empty($email or $senha)) {
    header('Location: ../views/erro.html');
} else {
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if ($result) {
        $hash = $result['senha'];

        if (!password_verify($senha, $hash)) {
            header('Location: ../views/erro.html');
        } else {
            session_start();
            $_SESSION['email'] = $result['email'];
            $_SESSION['nome'] = $result['nome'];
            header('Location: ../controller/perfil.php');
        }
    } else {
        header('Location: ../views/erro.html');
        //log 
    }
}
// 'or''1 = 1' 