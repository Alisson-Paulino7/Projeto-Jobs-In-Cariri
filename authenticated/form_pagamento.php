<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idUsuario = $_GET['id_cadastro'];
    $idVaga = $_GET['id_vaga'];

    $sql = "SELECT * FROM cadastro c INNER JOIN pagamento p ON c.id = p.id_cadastro INNER JOIN vagas v ON v.id = p.id_vaga   WHERE c.id = '$idUsuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeUsuario = $row['nome'];
        $cargo = $row['cargo'];
        $empresa = $row['empresa'];
    } else {
        $nomeUsuario = "Usuário não encontrado";
    }
} else {
    $nomeUsuario = "Nenhum usuário selecionado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
</head>
<body>
<h1>Pagamento</h1>
    <section>
    <form action="validaForm_pagamento.php" method='POST'> 
        <div class='card-pagamento'>
        <div class="container">
            <p>Profissional: <?php echo $nomeUsuario; ?></p>
            <p>Empresa: <?php echo $empresa; ?></p>
            <p>Cargo: <?php echo $cargo; ?></p>
            </div>
            <img src="..\imagens\correto(1) 1.png" alt="">
        </div>
        
        
        <div class='card-forma-pagamento'>
    <div class='tipo-pagamento'>
        <input type="radio" id="pix" name="formaPagamento" value="PIX" onclick="limitarSelecao(this)">
        <label for="pix">PIX</label>
    </div>
    <div class='tipo-pagamento'>
        <input type="radio" id="debito" name="formaPagamento" value="Débito" onclick="limitarSelecao(this)">
        <label for="debito">Débito</label>
    </div>
    <div class='tipo-pagamento'>
        <input type="radio" id="dinheiro" name="formaPagamento" value="Dinheiro" onclick="limitarSelecao(this)">
        <label for="dinheiro">Dinheiro</label>
    </div>
</div>
<div class="valorPagamento">
<input type="text" name="valorPagamento" id="valorPagamento" placeholder="Digite o valor do pagamento">
<div class="container-btns">
<input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
<input type="hidden" name="idVaga" value="<?php echo $idVaga; ?>">
    <button><a href='pagamento.php' style='text-decoration:none; color:black'>Voltar</a></button>
    <input type="submit" value="Confirmar pagamento">
</div>
</div>
</form>
    </section>
</body>
</html>
<script>
    function limitarSelecao(radioButton) {
        const radioButtons = document.querySelectorAll('input[name="formaPagamento"]');
        radioButtons.forEach((rb) => {
            if (rb !== radioButton) {
                rb.checked = false;
            }
        });
    }

    const input = document.getElementById('valorPagamento');

  input.addEventListener('input', function() {
    const numericValue = this.value.replace(/\D/g, '');
    this.value = numericValue;
  });

</script>
<style>
    *{
        padding:0;
        margin:0;
        box-sizing:border-box; 
    }
body{
    background:#033F63;
    font-family:roboto;
}
h1{
    color:white;
    text-align:center;
    font-size:30px;
    margin:20px;
}
section{
    background:#DADADA;
    display:flex;
    flex-direction:column;
    align-items:center;
    width:65%;
    margin:100px auto;
    padding:20px;
    border-radius:20px;
}
.card-pagamento{
    width:400px;
    background:white;
    height:200px;
    display:flex;
    border-radius:10px;
    margin:20px;
    align-items:center;
    justify-content:space-around;
}

.container p{
    padding:5px;
    font-weight:600;
}

.card-pagamento img{
    width:110px;
    height:110px;
}
.card-forma-pagamento{
    display:flex;
    background:white;
    width:400px;
    border-radius:10px;
    justify-content:center;
    margin:20px;
}

.tipo-pagamento{
    margin:20px;
}

.valorPagamento{
    background:white;
    width:400px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:10px;
    margin:20px;
    border-radius:10px;
    align-items:center;
}

input[type=text]{
    height:40px;
    outline:none;
    color:green;
    font-weight:600;
    width:300px;
    padding-left:5px;
    border-radius:6px;
    border:1px solid #D9D9D9;
}

.container-btns{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px;
    width:300px;
}

.container-btns button{
    width:100px;
    height:30px;
    background:#D9D9D9;
    border-radius:10px;
    border:none;
    cursor:pointer;
    font-weight:600;
}
.container-btns input[type=submit]{
height:30px;
border-radius:10px;
border:none;
background: #039000;
color:white;
width:60%;
font-weight:600;
cursor:pointer;


}
</style>