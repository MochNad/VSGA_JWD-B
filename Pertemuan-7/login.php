<?php
session_start();

// Cek apakah pengguna sudah login, jika ya, alihkan ke halaman lain
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Mengecek kecocokan email di database
    $sql = "SELECT id, email, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Memverifikasi password yang diinputkan
        if ($password === $storedPassword) {
            // Buat session dan alihkan ke halaman welcome
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];

            // Set pesan sukses
            $successMessage = "Login berhasil";
            header("location: welcome.php");
            exit;
        } else {
            $errorMessage = "Email atau password yang Anda masukkan salah.";
        }
    } else {
        $errorMessage = "Email atau password yang Anda masukkan salah.";
    }
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="login">
                            <?php
                                if (isset($successMessage)) {
                                    echo '<div class="alert alert-success mt-3">' . $successMessage . '</div>';
                                } elseif (isset($errorMessage)) {
                                    echo '<div class="alert alert-danger mt-3">' . $errorMessage . '</div>';
                                }
                            ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button form="login" type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
