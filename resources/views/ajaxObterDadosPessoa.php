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
  <input type="hidden" name="pessoaId" id="id" value="<?php echo $id; ?>">
  <label for="">Nome</label>
  <input type="text" name="nome" id="nome" value="<?php echo $dados['nome']; ?>">
  <label for="">Senha</label>
  <input type="password" name="senha" id="senha">
  <label for="">Telefone</label>
  <input type="number" name="telefone" id="telefone" value="<?php echo $dados['telefone']; ?>">
  <button id="btn-atualizar">Atualizar</button>
</div>
<script>
  $('#btn-atualizar').click(function() {
    var id = $('#id').val(); 
    var nome = $('#nome').val();
    var telefone = $('#telefone').val();
    var senha = $('#senha').val();

    $.ajax({
      type: 'POST',
      url: 'ajaxEditarPessoa.php',
      data: {
        "id": id,
        "nome": nome,
        "telefone": telefone,
        "senha": senha
      },
      success: function(result) {
        $("#mostrar").html(result);
      }
    });
  });
</script>
