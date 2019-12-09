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
    <script>
        function cancelarAgendamento(idAgendamento) {
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
                    location.href = "/mobile/home/cancelar.php?id=" + idAgendamento;
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

        .button-color {
            background-color: #58A4B0;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        #inner {
            width: 50%;
            margin: 0 auto
        }

        #tableShadow {
            border: 1px solid;
            padding: 10px;
            box-shadow: 1px 3px 10px black;
        }

        .footer {
            position: absolute;
            right: 0;
            bottom: 1;
            left: 0;
            padding: 1rem;
            color: #efefef;
            text-align: center;
            margin-top: 20px;
            /* padding-bottom: 50%; */
        }
    </style>
</head>

<body>
    <?php
    date_default_timezone_set('America/Fortaleza');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');

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
        <a href="#" class="brand-logo" style="font-size: 15px;">Agendamentos</a>
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
        <br><br>
        <?php
        // echo "<div style=\"color: #fff; text-shadow: 2px 2px #000;padding-left: 20px;\"><h1>Agendamentos</h1></div>";
        $myId = $_SESSION['id_usuario'];

        if ($_SESSION['permissao'] == "1") {
            $query = "SELECT * FROM `reservas` where `cancelado` = 0;";

            $result = mysqli_query($con, $query);
            $num_rows = mysqli_num_rows($result);

            //             echo '<div class="info-button">
            //       <a href="#" data-role="popover" data-popover-text="Há ' . $num_rows . ' agendamento(s) neste momento." data-popover-position="bottom" data-popover-trigger="click" class="button"><span class="mif-calendar icon"></span> Agendamentos ativos</a>
            //       <a href="#" class="info">' . $num_rows . '</a>
            //   </div>
            //       ';

            echo "<table border='8' id='tableShadow'>
  <tr style='background-color: #d8dbe2';>
  <th>Recurso</th>
  <th>Reservado para</th>
  <th>Reservado por</th>
  <th></th>
  
  </tr>";

            $dataAgora = date('m/d/Y h:i A');

            while ($row = mysqli_fetch_array($result)) {

                // Verifica se agendamento existe

                $dataComp = $row['reserva']; // Retorna o valor do campo reserva (Ex.: 11/06/2019 3:40 PM)
                $dataComp = date("m/d/Y h:i A", strtotime($dataComp)); // Converte o valor m/d/Y para d/m/Y
                $dataConverter = date("G:i", strtotime($row['reserva'])); // Converte o $dataComp para hora (Ex.: 15:40)
                $horaFinal = strtotime($dataConverter);
                $horaFinal = date("H:i", strtotime('+50 minutes', $horaFinal)); // Adiciona 50 minutos ao horario de agendamento.
                $dataConverterAgora = date("G:i", strtotime($dataAgora)); // Converte a hora atual para formato (G:i) (Ex.: 21:10)

                $dataHoje = date("d/m/Y", strtotime($dataAgora));

                $dif = strtotime($dataComp) - strtotime($dataAgora);

                // echo "<p style='color: yellow; background-color: blue; padding-left: 30px; padding-top: 10px; padding-bottom: 10px;'>datacomp: " . $dataComp . "";
                // echo "<br>dataagora: " . $dataAgora . "</p>";

                $dias = floor($dif / (60 * 60 * 24) + 1);

                // Verifica se o dia do agendamento já aconteceu, se sim o evento é cancelado.

                $excluirEvento = false;
                if ($dias == 0) {
                    if ($dataConverterAgora > $horaFinal) {
                        $excluirEvento = true;
                    }
                }

                if ($dias < 0 || $dataComp == $dataAgora || $excluirEvento == true) {
                    $recId = $row['recId'];
                    $query_update = "UPDATE reservas SET cancelado = '1' WHERE recId=$recId;";
                    if (mysqli_query($con, $query_update) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) { } else {
                        echo "erro";
                    }
                }

                echo "<tr>";

                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . ucwords(strftime('%d de %B de %Y às %H:%M (%A)', strtotime($row['reserva']))) . "</td>";
                $query_nome_usuario = "SELECT `nome` FROM `usuarios` WHERE id = " . $row['usuario'] . ";";
                $query_nome_usuario_result = mysqli_query($con, $query_nome_usuario);
                $query_nome_usuario_row = mysqli_fetch_array($query_nome_usuario_result);
                echo "<td>" . $query_nome_usuario_row['nome'] . " (<b>ID: </b> " . $row['usuario'] . ")</td>";

                // echo "<td><a class=\"button\" onclick=\"cancelarAgendamento(" . $row['id'] . ");\"><span class=\"mif-cross\"></span></a></td>";

                echo '<td><a class="btn waves-effect waves-light red" name="agendar" onclick="cancelarAgendamento(' . $row['id'] . ');">CANCELAR</a></td>';

                echo "</tr>";
            }
            echo "</table>";
            if ($num_rows < 1) {
                echo '<br><div class="fg-white" id="tableShadow">';
                echo '<p class="center" style="color: white;">Não há nenhum agendamento no sistema.</p>';
                echo '</div>';
            }
        } else {
            $query = "SELECT * FROM `reservas` where `usuario` = '$myId' AND `cancelado` = 0;";
            $result = mysqli_query($con, $query);
            $num_rows = mysqli_num_rows($result);

            //             echo '<div class="info-button">
            //       <a href="#" data-role="popover" data-popover-text="Você possui ' . $num_rows . ' agendamento(s) neste momento." data-popover-position="bottom" data-popover-trigger="click" class="button"><span class="mif-calendar icon"></span> Agendamentos ativos</a>
            //       <a href="#" class="info">' . $num_rows . '</a>
            //   </div>
            //       ';

            echo "<table border='8' id='tableShadow'>
  <tr style='background-color: #d8dbe2';>
  <th>Recurso</th>
  <th>Reservado para</th>
  <th></th>
  
  </tr>";

            $dataAgora = date('m/d/Y h:i A');

            while ($row = mysqli_fetch_array($result)) {

                // Verifica se agendamento existe

                $dataComp = $row['reserva'];
                $dif = strtotime($dataComp) - strtotime($dataAgora);
                $dias = floor($dif / (60 * 60 * 24));

                if ($dias < 0 || $dataComp == $dataAgora) {
                    $recId = $row['recId'];
                    $query_update = "UPDATE reservas SET cancelado = '1' WHERE recId=$recId;";
                    if (mysqli_query($con, $query_update) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) { } else {
                        echo "erro";
                    }
                }

                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . ucwords(strftime('%d de %B de %Y às %H:%M (%A)', strtotime($row['reserva']))) . "</td>";
                // echo "<td><a class=\"button alert cycle outline\" onclick=\"cancelarAgendamento(" . $row['id'] . ");\"><span class=\"mif-cross\"></span></a></td>";
                echo '<td><a class="btn waves-effect waves-light" name="agendar" onclick="cancelarAgendamento(' . $row['id'] . ');">CANCELAR</a></td>';
                echo "</tr>";
            }
            echo "</table>";
            if ($num_rows < 1) {
                echo '<br><div class="fg-white" id="tableShadow">';
                echo '<p class="center" style="color: white;">Você não possuí nenhum agendamento.</p>';
                echo '</div>';
            }
        }

        mysqli_close($con);
        ?>

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