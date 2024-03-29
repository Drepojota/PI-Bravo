<?php
session_start();
require_once('../conexao/conexao.php');

include_once('../include/nav.php');

if (!isset($_SESSION['admin_logado'])) {
    header("Location:login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT*
                           FROM ADMINISTRADOR");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao listar produtos: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Listar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../include/lista_produtos.css">
    <style>
        .modal {
            padding-top: 15%;
            backdrop-filter: blur(10px);
        }

        .modal-content {
            background-color: #333;
            border: 1px solid #333;
            border-radius: 10px;
            width: 100%;
            height: 20%;
        }

        /* Personalize o cabeçalho do modal */
        .modal-header {
            background-color: #333;
            border-bottom: 2px solid #fff;
            border-radius: 10px 10px 0 0;
            text-align: center;
            align-items: center;
            padding-left: 35px;
        }

        .modal-header h1 {
            color: red;
            font-size: xx-large;
            font-family: Georgia, 'Times New Roman', Times, serif;
            padding-left: 2px;
        }

        /* Personalize o botão de fechar do modal */
        .modal-header .close {
            color: #fff;
        }

        /* Personalize o corpo do modal */
        .modal-body {
            color: #fff;
            font-size: large;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            padding-top: 10%;
        }

        /* Personalize o rodapé do modal */
        .modal-footer {
            background-color: #333;
            border-top: 0px solid #17a2b8;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 pt-5">
        <h1 class="display-4 py-3">Lista de Administradores</h1>
        <p class="lead"></p>
    </div>
    <div class="container mt-3 mb-S">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-12 d-flex align-center d ">
                <table class="table table-striped table-dark" id="admin-table">
                    <thead class="align-center">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Ativo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto) : ?>
                            <tr>
                                <td>
                                    <?php echo $produto['ADM_ID']; ?>
                                </td>
                                <td>
                                    <?php echo $produto['ADM_NOME']; ?>
                                </td>
                                <td>
                                    <?php echo $produto['ADM_EMAIL']; ?>
                                </td>
                                <td>
                                    <?php echo $produto['ADM_SENHA']; ?>
                                </td>
                                <td>
                                    <?php echo ($produto['ADM_ATIVO'] == 1 ? 'Sim' : 'Não'); ?>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="editar_admin.php?id=<?php echo $produto['ADM_ID']; ?>">Editar</a> |
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Excluir
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content d-flex">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Atenção</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Página de Exclusão Ainda Está em Desenvolvimento
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>