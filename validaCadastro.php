<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados foram preenchidos
    if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['email']) && isset($_POST['senha'])
    && isset($_POST['cpf']) && isset($_POST['rg']) && isset($_POST['dtNascimento']) && isset($_POST['endereco'])
    && isset($_POST['cidade']) && isset($_POST['celular'])) {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $dtNascimento = $_POST['dtNascimento'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $celular = $_POST['celular'];



class Conexao {
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
}

class Usuario {
    private $conexao;
    
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function cadastrar($nome, $sobrenome, $email, $senha, $cpf, $rg, $dtNascimento, $endereco, $cidade, $celular) {
        $sql = "INSERT INTO cadastro (nome, sobrenome, email, senha, cpf, rg, dtNascimento, endereco, cidade, celular) 
        VALUES (:nome, :sobrenome, :email, :senha, :cpf, :rg, :dtNascimento, :endereco, :cidade, :celular)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':dtNascimento', $dtNascimento);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':celular', $celular);
        
        try {
            $stmt->execute();
            echo "<script>setTimeout(function(){window.location.href='login.php';}, 3000);</script>";
            echo "<div class='success'>Cadastro realizado com sucesso!</div>";
            echo "<div class='loader'></div>";
            echo "<div class='text'>Você será redirecionado para tela de login</div>";
        } catch (PDOException $e) {
            echo 'Erro ao cadastrar usuário: ' . $e->getMessage();
        }
    }
 
    public function listar() {
        $sql = "SELECT * FROM cadastro";
        
        $stmt = $this->conexao->prepare($sql);
        
        try {
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cadastro;
        } catch (PDOException $e) {
            echo 'Erro ao listar usuários: ' . $e->getMessage();
        }
    }
    
    public function atualizar($id, $nome, $senha, $cpf_cnpj, $contato) {
        $sql = "UPDATE cadastrp SET nome = :nome, senha = :senha, cpf_cnpj = :cpf_cnpj WHERE id = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $email);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt->bindParam(':contato', $contato);
        $stmt->bindParam(':id', $id);
        
        try {
            $stmt->execute();
            echo 'Usuário atualizado com sucesso!';
        } catch (PDOException $e) {
            echo 'Erro ao atualizar usuário: ' . $e->getMessage();
        }
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM cadastro WHERE id = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        try {
            $stmt->execute();
            echo 'Usuário excluído com sucesso!';
        } catch (PDOException $e) {
            echo 'Erro ao excluir usuário: ' . $e->getMessage();
        }
    }
}

class Validacao {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function checkEmail($email, $nome, $sobrenome, $senha, $cpf, $rg, $dtNascimento, $endereco, $cidade, $celular){
        $sql = "SELECT id FROM cadastro WHERE email = :email";
    
        $stmt = $this->conexao->prepare($sql);
        
        $stmt->bindValue(':email', $email);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "<div class='cadastrado'>E-mail já cadastrado!<button class='btn-cadastrado' onclick='window.history.back()'>Voltar</button></div>";
            echo "";
        } else {
            $cadastro = new Usuario($this->conexao);
            $cadastro->cadastrar($nome, $sobrenome, $email, $senha, $cpf, $rg, $dtNascimento, $endereco, $cidade, $celular);
        }
    }
}

$conexao = new Conexao();

$valida = new Validacao($conexao->conectar());

$valida->checkEmail($email, $nome, $sobrenome, $senha, $cpf, $rg, $dtNascimento, $endereco, $cidade, $celular);

    } else {
        echo 'Por favor, preencha todos os campos do formulário.';
    } 
} else {
    echo 'O formulário não foi enviado.';
}


?>


<style>
    .cadastrado{color:white;
    font-size:30px;
text-align:center;
margin:100px auto;
display:flex;
justify-content:center;
flex-direction:column;
align-items:center;
}
.btn-cadastrado{
    background:white;
    height:40px;
    width:150px;
    color:black;
    border:none;
    border-radius:10px;
    text-align:center;
    margin:40px auto;
    font-weight:600;
    
}
    body{background:black;}
    .loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    margin: 20px auto;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.success {
    font-size:30px;
    color: #00A6ED;
    padding: 10px;
    margin: 20px 0;
    text-align: center;
    margin-top:200px;
    font-weight:600;
    font-family:Roboto;
}

.text{
    font-size:30px;
    color: #00A6ED;
    padding: 10px;
    margin: 20px 0;
    text-align: center;
    margin-top:20px;
    font-weight:600;
    font-family:Roboto;
}

</style>
