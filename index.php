<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleHome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Jobs In Cariri</title>
</head>

<body style="background-image:url('https://i.ibb.co/cJgW1Zy/Adobe-Stock-352915097-1.png');  background-repeat: no-repeat;
;     background-size: cover;">
<header style="background:white; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
        <ul class='logo'>
            <li><img src=".\imagens\Logo.svg" alt="" style="width:30px"></li>
        </ul>
        <ul class='btns-header'>
            <li>Candidaturas</li>
            <li>Empresas</li>
            <li>Publicar vaga</li>
        </ul>
        <ul class='container-cadastro'>
            <li style='color:#FFA500; text-decoration:none;'><a style="text-decoration:none;color:#FFA500;"href="./login.php">Login</a></li>
            <li><a style="text-decoration:none;color:#033F63;" href="./cadastro.php">Cadastro</a></li>
        </ul>
    </header>
    
    <main >
        <div class="title">
        <h1 style='font-weight:300;'>Conectando talentos a oportunidades</h1>
        <h1 style='font-weight:600;'>Encontre sua vaga de emprego</h1>
        </div>
        <form action="get">
            <input type="text" name='vagas' placeholder='Pelo que procura? Digite aqui...'>
            <input type="text" name='local' placeholder='Onde? Qual cidade?'>
            <input type="submit" name="buscar" id="" value='Pesquisar' class='pesquisar'>
        </form>
    </main>
</body>
</html>