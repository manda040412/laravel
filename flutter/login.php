<?php
header('Content-Type: application/json');

// Establish database connection
$db = mysqli_connect('localhost', 'root', '', 'maxmovement');

// Check if the connection was successful
if (!$db) {
    echo json_encode(array("status" => "error", "message" => "Unable to connect to MySQL: " . mysqli_connect_error()));
    exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Hash the password before querying the database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare a parameterized query to prevent SQL injection
$sql = "SELECT * FROM users WHERE email = ?";

// Prepare the statement
$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "s", $email);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($result && $row = mysqli_fetch_assoc($result)) {
            // Debug: Output the input password and the password hash from the database
            error_log("Input password: " . $password);
            error_log("Database password hash: " . $row['password']);
            
            // Verify the hashed password
            if ($hashedPassword == $row['password']) {
                // Password is correct, login successful
                echo json_encode(array("status" => "success", "message" => "Login successful"));
            } else {
                // Password is incorrect
                echo json_encode(array("status" => "error", "message" => "Incorrect password"));
            }
        } else {
            // User not found
            echo json_encode(array("status" => "error", "message" => "User not found"));
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Error executing the statement
        echo json_encode(array("status" => "error", "message" => "Could not execute statement: " . mysqli_stmt_error($stmt)));
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // Error in preparing SQL statement
    echo json_encode(array("status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($db)));
}

// Close database connection
mysqli_close($db);
?>
