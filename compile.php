<style>
    .hasil {
        width:90%;
        border: solid 1px grey;
        padding: 10px;
        background-color: #abfcff;
    }
</style>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include "koneksi.php";
    if (!isset($_POST['code']) || $_POST['code'] =="")
    {
        echo "";
    }
    else {
        $code = $_POST['code'];
        $removePhpTag = str_replace(array("<?php","?>"), "", $code);

        //mengeksekusi kode php
        set_time_limit(5);
        echo "<div class='alert alert-success' role='alert'><strong>Output : </strong>";
		          eval($removePhpTag);
        echo "</div>"; 
?>
    <div class="row">
        <div class="col">
            <?php
            $idSoal = $_POST['id_soal'];
            
            $sqlSoal = "SELECT * FROM soal WHERE id_soal = $idSoal LIMIT 1";
            $querySoal = mysqli_query($konek, $sqlSoal);
            $dataSoal = mysqli_fetch_assoc($querySoal);
            // echo $dataSoal['jawaban'];
            $jawabanBersih = str_replace(array(" ","\n","\r","\t"), "", $removePhpTag); //menghilangkan spasi, enter, dan tab
            $jawaban = $dataSoal['jawaban'];
            // echo $jawabanBersih;

            // mengecek kemiripan dengan soal
            function similarity($str1, $str2) {
                $len1 = strlen($str1);
                $len2 = strlen($str2);
                
                // Membuat matriks untuk menyimpan jarak antara karakter-karakter di kedua string
                $matrix = array();
                for ($i = 0; $i <= $len1; $i++) {
                  $matrix[$i] = array();
                  for ($j = 0; $j <= $len2; $j++) {
                    $matrix[$i][$j] = 0;
                  }
                }
                
                // Mengisi matriks dengan jarak antara karakter-karakter di kedua string
                for ($i = 0; $i <= $len1; $i++) {
                  $matrix[$i][0] = $i;
                }
                for ($j = 0; $j <= $len2; $j++) {
                  $matrix[0][$j] = $j;
                }
                for ($i = 1; $i <= $len1; $i++) {
                  for ($j = 1; $j <= $len2; $j++) {
                    $cost = ($str1[$i-1] == $str2[$j-1]) ? 0 : 1;
                    $matrix[$i][$j] = min(
                      $matrix[$i-1][$j] + 1,
                      $matrix[$i][$j-1] + 1,
                      $matrix[$i-1][$j-1] + $cost
                    );
                  }
                }
                
                // Menghitung persentase kemiripan antara kedua string
                $maxLen = max($len1, $len2);
                $similarity = ($maxLen - $matrix[$len1][$len2]) / $maxLen * 100;
                return $similarity;
              }
              
              // Contoh penggunaan
              $str1 = $jawabanBersih;
              $str2 = $jawaban;
              $similarity = round(similarity($str1, $str2));
              // percabangan untuk warna latar kemiripan
              if ($similarity >= 80 && $similarity <= 100) {
                $bg = 'btn-success';
              } else if ($similarity >= 70 && $similarity < 80) {
                $bg = 'btn-warning';
              }
              else
              {
                $bg = 'btn-danger';
              }
              
              echo "Kemiripan dengan jawaban adalah: "."<span class='btn $bg'>".$similarity."%</span>";
            ?> 
        </div>
    </div>
    <hr>
    <h4>Apakah jawaban sudah benar? Silahkan masukkan nama dan kelas kemudian klik Kirim Jawaban</h4>
    <form action="simpan.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input class="form-control" type="text" name="nama" id="" required></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <select class="form-control custom-select" name="kelas" id="">
                        <option value="x7">X-RPL-7</option>
                        <option value="x8">X-RPL-8</option>
                        <option value="acp">X-ACP</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button class="btn btn-md btn-primary" type="submit">Kirim Jawaban</button></td>
            </tr>
        </table>
        <textarea name="hasil" id="" style="display:none"><?php echo $code;?></textarea>
        <input type="hidden" name="id_soal" id="" value="<?php echo $_POST['id_soal']?>">
        <input type="hidden" name="nilai" value="<?= $similarity;?>">
    </form>
    <?php
    }
    ?>