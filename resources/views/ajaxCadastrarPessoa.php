<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];

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

  $response = curl_exec($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  curl_close($curl);
  

  if ($httpCode == 200) {
    $msgSuccess = "Usuário cadastrado com sucesso! Redirecionando... ";
    
?>
    <div class="alert alert-success">
      <?php print_r($msgSuccess);?>
    </div>
  <?php
  } else {
    $msgError = "Erro ao Cadastrar: O Email já está sendo utilizado.";
  ?>
    <div class="alert alert-danger">
      <?php print_r($msgError);
      ?>
    </div>
<?php
  }
}
?>