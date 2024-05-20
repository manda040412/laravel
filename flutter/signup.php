<?php
$db = mysqli_connect('localhost','root','','maxmovement');
if (!$db) {
    echo "Database connection failed";
}

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hash kata sandi sebelum menyimpannya
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE email = '".$email."'";
$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

if ($count == 1) {
    // User sudah ada
    $response = array("error" => "User already exists");
} else {
    // Insert pengguna baru
    $insert = "INSERT INTO users(email, password) VALUES ('".$email."','".$hashedPassword."')";
    $query = mysqli_query($db,$insert);
    if ($query) {
        // Pendaftaran berhasil
        $response = array("success" => "Signup successful");
    } else {
        // Gagal memasukkan pengguna baru
        $response = array("error" => "Failed to signup");
    }
}

// Kembalikan respons JSON
echo json_encode($response);
?>