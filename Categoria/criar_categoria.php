<?php
// Importa a configuração de conexão com o banco de dados.
require_once('../conexao/conexao.php');

include_once('../include/nav.php');

// Bloco que será executado quando o formulário for submetido.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Bloco para adicionar nova categoria.
    if (isset($_POST['nova_categoria'])) {
        $nova_categoria_nome = $_POST['nova_categoria_nome'];
        $nova_categoria_descricao = $_POST['nova_categoria_descricao'];
        $nova_categoria_ativo = isset($_POST['nova_categoria_ativo']) ? 1 : 0;

        try {
            $sql_categoria = "INSERT INTO CATEGORIA (CATEGORIA_NOME, CATEGORIA_DESC, CATEGORIA_ATIVO) VALUES (:nome, :descricao, :ativo)";
            $stmt_categoria = $pdo->prepare($sql_categoria);
            $stmt_categoria->bindParam(':nome', $nova_categoria_nome, PDO::PARAM_STR);
            $stmt_categoria->bindParam(':descricao', $nova_categoria_descricao, PDO::PARAM_STR);
            $stmt_categoria->bindParam(':ativo', $nova_categoria_ativo, PDO::PARAM_INT);
            $stmt_categoria->execute();

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById("confirmModal"));
                myModal.show();
            });
          </script>';
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Erro ao cadastrar categoria: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Categoria</title>
    <link rel="stylesheet" href="../include/criar_categoria.css">
</head>

<body>
    <div class="mt-3">
        <h1 class="display-4 py-2">Criar Categoria</h1>
    </div>
    <div class="container bg-dark">
        <div class="row">
            <div class="col-6">
                <form method="POST" action="">
                    <p>
                        <tr>
                            <label for="nova_categoria_nome">Nome da Nova Categoria:</label>
                            <input type="text" name="nova_categoria_nome" required>
                        </tr>
                    <p>
                        <tr>
                            <label for="nova_categoria_descricao">Descrição da Nova Categoria:</label>
                            <textarea name="nova_categoria_descricao" required></textarea>
                        </tr>
                    <p>
                        <tr>
                            <label for="nova_categoria_ativo">Ativo:</label>
                            <input type="checkbox" name="nova_categoria_ativo">
                        </tr>
                    <p>
                        <input type="submit" name="nova_categoria" class="btn btn-outline-light"
                            value="Adicionar Nova Categoria">

                    <div class="modal" id="confirmModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Atenção</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Sua Categoria foi Criada com Sucesso!!!</p>
                                </div>
                                <div class="modal-footer d-flex">
                                    <button type="button" class="btn btn-large btn-outline-light" data-dismiss="modal"
                                        aria-label="Close">Fechar</button>
                                    <a href="categoria.php" class="btn btn-outline-light">Lista de Categoria</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>