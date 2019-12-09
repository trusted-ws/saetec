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

        .button-color {
            background-color: #58A4B0;
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
        <a href="#" class="brand-logo" style="font-size: 15px;">Editar Recurso</a>
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
    <br><a class="waves-effect waves-light btn-small white black-text" href="gerenciarRecurso.php"><i class="material-icons">arrow_back</i></a>
        <?php

        if (isset($_GET['recId'])) {
            $recId = $_GET['recId'];

            $query = "SELECT * FROM `recurso` WHERE `recId` = $recId;";
            $result = mysqli_query($con, $query);


            while ($row = mysqli_fetch_array($result)) {

                // Open Form and Container
                echo "
                <div class=\"container\"><br>
                <center><p><b>Você está editando o seguinte recurso:</b><br><span style=\"color: #58A4B0;\">" . $row['nome'] . " <b>(ID: " . $row['recId'] . ")</span></b></p></center><br><br>
                <form method=\"post\" action=\"editandoRecurso.php\" class=\"col s12\">";
                echo '<input type="hidden" name="recId" value="' . $recId . '" />';
                echo "
                
                <div class=\"input-field col s6\">
                <input value=\"" . $row['nome'] . "\" placeholder=\"Insira o nome do recurso\" id=\"nomeRecurso\" type=\"text\" class=\"validate\" name=\"eNome\" required>
                <label for=\"nomeRecurso\">Nome do Recurso</label>
              </div><br>
                
                ";

                echo "
                
                <div class=\"input-field col s6\">
                <input value=\"" . $row['quantidade'] . "\" placeholder=\"Insira uma quantidade\" id=\"quantidade\" type=\"number\" name=\"eQuantidade\" class=\"validate\" required>
                <label for=\"quantidade\">Quantidade do Recurso</label>
                <div style='color: #58A4B0; font-size: 12px;'>Para desativar o recurso, altere a quantidade para zero (0).</div>
                </div><br>
                
                ";

                if ($row['tipo_recurso'] == "Recurso / Aparelho") {
                    echo "
                <div class='input-field col s12'>
                <select name='tiporecurso'>
                  <option value='Recurso / Aparelho' selected='selected'>Recurso / Aparelho</option>
                  <option value='Sala / Laboratorio'>Sala / Laboratório</option>
                </select>
                <label>Tipo de Recurso</label>
              </div>
                ";
                } else {
                    echo "
                    <div class='input-field col s12'>
                    <select name='tiporecurso'>
                      <option value='Recurso / Aparelho'>Recurso / Aparelho</option>
                      <option value='Sala / Laboratorio' selected='selected'>Sala / Laboratório</option>
                    </select>
                    <label>Tipo de Recurso</label>
                  </div>
                    ";
                }

                echo "<br>
                
                <div class=\"input-field col s12\">
                <textarea id=\"eDescricao\" class=\"materialize-textarea\" name=\"eDescricao\" required>" . $row['descricao'] . "</textarea>
                <label for=\"eDescricao\">Descrição do Recurso</label>
              </div>

                ";

                echo "
                <center>
                <button type=\"submit\" class=\"btn waves-effect waves-light btn-large button-color\" name=\"action\">SALVAR
                <i class=\"material-icons right\">save</i>
              </button>
              
              <a onclick=\"excluirRecurso(" . $row['recId'] . ");\" class=\"btn waves-effect waves-light red btn-large\" name=\"action\"><i class=\"material-icons\">delete</i>
            </a>
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