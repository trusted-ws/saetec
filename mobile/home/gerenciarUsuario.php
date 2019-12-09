<html>

<head>
    <title>Saetec</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#373F51">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script language="javascript">
        function excluirUsuario(idConta) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, apagar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {

                    location.href = "excluir_usuario.php?uid=" + idConta;
                }
            })
        }

        function aceitarUsuario(idConta) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você realmente deseja aceitar este usuário?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, aceitar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {

                    location.href = "aceitar_usuario.php?uid=" + idConta;
                }
            })
        }
    </script>
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

        .desabilitado {
            background-color: #636363;
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
        <a href="#" class="brand-logo" style="font-size: 15px;">Gerenciar Usuário</a>
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


    <div class="container">
        <?php
        // echo "<div style=\"color: #fff; text-shadow: 2px 2px #000;padding-left: 20px;\"><h5>Agendar Recursos</h5></div>";
        $query = "SELECT * FROM `usuarios`;";
        $result = mysqli_query($con, $query);
        ?>
        <div class="row">
            <br><a class="waves-effect waves-light btn-small navcolor white-text" href="gerenciamento.php"><i class="material-icons">arrow_back</i></a><br><br>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                if ($row['ativo'] == 1) {
                    $status = "Ativado";
                } else {
                    $status = "Desativado";
                }
                if ($row['tipo'] == 1) {
                    $role = "Administrador";
                } else {
                    $role = "Normal";
                }

                echo '
                    <div class="col s12 m6">
                        <div class="card white black-text">
                            <div class="card-content">
                                <center><div>Tipo de usuário: <b>' . $role . '</b> (ID: ' . $row['id'] . ')</div></center>
                                <h5>' . $row['nome'] . '<br><span style="font-size: 12px;"></span></h5>
                                <p>' . $row['username'] . '</p><br>
                                ';

                if ($row['pendente'] == 0) {
                    if ($status == "Ativado") {
                    } else {
                        echo '<center><span style="color: red;">USUÁRIO <b>DESATIVADO</b></span></center><br>';
                    }
                } else {
                    echo '<center><span style="color: blue;">USUÁRIO <b>PENDENTE</b></span></center><br>';
                }
                if ($row['pendente'] == 0) {
                    echo "
                    <a class=\"btn waves-effect waves-light desabilitado\" name=\"editar\" href=\"/mobile/home/editarUsuario.php?uid=" . $row['id'] . "\">
                    EDITAR<i class=\"material-icons right\">edit</i>
                </a>
                    ";
                } else {
                    //echo "<td><a class=\"button success outline\" onclick=\"aceitarUsuario(" . $row['id'] . ");\">ACEITAR</span></a></td>";
                    echo "
                    <a class=\"btn waves-effect waves-light indigo\" name=\"aceitar\"  onclick=\"aceitarUsuario(" . $row['id'] . ");\">
                    ACEITAR<i class=\"material-icons right\">check_circle</i>
                </a>
                    ";
                }
                //echo "<td><a class=\"button alert cycle outline\" onclick=\"excluirUsuario(" . $row['id'] . ");\"><span class=\"mif-cross\"></span></a></td>";
                echo "
                <a class=\"btn waves-effect waves-light red\" name=\"excluir\"  onclick=\"excluirUsuario(" . $row['id'] . ");\">
                EXCLUIR<i class=\"material-icons right\">delete</i>
            </a>
                ";
                echo '            
                            </div>
                        </div>
                    </div>';
            } ?>

        </div>


    </div>


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