<head>
    <title>Logado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center p-5">
        <h1>Lista de Usuários</h1>
    </div>
    <div class="d-flex justify-content-center text-center">
        <div class="p-3">
            <a class="btn btn-primary" href="cadastro.php">Cadastro</a>
        </div>
        <div class="p-3">
            <a class="btn btn-primary" href="login.php">Login</a>
        </div>
        <div class="p-3">
            <a class="btn btn-primary" href="logado.php">Home</a>
        </div>
    </div>
    
    <div class="alert" id="mostrar" role="alert"></div>

    
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'ajaxMostrarDados.php',
                method: 'GET',
                success: function(result) {
                    $("#mostrar").html(result);
                }
            });


        });
    </script>
</body>

</html>