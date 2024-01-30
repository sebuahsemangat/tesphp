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
</head>
<body>
    <h2>Selamat Datang di Aplikasi Tes PHP</h2>
    <p>Silahkan Login untuk menggunakan aplikasi ini.</p>
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
                echo "NIS atau Password salah. Silahkan coba lagi!";
            }
        }
        ?>
        <table>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><input type="text" name="nis" id=""></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="Login" name="login"></td>
            </tr>
        </table>
    </form>
</body>
</html>