    <?php

    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');
    // Verifica se usuário autenticado possuí privilégios de administrador
    require('../../includes/admin.php');

    //$eNome = $_POST['eNome'];
    //$eDescricao = $_POST['descricao'];
    //$eTipo = $_POST['tiporecurso'];
    //$eQuantidade = (is_numeric((int) $_POST['eQuantidade']) ? (int) $_POST['eQuantidade'] : 0);
    //$recId = $_POST['recId'];

	$eNome = isset($_POST["eNome"]) ? addslashes(trim($_POST["eNome"])) : FALSE;
	$eDescricao = isset($_POST["eDescricao"]) ? addslashes(trim($_POST["eDescricao"])) : FALSE; 
	$eTipo = isset($_POST["tiporecurso"]) ? addslashes(trim($_POST["tiporecurso"])) : FALSE;
	$recId = isset($_POST["recId"]) ? addslashes(trim($_POST["recId"])) : FALSE; 

	if(!($eNome || $eStatus || $eTipo || $id)) {
		header("Location: ../index.php");
		exit;
	}
	$eQuantidade = (is_numeric((int) $_POST['eQuantidade']) ? (int) $_POST['eQuantidade'] : 0);

    $query_update = "UPDATE recurso SET nome = '$eNome', tipo_recurso = '$eTipo', descricao = '$eDescricao', quantidade = '$eQuantidade' WHERE recId=$recId;";

    if (mysqli_query($con, $query_update) or die("Erro no banco de dados!" . " [ " . mysqli_error($con) . " ] ")) {
        echo '<script language="javascript">';
        echo 'alert("Editado com sucesso!")';
        echo '</script>';
        header('location:gerenciar_recursos.php');
    } else {
        echo "erro";
    }
    mysqli_close($con);

    ?>
