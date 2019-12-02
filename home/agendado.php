    <?php

    // Conexão com a base de dados
    require('../includes/conn.php');
    // Verificador de Sessão
    require('../includes/verifica.php');

    $data = $_POST['data'];
    $horario = $_POST['horario'];

    $data = date( 'm/d/Y', strtotime($data));

    $reserva = "$data $horario";

    $recId = (int) $_POST['recId'];
    $usuario = $_SESSION['id_usuario'];
    $nome = $_POST['nome'];


    if($horario == " ") {
        header("Location: agendando_recurso.php");
    }

    $query_verifica = "SELECT * FROM `reservas` WHERE `reserva` = '" . $reserva . "' AND `cancelado` = '0' AND `recId` = '" . $recId . "';";

    $result = mysqli_query($con, $query_verifica) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
    $total = mysqli_num_rows($result);
    if ($total == 0) {
        if (!($recId == 0)) {
            $query = "INSERT INTO `reservas` ( `recId`, `reserva`, `usuario`, `nome`, `cancelado` ) VALUES ( '" . $recId . "', '" . $reserva . "', '" . $usuario . "', '" . $nome . "', '0');";
            if (mysqli_query($con, $query) or die(" (2) Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
                header("location:agendando_recurso.php?c=rrcs");
            }
        }
    } else {
        header("location:agendando_recurso.php?c=raeitt");
    }

    mysqli_close($con);
    ?>
