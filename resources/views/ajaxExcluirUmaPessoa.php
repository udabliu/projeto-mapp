<?php
$id = $_GET['pessoaId'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://localhost:8001/pessoa/$id/uma",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$dadosJson = curl_exec($curl);
$dados = json_decode($dadosJson, true); // Decodifica o JSON para um array associativo

curl_close($curl);

if ($dados) {
?>
  <div>
    <label>Tem certeza que deseja excluir?</label>
    <button class="btn-sim btn btn-success" data-id="<?php echo $dados["id"]; ?>">Sim</button>
    <button class="btn-nao btn btn-danger" data-id="<?php echo $dados["id"]; ?>">Não</button>
  </div>

<?php
}
?>
<script>
  $(document).ready(function() {
    $('.btn-sim').on('click', function() {
      var pessoaId = $(this).data('id');
      $.ajax({
        url: 'ajaxExcluirPessoa.php?pessoaId=' + pessoaId,
        type: 'DELETE',
        success: function(result) {
          $("#mostrar").html(result);
          setTimeout(function() {
            location.reload();
          }, 1000);
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.btn-nao').on('click', function() {
      var pessoaId = $(this).data('id');
      var sureDiv = $('#sure-' + pessoaId);
      if (sureDiv.is(':visible')) {
        sureDiv.hide();
      } else {
        $.ajax({
          url: 'ajaxExcluirUmaPessoa.php?pessoaId=' + pessoaId,
          type: 'GET',
          success: function(result) {
            sureDiv.html(result).show();
          }
        });
      }
    });
  });
</script>
