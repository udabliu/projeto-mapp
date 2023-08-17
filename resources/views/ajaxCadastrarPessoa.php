<?php

include('index.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];







$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost:8001/pessoa/cadastrar',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'nome=$nome,
                        email=$email,
                        senha=$senha,
                        telefone=$telefone',
  
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

}
else {
  echo "erro da pag";
}


