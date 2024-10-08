<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Azure SQL Database connection details
    $servername = "tcp:onilnebooksseerver.database.windows.net,1433";
    $username = "azure";
    $password = "Book@123";
    $dbname = "ebook_database";

    // Connection options
    $connectionOptions = array(
        "Database" => $dbname,
        "Uid" => $username,
        "PWD" => $password,
        "Encrypt" => true,
        "TrustServerCertificate" => false
    );

    // Establish connection
    $conn = sqlsrv_connect($servername, $connectionOptions);

    // Check connection
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $params = array($name, $email, $subject, $message);

    // Execute the prepared query
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        echo "Message sent successfully!";
    } else {
        echo "Error: ";
        print_r(sqlsrv_errors());
    }

    // Free statement and close connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo "Invalid request method.";
}
?>
