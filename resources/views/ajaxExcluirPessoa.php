<?php
$id = $_GET['pessoaId'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "localhost:8001/pessoa/$id/deletar",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

if ($httpCode == 200) {
  $msgSuccess = "Dados Apagados com Sucesso! Redirecionando..."
  ?>
    <div class="alert alert-success">
      <?php print_r($msgSuccess); ?>
    </div>
  <?php
  } else {
    $msgError = "Erro ao Apagar Dados.";
  ?>
    <div class="alert alert-danger">
      <?php print_r($msgError);
      ?>
    </div>
  <?php
  }
  ?>