<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Azure SQL Database connection
    $servername = "tcp:onilnebooksseerver.database.windows.net,1433";
    $username = "azure";
    $dbPassword = "Book@123";
    $dbname = "booksdb";

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

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $params = array($name, $email, $hashedPassword);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        echo "Registration successful!";
    } else {
        echo "Error: ";
        print_r(sqlsrv_errors());
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
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
    <p><a href="login.php">Already have an account? Login here.</a></p>
</body>
</html>
