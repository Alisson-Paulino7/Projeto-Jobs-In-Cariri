<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Cadastro</title>
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
  <a href="../authenticated/ranking.php"> <li>Ranking</li></a>
  <a href="../authenticated/editarPerfil.php"> <li>Profissão</li></a>
  <a href="#"><li>Contratos</li></a>
  <a href="#"> <li>Chat</li></a>
  <a href="../authenticated/pagamento.php"> <li>Pagamentos</li></a>
  <a href="..\login.php"><li>Sair</li></a>
  </ul>
</div>


    </ul>
</header>

<main>
    <section>
    <h1>Ultimos usuarios</h1>
    <?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql = "SELECT c.nome as n1, COALESCE(p.nome, 'Profissão não cadastrada') as n2 FROM `cadastro` c
left JOIN `profissao` p
ON c.id_profissao = p.id ";



$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    $count = 0;

   
    while($row = $result->fetch_assoc()) {
        
        if ($count >= 5) {
            break;
        }

        
        echo "<div class='container-vagas'>"."<div class='vagas'>"." Nome: " . $row["n1"]."<br>" . " Profissão: " . $row["n2"]. "<br>"."</div>"."<div class='candidatar'>"."<p> Contratar</p>"."</div>"."</div>";

        
        $count++;
    }
} else {
    echo "<div class='not-jobs'>Nenhuma vaga encontrada.</div>";
}


?>
    </section>

<section>
<h1>Ultimas vagas</h1>
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


$idUsuario = $_SESSION['user_id'];

$sql = "SELECT *
FROM vagas
WHERE usuario_responsavel != '$idUsuario'
ORDER BY data_cadastro DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 0;

    while($row = $result->fetch_assoc()) {
        if ($count >= 5) {
            break;
        }

        echo "<div class='container-vagas'>";
        echo "<div class='vagas'>";
        echo "Empresa: " . $row["empresa"] . "<br>";
        echo "Cargo: " . $row["cargo"] . "<br>";
        echo "</div>";
        echo "<div class='candidatar'>";
        echo "<form method='POST' action='vinculaUsuarioPagamento.php'>";
        echo "<input type='hidden' name='id_cadastro' value='$idUsuario'>";
        echo "<input type='hidden' name='id_vaga' value='" . $row['id'] . "'>";
        echo "<input type='submit' value='Candidatar' style='background:transparent; color:#033F63;border:none; cursor:pointer; font-size:15px'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";

        $count++;
    }
} else {
    echo "<div class='not-jobs'>Nenhuma vaga encontrada.</div>";
}

$conn->close();
?>
</section>

</main>



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
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
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
 
  font-size:10px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  list-style: none;
  padding: 0;
  max-width:88px;
 
  display: none;
  z-index: 1;
}

.dropdown-menu li {
  padding: 10px 10px;
  color:#fff;
}

.dropdown-menu li:hover {
  
  color:#033F63;
  background-color: #f1f1f1;
}

.dropdown-menu li a:hover{
  color:#033F63;
 
}
a{color:white;}
.show {
  display: block;
}


body{
  
}
    main{display:flex;
        justify-content:space-around;
        background-image: url("../imagens/img.jpeg");
			background-repeat: no-repeat;
			background-size: cover;
      height:100vh;
      opacity: 0.9;
       
       

    }

    .container-vagas{
        display:flex;
        flex-direction:column;

    }
    .vagas{
        display:flex;
        align-items:center;
        flex-direction:column;
        justify-content:center;
        text-align:center;
        width:300px;
        height:80px;
        margin: auto;
        border-top-left-radius:10px;
        border-top-right-radius:10px;
        background:white;

    }

    .candidatar{
        background:#FFA500;
        width:300px;
        height:40px;
        display:flex;
        justify-content:center;
        align-items:center;
        border-bottom-right-radius:10px;
        border-bottom-left-radius:10px;
        margin:auto;
        margin-bottom:20px;
        color: #033F63;
        
    }

    h1{text-align:center;
    color:white;
    margin:10px; 
 }

    .not-jobs{
        text-align:center;
        margin:100px auto;
        font-size: 26px;
        color: white;
        font-weight:600;
    }

 



</style>

