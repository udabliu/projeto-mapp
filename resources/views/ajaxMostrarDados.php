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
      <ul class="list-group p-5">
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["id"]); ?></li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["nome"]); ?></li>
        <li class="list-group-item d-flex justify-content-center"><?php print_r($pessoa["email"]); ?></li>
        <li class="list-group-item d-flex justify-content-around">
          <button id="btn-delete" class="btn btn-danger" data-id="<?php echo $pessoa["id"]; ?>">Deletar</button>
          <div id="sure"></div>
          <button id="btn-edit" class="btn btn-warning" data-id="<?php echo $pessoa["id"]; ?>">Editar</button>
        </li>
  </div>
  </ul>
<?php endforeach; ?>
</div>


<script>
  $(document).ready(function() {
    $('#btn-enviar').click(function() {
      var nome = $('#nome').val();
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
      });
    });
  });
</script>


<script>
   $(document).ready(function() {
    $('#btn-delete').on('click', function() {
      var pessoaId = $(this).data('id');
      $.ajax({
        url: 'ajaxExcluirUmaPessoa.php?pessoaId=' + pessoaId,
        type: 'GET',
        success: function(result) {
          $("#sure").html(result);
        }
      })
    })
  });

</script>

<script>
  $(document).ready(function() {
    $('#btn-edit').on('click', function() {
      var pessoaId = $(this).data('id');
      $.ajax({
        url: 'ajaxObterDadosPessoa.php?pessoaId=' + pessoaId,
        type: 'GET',
        success: function(result) {
          $("#mostrar").html(result);
        }
      })
    });
  })
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