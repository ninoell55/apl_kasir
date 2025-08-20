<?php
include "../../connection/conn.php"; // koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password di database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Jika berhasil login, langsung redirect
        header("Location: ../../pages/users/dashboard.php");
        exit;
    } else {
        echo "<p style='color:red;'>Username atau password salah!</p>";
    }
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

<div class="card">
    <h1>Register</h1>
    <p>Caffe Member</p>

    <form action="" method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>



</body>
</html>
