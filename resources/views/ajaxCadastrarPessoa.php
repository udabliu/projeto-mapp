<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];

  $valida = true;
  if ($nome == '') {
    $valida = false;
    echo 'Favor informar nome';
  }

  $valida = true;
  if ($email == '') {
    $valida = false;
    echo 'Favor informar email';
  }

  $valida = true;
  if ($senha == '') {
    $valida = false;
    echo 'Favor informar senha';
  }

  if ($valida) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8001/pessoa/cadastrar',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => "nome=$nome&email=$email&senha=$senha&telefone=$telefone",
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $dadosJson = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $dados = json_decode($dadosJson, true);
    curl_close($curl);
    print_r($dados);
  }
}

