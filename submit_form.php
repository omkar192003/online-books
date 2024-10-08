<?php
// Database credentials
$servername = "tcp:onilnebooksseerver.database.windows.net,1433";
$username = "azure";
$password = "Book@123";
$dbname = "booksdb";

// Connection options
$connectionOptions = array(
    "Database" => $dbname,
    "Uid" => $username,
    "PWD" => $password,
    "Encrypt" => true,
    "TrustServerCertificate" => false
);

// Establishes the connection to Azure SQL Database
$conn = sqlsrv_connect($servername, $connectionOptions);

// Check connection
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['ebook-form-name'];
    $email = $_POST['ebook-email'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    $params = array($name, $email);
    
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        echo "New record created successfully";
    } else {
        echo "Error: ";
        print_r(sqlsrv_errors());
    }

    sqlsrv_free_stmt($stmt);
}

// Close connection
sqlsrv_close($conn);
?>
