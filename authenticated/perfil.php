<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Perfil</title>
</head>
<body>
    <h1>Editar perfil</h1>
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

$sql = "SELECT * FROM `cadastro` WHERE id = $id_do_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form method='POST' action='' enctype='multipart/form-data'>
            <div class='container-img'>
                <img src='img/{$row['foto']}' style='border-radius: 100%;' id='preview-img'>
                <input type='file' name='foto' class='custom-file-input' id='foto' onchange='previewImage();'></div>
            <input type='submit' value='Atualizar cadastro' name='atualizar_cadastro'>
        </form>";
    }
}


if (isset($_POST['atualizar_cadastro'])) {
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $foto = $_FILES["foto"]["tmp_name"];
        $target_dir = "img/";
        $new_file_name = uniqid() . "_" . $_FILES["foto"]["name"];
        $target_file = $target_dir . $new_file_name;
        move_uploaded_file($foto, $target_file);
        $sql = "UPDATE cadastro SET foto = '$new_file_name' WHERE id = $id_do_usuario";
        if ($conn->query($sql) === TRUE) {
            echo "Cadastro atualizado com sucesso!";
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao atualizar cadastro: " . $conn->error;
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



<style>
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
    height:40px;
    width:250px;
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
        align-items:center;
        justify-content:center;

    }

    .container-img img{
        width:180px;
        height:180px;
        border-radius:100%;
    }

    h1{
        text-align:center;
    }
  
    .custom-file-input {
  color: #033f63;
  margin:auto;
  width:190px;
  margin:30px;
  margin-left:30px;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Adicione uma foto ao perfil';
  display: inline-block;
  border:none;
  background:white;
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  color:#033f63;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  
  font-size: 10pt;
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
  padding: 20px;
  background:#033f63;
}
body h1{
    color:white;
}

<style>
    .container-img {
        display: flex;
        flex-direction: column;
        align-items: center;
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
</style>