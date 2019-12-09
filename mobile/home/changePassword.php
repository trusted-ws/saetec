<html>

<head>
    <title>Saetec - Alterar Senha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#373F51">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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

        .input-field {
            color: white;
        }
    </style>
</head>

<body>
    <?php
    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');

    // Consulta do Usuário baseado no Session-UID
    $uid = $_SESSION['id_usuario'];
    $query = "SELECT * FROM `usuarios` WHERE `id` = '$uid'";
    $result = mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
    $total = mysqli_num_rows($result);
    $dados = mysqli_fetch_array($result);

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
        <a href="#" class="brand-logo" style="font-size: 15px;">Minha Conta - Alterar Senha</a>
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
                    echo '<li><a href="gerenciamento.php">Gerênciar<span class="new badge" data-badge-caption="pendente(s)">' . $num_rows_usuarios_pendentes . '</span></a></li>';
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


    <div class="container white-text"><br><br>
        <!-- <a class="waves-effect waves-light btn-small white black-text" href="gerenciamento.php"><i class="material-icons">arrow_back</i></a><br><br><br> -->
        <center>
            <div class="section">
                <h5>Alteração de Senha</h5>
                <p>Olá <?php echo $dados['nome']; ?>, para alterar sua senha preencha os campos abaixo:</p>
            </div>
            <div class="row">
                <form class="col s12" action="changingPassword.php" method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="senhaAtual" type="password" class="validate input-field" name="senhaAtual" required>
                            <label for="senhaAtual">Senha</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="novaSenha" type="password" class="validate input-field" minlength="8" name="novaSenha" required>
                            <label for="novaSenha">Nova senha</label>
                        </div>
                        <div class="input-field col s12">
                            <input id="senhaConfirma" type="password" class="validate input-field" minlength="8" name="senhaConfirma" required>
                            <label for="senhaConfirma">Confirmar senha</label>
                        </div>
                    </div>

                    <button class="waves-effect waves-light btn modal-trigger navcolor" type="submit">ALTERAR<i class="material-icons right">security</i></button>
                    <button class="waves-effect waves-light btn modal-trigger navcolor" onclick="location.href = 'minhaconta.php';">VOLTAR<i class="material-icons right">arrow_back</i></button>
                </form>
            </div>
        </center>

    </div>

    <?php

    if (isset($_GET['c'])) {
        if ($_GET['c'] == "incorrectPassword") {
            echo '<script language="javascript">
        Swal.fire(
            \'Senha Incorreta\',
            \'A senha digitada está incorreta!\',
            \'error\'
          )
        </script>
        ';
        } else if ($_GET['c'] == "passwordNotEqual") {
            echo '<script language="javascript">
        Swal.fire(
            \'As senhas não correspondem\',
            \'As senhas digitadas não são iguais!\',
            \'error\'
          )
        </script>
        ';
        } else if ($_GET['c'] == "taina") {
            echo '<div class="alert alert-warning text-center"> Este usuário foi desativado. </div>';
        } else if ($_GET['c'] == "tuip") {
            echo '<div class="alert alert-warning text-center"><strong>Conta não ativa</strong><br> Aguardando confirmação do Administrador. </div>';
        }
    } else { }
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
        })
    </script>

</body>

</html>