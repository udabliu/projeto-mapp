<head>
    <title>Logado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center p-5">
        <h1>Lista de Usuários</h1>
    </div>

    <div class="alert" id="mostrar" role="alert"></div>


    <script>
        $(document).ready(function() {
            // Primeira chamada AJAX para mostrar dados
            $.ajax({
                url: 'ajaxMostrarDados.php',
                method: 'GET',
                dataType: 'html', // Define o tipo de dados esperado (HTML)
                success: function(result) {
                    $("#mostrar").html(result);
                }
            });


        });
    </script>
</body>

</html>