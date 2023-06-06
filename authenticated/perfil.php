<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/ranking.css">
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
    
    <?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ..\login.php");
    exit;
}

$id_do_usuario = $_SESSION["user_id"];

$sql = "SELECT nome, sobrenome, email, endereco, cidade, celular, foto FROM `cadastro` WHERE id = $id_do_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $sobrenome = $row['sobrenome'];
        $email = $row['email'];
        $endereco = $row['endereco'];
        $cidade = $row['cidade'];
        $celular = $row['celular'];

        echo "<h1>Editar perfil</h1>
            <form method='POST' action='' enctype='multipart/form-data'>
                <div class='container-img'>
                    <div class='estilo'>
                        <div class='alteraft'>
                            <img src='img/{$row['foto']}' style='border-radius: 10px;' id='preview-img'>
                            <input type='file' name='foto' class='custom-file-input' id='foto' onchange='previewImage();'>
                        </div>
                        <div class='inf'>
                            <label for='nome'>Nome: $nome </label>
                            <input type='text' placeholder='Digite o novo nome' name='nome'>
                            <label for='sobrenome'>Sobrenome: $sobrenome</label>
                            <input type='text' placeholder='Digite o novo sobrenome' name='sobrenome'>
                            <label for='email'>Email: $email</label>
                            <input type='email' placeholder='Digite seu email' name='email'>
                            <label for='endereco'>Endereço: $endereco</label>
                            <input type='text' placeholder='Digite endereço' name='endereco'>
                            <label for='cidade'>Cidade: $cidade</label>
                            <input type='text' placeholder='Digite o nome da sua cidade' name='cidade'>
                            <label for='celular'>Telefone: $celular</label>
                            <input type='tel' placeholder='Digite o numero de telefone' name='celular'>
                        </div>
                    </div>
                </div>
                <input type='submit' value='Atualizar Foto' name='atualizar_foto' style='font-size: 20px; color:black; box-shadow:15px 15px rgba(0,0,0,0.5)'>
                <input type='submit' value='Atualizar cadastro' name='atualizar_cadastro' style='font-size: 20px; color:black; box-shadow:15px 15px rgba(0,0,0,0.5)'>
            </form>";

        if (isset($_POST['atualizar_cadastro'])) {
            if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['email']) && isset($_POST['endereco']) && isset($_POST['cidade']) && isset($_POST['celular'])) {
                $novoNome = $_POST['nome'];
                $novosobrenome = $_POST['sobrenome'];
                $novoEmail = $_POST['email'];
                $novoEndereco = $_POST['endereco'];
                $novaCidade = $_POST['cidade'];
                $novoCelular = $_POST['celular'];

                if (!empty($novoNome) && !empty($novosobrenome) && !empty($novoEmail)  && !empty($novoEndereco) && !empty($novaCidade) && !empty($novoCelular)) {
                  $sql = "UPDATE cadastro SET nome = '$novoNome', sobrenome  = '$novosobrenome', email = '$novoEmail', endereco = '$novoEndereco', cidade = '$novaCidade', celular = '$novoCelular' WHERE id = $id_do_usuario";
      

                if ($conn->query($sql) === TRUE) {
                    echo "Cadastro atualizado com sucesso.";
                    header("Location: home.php");
                } else {
                    echo "Erro ao atualizar cadastro: " . $conn->error;
                }
            } else {
                echo "Erro: Algum campo obrigatório não foi preenchido.";
            }
        }
    }
  }
}




if (isset($_POST['atualizar_foto'])) {
  // Verifica se o botão 'Atualizar Cadastro' foi acionado

  if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
      // Verifica se um arquivo de foto foi enviado e se não ocorreu nenhum erro durante o upload

      $foto = $_FILES["foto"]["tmp_name"];
      // Armazena o caminho temporário do arquivo de foto

      $target_dir = "img/";
      // Diretório de destino para onde o arquivo de foto será movido

      $new_file_name = uniqid() . "_" . $_FILES["foto"]["name"];
      // Gera um nome único para o arquivo de foto usando uniqid() e o nome original do arquivo

      $target_file = $target_dir . $new_file_name;
      // Caminho completo para o novo arquivo de foto

      move_uploaded_file($foto, $target_file);
      // Move o arquivo de foto do diretório temporário para o diretório de destino

      $sql = "UPDATE cadastro SET foto = '$new_file_name' WHERE id = $id_do_usuario";
      // Cria a consulta SQL para atualizar o campo de foto na tabela de cadastro

      if ($conn->query($sql) === TRUE) {
          // Executa a consulta SQL e verifica se a atualização foi bem-sucedida

          echo "Cadastro atualizado com sucesso!";
          // Exibe uma mensagem de sucesso

          header("Location: home.php");
          // Redireciona o usuário para a página home.php

          exit;
      } else {
          echo "Erro ao atualizar cadastro: " . $conn->error;
          // Exibe uma mensagem de erro, caso ocorra algum problema na atualização do cadastro
      }
  }
}




