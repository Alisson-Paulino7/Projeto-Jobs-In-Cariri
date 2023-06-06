<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<?php

class Conexao {
    private $conexao;
    private $host = 'localhost';
    private $dbname = 'jobs';
    private $usuario = 'root';
    private $senha = '';
    
    public function conectar() {
        try {
            $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }
    
    public function fecharConexao() {
        $this->conexao = null;
    }
}


class Login {
    private $conexao;
    
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }


    public function logar($email, $senha) {
        $sql = "SELECT * FROM cadastro WHERE email = :email AND senha = :senha";
        
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            session_start();
            $_SESSION['user_id'] = $result['id'];

            echo"<div class='feito'>
            <h1>Login efetuado com sucesso!</h1>
            </div>";
            echo "<div class='container'>
            <img src='./imagens/sucesslogin.png' alt='' class='centered-image'></div>";
            echo "<script>setTimeout(function()
            {window.location.href='authenticated/home.php';}, 1500);
            </script>";

            
        } else {
            echo "<div class='feito'>
            <h1>Usuário ou senha incorretos!</h1>
            </div>";
            echo "<div class='container'>
            <img src='./imagens/errorlogin.png' alt='' class='centered-image'></div>";
            echo "<script>setTimeout(function()
            {window.location.href='login.php';}, 1500);
            </script>";
        }
        
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados foram preenchidos
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $conexao = new Conexao();
        #$logando = new login($conexao->conectar());
        $db = $conexao->conectar();

        $logando = new Login($db);
        $logando->logar($email, $senha);

        $conexao->fecharConexao();
    } else {
        echo 'Por favor, preencha todos os campos do formulário.';
    }
} else {
    echo 'O formulário não foi enviado.';
}


?>

<style>
.feito {
    display: flex;
    justify-content: center;
    color: #457b9d;
    list-style: none;
    font-family: Roboto;
    padding-top: 100px;

}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
}

.centered-image {
    width: 400px;
    max-width: 100%;
    max-height: 100%;
}

body {
    background: #edede9;
}


</style>
