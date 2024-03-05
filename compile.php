<style>
    /* CSS untuk animasi loading */
    .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
      margin: auto;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* CSS untuk konten halaman */
    .content {
      display: none; /* Sembunyikan konten ketika loading */
    }
</style>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
    // JavaScript untuk menampilkan konten setelah selesai loading
    document.addEventListener("DOMContentLoaded", function() {
      // Sembunyikan animasi loading
      document.getElementById("loader").style.display = "none";
      // Tampilkan konten halaman
      document.getElementById("content").style.display = "block";
    });
  </script>

<!-- Animasi loading -->
<div id="loader" class="loader"></div>

<div id="content" class="content">
<?php
session_start();
include "koneksi.php";
include "ld.php";
    if (!isset($_POST['code']) || $_POST['code'] =="")
    {
        echo "";
    }
    else {
        $code = $_POST['code'];
        $removePhpTag = str_replace(array("<?php","?>","<?="), "", $code);

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
            $jawabanBersih = str_replace(array(" ","\n","\r","\t"), "", $removePhpTag); //menghilangkan spasi, enter, dan tab

            //membaca semua jawaban berdasarkan id soal
            $qryJawaban = mysqli_query($koneksi, "SELECT * FROM jawaban WHERE id_soal = '$idSoal'");

            //Variabel untuk menampung nilai tertinggi
            $maxScore = PHP_INT_MIN;
            //cek kemiripan antara jawaban siswa dengan seluruh jawaban di database
            while($dataJawaban = mysqli_fetch_assoc($qryJawaban))
            {
              //cek kemiripan untuk setiap jawaban
              $similarity = round(similarity($jawabanBersih, $dataJawaban['jawaban_bersih']));
              
              if($similarity > $maxScore) {
                $maxScore = $similarity;
              }
              
            }
              
              // percabangan untuk warna latar kemiripan
              if ($maxScore >= 80 && $maxScore <= 100) {
                $bg = 'btn-success'; //warna hijau jika kemiripan >= 80%
              } else if ($maxScore >= 70 && $maxScore < 80) {
                $bg = 'btn-warning'; //warna kuning jika kemiripan >= 70%
              }
              else {
                $bg = 'btn-danger'; //warna merah jika kemiripan < 70%
              }
              //tampilkan kemiripan
              echo "Nilai jawaban: "."<span class='btn $bg'>".$maxScore."</span><br>";
              
            ?> 

            <form action="simpan_nilai.php" method="post"> 
              <input type="hidden" name="id_soal" value="<?= $idSoal;?>">
              <input type="hidden" name="nilai" value="<?= $maxScore;?>">
              <textarea style="display:none;" name="jawaban" id="" cols="30" rows="10"><?= $code;?></textarea>
              <input type="submit" value="Kirim Jawaban" class="btn btn-warning btn-md mt-2">
            </form>
        </div>
    </div>
    <?php
    }
    ?>

</div>