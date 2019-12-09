<html>

<head>
    <title>Saetec - Gerenciamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#373F51">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
        body {
            /* background-color: #373F51; */
            background-color: white;
        }

        .navcolor {
            background-color: #373F51;
            /* Blue-Darker */
        }

        .navcolor2 {
            background-color: #1B1B1E;
            /* Black */

        }

        .input-field {
            color: black;
        }
    </style>
</head>

<body>
    <?php
    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');
    // Verificador de Permissão de Administrador
    require('../../includes/admin.php');

    if (isset($_GET['c'])) {
        if ($_GET['c'] == "done") {
            echo '
            <script>
            Swal.fire(
                \'Recurso Adicionado\',
                \'O recurso foi adicionado com sucesso!\',
                \'success\'
              )
              </script>
            ';
        }
    }

    // Verificar usuários pentendes
    $query_usuarios_pendentes = "SELECT * FROM `usuarios` where `pendente` = 1;";
    $result_usuarios_pendentes = mysqli_query($con, $query_usuarios_pendentes);
    $num_rows_usuarios_pendentes = mysqli_num_rows($result_usuarios_pendentes);
    if ($_SESSION['permissao'] == "1") {
        echo '<nav class="nav-wrapper navcolor2">';
    } else {
        echo '<nav class="nav-wrapper navcolor">';
    }
    ?>
    <div class="container">
        <a href="#" class="brand-logo" style="font-size: 15px;">Adicionar Recurso</a>
        <a href="#" class="sidenav-trigger" data-target="mobile-links">
            <i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">Saetec</a></li>
            <li><a href="agendar_objeto.php">Agendar</a></li>
            <li><a href="agendamentos.php">Agendamentos</a></li>
            <li><a href="minhaconta.php">Minha Conta</a></li>
            <?php
            if ($_SESSION['permissao'] == "1") {
                if ($num_rows_usuarios_pendentes > 0) {
                    echo '<li><a href="gerenciamento.php">Gerênciar<span class="new badge">' . $num_rows_usuarios_pendentes . '</span></a></li>';
                } else {
                    echo '<li><a href="gerenciamento.php">Gerênciar</a></li>';
                }
            }
            ?>
            <li><a href="/home/sair.php">Sair</a></li>
        </ul>
    </div>

    </nav>

    <ul class="sidenav" id="mobile-links">
        <li><a href="index.php"><i class="material-icons">home</i>Saetec</a></li>
        <li><a href="agendar_objeto.php"><i class="material-icons">schedule</i>Agendar</a></li>
        <li><a href="agendamentos.php"><i class="material-icons">view_list</i>Agendamentos</a></li>
        <li><a href="minhaconta.php"><i class="material-icons">account_circle</i>Minha Conta</a></li>
        <?php
        if ($_SESSION['permissao'] == "1") {
            if ($num_rows_usuarios_pendentes > 0) {
                echo '<li><a href="gerenciamento.php"><i class="material-icons">local_cafe</i>Gerênciar<span class="new badge" data-badge-caption="pendente(s)">' . $num_rows_usuarios_pendentes . '</span></a></li>';
            } else {
                echo '<li><a href="gerenciamento.php"><i class="material-icons">local_cafe</i>Gerênciar</a></li>';
            }
        }
        ?>
        <li><a href="/home/sair.php"><i class="material-icons">logout</i>Sair</a></li>
    </ul>

    <div class="container white-text">
        <br><a class="waves-effect waves-light btn-small white black-text" href="gerenciamento.php"><i class="material-icons">arrow_back</i></a><br><br><br>
        <div class="row white-text">
            <form class="col s12" action="incluindoRecurso.php" method="post">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nome" type="text" class="validate input-field" name="nome" required>
                        <label for="nome">Nome do Recurso</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="quantidade" type="number" class="validate input-field" name="quantidade" required>
                        <label for="quantidade">Quantidade</label>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="descricao" class="materialize-textarea input-field" name="descricao" required></textarea>
                            <label for="descricao">Descrição</label>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12">
                    <select name="categoria" required>
                        <option value="" disabled selected>Escolha um opção</option>
                        <option name="recurso_aparelho" value="Recurso / Aparelho">Recurso / Aparelho</option>
                        <option name="sala_laboratorio" value="Sala / Laboratorio">Sala / Laboratório</option>
                    </select>
                    <label>Tipo de Recurso</label>
                </div>
                <center>
                    <button class="waves-effect waves-light btn-large white black-text" type="submit"><i class="material-icons right">add</i>Adicionar</button><br><br>
                </center>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').formSelect();
        });

        $(document).ready(function() {
            $('.collapsible').collapsible();
        });
        $(document).ready(function() {
            $('.sidenav').sidenav();
        })
    </script>
</body>

</html>