<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Profissão</title>
</head>
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

      
      mysqli_close($conn);
    ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Cadastrar">
  </form>
</body>
</html>

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

body {
  font-family: Arial, sans-serif;
  color: #333;
}


h1, form {
  margin: 30px auto;
  max-width: 500px;
  display:flex;
  justify-content:center;
  align-items:center;
  flex-direction:column;
  color:#033F63;
  
}


input[type=submit] {
  background-color: #033F63;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


select {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 20px;
}


</style>