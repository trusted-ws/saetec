<html>

<head>
    <title>Saetec - Gerenciamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#373F51">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-color: #373F51;
        }

        .navcolor {
            background-color: #373F51;
            /* Blue-Darker */
        }

        .navcolor2 {
            background-color: #1B1B1E;
            /* Black */

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
        <a href="#" class="brand-logo" style="font-size: 15px;">Gerenciamento</a>
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


    <div class="container ">
        <br><br>
        <center>
            <a class="waves-effect waves-light btn-large navcolor" href="adicionarRecurso.php"><i class="material-icons right">queue</i>Adicionar Recursos</a><br><br>
            <a class="waves-effect waves-light btn-large navcolor" href="gerenciarRecurso.php"><i class="material-icons right">list</i>Gerênciar Recursos</a><br><br>
            <a class="waves-effect waves-light btn-large navcolor" href="cadastrarUsuario.php"><i class="material-icons right">group_add</i>Cadastrar Usuários</a><br><br>
            <?php
            if ($_SESSION['permissao'] == "1") {
                if ($num_rows_usuarios_pendentes > 0) {
                    if($num_rows_usuarios_pendentes == 1) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_1</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 2) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_2</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 3) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_3</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 4) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_4</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 5) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_5</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 6) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_6</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 7) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_7</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 8) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_8</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes == 9) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_9</i>Gerênciar Usuários</a><br><br>';
                    } else if($num_rows_usuarios_pendentes > 9) {
                        echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">filter_9_plus</i>Gerênciar Usuários</a><br><br>';
                    }
                } else {
                    echo '<a class="waves-effect waves-light btn-large navcolor" href="gerenciarUsuario.php"><i class="material-icons right">group</i>Gerênciar Usuários</a><br><br>';
                }
            }
            ?>
        </center>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.collapsible').collapsible();
        });
        $(document).ready(function() {
            $('.sidenav').sidenav();
        })
    </script>
</body>

</html>