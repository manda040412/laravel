<?php
$db = mysqli_connect('localhost','root','','maxmovement');
if (!$db) {
    echo "Database connection failed";
}

// Ambil data dari request POST
$name = isset($_POST['name']) ? $_POST['name'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$religion = isset($_POST['religion']) ? $_POST['religion'] : '';
$institution = isset($_POST['institution']) ? $_POST['institution'] : '';
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
$field_of_expertise = isset($_POST['field_of_expertise']) ? $_POST['field_of_expertise'] : '';

// Lakukan validasi data jika diperlukan
// ...

// Lakukan pengecekan apakah username sudah ada
$sql = "SELECT * FROM registration WHERE username = '".$username."'";
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    // Jika username sudah ada, kirim respons error
    echo json_encode(["error" => "Username already exists"]);
} else {
    // Jika username belum ada, lakukan penyimpanan data
    $insert = "INSERT INTO registration (name, username, date_of_birth, address, religion, institution, phone_number, field_of_expertise) VALUES ('$name', '$username', '$date_of_birth', '$address', '$religion', '$institution', '$phone_number', '$field_of_expertise')";
    $query = mysqli_query($db, $insert);

    if ($query) {
        // Jika penyimpanan berhasil, kirim respons sukses
        echo json_encode(["success" => "Registration successful"]);
    } else {
        // Jika terjadi kesalahan saat penyimpanan, kirim respons error
        echo json_encode(["error" => "Failed to register"]);
    }
}

?>
