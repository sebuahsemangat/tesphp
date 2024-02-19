<?php
session_start();
include "koneksi.php";
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
      height: 100vh; /* Menggunakan 100% tinggi viewport */
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
        <?php
        //jika tombol login ditekan
        if(isset($_POST['login']))
        {
            $nis=addslashes($_POST['nis']); //input nis
            $password=addslashes(md5($_POST['password'])); //input password

            //query pencarian data berdasarkan nis dan password
            $qry=mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' and password='$password' LIMIT 1");

            //pecah menjadi data array
            $data=mysqli_fetch_assoc($qry);

            //hitung jumlah data
            $count=mysqli_num_rows($qry);
            
            //Cek jika jumlah data adalah 1
            if ($count == 1)
            {
                //buatkan session bernama siswa dengan nilai id_siswa
                $_SESSION["siswa"] = $data["id_siswa"]; //0 adalah index diambil dari field id_siswa di table siswa
                
                //Redirect ke halaman home.php
                header("location: home.php");
            }
            else
            {
                //jika data tidak ditemukan
                echo "<p class='btn btn-danger' style='width:100%'>NIS atau Password salah. Silahkan coba lagi!</p>";
            }
        }
        ?>
          <div class="mb-3">
            <label for="username" class="form-label">NIS</label>
            <input type="text" class="form-control" id="username" name="nis" required>
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
      <p>Apep Wahyudin</p>
    </div>
  </footer>
</body>
</html>