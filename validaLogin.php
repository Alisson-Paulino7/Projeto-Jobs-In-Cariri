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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM cadastro WHERE email = ? AND senha = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Falha na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $senha);

    if ($stmt->execute()) {
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            $_SESSION['user_id'] = $row['id']; 

            header("Location: authenticated/home.php");
            exit();
            
        } else {
          
            echo "Usuário ou senha incorretos!";
            sleep(3); 
            header("Location: login.php");
            exit();
        }
        
    } else {
        echo "Erro ao buscar no banco de dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
