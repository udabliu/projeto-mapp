<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8001/pessoa/mostrar',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
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
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["id"]); ?></li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["nome"]); ?></li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["email"]); ?></li>
        <li class="list-group-item d-flex justify-content-left">
          <button class="btn-delete" data-id="<?php echo $pessoa["id"]; ?>">Deletar</button>
          <button id="btn-edit" data-id="<?php echo $pessoa["id"]; ?>">Editar</button>
        </li>
  </div>
  </ul>
<?php endforeach; ?>
</div>

<div id="form" hidden>
  <input type="text" id="nome">
  <input type="text" id="email">
  <input type="text" id="telefone">
  <input type="text" id="senha">
  <button id="btn-enviar"></button>
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
    })
  })
</script>

<script>
  $(document).ready(function() {
    $('.btn-edit').on('click', function() {
      var pessoaId = $(this).data('id');
      $.ajax({
        url: 'ajaxEditarPessoa.php?pessoaId=' + pessoaId,
        type: 'GET',
        success: function(result) {
          $("#mostrar").html(result);
        }
      });
    })
  })
</script>

<script>
  $(document).ready(function() {
    $('#btn-cadastrar').click(function() {
      var nome = $('#nome').val(); // Suponho que você esteja capturando esses valores de algum lugar
      var email = $('#email').val();
      var telefone = $('#telefone').val();
      var senha = $('#senha').val();

      $.ajax({
        type: 'POST',
        url: 'ajaxEditarPessoa.php',
        data: {
          "nome": nome,
          "email": email,
          "telefone": telefone,
          "senha": senha
        },

        success: function(result) {
          $("#alert").html(result);
        },
        error: function(error) {
          console.log('Erro na requisição Ajax:', error);
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