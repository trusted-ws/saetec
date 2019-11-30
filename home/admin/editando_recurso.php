    <?php

    // Conexão com a base de dados
    require('../../includes/conn.php');
    // Verificador de Sessão
    require('../../includes/verifica.php');
    // Verifica se usuário autenticado possuí privilégios de administrador
    require('../../includes/admin.php');

    $eNome = $_POST['eNome'];
    $eDescricao = $_POST['descricao'];
    $eTipo = $_POST['tiporecurso'];
    $eQuantidade = (is_numeric((int) $_POST['eQuantidade']) ? (int) $_POST['eQuantidade'] : 0);
    $recId = $_POST['recId'];

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
