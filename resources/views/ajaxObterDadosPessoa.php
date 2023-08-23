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

<div class="form-control d-flex flex-column justify-content-center">
  <input type="hidden" name="pessoaId" id="id" value="<?php echo $id; ?>">
  <label for="">Nome</label>
  <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $dados['nome']; ?>">
  <label for="">Email</label>
  <input class="form-control" type="text" name="email" id="email" value="<?php echo $dados['email']; ?>">
  <label for="">Senha</label>
  <input class="form-control" type="text" name="senha" id="senha" value="<?php echo $dados['senha']; ?>">
  <label for="">Telefone</label>
  <input class="form-control" type="number" name="telefone" id="telefone" value="<?php echo $dados['telefone']; ?>">
  <button class="btn btn-primary m-3" id="btn-atualizar">Atualizar</button>
  <div id="result"></div>
</div>
<script>
  $(document).ready(function() {
    $('#btn-atualizar').click(function() {
      var id = $('#id').val();
      var nome = $('#nome').val();
      var email = $('#email').val();
      var telefone = $('#telefone').val();
      var senha = $('#senha').val();

      $.ajax({
        type: 'POST',
        url: 'ajaxEditarPessoa.php',
        data: {
          "id": id,
          "nome": nome,
          "email": email,
          "telefone": telefone,
          "senha": senha
        },
        success: function(result) {
          $("#result").html(result);
          if (result.includes("Dados Alterados com Sucesso! Redirecionando...")) {
            setTimeout(function() {
              window.location.href = 'logado.php';
            }, 1000);
          }
        }
      })
    })
  });
</script>