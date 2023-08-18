<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8001/pessoa/login', 
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => "email=$email&senha=$senha",
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

    // Verifique a resposta do servidor de autenticação
    if ($response === "Autenticação bem-sucedida") {
      $_SESSION["email"] = $email;
      $_SESSION["senha"] = $senha;
      echo "Login bem-sucedido! Redirecionando...";
    } else {
      echo "Credenciais inválidas.";
    }
}
?>
