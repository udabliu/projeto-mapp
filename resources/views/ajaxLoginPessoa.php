<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


    curl_close($curl);

    
    if ($httpCode == 200) {
      $_SESSION["email"] = $email;
      $_SESSION["senha"] = $senha;
      $msgSucess = "Usuário logado com sucesso! Redirecionando...";
      ?>
  <div class="alert alert-success">
    <?php print_r($msgSucess); ?>
  </div>
  
  <?php
  } else {
    $msgError = "Erro ao logar";
  ?>
  <div class="alert alert-danger">
    <?php print_r($msgError); ?>
  </div>
  <?php

  }}
  ?>

  
