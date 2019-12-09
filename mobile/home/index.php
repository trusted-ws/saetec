<html>

<head>
    <title>Saetec</title>
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
        .navcolor3 {
            background-color: #58A4B0;
        }
        .navcolor4 {
            background-color: #B8C8D8;
        }
        
    </style>
</head>

<body>
    <?php
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
        <a href="#" class="brand-logo">Saetec</a>
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


    <div class=" white-text">

        <div class="carousel carousel-slider center">
            <!-- <div class="carousel-fixed-item center">
                <a class="btn waves-effect white grey-text darken-text-2">button</a>
            </div> -->
            <div class="carousel-item navcolor white-text" href="#one!">
                <h2>Bem-vindo ao <b>Saetec</b></h2>
                <p class="white-text">Caso precise de ajuda<br>é só arrastar a tela para o lado :)</p>
                <i class="material-icons">arrow_forward</i>
            </div>
            <div class="carousel-item navcolor white-text" href="#two!">
                <h2>Para <span style="color: #58A4B0;">realizar</span> um agendamento</h2>
                <p class="white-text">Abra o menu <span style="font-size: 30px;">(</span><i class="material-icons">menu</i><span style="font-size: 30px;">)</span>, em seguida va em 'agendar'.<br>Depois é só escolher o recurso a ser agendado e agenda-lo.</p>
            </div>
            <div class="carousel-item navcolor white-text" href="#three!">
                <h2>Para <span style="color: red;">cancelar</span> um agendamento</h2>
                <p class="white-text">É só abrir o menu <span style="font-size: 30px;">(</span><i class="material-icons">menu</i><span style="font-size: 30px;">)</span>, depois é só clicar no 'agendamentos' para exibir todos os seus agendamentos.<br></p>
            </div>
            <div class="carousel-item navcolor white-text" href="#four!">
                <h2>Para alterar sua <b>senha</b> ou seu <b>nome de usuário</b></h2>
                <p class="white-text">Abra o menu <span style="font-size: 30px;">(</span><i class="material-icons">menu</i><span style="font-size: 30px;">)</span>, em seguida clique em 'Minha Conta'. Lá você pode alterar seu <b>nome de usuário</b> e sua <b>senha</b>.</p>
            </div>
            <div class="carousel-item navcolor white-text" href="#four!">
                <h2>Para mais informações</h2>
                <p class="white-text">Consulte o <a style="color: #58A4B0; text-decoration: underline;" href="/tutorial/f8032d5cae3de20fcec887f395ec9a6a.pdf" target="_BLANK">Guia do Usuário</a> para Desktop.</p>
            </div>
            <div class="carousel-item navcolor white-text" href="#four!">
                <!-- <h2>#Saetec</h2> -->
                <p class="white-text"><br><br><span class="" style="font-size: 12px;"><span style="text-align: justify; text-justify: inter-word;">O Sistema de Agendamentos da Etec (SAETEC) foi desenvolvido para facilitar o agendamento de um recurso por parte do corpo docente. Este projeto é componente de um Trabalho de Conclusão de Curso realizado pelos alunos do curso de Informática para Internet do ETIM 3º B1 de 2019.</span><br><br><br><br><br>Desenvolvido por Murilo Augusto, Igor Gabriel e Luiz Gustavo<br>E-mail para contato: <a href="mailto:eth0.db0@gmail.com">eth0.db0@gmail.com</a></span><br><br>Sistema de Agendamentos da Etec &copy 2019</p>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true
        });
        $(document).ready(function() {
            $('.sidenav').sidenav();
        })
    </script>
</body>

</html>