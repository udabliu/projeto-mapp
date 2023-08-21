<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center p-5">
        <h2>Login</h2>
    </div>
    <div>
        <div class="w-100 d-flex justify-content-center align-items-center flex-column">
            <div class="mb-3 w-25">
                <label for="exampleInputEmail1" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 w-25">
                <label for="exampleInputPassword1" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <div class="d-flex justify-content-center p-3">
            <a href="cadastro.php">
                Ainda não possui cadastro? Cadastre-se Aqui</a>
            </div>

            <button id="btn-login" class="btn btn-primary">Entrar</button>
        </div>
    </div>
    <div class="alert" id="alert" role="alert"></div>
    <script>
        $(document).ready(function() {
            $('#btn-login').click(function() {
                var email = $('#email').val();
                var senha = $('#senha').val();

                $('#alert').html(`<div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`);
                if (email == '') {
                    $('#alert').html('Preencha o campo Email.');
                    $('#alert').addClass("alert-danger");
                    return false;
                }

                if (senha == '') {
                    $('#alert').html('Preencha o campo Senha.');
                    $('#alert').addClass("alert-danger");
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: 'ajaxLoginPessoa.php',
                    data: {
                        "email": email,
                        "senha": senha
                    },
                    success: function(result) {
                        $("#alert").html(result);  
                    },                   
                });
            });
        });
    </script>
</body>