<html>

<head>
    <title>Agendar</title>

    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>

    <script type="text/javascript" src="/bower_components/bootstrap3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="/bower_components/bootstrap3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <meta charset="utf-8">
</head>

<body>

    <div class="container" style="margin-top: 100px;">
        <?php
        date_default_timezone_set('America/Fortaleza');

        // Conexão com a base de dados
        require('../includes/conn.php');
        // Verificador de Sessão
        require('../includes/verifica.php');

        $recId = 0;
        $buttonState = '1';
        $nome = "";
        if (isset($_GET['recId']) && isset($_GET['resname'])) {
            $recId = $_GET['recId'];
            $nome = $_GET['resname'];

            $query = "SELECT * FROM `reservas` WHERE recId = '$recId' AND `cancelado` = '0';";
            $result = mysqli_query($con, $query);

            $dataAgora = date('m/d/Y h:i A');
            echo "<h4 class=\"display-4\" style=\"color: gray;\">Você está agendando um(a)<h3 class=\"text-muted\" style=\"color:#4f000e;padding-left:15px;\">" . $nome . "</h3></h4><br><br>";

            while ($row = mysqli_fetch_array($result)) {

                $dataComp = $row['reserva']; // Retorna o valor do campo reserva (Ex.: 11/06/2019 3:40 PM)
                $dataConverter = date("G:i", strtotime($row['reserva'])); // Converte o $dataComp para hora (Ex.: 15:40)
                $dataConverterAgora = date("G:i", strtotime($dataAgora)); // Converte a hora atual para formato (G:i) (Ex.: 21:10)

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
                } else {

                    echo "<span style=\"padding-left:8px;color:gray;\">Faltam " . $dias . " dia(s) para este evento acontecer.</span>";

                    echo "<ul class=\"list-group\">";
                    echo "<li class=\"list-group-item\"> Este recurso foi reservado também para o dia <b>" . $row['reserva'] . "</b></li>";
                    echo "</ul>";
                }
            }
        }

        ?>
        <?php
        if (isset($_GET['c'])) {
            if ($_GET['c'] == "raeitt") {
                echo '<div class="alert alert-danger"><strong>Erro!</strong> Este recurso já está reservado para este dia ou horário.</div>';
            }
            if ($_GET['c'] == "rrcs") {
                echo '<div class="alert alert-success"><strong>Sucesso!</strong> Este recurso foi reservado com sucesso.</div>';
                $buttonState = '0';
            }
        }
        ?>
        <hr>
        <div class="col-sm-6" style="height:130px;">
            <form action="agendado.php" method="post">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker11'>
                        <input type='text' class="form-control" name="data" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                </div>
                <?php
                echo "<input type=\"hidden\" name=\"recId\" value=\"" . $recId . "\">";
                echo "<input type=\"hidden\" name=\"nome\" value=\"" . $nome . "\">";
                ?>
                <?php
                if ($buttonState == '0') {
                    echo '<input class="btn btn-primary" type="submit" value="Agendar" disabled>';
                } else {
                    echo '<input class="btn btn-primary" type="submit" value="Agendar">';
                }
                ?>
                <a class="btn btn-primary" href="agendar_objeto.php">Voltar</a>
            </form>
        </div>
        <script type="text/javascript">
            $(function() {
                $('#datetimepicker11').datetimepicker({
                    daysOfWeekDisabled: [0, 0],
                    showClear: true,
                    sideBySide: true,
                    stepping: 10
                });
            });
        </script>
    </div>



</body>

</html>