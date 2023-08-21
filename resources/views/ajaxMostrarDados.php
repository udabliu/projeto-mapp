<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8001/pessoa/mostrar', // URL para buscar os dados
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET', // Usando o método GET para buscar os dados
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

$pessoas = json_decode($response, true); // Decodifica a resposta JSON para um array associativo



if ($httpCode == 200) {
?>
  <div>
    <?php foreach ($pessoas as $pessoa) : ?>
      <ul class="list-group p-4">
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["id"]); ?>
          <button class="btn-delete" data-id="<?php echo $pessoa["id"]; ?>">Deletar</button>
        </li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["nome"]); ?></li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["email"]); ?></li>
      </ul>
    <?php endforeach; ?>
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-delete').on('click', function() {
        var pessoaId = $(this).data('id');
        $.ajax({
          url: 'ajaxExcluirPessoa.php?pessoaId=' + pessoaId,
          type: 'DELETE',
          success: function(result) {
            $("#mostrar").html(result);
          }
        });
      });
    });
  </script>

<?php
} else {
  $msgError = "Erro ao Carregar Dados";
?>
  <div class="alert alert-danger">
    <?php print_r($msgError);
    ?>
  </div>
<?php
}

?>