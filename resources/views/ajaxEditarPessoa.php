<?php
$id = $_POST['id'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "localhost:8001/pessoa/$id/editar",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS => "nome=$nome&senha=$senha&telefone=$telefone",
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

if ($httpCode == 200) {
$msgSuccess = "Dados Alterados com Sucesso!"
?>
  <div class="alert alert-success">
    <?php print_r($msgSuccess); ?>
  </div>
<?php
} else {
  $msgError = "Erro ao Alterar os Dados.";
?>
  <div class="alert alert-danger">
    <?php print_r($msgError);
    ?>
  </div>
<?php
}
?>