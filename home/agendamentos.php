<!DOCTYPE html>
<html>

<head>
  <title>Saetec - Agendamentos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
  <script href="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script language="javascript">
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
          // Swal.fire(
          //   'Excluido!',
          //   'Esse agendamento foi excluido',
          //   'success'
          // )
          location.href = "/home/cancelar.php?id=" + idAgendamento;
        }
      })
    }

    function showAgendamentosAtivos() {
      Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
      })
    }
  </script>

  <style>
    body {
      background: rgb(169, 188, 208);
      background: linear-gradient(353deg, rgba(169, 188, 208, 1) 0%, rgba(169, 188, 208, 1) 16%, rgba(88, 164, 176, 1) 100%);
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
  </style>

</head>

<body>

  <ul class="h-menu">
    <li><a href="index.php"><span class="mif-home icon"></span> Saetec</a></li>
    <li><a href="agendar_objeto.php"><span class="mif-calendar icon"></span> Agendar</a></li>
    <li><a href="agendamentos.php"><span class="mif-insert-template icon"></span> Agendamentos</a></li>
    <li><a href="minhaconta.php"><span class="mif-user icon"></span> Minha Conta</a></li>
    <!-- <li><a href="estatisticas.php"><span class="mif-chart-dots icon"></span> Estatísticas</a></li> -->
    <?php
    date_default_timezone_set('America/Fortaleza');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

    // Conexão com a base de dados
    require('../includes/conn.php');
    // Verificador de Sessão
    require('../includes/verifica.php');

    $query_usuarios_pendentes = "SELECT * FROM `usuarios` where `pendente` = 1;";
    $result_usuarios_pendentes = mysqli_query($con, $query_usuarios_pendentes);
    $num_rows_usuarios_pendentes = mysqli_num_rows($result_usuarios_pendentes);

    if ($_SESSION["permissao"] == "1") {

      // echo " <button class=\"dropbtn\">Admin";
      // echo " <i class=\"fa fa-caret-down\"></i>";
      // echo " </button>";
      // echo "  <div class=\"dropdown-content\">";
      // echo "  <a href=\"admin/incluir_objeto.php\">Incluir</a>";
      // echo "  <a href=\"admin/gerenciar_recursos.php\">Gerenciar</a>";
      // echo "  <a href=\"admin/cadastrar.php\">Cadastrar</a>";
      // echo "  <a href=\"admin/gerenciar.php\">Usuários</a>";
      // echo "</div>";
      echo '
    <li>';
    if($num_rows_usuarios_pendentes > 0) {
      echo '<a href="#" class="dropdown-toggle"><span class="mif-command icon"></span> Gerênciar <span class="badge inline bg-cyan fg-white">' . $num_rows_usuarios_pendentes . '</span></a>';
    } else {
    echo '<a href="#" class="dropdown-toggle"><span class="mif-command icon"></span> Gerênciar</a>';
  }
      echo '
    <ul class="d-menu" data-role="dropdown">
      <li>
        <a href="#" class="dropdown-toggle"><span class="mif-dashboard icon"></span> Recursos</a>
        <ul class="d-menu" data-role="dropdown">
          <li><a href="admin/incluir_objeto.php"><span class="mif-add icon"></span> Adicionar Recurso</a></li>
          <li><a href="admin/gerenciar_recursos.php"><span class="mif-developer_board icon"></span> Gerênciar Recurso</a></li>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a href="admin/cadastrar.php"><span class="mif-user-plus icon"></span> Cadastrar Usuários</a></li>';
      if($num_rows_usuarios_pendentes > 0) {
        echo '<li><a href="admin/gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários <span class="badge inline bg-cyan fg-white">' . $num_rows_usuarios_pendentes . '</span></a></li>';
      } else {
        echo '<li><a href="admin/gerenciar.php"><span class="mif-users icon"></span> Gerênciar Usuários</a></li>';
      }
      echo '
      <li class="divider"></li>
    </ul>
  </li>
';
    }
    ?>
    <li><a href="/home/sair.php"><span class="mif-exit icon"></span> Sair</a></li>
  </ul>
  </div>

  <div class="container">
    <?php
    echo "<div style=\"color: #fff; text-shadow: 2px 2px #000;padding-left: 20px;\"><h1>Agendamentos</h1></div>";
    $myId = $_SESSION['id_usuario'];

    if ($_SESSION['permissao'] == "1") {
      $query = "SELECT * FROM `reservas` where `cancelado` = 0;";

      $result = mysqli_query($con, $query);
      $num_rows = mysqli_num_rows($result);
      
      echo '<div class="info-button">
      <a href="#" data-role="popover" data-popover-text="Você possui ' . $num_rows . ' agendamentos neste momento." data-popover-position="bottom" data-popover-trigger="click" class="button"><span class="mif-calendar icon"></span> Agendamentos ativos</a>
      <a href="#" class="info">' . $num_rows . '</a>
  </div>
      ';

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
        $dataConverter = date("G:i", strtotime($row['reserva'])); // Converte o $dataComp para hora (Ex.: 15:40)
        $dataConverterAgora = date("G:i", strtotime($dataAgora)); // Converte a hora atual para formato (G:i) (Ex.: 21:10)

        // echo "<h1 style=\"color:red;\">Convert: " . $dataConverter . "</h1><br>";
        // echo "<h1 style=\"color:red;\">Agora: " . $dataConverterAgora . "</h1><br>";

        $dif = strtotime($dataComp) - strtotime($dataAgora);
        $dias = floor($dif / (60 * 60 * 24));

        // Verifica se o dia do agendamento já aconteceu, se sim o evento é cancelado.

        $excluirEvento = false;
        if ($dias == 0) {
          if ($dataConverterAgora > $dataConverter) {
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
        
        // --- --- ---

        echo "<tr>";
        
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . ucwords(strftime('%d de %B de %Y às %H:%M (%A)', strtotime($row['reserva']))) . "</td>";
        $query_nome_usuario = "SELECT `nome` FROM `usuarios` WHERE id = " . $row['usuario'] . ";";
        $query_nome_usuario_result = mysqli_query($con, $query_nome_usuario);
        $query_nome_usuario_row = mysqli_fetch_array($query_nome_usuario_result);
        echo "<td>" . $query_nome_usuario_row['nome'] . " <button class=\"button white mini rounded\"><b> ID: </b> " . $row['usuario'] . "</button></td>";
        //echo "<td><a class='button alert outline' href=\"/home/cancelar.php?id=" . $row['id'] . "\">CANCELAR</a></td>";
        echo "<td><a class=\"button alert cycle outline\" onclick=\"cancelarAgendamento(" . $row['id'] . ");\"><span class=\"mif-cross\"></span></a></td>";
        
        echo "</tr>";
      }
      echo "</table>";
      if ($num_rows < 1) {
        echo '<br><div class="fg-white" id="tableShadow">';
        echo '<p class="p-15 text-center">Não há nenhum agendamento no sistema.</p>';
        echo '</div>';
      }
    } else {
      $query = "SELECT * FROM `reservas` where `usuario` = '$myId' AND `cancelado` = 0;";
      $result = mysqli_query($con, $query);
      $num_rows = mysqli_num_rows($result);
      
      echo '<div class="info-button">
      <a href="#" class="button"><span class="mif-calendar icon"></span> Agendamentos ativos</a>
      <a href="#" class="info">' . $num_rows . '</a>
  </div>
      ';

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
        //echo "<td><a class='button alert outline' href=\"/home/cancelar.php?id=" . $row['id'] . "\">CANCELAR</a></td>";
        echo "<td><a class=\"button alert cycle outline\" onclick=\"cancelarAgendamento(" . $row['id'] . ");\"><span class=\"mif-cross\"></span></a></td>";
        echo "</tr>";
      }
      echo "</table>";
      if ($num_rows < 1) {
        echo '<br><div class="fg-white" id="tableShadow">';
        echo '<p class="p-15 text-center">Você não possuí nenhum agendamento.</p>';
        echo '</div>';
      }
    }

    mysqli_close($con);
    ?>
  </div>
  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>

</html>