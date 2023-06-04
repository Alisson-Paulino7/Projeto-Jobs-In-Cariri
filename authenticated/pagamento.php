<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}


$idUsuario = $_SESSION['user_id'];
$sql = "SELECT v.empresa, COALESCE(p.valor,'Primeiro pagamento') as valor, p.dtPagamento, v.cargo, c.nome, c.cpf, p.id_cadastro as id_cadastro, p.id_vaga as id_vaga FROM `pagamento` p
INNER JOIN `vagas` v
ON p.id_vaga = v.id
INNER JOIN `cadastro` c
ON c.id = p.id_cadastro
WHERE v.usuario_responsavel = '$idUsuario'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Pagamento</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <header>
        <ul>
            <a href="../authenticated/home.php">
                <li>
                    <img src="..\imagens\Logo.svg" alt="" class="logo"> JOBS IN CARIRI
                </li>
            </a>
            <li>
                Candidatos
            </li>
            <a href="../authenticated/cadastroVagas.php">
                <li>Empresas</li>
            </a>
            <li>Ultimas vagas</li>
            <div class="dropdown">
                <li class="dropdown-btn">Perfil</li>
                <ul class="dropdown-menu">
                    <a href="#">
                        <li>Editar perfil</li>
                    </a>
                    <a href="../authenticated/ranking.php">
                        <li>Ranking</li>
                    </a>
                    <a href="../authenticated/editarPerfil.php">
                        <li>Profissão</li>
                    </a>
                    <a href="#">
                        <li>Contratos</li>
                    </a>
                    <a href="#">
                        <li>Chat</li>
                    </a>
                    <a href="../authenticated/pagamento.php">
                        <li>Pagamentos</li>
                    </a>
                    <a href="..\login.php">
                        <li>Sair</li>
                    </a>
                </ul>
            </div>


        </ul>
    </header>
    <h1>Lista de profissionais vinculados a suas vagas</h1>

    <table>
        <tr>
            <th>Empresa</th>
            <th>Cargo</th>
            <th>Nome</th>
            <th>Cpf</th>
            <th>Valor</th>
            <th>Dt ultimo pagamento</th>
            <th>Ação</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='tpgto'>";
                echo "<td>" . $row["empresa"] . "</td>";
                echo "<td>" . $row["cargo"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["cpf"] . "</td>";
                echo "<td>" . $row["valor"] . "</td>";
                echo "<td>" . $row["dtPagamento"] . "</td>";

                echo "<td><a href='form_pagamento.php?id_cadastro=" . $row["id_cadastro"] . "&id_vaga=" . $row["id_vaga"] . "' style='color:green;'>Pagar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
        }
        ?>
    </table>

    <?php

    $conn->close();
    ?>
</body>

</html>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #F5F5F5;
        font-family: Roboto;
    }

    h1 {
        background-color: #FFFFFF;
        padding: 20px;
        text-align: center;
        margin: 0;
        color: #333333;
    }

    table {
        width: 100%;
        background-color: #FFFFFF;
        border-collapse: collapse;
        margin-top: 20px;
        border: none;

    }

    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border: none;
        
    }

    th {
        background:#ff8800;
        color: white;
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
       border: none;

    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #DDDDDD;
    }

    a {
        color: #333333;
        text-decoration: none;
    }

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-btn {


        border: none;
        cursor: pointer;
        padding: 10px 20px;
        font-size: 16px;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #033F63;

        font-size: 10px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        list-style: none;
        padding: 0;
        max-width: 88px;

        display: none;
        z-index: 1;
    }

    .dropdown-menu li {
        padding: 10px 10px;
        color: #fff;
    }

    .dropdown-menu li:hover {

        color: #033F63;
        background-color: #f1f1f1;
    }

    .dropdown-menu li a:hover {
        color: #033F63;

    }

    a {
        color: white;
    }

    .show {
        display: block;
    }
</style>

<script>
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', (event) => {
        if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-menu')) {
            dropdownMenu.classList.remove('show');
        }
    });
</script>