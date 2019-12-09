<html>

<head>
    <title>Agendar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#373F51">
    <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>

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
        require('../../includes/conn.php');
        // Verificador de Sessão
        require('../../includes/verifica.php');

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

                $idusuario = $row['usuario'];
                $query_usuario = "SELECT `nome` FROM `usuarios` WHERE id = '$idusuario';";
                $result_usuario = mysqli_query($con, $query_usuario);
                $row_usuario = mysqli_fetch_array($result_usuario);
                $usuario = $row_usuario['nome'];

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
                } else {

                    echo "<span style=\"padding-left:8px;color:gray;\">Faltam " . $dias . " dia(s) para este evento acontecer.</span>";

                    echo "<ul class=\"list-group\">";
                    $a = explode(" ", $dataComp);
                    $dataAmostra = strtotime($a[0]);
                    $dataAmostra = date('d/m/Y', $dataAmostra);
                    echo "<li class=\"list-group-item\" style=\"background-color: #D8DBE2 \"> Este recurso foi reservado também para o dia <b>" . $dataAmostra . " das $dataConverter até $horaFinal</b> por <span style=\"color: #58A4B0; font-size: 16;\">$usuario</span></li>";
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
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select name="horario" class="form-control selectpicker" id="combobox">
                            <option value=" ">Selecione um horário</option>
                            <option value="7:10 AM">7:10</option>
                            <option value="8:00 AM">8:00</option>
                            <option value="8:50 AM">8:50</option>
                            <option value="9:40 AM">9:40</option>
                            <option value="10:00 AM">10:00</option>
                            <option value="10:50 AM">10:50</option>
                            <option value="11:40 AM">11:40</option>
                            <option value="1:00 PM">13:00</option>
                            <option value="1:50 PM">13:50</option>
                            <option value="2:40 PM">14:40</option>
                            <option value="3:30 PM">15:30</option>
                            <option value="4:20 PM">16:20</option>
                            <option value="5:10 PM">17:10</option>
                            <option value="7:00 PM">19:00</option>
                            <option value="7:50 PM">19:50</option>
                            <option value="8:40 PM">20:40</option>
                            <option value="9:30 PM">21:30</option>
                            <option value="10:20 PM">22:20</option>
                        </select>
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
                    echo '<input class="btn btn-primary" type="submit" value="Agendar" id="submit" disabled>';
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
                    //stepping: 10,
                    format: 'MM/DD/YYYY',
                    locale: 'pt-br'
                });
            });
            $(document).ready(function() {
                // $('#combobox').val("0");

                $('#combobox').change(function() {
                    selectVal = $('#combobox').val();

                    if (selectVal == 0) {
                        $('#submit').prop("disabled", true);
                    } else {
                        $('#submit').prop("disabled", false);
                    }
                })

            });
        </script>
    </div>



</body>

</html>