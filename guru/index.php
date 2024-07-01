<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php"); // Redirect ke halaman home jika sudah login
    exit;
}
include "../koneksi.php"; 
// Fungsi untuk membersihkan input
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru | Tes PHP</title>
    <link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css">
    <style>
        /* CSS untuk menengahkan heading */
        .center-heading {
            text-align: center;
        }
        /* CSS untuk menengahkan secara vertikal dan horizontal */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Menggunakan 100% tinggi viewport */
        }
        footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row center-container">
            <div class="col-md-6">
                <h2 class="mt-5 center-heading">Hallo Bapak/Ibu Guru Hebat!</h2>
                <p class="center-heading">Silahkan Login untuk menggunakan aplikasi ini.</p>
                <?php
                // Memeriksa apakah data dikirim melalui metode POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Mendapatkan data dari form dan membersihkan input
                    $username = cleanInput($_POST['username']);
                    $password = cleanInput($_POST['password']);

                    // Menggunakan prepared statements untuk menghindari SQL Injection
                    $stmt = $koneksi->prepare("SELECT id_guru, password FROM guru WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->store_result();

                    // Memeriksa apakah query mengembalikan baris data
                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id_guru, $hashed_password);
                        $stmt->fetch();

                        // Verifikasi password
                        if (password_verify($password, $hashed_password)) {
                            // Simpan username dan id_guru ke dalam session
                            $_SESSION['username'] = $username;
                            $_SESSION['id_guru'] = $id_guru;

                            // Redirect ke halaman home
                            header("Location: home.php");
                            exit;
                        } else {
                            echo "Username atau password salah";
                        }
                    } else {
                        echo "Username atau password salah";
                    }

                    // Menutup statement
                    $stmt->close();

                    // Menutup koneksi database
                    $koneksi->close();
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>Created by Apep Wahyudin</p>
        </div>
    </footer>
</body>
</html>
