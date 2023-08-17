<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="alert" id="alert" role="alert"></div>
<div class="d-flex justify-content-center p-5">

    <h2>Cadastro de Usuário</h2>
    <form action="ajaxCadastrarPessoa.php">
</div>
<div class="w-100 d-flex justify-content-center align-items-center flex-column">
    <div class="mb-3 w-25">
        <label for="exampleInputEmail1" class="form-label">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 w-25">
        <label for="exampleInputEmail1" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 w-25">
        <label for="exampleInputEmail1" class="form-label">Telefone:</label>
        <input type="number" class="form-control" id="telefone" name="telefone" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 w-25">
        <label for="exampleInputPassword1" class="form-label">Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha">
    </div>

  <button type="submit" id="submit" class="btn btn-primary">Cadastrar</button>
</form>
</div>

    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var nome = $('#nome').val();
                var email = $('#email').val();
                var telefone = $('#telefone').val();
                var senha = $('#senha').val();

                $('#alert').html('');
                if (nome == '') {
                    $('#alert').html('Preencha o Nome.');
                    $('#alert').addClass("alert-danger");
                    return false;
                }
                $('#alert').html('');
                
                $.ajax({
                    method: 'POST',
                    url: 'ajaxCadastrarPessoa.php',
                    data: {nome: nome,email: email,telefone: telefone,senha: senha},
                    success: function(result) {
                        $('form').trigger("reset");
                        $('#alert').addClass("alert-success");
                        $('#alert').fadeIn().html(result);
                        setTimeout(function(){
                            $('#alert').fadeOut('Slow');
                        },3000);
                       
                    }
                });
            });
        });
    </script>

    
    
</body>
</html>



