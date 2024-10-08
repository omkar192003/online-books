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
    $sql = "INSERT INTO loginusers (name, email, password) VALUES (?, ?, ?)";
    $params = array($name, $email, $hashedPassword);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        // Redirect to the login page after successful registration
        header("Location: login.php");
        exit();
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        p {
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
        <p><a href="login.php">Already have an account? Login here.</a></p>
    </div>
</body>
</html>
