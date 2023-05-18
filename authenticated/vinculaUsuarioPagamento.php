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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $idUsuario = $_POST['id_cadastro'];
    $idVaga = $_POST['id_vaga'];

    
    $checkQuery = "SELECT * FROM pagamento WHERE id_cadastro = '$idUsuario' AND id_vaga = '$idVaga'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<h1>Inscrição já foi realizada</h1>";
        echo "<script>setTimeout(function(){window.location.href='home.php';}, 3000);</script>";
    } else {
        
        $sql = "INSERT INTO pagamento (id_cadastro, id_vaga)
                VALUES ('$idUsuario', '$idVaga')";

        if ($conn->query($sql) === TRUE) {
            echo "<h1>Inscrição realizada com sucesso</h1>";
            echo "<script>setTimeout(function(){window.location.href='home.php';}, 3000);</script>";
        } else {
            echo "<h1>Erro ao realizar sua inscrição</h1> " . $conn->error;
            echo "<script>setTimeout(function(){window.location.href='home.php';}, 3000);</script>";
        }
    }
}


?>


<style>
body{
    background:#033F63;
    font-family:roboto;
}

h1{
    text-align:center;
    margin:200px auto;
    color:white;
}

</style>