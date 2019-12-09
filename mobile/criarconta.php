<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saetec - Criar Conta</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                    <h5 class="grey-text" style="padding-top: 20px;">Criar Conta</h5>
                    <form class="col s12" method="post" action="" id="formValidate">
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' placeholder="João da Silva" type='text' name='username' id='username' required />
                                <label for='username'>Nome de Usuário</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input placeholder="joao@email.com" class='validate' type='email' name='email' id='email' data-error='E-mail não é válido.' required />
                                <label for='email'>E-mail</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' placeholder="" type='password' name='password' minlength='8' id='password' required />
                                <label for='password'>Nova Senha</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' placeholder="" type='password' name='password_confirm' minlength='8' id='password_confirm' required />
                                <label for='password_confirm'>Repita a Senha</label>
                            </div>
                        </div>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Criar Conta</button>
                            </div>
                            Já possui uma conta?<br><a href="index.php">Conecte-se agora!</a>
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
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $("#formValidate").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 4
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirm: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                messages: {
                    username: {
                        required: "",
                        minlength: ""
                    },
                    email: {
                        required: "",
                        minlength: "",
                    },
                    password: {
                        required: "",
                        minlength: ""
                    },
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            }
        });
    </script> -->

    <?php
    // Conexão com a base de dados
    require('../includes/conn.php');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $login = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
        $senha = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE;
        $senha_confirma = isset($_POST["password_confirm"]) ? md5(trim($_POST["password_confirm"])) : FALSE;
        $nome = isset($_POST["username"]) ? addslashes(trim($_POST["username"])) : FALSE;


        if (!($login || $senha || $senha_confirma || $nome)) {
            echo "
			<script language=\"javascript\">
			Swal.fire(
			  'Falha ao Cadastrar',
			  'Todos os campos são obrigatórios!',
			  'error'
			)
			</script>
			";
            die();
        }


        if (!($senha == $senha_confirma)) {
            echo "
			<script language=\"javascript\">
			Swal.fire(
			  'Falha ao Cadastrar',
			  'As senhas não correspondem',
			  'error'
			)
			</script>
			";
            die();
        }


        $query_usuario = "SELECT * FROM `usuarios` WHERE `username` = '" . $login . "';";

        $result = mysqli_query($con, $query_usuario) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
        $total = mysqli_num_rows($result);
        $result = mysqli_query($con, $query_usuario) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ");
        $total = mysqli_num_rows($result);
        if ($total == 0) {
            $query = "INSERT INTO `usuarios` ( `nome`, `username`, `password`, `tipo`, `ativo`, `pendente`) VALUES ( '" . $nome . "', '" . $login . "', '" . $senha . "', '2', '1', '1');";
            if (mysqli_query($con, $query) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
                //header("location:/mobile/sucesso.php");
                echo "
                <script language=\"javascript\">
                window.location.href = \"/mobile/sucesso.php\";
                </script>
                ";
            }
        } else {
            echo "
			<script language=\"javascript\">
			Swal.fire(
			  'Falha ao Cadastrar',
			  'O e-mail informado já está em uso',
			  'error'
			)
			</script>
			";
        }
    } else { }
    ?>
</body>

</html>