<?php
// Verificador de Sessão
session_start();

// Verifica se existe os dados da sessão de login 
if (!(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"]))) {
    // Usuário logado! Redireciona para a página home 

    header("location: /mobile/home/index.php");
    exit;
}


?>

<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saetec - Login</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        body {
            background: #fff;
        }

        .input-field input[type=date]:focus+label,
        .input-field input[type=text]:focus+label,
        .input-field input[type=email]:focus+label,
        .input-field input[type=password]:focus+label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class=""></div>
    <main>
        <center>
            <!-- <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" /> -->
            <div class=""></div>

            <!-- <h5 class="indigo-text">Please, login into your account</h5> -->
            <div class="section"></div>

            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    <img class="responsive-img" style="width: 250px;" src="../LogoM.png" />
                    <h5 class="grey-text" style="padding-top: 20px;">Autentique-se</h5>
                    <form class="col s12" method="post" action="login.php">
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='username' id='email' required />
                                <label for='email'>E-mail</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' required />
                                <label for='password'>Senha</label>
                            </div>
                            <label style='float: right;'>
                                <!-- <a class='pink-text' href='#!'><b>Forgot Password?</b></a> -->
                            </label>
                        </div>
                        <?php

                        if (isset($_GET['c'])) {
                            if ($_GET['c'] == "uopww") {
                                echo "<div style=\"border-left: 2px solid red;padding-left: 4px; padding-bottom: 10px; padding-right: 14px; padding-left: 14px; padding-top: 1px; background-color: #ebb9b9;\"><p class=\"\"><center><b>Credenciais Inválidas</b><br>Usuário e/ou senha incorretos!</center></p></div>";
                            } else if ($_GET['c'] == "uopwb") {
                                echo "<div style=\"border-left: 2px solid #e3d10b;padding-left: 4px; padding-bottom: 10px; padding-right: 14px; padding-left: 14px; padding-top: 1px; background-color: #e0dfb6;\"><p class=\"\"> É necessário preencher todos os campos</p></div>";
                            } else if ($_GET['c'] == "taina") {
                                echo "<div style=\"border-left: 2px solid #e3d10b;padding-left: 4px; padding-bottom: 10px; padding-right: 14px; padding-left: 14px; padding-top: 1px; background-color: #e0dfb6;\"><p class=\"\"> Este usuário foi desativado</p></div>";
                            } else if ($_GET['c'] == "tuip") {
                                echo "<div style=\"border-left: 2px solid #e3d10b;padding-left: 4px; padding-bottom: 10px; padding-right: 14px; padding-left: 14px; padding-top: 1px; background-color: #e0dfb6;\"><p class=\"\"><center><b>Conta não Ativa</b><br>Seu cadastro ainda não foi aprovado pelo Administrador</center></p></div>";
                            }
                        } else { }
                        ?>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
                            </div>
                            Não possui uma conta?<br><a href="criarconta.php">Crie uma agora!</a>
                        </center>
                    </form>
                </div>

            </div>
            <div style="color: #a3a3a3; font-size: 12px;">
                <p>Desenvolvido por Murilo Augusto, Igor Gabriel e Luiz Gustavo
                    <br>E-mail para contato: <a href="mailto:eth0.db0@gmail.com">eth0.db0@gmail.com</a></p>
                    <a href="/index.php?c=desktop"><i class="material-icons">smartphoneforwardcomputer</i></a>

            </div>

        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>