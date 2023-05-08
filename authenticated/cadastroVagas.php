<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastroVagas.css">
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
  <a href="#"><li>Editar perfil</li></a>
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
<main>
    <h1>Publique sua vaga</h1>
    <p>Preencha o formulário abaixo</p>
    <form action="validaCadastroVagas.php" method="POST" onSubmit="return validarFormulario()">
        <div class="container">
        <label for="empresa">Empresa / Local</label>
        <input type="text" placeholder="Digite o nome da empresa ou local de trabalho..." name="empresa" required></div>
        <div class="container">
        <label for="cargo">Cargo / Função</label>
        <input type="text" placeholder="Digite uma profissão..." name="cargo" required></div>
        <div class="container">
        <label for="telefone">Telefone</label>
        <input type="number" placeholder="Digite um telefone para contato..." name="telefone" required></div>
        <div class="container">
        <label for="Email">Email</label>
        <input type="email" placeholder="Digite um email..." name="email" required></div>
        <div class="container">
        <label for="requisitos">Requisitos</label>
        <input type="text" placeholder="Digite os requisitos caso seja necessários..." name="requisitos" required></div>
        <div class="container">
        <label for="beneficios">Benefícios</label>
        <input type="text" placeholder="Digite os benefícios caso tenha ...." name="beneficios" required></div>
        <input type="submit" value="Solicitar divulgação" onClick="validarFormulario()">
    </form>
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

</style>