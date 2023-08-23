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

?>

<div>
<input type="hidden" name="pessoaId" id="id" value="<?php echo $dados["id"]; ?>">
<label>Tem certeza que deseja excluir?</label>
  <button id="btn-sim">sim</button>
  <button id="nao">nao</button>
</div>

<script>
  $('#btn-sim').click(function() {
    var pessoaId = $('#id').val(); 
  })
  $.ajax({
        url: 'ajaxExcluirPessoa.php?pessoaId=' + pessoaId,
        type: 'GET',
        success: function(result) {
          $("#sure").html(result);

      }
  })
</script>