$conn->close();
?>

</body>

<script>
function previewImage() {
    var preview = document.querySelector('#preview-img');
    var file = document.querySelector('#foto').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>


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
*/
<style>
    header{
        background-color: white;
        
    margin-bottom: 50px;

    }
    h1{
      background: rgba(0,0,0,0.3);
    }
    .alteraft{
        display:column;
        
    }
    .alteraft input#foto{
     padding: 18px;
     margin-right: 80px;
    }
        .inf label{
            font-size: 20px;
            color:white;
            border: 0px solid;
            border-radius: 5px;
            margin-left: 20px;
            width: 500px;
            background: rgba(#fff, #fff, #fff, 0.5);
        }
        .inf input{
            font-size: 20px;
            color:black;
            border: 0px solid;
            border-radius: 5px;
            margin-top: 20px;
            margin: 20px;
            padding: 10px;
            width: 500px;
            background: whitesmoke;
        }
    .inf{
        display: flex;
            flex-direction: column;
            justify-content: space-around;
        margin-top: -1px;
        margin-left: -30px;
        border: 0px solid  #ff6600;
        border-radius: 20px;
        padding: 10px;
        background: rgba(#fff,#fff,#fff,0.5);
        padding-bottom: 20px;
        padding-right: 50px;
        padding-left: 30px;
    }
    .nome{
       text-align: center;
        border: 0px solid ;
        font-size:20px;
        font-weight: 400;
    }
    .estilo{
        border: 1px solid #ffe600 ;
        border-radius: 20px;
        background: rgba(0,0,0,0.3);
        
       
        padding-left: 30px;
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        
    }
    form{display:flex;
    justify-content:center;
    flex-direction:column;
    align-items:center;
    width:500px;
    color:white;
    margin:40px auto;}

    form input{
    width:400px;
    background:none;
    color:white;
    height:30px;}

    input[type='submit']{
    height:60px;
    width:250px;
    background: linear-gradient(to left,  #ff6600, #ffe600);
    margin-top: 80px;
    
}
    .container-inputs{
    display:flex;
    flex-direction:column;
    align-items:start;
    justify-content:flex-start;
    margin:10px;
    }
    .container-img{
        display:flex;
        flex-direction:column;
        align-items:left;
        justify-content:left;
        
    }

    .container-img img{
        width:220px;
        height:220px;
        border:0px solid;
       border-radius: 10px;
       margin-top: 50px;
       
    }

    h1{
        text-align:center;
    }
  
    .custom-file-input {
  color: #033f63;
  width:240px;
  height: 100px;
  margin-left: -17px;
  font-weight: bold;
  
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Adicione uma foto ao perfil';
  display: inline-block;
  border:none;
  background: whitesmoke;
  border: 1px solid grey;
  border-radius: 10px;
  padding: 15px;
  padding-right: 18px;
  outline: none;
  color:black;
  white-space: nowrap;
  cursor: pointer;
  font-size: 15px;
  
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active {
  outline: 0;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
}

body {
    font-family:Roboto;
  padding: 0px;
  background-image:url(../imagens/fundologin.svg);
  background-size:cover;
background-repeat: no-repeat;
}
body h1{
    color:white;
}


    .container-img {
        display: flex;
        flex-direction: column;
        align-items: left;
        margin-bottom: 20px;
       
    }

    .container-img img {
       
        margin-bottom: 10px;
    }

    .custom-file-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
    }

    .container-inputs {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .container-inputs label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .container-inputs input {
        border: none;
        border-bottom: 1px solid #ccc;
        padding: 5px;
        outline:none;
        font-size: 16px;
    }

    input[type='submit'] {
        background-color: white;
        color: #033f63;
        border: none;
        font-weight:600;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        padding: 10px 20px;
    }

   

</style>