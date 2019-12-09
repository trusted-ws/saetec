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
    <meta charset="utf-8">

    <script language="javascript">
        function excluirRecurso(idRecurso) {
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
                    location.href = "excluir_recurso.php?recId=" + idRecurso;
                }
            })
        }
    </script>
    <style>
        body {
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
        <a href="#" class="brand-logo" style="font-size: 15px;">Editar Usuário</a>
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
    <br><a class="waves-effect waves-light btn-small white black-text" href="gerenciarUsuario.php"><i class="material-icons">arrow_back</i></a>
        <?php

        if (isset($_GET['uid'])) {
            $uid = $_GET['uid'];

            $query = "SELECT * FROM `usuarios` WHERE `id` = $uid;";
            $result = mysqli_query($con, $query);



            while ($row = mysqli_fetch_array($result)) {

                if ($row['ativo'] == 1) {
                    $status = "Ativado";
                } else {
                    $status = "Desativado";
                }
                if ($row['tipo'] == 1) {
                    $role = "Admin";
                } else {
                    $role = "Normal";
                }

                // Open Form and Container
                echo "
                <div class=\"container\"><br>
                <center><p><b>Você está editando o seguinte usuário:</b><br><span style=\"color: #58A4B0;\">" . $row['nome'] . " <b>(ID: " . $uid . ")</span></b></p></center><br><br>
                <form method=\"post\" action=\"editandoUsuario.php\" class=\"col s12\">";
                echo '<input type="hidden" name="neID" value="' . $uid . '" />';
                echo "
                
                <div class=\"input-field col s6\">
                <input value=\"" . $row['nome'] . "\" placeholder=\"Insira o nome do recurso\" id=\"eNome\" type=\"text\" class=\"validate\" name=\"eNome\" required>
                <label for=\"eNome\">Nome de Usuário</label>
              </div><br>
                
                ";

                if ($row['ativo'] == '1') {
                    echo "
                <div class='input-field col s12'>
                <select name='status'>
                  <option value='1' selected='selected'>Ativo</option>
                  <option value='0'>Desativado</option>
                </select>
                <label>Tipo de Conta</label>
              </div>
                ";
                } else {
                    echo "
                    <div class='input-field col s12'>
                    <select name='status'>
                      <option value='1'>Ativo</option>
                      <option value='0' selected='selected'>Desativado</option>
                    </select>
                    <label>Tipo de Conta</label>
                  </div>
                    ";
                }
                echo "<br>";
                if ($row['tipo'] == '1') {
                    echo "
                <div class='input-field col s12'>
                <select name='tipoconta'>
                  <option value='1' selected='selected'>Administrador</option>
                  <option value='2'>Normal</option>
                </select>
                <label>Status</label>
              </div>
                ";
                } else {
                    echo "
                    <div class='input-field col s12'>
                    <select name='tipoconta'>
                      <option value='1'>Administrador</option>
                      <option value='2' selected='selected'>Normal</option>
                    </select>
                    <label>Status</label>
                  </div>
                    ";
                }

                echo "<br>
                <center>
                <button type=\"submit\" class=\"btn waves-effect waves-light btn-large white black-text\" name=\"action\">SALVAR
                <i class=\"material-icons right\">save</i>
              </button>

              </center>
                
                ";


                // Closing Form and container
                echo "
                
                </form>
                </div>";
            }

            mysqli_close($con);
        }

        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').formSelect();
        });

        $(document).ready(function() {
            $('.sidenav').sidenav();
        })
    </script>
</body>

</html>