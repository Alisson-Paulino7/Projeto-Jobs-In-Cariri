<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   
    <title>Login</title>
</head>
<body>
    <main style="height: 100vh;"> 
    <div class="logo">
        <img src="./imagens/Logo.svg" alt="">
        <p>Jobs In Cariri</p>
        </div>  
        <form action="validaLogin.php" method="post">
    <h1>Login</h1>
    <p>Entre com seu e-mail e sua senha</p>
    <input type="text" name="email" placeholder="Digite seu email...">
    <input type="password" name="senha" placeholder="Digite sua senha...">
    <input type="submit" value="Entrar" onclick="login()">
</form>
  <p class="cadastro-login">Não tem uma conta?<a href="cadastro.php"> Crie aqui!</a></p>
  </main> 
  

</body>
</html>

<script>
function login() {
  var email = document.getElementsByName("email")[0].value;
  var senha = document.getElementsByName("senha")[0].value;

  if (email == "" || senha == "") {
    alert("Por favor, preencha todos os campos!");
    event.preventDefault();
  }
}
</script>
