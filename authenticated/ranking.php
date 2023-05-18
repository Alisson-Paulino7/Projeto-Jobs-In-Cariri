<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ranking.css">
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Ranking</title>
</head>
<body>
<header>
    <ul>
        <a href="../authenticated/home.php"> <li>
            <img src="..\imagens\Logo.svg" alt="" class="logo"> JOBS IN CARIRI
        </li></a> 
        <li>
            Candidatos
        </li>
        <a href="../authenticated/cadastroVagas.php"> <li>Empresas</li></a>
        <li>Ultimas vagas</li>
        <div class="dropdown">
  <li class="dropdown-btn">Perfil</li>
  <ul class="dropdown-menu">
  <a href="../authenticated/perfil.php"><li>Editar perfil</li></a>
  <a href="#"> <li>Ranking</li></a>
  <a href="../authenticated/editarPerfil.php"> <li>Profissão</li></a>
  <a href="#"><li>Contratos</li></a>
  <a href="#"> <li>Chat</li></a>
  <a href="#"> <li>Pagamentos</li></a>
  <a href="..\login.php"><li>Sair</li></a>
  </ul>
</div>


    </ul>
</header>
</body>
<section>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php"); 
    exit();
}

$cidadeFiltro = isset($_POST['cidadeFiltro']) ? $_POST['cidadeFiltro'] : '';
$profissaoFiltro = isset($_POST['profissaoFiltro']) ? $_POST['profissaoFiltro'] : '';

$sql = "SELECT c.nome as n1, COALESCE(p.nome, 'Não cadastrada') as n2, c.cidade as cidade, c.foto 
        FROM `cadastro` c
        LEFT JOIN `profissao` p ON c.id_profissao = p.id";

if ($cidadeFiltro && $profissaoFiltro) {
    $sql .= " WHERE c.cidade LIKE '%$cidadeFiltro%' AND p.nome LIKE '%$profissaoFiltro%'";
} elseif ($cidadeFiltro) {
    $sql .= " WHERE c.cidade LIKE '%$cidadeFiltro%'";
} elseif ($profissaoFiltro) {
    $sql .= " WHERE p.nome LIKE '%$profissaoFiltro%'";
}

$result = $conn->query($sql);
$sqlProfissao = "SELECT  nome FROM profissao";
$resultProfissao = mysqli_query($conn, $sqlProfissao);
?>

   
<h2>Lista de Profissionais</h2>
    <form method="POST" action="">
    <h1>Filtro</h1>
        <select name="cidadeFiltro" id="cidadeFiltro">
            <option disabled selected>Cidade</option>
            <option value="">Todas as cidades</option>
            <option value="Crato">Crato</option>
            <option value="Juazeiro">Juazeiro</option>
            <option value="Barbalha">Barbalha</option>
            <option value="Fortaleza">Fortaleza</option>
        </select>

        <select name="profissaoFiltro" id="profissaoFiltro">
        <option disabled selected>Profissão</option>
            <option value="">Todas as profissões</option>
            <?php
            while ($rowProfissao = mysqli_fetch_assoc($resultProfissao)) {
                $nomeProfissao = $rowProfissao["nome"];
                echo "<option value=\"$nomeProfissao\">$nomeProfissao</option>";
            }
            ?>
        </select>

        <input type="submit" value="Buscar">
    </form>

    



<?php

$conn->close();
?>

</section>
<div class='lista-profissionais'>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "<div class='container' style='display:flex;'><div class='profissionais'>";
            echo "<p> Nome: " . $row['n1'] . "</p>";
            echo "<p> Profissão: " . $row['n2'] . "</p>";
            echo "<p>Cidade: " . $row['cidade'] . "</p>";
            echo "</div><img src='img/{$row['foto']}' style='border-radius: 100%; width:100px; height:100px;'></div>";
            
        }
    } else {
        echo "<p class='not-results'> Nenhum profissional encontrado!";
    }
    ?>
</div>
</body>
</html>
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
