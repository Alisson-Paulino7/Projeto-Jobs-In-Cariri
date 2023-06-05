<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="..\imagens\Logo.svg" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../css/home.css">
  <title>Perfil</title>
</head>

<body>
  <header>
  <ul>
      <a href="../authenticated/home.php">
        <li>
          <img src="..\imagens\Logo.svg" alt="" class="logo"> JOBS IN CARIRI
        </li>
      </a>
      <a href="./ranking.php">
        <li>Ranking</li>
      </a>
      <a href="../authenticated/cadastroVagas.php">
        <li>Empresas</li>
      </a>
      <a href="../authenticated/editarPerfil.php">
        <li>Profissão</li>
      </a>

      <div class="dropdown">
        <li class="dropdown-btn">Perfil</li>
        <ul class="dropdown-menu">
          <a href="./perfil.php">
            <li>Editar perfil</li>
          </a>
          <a href="./pagamento.php">
            <li>Pagamentos</li>
          </a>
          <a href="..\login.php">
            <li>Sair</li>
          </a>
        </ul>
      </div>
</ul>

  </header>
</body>

</html>

<body>
  <h1>Cadastro de Profissão</h1>
  <form method="post">
    <label for="id_profissao">Selecione a profissão:</label>
    <select name="id_profissao">
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jobs";


      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
      }

      $sql = "SELECT id, nome FROM profissao";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $nome = $row["nome"];
        echo "<option value=\"$id\">$nome</option>";
      }

      $result = $conn->query($sql);
      $sqlprofissao = "SELECT nome FROM profissao";
      $resultprofissao = mysqli_query($conn, $sqlprofissao);

      $profissaoExibidas = array(); // Array para armazenar as cidades já exibidas

      while ($rowcidade = mysqli_fetch_assoc($resultprofissao)) {
        $nomeprofissao = strtolower($rowprofissao["nome"]);//Converte para minúsculo
        $nomeprofissao = ucfirst($nomeprofissao); // Torna a primeira letra maiúscula

        // Verifica se a cidade já foi exibida
        if (!in_array($nomeprofissao, $profissaoExibidas)) {
          echo "<option value=\"$nomeprofissao\">$nomeprofissao</option>";
          $profissaoExibidas[] = $nomeprofissao; // Adiciona a cidade ao array de cidades exibidas
        }
      }
      
      mysqli_close($conn);
      
      ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Cadastrar">
  </form>
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
<?php


session_start();


if (isset($_SESSION["user_id"])) {
  $id_do_usuario = $_SESSION["user_id"];
}

if (isset($_POST["submit"])) {

  $id_profissao = $_POST["id_profissao"];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jobs";


  $conn = new mysqli($servername, $username, $password, $dbname);


  if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
  }

  $sql = "UPDATE cadastro SET id_profissao = $id_profissao WHERE id = $id_do_usuario";
  if (mysqli_query($conn, $sql)) {
    echo "Profissão cadastrada com sucesso!";
    header("Location: home.php");
    exit();
  } else {
    echo "Erro ao cadastrar profissão: " . mysqli_error($conn);
  }


  mysqli_close($conn);
}
?>

<style>
  .dropdown {
    position: relative;
    display: inline-block;
  }

  .op {
    border-radius: 20px;
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

  header {
    padding-top: 5px;
    background-color: white;
  }

  body {
    font-family: Arial, sans-serif;
    color: #333;
    background-image: url(../imagens/fundologin.svg);
    background-size: cover;
    background-repeat: no-repeat;
  }

  form {
    border: 0px solid;
    border-radius: 10px;
    background-color: rgba(0, 0, 0, 0.3);
    padding: 20px;
    padding-bottom: 50px;

  }

  h1,
  form {
    margin: 30px auto;
    max-width: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: #033F63;
    border: 0px solid;
    border-radius: 10px;
    background-color: black;
    color: white;
    padding: 20px;
    margin-top: 100px;
    background-color: rgba(0, 0, 0, 0.4);
  }


  input[type=submit] {
    background: linear-gradient(to left,  #ff6600, #ffe600);
    color: black;
    padding: 20px;
    width: 160px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
  }

  label {
    color: white;
    font-size: 20px;
    margin: 20px;
    font-weight: bold;
  }

  select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 20px;
    font-size: 20px;
  }
</style>