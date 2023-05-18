<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php"); 
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_POST['idUsuario'];
    $idVaga = $_POST['idVaga'];
    $formaPagamento = $_POST['formaPagamento'];
    $valorPagamento = $_POST['valorPagamento'];
    $dtPagamento = date('Y-m-d H:i:s'); 

    $sqlUpdate = "UPDATE pagamento SET forma_pagamento = '$formaPagamento', valor = '$valorPagamento', dtPagamento = '$dtPagamento' WHERE id_cadastro = '$idUsuario' AND id_vaga = '$idVaga'";
    $resultUpdate = $conn->query($sqlUpdate);

    if ($resultUpdate === TRUE) {
        $sqlInsertHistorico = "INSERT INTO historico (id_cadastro_user, id_vaga_user, forma_pagamento_user, valor_user, dtPagamento)
                               VALUES ('$idUsuario', '$idVaga', '$formaPagamento', '$valorPagamento', '$dtPagamento')";
        $resultInsertHistorico = $conn->query($sqlInsertHistorico);
    
        if ($resultInsertHistorico === TRUE) {
            echo "<h1>Pagamento efetuado com sucesso!</h1>";
        echo "<script>setTimeout(function(){window.location.href='pagamento.php';}, 3000);</script>";
        } else {
            echo "<h1>Erro ao inserir o pagamento no histórico: </h1>" . $conn->error;
            echo "<script>setTimeout(function(){window.location.href='pagamento.php';}, 3000);</script>";
        }
    } else {
        echo "<h1>Erro ao atualizar o pagamento: </h1>" . $conn->error;
        echo "<script>setTimeout(function(){window.location.href='pagamento.php';}, 3000);</script>";
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