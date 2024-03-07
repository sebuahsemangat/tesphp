<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: home.php"); // Redirect ke halaman home jika sudah login
  exit;
}
include "../koneksi.php";
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
        // Memeriksa apakah pengguna sudah login sebelumnya
        if (isset($_SESSION['username'])) {
          header("Location: home.php"); // Redirect ke halaman home jika sudah login
          exit;
        }

        // Memeriksa apakah data dikirim melalui metode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Mendapatkan data dari form
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          // Melakukan query untuk memeriksa apakah username dan password cocok
          $query = mysqli_query($koneksi, "SELECT * FROM guru WHERE username='$username' AND password='$password'");

          //data
          $data_guru = mysqli_fetch_assoc($query);

          // Memeriksa apakah query mengembalikan baris data
          if (mysqli_num_rows($query) == 1) {
            // Jika data ditemukan, simpan username ke dalam session
            $_SESSION['username'] = $username;
            $_SESSION['id_guru'] = $data_guru['id_guru'];

            // Redirect ke halaman home
            header("Location: home.php");
            exit;
          } else {
            // Jika data tidak ditemukan, tampilkan pesan error
            echo "Username atau password salah";
          }

          // Menutup koneksi database
          mysqli_close($koneksi);
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