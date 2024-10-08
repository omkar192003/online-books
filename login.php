<?php
session_start(); // Start session to manage user sessions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Azure SQL Database connection
    $servername = "tcp:onilnebooksseerver.database.windows.net,1433";
    $username = "azure";
    $dbPassword = "Book@123";
    $dbname = "ebook_database";

    // Connection options
    $connectionOptions = array(
        "Database" => $dbname,
        "Uid" => $username,
        "PWD" => $dbPassword,
        "Encrypt" => true,
        "TrustServerCertificate" => false
    );

    // Establish connection
    $conn = sqlsrv_connect($servername, $connectionOptions);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Query the user
    $sql = "SELECT * FROM users WHERE email = ?";
    $params = array($email);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    // Check password
    if ($user && password_verify($password, $user['password'])) {
        // Start a session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        echo "Login successful! Welcome, " . $_SESSION['user_name'];
    } else {
        echo "Invalid email or password.";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h1, h2 {
    color: #333;
}

form {
    background: #fff;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    background: #28a745;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #218838;
}

    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <p><a href="register.php">Don't have an account? Register here.</a></p>
</body>
</html>
