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
          <button class="btn btn-danger btn-delete" data-id="<?php echo $pessoa["id"]; ?>">Deletar</button>
          <div class="edit-delete" id="sure-<?php echo $pessoa["id"]; ?>"></div>
          <button class="btn btn-warning btn-edit" data-id="<?php echo $pessoa["id"]; ?>">Editar</button>
        </li>
        <div class="edit" id="edit-sure-<?php echo $pessoa["id"]; ?>"></div>
  </div>
  </ul>
<?php endforeach; ?>
</div>
<script>
$(document).ready(function() {
  $('.btn-delete').on('click', function() {
    var pessoaId = $(this).data('id');
    $('.edit-delete').hide();
    var sureDiv = $('#sure-' + pessoaId);
    $.ajax({
      url: 'ajaxExcluirUmaPessoa.php?pessoaId=' + pessoaId,
      type: 'GET',
      success: function(result) {
        sureDiv.html(result).show();
      }
    });
  });
});

</script>

<script>
 $(document).ready(function() {
    $('.btn-edit').on('click', function() {
      var pessoaId = $(this).data('id');
      $('.edit').hide();
      var sureDiv = $('#edit-sure-' + pessoaId);
      if (sureDiv.is(':visible')) {
        sureDiv.hide();
      } else {
        $.ajax({
          url: 'ajaxObterDadosPessoa.php?pessoaId=' + pessoaId,
          type: 'GET',
          success: function(result) {
            sureDiv.html(result).show();
          }
        });
      }
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