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
              echo "Kemiripan dengan jawaban adalah: "."<span class='btn $bg'>".$maxScore."%</span><br>";
              
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