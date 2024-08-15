<?php
session_start();
include "koneksi.php";

// Pembatasan percobaan login
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Maksimum percobaan login
$max_attempts = 3;

// Durasi penguncian setelah percobaan gagal (dalam detik)
$lockout_time = 300; // 5 menit

// Cek apakah pengguna terkunci
if (isset($_SESSION['lockout_time']) && time() - $_SESSION['lockout_time'] < $lockout_time) {
    $remaining_time = $lockout_time - (time() - $_SESSION['lockout_time']);
    die("Akun Anda terkunci. Silakan coba lagi setelah " . ceil($remaining_time / 60) . " menit.");
}

if (isset($_POST['login'])) {
    // CAPTCHA sederhana
    if ($_POST['captcha'] != $_SESSION['captcha_code']) {
        echo "<p class='alert alert-danger' style='width:100%'>Captcha salah. Silakan coba lagi!</p>";
    } else {
        $nis = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_NUMBER_INT);
        $password_filtered = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = md5($password_filtered);

        $stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE nis=? and password=? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $nis, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $data = mysqli_fetch_assoc($result);
                $_SESSION["siswa"] = $data["id_siswa"];
                $_SESSION['login_attempts'] = 0; // Reset percobaan login
                header("location: home.php");
            } else {
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] >= $max_attempts) {
                    $_SESSION['lockout_time'] = time();
                    die("Terlalu banyak percobaan login. Akun Anda terkunci selama 5 menit.");
                } else {
                    echo "<p class='alert alert-danger' style='width:100%'>NIS atau Password salah. Silakan coba lagi!</p>";
                }
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}

// Membuat CAPTCHA sederhana
$captcha_code = rand(1000, 9999);
$_SESSION['captcha_code'] = $captcha_code;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Tes PHP</title>
  <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
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
        <h2 class="mt-5 center-heading">Selamat Datang di Aplikasi Tes PHP</h2>
        <p class="center-heading">Silahkan Login untuk menggunakan aplikasi ini.</p>
        <form action="" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">NIS</label>
            <input value="<?php if(isset($_POST['login'])){echo $_POST['nis'];} ?>" type="text" class="form-control" id="username" name="nis" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input value="<?php if(isset($_POST['password'])){echo $_POST['nis'];} ?>" type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="captcha" class="form-label">Masukkan kode berikut: <strong><?php echo $captcha_code; ?></strong></label>
            <input type="text" class="form-control" id="captcha" name="captcha" required>
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <div class="container">
      <p>Apep Wahyudin</p>
    </div>
  </footer>
</body>

</html>
