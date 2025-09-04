<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) 
    {
        if (password_verify($password, $row['password'])) 
        {
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.php");
            exit();
        } 
        else 
        {
            echo "Invalid password";
        }
    } 
    else 
    {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
